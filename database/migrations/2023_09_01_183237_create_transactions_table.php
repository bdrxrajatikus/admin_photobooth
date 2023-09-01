<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('transaction_date');
            $table->string('phone_number');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('promo_code_id')->nullable();
            $table->decimal('final_price', 10, 2);
            $table->enum('status', ['success', 'pending', 'failed']);
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('promo_code_id')->references('id')->on('vouchers')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
