<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('awards', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('title');            
            $table->string('description');
            $table->date('date');  

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
