<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_versements', function (Blueprint $table) {
            $table->id();

            $table->string('code')->nullable();
            $table->string('nom_deposant')->nullable();
            $table->string('objet_versement')->nullable();
            $table->string('motif_versement')->nullable();
            $table->float('montant')->nullable();
            $table->date('date_versement')->nullable();

            $table->foreignId('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('bon_versements');
    }
};
