<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_add_role_to_users_table.php

public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Menambahkan kolom 'role' dengan tipe enum
        // Peran yang diizinkan: 'admin', 'pemilik_usaha', 'user'
        // Nilai default saat user baru dibuat adalah 'user'
        $table->enum('role', ['admin', 'pemilik_usaha', 'user'])->default('user')->after('email');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
