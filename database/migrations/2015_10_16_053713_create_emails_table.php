<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->enum('list', array('white_list', 'black_list'));
            $table->string('email');
            $table->timestamps();

            // http://laravel.io/forum/10-12-2014-two-field-in-combination-should-be-unique-in-database
            // http://laravel.com/api/5.1/Illuminate/Database/Schema/Blueprint.html#method_unique
            $table->unique(array('customer_id', 'email'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('emails');
    }
}
