<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEssayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('essay', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('essay');            
            $table->string('original_name');            
            

            $table->integer('id_user')->unsigned();  
            $table->foreign('id_user')
            ->references('id')->on('users')
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
