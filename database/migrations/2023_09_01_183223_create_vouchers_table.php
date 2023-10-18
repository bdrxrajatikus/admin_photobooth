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
            $table->unsignedBigInteger('settings_id')->nullable();
            $table->string('promo_code')->unique();
            $table->string('promo_name');
            $table->text('description')->nullable();
            $table->integer('qty');
            $table->boolean('is_percentage');
            $table->date('expired_date')->nullable();
            $table->decimal('amount', 10, 2);
            $table->integer('usage')->default(0);
            $table->timestamps();

            $table->foreign('settings_id')->references('id')->on('settings');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
