<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableTransactionRequestUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_request_url', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("msisdn");
            $table->string("sender");
            $table->string("url")->nullable();
            $table->string("short_url")->nullable();
            $table->text('response')->nullable();
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
        Schema::drop('transaction_request_url');
    }
}
