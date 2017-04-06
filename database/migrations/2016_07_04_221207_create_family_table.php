<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('familiars', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('first_name');            
            $table->string('last_name');
            $table->boolean('deceased');
            $table->string('title');
            $table->string('employer');
            $table->string('industry');
            $table->string('city'); 
            $table->string('siblings'); 

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
