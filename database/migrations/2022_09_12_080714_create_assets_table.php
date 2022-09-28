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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->integer('crypto_id');
            $table->integer('cmc_rank');
            $table->string('symbol');
            $table->string('name');
            $table->double('price');
            $table->float('percent_change_1h');
            $table->float('percent_change_24h');
            $table->float('percent_change_7d');
            $table->double('market_cap');
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
        Schema::dropIfExists('assets');
    }
};
