<?php

namespace Tests\Unit\Guide;

use App\Services\Guide\UserGuideService;
use Tests\TestCase;

/**
 * Isi User Guide JARVIES: pasangan EN dan ID, front matter, gaya penulisan (tanpa em dash dan en dash),
 * tautan antartopik, gambar, dan aturan "tautan hanya ke topik yang terlihat oleh semua pembaca topik asal".
 */
class UserGuideContentTest extends TestCase
{
    private const EM = "\u{2014}";
    private const EN = "\u{2013}";

    private const PSEUDO = ['@customer', '@customer-admin', '@parent-customer', '@staff'];

    /** Kombinasi izin semu yang dapat dimiliki pengguna nyata. */
    private const READERS = [
        'customer member'       => ['@customer'],
        'customer admin'        => ['@customer', '@customer-admin'],
        'parent member'         => ['@customer', '@parent-customer'],
        'parent admin'          => ['@customer', '@customer-admin', '@parent-customer'],
        'staff'                 => ['@staff'],
    ];

    private function svc(): UserGuideService
    {
        return new UserGuideService();
    }

    public function test_every_english_topic_has_an_indonesian_pair_and_the_reverse(): void
    {
        $en = array_keys($this->svc()->loadFiles('en', true));
        $id = array_keys($this->svc()->loadFiles('id', true));
        sort($en);
        sort($id);

        $this->assertNotEmpty($en);
        $this->assertSame($en, $id, 'EN and ID topic keys differ');
    }

    public function test_front_matter_is_valid(): void
    {
        $chapters = array_keys(config('user_guide.chapters'));

        foreach (['en', 'id'] as $loc) {
            foreach ($this->svc()->loadFiles($loc, true) as $key => $t) {
                $this->assertMatchesRegularExpression('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $key, "$loc/$key key");
                $this->assertContains($t['chapter'], $chapters, "$loc/$key chapter");
                $this->assertNotSame('', trim($t['title']), "$loc/$key title");
                $this->assertNotSame('', trim($t['summary']), "$loc/$key summary");
                $this->assertNotNull($t['updated'], "$loc/$key updated");
                foreach ($t['requires'] as $req) {
                    $this->assertContains($req, self::PSEUDO, "$loc/$key requires $req");
                }
            }
        }

        $en = $this->svc()->loadFiles('en', true);
        $id = $this->svc()->loadFiles('id', true);
        foreach ($en as $key => $t) {
            $this->assertSame($t['chapter'], $id[$key]['chapter'], "$key chapter differs between languages");
            $this->assertSame($t['requires'], $id[$key]['requires'], "$key requires differs between languages");
            $this->assertSame($t['order'], $id[$key]['order'], "$key order differs between languages");
        }
    }

    public function test_no_em_or_en_dash_anywhere_in_the_guide(): void
    {
        $has = fn (string $s) => str_contains($s, self::EM) || str_contains($s, self::EN);

        foreach (['en', 'id'] as $loc) {
            foreach ($this->svc()->files($loc) as $f) {
                $this->assertFalse($has((string) file_get_contents($f)), "$loc/" . basename($f));
            }
        }
        foreach (glob(resource_path('guide/_*.md')) ?: [] as $f) {
            $this->assertFalse($has((string) file_get_contents($f)), basename($f));
        }
        $this->assertFalse($has(json_encode(config('user_guide'), JSON_UNESCAPED_UNICODE)), 'config user_guide');

        foreach (['en', 'id'] as $loc) {
            foreach ($this->svc()->topics($loc) as $key => $t) {
                $this->assertFalse($has($t['html'] . $t['title'] . $t['summary']), "$loc/$key (render)");
            }
        }
    }

    public function test_bodies_use_only_markdown_and_internal_links_and_images(): void
    {
        foreach (['en', 'id'] as $loc) {
            $keys = array_keys($this->svc()->loadFiles($loc, true));

            foreach ($this->svc()->loadFiles($loc, true) as $key => $t) {
                $body = preg_replace('/<!--.*?-->/s', '', $t['body']);

                $this->assertDoesNotMatchRegularExpression('/<\/?[a-z][^>]*>/i', $body, "$loc/$key raw HTML");
                $this->assertDoesNotMatchRegularExpression('/\]\(\s*(?:[a-z][a-z0-9+.\-]*:|\/\/)/i', $body, "$loc/$key external link");

                preg_match_all('/!\[([^\]]*)\]\(([^)\s]*)[^)]*\)/', $body, $images, PREG_SET_ORDER);
                foreach ($images as [$whole, $alt, $src]) {
                    $this->assertNotSame('', trim($alt), "$loc/$key image alt");
                    $this->assertMatchesRegularExpression('#^images/guide/[A-Za-z0-9._\-]+\.(?:png|jpg)$#', $src, "$loc/$key image path");
                    $this->assertFileExists(public_path($src), "$loc/$key image file");
                    $this->assertLessThanOrEqual(600 * 1024, filesize(public_path($src)), "$loc/$key image size");
                }

                preg_match_all('/\[\[([^\]|]+)(?:\|[^\]]*)?\]\]/', $body, $links);
                foreach (array_unique($links[1]) as $target) {
                    $this->assertNotSame($key, $target, "$loc/$key links to itself");
                    $this->assertContains($target, $keys, "$loc/$key links to missing topic $target");
                }
            }
        }
    }

    public function test_images_are_the_same_in_both_languages(): void
    {
        $en = $this->svc()->loadFiles('en', true);
        $id = $this->svc()->loadFiles('id', true);
        $imagesOf = function (string $body): array {
            preg_match_all('#\]\((images/guide/[^)\s]+)#', $body, $m);

            return $m[1];
        };

        foreach ($en as $key => $t) {
            $this->assertSame($imagesOf($t['body']), $imagesOf($id[$key]['body']), "$key images differ between languages");
        }
    }

    public function test_a_topic_never_links_to_a_topic_some_of_its_readers_cannot_see(): void
    {
        foreach (['en', 'id'] as $loc) {
            $topics = $this->svc()->topics($loc);

            foreach ($topics as $key => $t) {
                preg_match_all('/\[\[([^\]|]+)(?:\|[^\]]*)?\]\]/', $this->bodyOf($loc, $key), $links);

                foreach (self::READERS as $name => $perms) {
                    if (!isset($this->svc()->visible([$key => $t], [], $perms)[$key])) {
                        continue;
                    }
                    foreach (array_unique($links[1]) as $target) {
                        $this->assertArrayHasKey(
                            $target,
                            $this->svc()->visible($topics, [], $perms),
                            "$loc/$key shows to a $name but links to [[$target]], which that reader cannot see"
                        );
                    }
                }
            }
        }
    }

    public function test_every_account_type_gets_a_sensible_topic_set(): void
    {
        $topics = $this->svc()->topics('en');
        $visibleKeys = fn (array $perms) => array_keys($this->svc()->visible($topics, [], $perms));

        $member = $visibleKeys(['@customer']);
        $this->assertContains('create-ticket', $member);
        $this->assertContains('close-ticket', $member);
        $this->assertNotContains('staff-ticket-work', $member);
        $this->assertNotContains('tickets-for-end-customers', $member);

        $this->assertContains('tickets-for-end-customers', $visibleKeys(['@customer', '@parent-customer']));

        $staff = $visibleKeys(['@staff']);
        $this->assertContains('staff-ticket-work', $staff);
        $this->assertNotContains('create-ticket', $staff);
        $this->assertContains('about-jarvies', $staff);
    }

    private function bodyOf(string $loc, string $key): string
    {
        return $this->svc()->loadFiles($loc, true)[$key]['body'];
    }
}
