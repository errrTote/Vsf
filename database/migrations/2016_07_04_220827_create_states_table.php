<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');                  
            $table->string('name'); 
            $table->integer('id_country')->unsigned(); 
            $table->foreign('id_country')->references('id')->on('countries');  
           
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
