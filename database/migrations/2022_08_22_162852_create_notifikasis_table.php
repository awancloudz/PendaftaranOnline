<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->dateTime('transaction_time');
            $table->string('transaction_status');
            $table->string('transaction_id');
            $table->string('status_message');
            $table->string('signature_key');
            $table->string('payment_type');
            $table->string('order_id');
            $table->string('gross_amount');
            $table->string('fraud_status')->nullable();
            $table->string('bank')->nullable();
            $table->string('va_number')->nullable();
            $table->string('permata_va_number')->nullable();
            $table->string('store')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('approval_code')->nullable();
            $table->string('issuer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifikasis');
    }
}
