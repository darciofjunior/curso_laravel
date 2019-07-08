<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsegined();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('tipo', ['E', 'S', 'T']);
            $table->double('saldo', 10, 2);
            $table->double('total_antes', 10, 2);
            $table->double('total_depois', 10, 2);
            $table->integer('user_id_transaction')->nullable();
            $table->date('data');
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
        Schema::dropIfExists('historicos');
    }
}
