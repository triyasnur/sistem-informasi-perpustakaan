<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (! Schema::hasColumn('books', 'kode_buku')) {
                $table->string('kode_buku')->nullable()->after('id');
            }

            if (! Schema::hasColumn('books', 'tahun')) {
                $table->year('tahun')->nullable()->after('penerbit');
            }
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'kode_buku')) {
                $table->dropColumn('kode_buku');
            }

            if (Schema::hasColumn('books', 'tahun')) {
                $table->dropColumn('tahun');
            }
        });
    }
};
