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
        Schema::create('invoice_user_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_session_id')->default(0);
            $table->unsignedBigInteger('invoice_user_id');
            $table->double('price')->default(0);
            $table->string('session_type');
            $table->unsignedBigInteger('invoice_id');
            $table->timestamps();
            $table->foreign('invoice_user_id')->references('id')->on('invoice_users')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_user_sessions');
    }
};
