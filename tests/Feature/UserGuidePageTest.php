<?php

namespace Tests\Feature;

use Tests\TestCase;

/** Halaman /user-guide: harus login, dan isinya mengikuti jenis akun (izin semu dari sesi). */
class UserGuidePageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // JarviesAuth menyimpan hasil cek login di properti static selama satu proses.
        \App\Http\Middleware\JarviesAuth::resetCache();
    }

    private function asUser(array $user): array
    {
        return ['auth_token' => 'test-token', 'user' => $user + ['id' => 1, 'type' => 'customer']];
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/user-guide')->assertRedirect(route('login'));
    }

    public function test_customer_member_sees_customer_topics_only(): void
    {
        $res = $this->withSession($this->asUser(['role' => ['id' => 3, 'name' => 'Customer'], 'can_view_all_tickets' => false]))
            ->get('/user-guide?lang=en');

        $res->assertOk()
            ->assertSee('id="topic-create-ticket"', false)
            ->assertSee('id="topic-close-ticket"', false)
            ->assertDontSee('id="topic-staff-ticket-work"', false)
            ->assertDontSee('id="topic-tickets-for-end-customers"', false);
    }

    public function test_parent_customer_also_sees_the_end_customer_topic(): void
    {
        $this->withSession($this->asUser(['role' => ['id' => 3, 'name' => 'Customer'], 'is_parent_customer' => true]))
            ->get('/user-guide?lang=en')
            ->assertOk()
            ->assertSee('id="topic-tickets-for-end-customers"', false);
    }

    public function test_super_admin_sees_staff_topics_and_not_customer_only_ones(): void
    {
        $this->withSession($this->asUser(['role' => ['id' => 1, 'name' => 'Super Admin'], 'type' => 'employee']))
            ->get('/user-guide?lang=en')
            ->assertOk()
            ->assertSee('id="topic-staff-ticket-work"', false)
            ->assertDontSee('id="topic-create-ticket"', false)
            ->assertDontSee('id="topic-close-ticket"', false);
    }

    public function test_language_switch_serves_indonesian(): void
    {
        $this->withSession($this->asUser(['role' => ['id' => 3, 'name' => 'Customer']]))
            ->get('/user-guide?lang=id')
            ->assertOk()
            ->assertSee('Membuat ticket');
    }

    public function test_an_unknown_language_falls_back_to_english(): void
    {
        $this->withSession($this->asUser(['role' => ['id' => 3, 'name' => 'Customer']]))
            ->get('/user-guide?lang=xx')
            ->assertOk()
            ->assertSee('Create a ticket');
    }
}
