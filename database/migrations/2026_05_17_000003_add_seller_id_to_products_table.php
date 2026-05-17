<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            if (! Schema::hasColumn('products', 'seller_id')) {
                $table->foreignId('seller_id')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
            }
        });

        DB::table('products')
            ->whereNull('seller_id')
            ->whereNotNull('user_id')
            ->update(['seller_id' => DB::raw('user_id')]);
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            if (Schema::hasColumn('products', 'seller_id')) {
                $table->dropConstrainedForeignId('seller_id');
            }
        });
    }
};
