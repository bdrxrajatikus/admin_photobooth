<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('promo_code')->unique();
            $table->string('promo_name');
            $table->text('description')->nullable();
            $table->integer('qty');
            $table->boolean('is_percentage');
            $table->date('expired_date')->nullable();
            $table->decimal('amount', 10, 2);
            $table->integer('usage')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
