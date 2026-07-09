<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Isi submitted_by_name dari customer_contact.full_name
        // berdasarkan email_work = submitted_by_email
        // Hanya untuk ticket yang submitted_by_name masih null
        DB::statement("
            UPDATE ticket t
            INNER JOIN customer_contact cc
                ON LOWER(cc.email_work) = LOWER(t.submitted_by_email)
            SET t.submitted_by_name = cc.full_name
            WHERE t.submitted_by_name IS NULL
              AND t.submitted_by_email IS NOT NULL
              AND t.submitted_by_email != ''
              AND cc.full_name IS NOT NULL
              AND cc.full_name != ''
        ");
    }

    public function down(): void
    {
        // Tidak bisa di-rollback karena tidak tahu nilai sebelumnya
    }
};
