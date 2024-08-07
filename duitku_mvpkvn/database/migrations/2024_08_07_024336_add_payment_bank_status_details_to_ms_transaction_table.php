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
            $table->string('dt_trc_payment');
            $table->string('dt_trc_bank');
            $table->integer('dt_trc_transfer_amount')->default(0);
            $table->enum('dt_trc_status', ['SUCCESS', 'PENDING'])->default('PENDING');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ms_transactions', function (Blueprint $table) {
            $table->dropColumn('dt_trc_payment');
            $table->dropColumn('dt_trc_bank');
            $table->dropColumn('dt_trc_transfer_amount');
            $table->dropColumn('dt_trc_status');
        });
    }
};
