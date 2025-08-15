<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('link_shopee')->nullable()->after('image');
            $table->string('link_tokopedia')->nullable()->after('link_shopee');
            $table->string('link_fb_marketplace')->nullable()->after('link_tokopedia');
            $table->string('link_tanihub')->nullable()->after('link_fb_marketplace');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'link_shopee',
                'link_tokopedia',
                'link_fb_marketplace',
                'link_tanihub',
            ]);
        });
    }
};
