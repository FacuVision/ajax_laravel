<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->id();
            $table->string("cod_patrimonial")->nullable();
            $table->string("marca");
            $table->string("modelo");
            $table->text("descripcion");
            $table->unsignedBigInteger("computer_id");
            $table->timestamps();

            $table->foreign('computer_id')
            ->references('id')
            ->on('computers')
            ->onDelete('cascade')
            ->onUpdate('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitors');
    }
}
