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
        Schema::table('ms_transactions', function (Blueprint $table) {
            $table->integer('dt_trc_amount')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ms_transactions', function (Blueprint $table) {
            $table->decimal('dt_trc_amount', 10, 2)->change();
        });
    }
};
