<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwivelFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('swivel_features', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('slug')->unique();
            $table->string('buckets', 20)->default('');
            $table->timestamps();

            // key section
			$table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::dropIfExists('swivel_features');
    }
}
