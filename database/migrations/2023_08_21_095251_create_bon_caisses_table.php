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

            $table->string('code')->nullable();
            $table->date('date_emission')->nullable();
            $table->float('montant_facture')->nullable();
            $table->float('montant_imposable')->nullable();
            $table->string('nature_retenue')->nullable();
            $table->float('taux_ab')->nullable();
            $table->float('montant_aib')->nullable();
            $table->float('montant_paye')->nullable();
            $table->float('avance_perçue')->nullable();
            $table->string('motif_operation')->nullable();
            $table->string('type')->nullable();
            // $table->string('executant');

            $table->foreignId('beneficiaire_id')->nullable();
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
