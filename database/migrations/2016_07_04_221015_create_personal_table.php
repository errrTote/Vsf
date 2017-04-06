<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('personals', function (Blueprint $table) {
            $table->increments('id');                  
            $table->date('birth_date'); 
            $table->string('home_phone');
            $table->string('movil_phone');
            $table->enum('gender',['m', 'f']);            
            $table->string('permanent_postal_code');
            $table->string('permanent_address');
            $table->string('permanent_city'); 
            $table->string('birth_city');
            $table->string('residence_postal_code');
            $table->string('residence_address');
            $table->string('residence_city'); 

            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')
            ->onDelete('cascade')                              
            ->onUpdate('cascade'); 

            $table->integer('id_permanent_state')->unsigned();
            $table->foreign('id_permanent_state')->references('id')->on('states');

            $table->integer('id_residence_state')->unsigned();
            $table->foreign('id_residence_state')->references('id')->on('states');

            $table->integer('id_birth_state')->unsigned(); 
            $table->foreign('id_birth_state')->references('id')->on('states');
           
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
