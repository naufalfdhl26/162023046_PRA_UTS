<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            if (! Schema::hasColumn('products', 'nama_produk')) {
                $table->string('nama_produk')->nullable()->after('user_id');
            }

            if (! Schema::hasColumn('products', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('nama_produk');
            }

            if (! Schema::hasColumn('products', 'harga')) {
                $table->unsignedBigInteger('harga')->nullable()->after('deskripsi');
            }

            if (! Schema::hasColumn('products', 'stok')) {
                $table->unsignedInteger('stok')->default(0)->after('harga');
            }

            if (! Schema::hasColumn('products', 'gambar')) {
                $table->string('gambar')->nullable()->after('stok');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            foreach (['gambar', 'stok', 'harga', 'deskripsi', 'nama_produk'] as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
