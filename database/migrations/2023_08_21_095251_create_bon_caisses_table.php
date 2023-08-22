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
        Schema::create('bon_caisses', function (Blueprint $table) {
            $table->id();

            $table->string('code');
            $table->date('date_emission');
            $table->float('montant_facture');
            $table->float('montant_imposable');
            $table->string('nature_retenue');
            $table->float('taux_ab');
            $table->float('montant_aib');
            $table->float('montant_paye');
            $table->float('avance_perçue');
            $table->string('motif_operation');
            $table->string('type');
            // $table->string('executant');

            $table->foreignId('beneficiaire_id');
            $table->foreign('beneficiaire_id')
                ->references('id')
                ->on('beneficiaires')
                ->onDelete('cascade');

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
        Schema::dropIfExists('bon_caisses');
    }
};
