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
            // Drop the ENUM column
            $table->dropColumn('dt_trc_type');

            // Add the ENUM column with new values
            $table->enum('dt_trc_type', ['cash-in', 'cash-out'])->after('dt_trc_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ms_transactions', function (Blueprint $table) {
            $table->dropColumn('dt_trc_type');

            $table->enum('dt_trc_type', ['debit', 'credit'])->after('dt_trc_amount');
        });
    }
};
