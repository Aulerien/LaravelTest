<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pays',255);
            $table->string('couleur',255);
            $table->string('continent',255);
            $table->timestamps();
        });


            \Illuminate\Support\Facades\DB::table('pays')->insert(
                array('pays' => 'Bénin',
                    'couleur' => 'Vert Jaune Rouge',
                    'continent' => 'Afrique')
            );


            \Illuminate\Support\Facades\DB::table('pays')->insert(
                array('pays' => 'France',
                    'couleur' => 'Rouge Bleu Blanc',
                    'continent' => 'Europe')
            );


            \Illuminate\Support\Facades\DB::table('pays')->insert(
            array('pays' => 'Argentine',
                'couleur' => 'Blanc Bleu',
                'continent' => 'Amérique')
        );



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pays');
    }
}
