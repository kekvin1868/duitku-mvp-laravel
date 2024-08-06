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
        Schema::create('ms_transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('dt_trc_amount', 10, 2);
            $table->enum('dt_trc_type', ['debit', 'credit']);
            $table->text('dt_trc_description')->nullable();
            $table->text('dt_trc_invoice_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_transactions');
    }
};
