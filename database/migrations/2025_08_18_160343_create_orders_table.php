<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Pembeli (jika login)
            $table->foreignId('merchant_id')->references('id')->on('users')->onDelete('cascade'); // Merchant pemilik produk
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Produk yang dipesan

            // Info Pelanggan
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('customer_address')->nullable();

            // Info Pesanan
            $table->string('platform'); // Misal: 'whatsapp', 'shopee', 'manual'
            $table->integer('quantity')->default(1);
            $table->decimal('total_amount', 15, 2);
            $table->string('payment_proof')->nullable(); // Path bukti bayar untuk pesanan manual
            $table->enum('status', ['Baru', 'Diproses', 'Selesai', 'Dibatalkan'])->default('Baru');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
