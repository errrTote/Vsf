<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('educations', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('career');
            $table->string('name');
            $table->enum('type', ['p','s','h']);
            $table->string('period');
            $table->string('address');
            $table->string('city'); 

            $table->integer('id_state')->unsigned();
            $table->foreign('id_state')->references('id')->on('states');

            $table->integer('id_user')->unsigned(); 
            $table->foreign('id_user')->references('id')->on('users')
            ->onDelete('cascade')                              
            ->onUpdate('cascade'); 
           
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
        //
    }
}
