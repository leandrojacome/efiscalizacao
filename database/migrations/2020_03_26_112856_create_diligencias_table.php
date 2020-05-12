<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDiligenciasTable.
 */
class CreateDiligenciasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('diligencias', function(Blueprint $table) {
            $table->increments('id');
			$table->cidade_id('int')->int();
			$table->observacao('string')->string();

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
		Schema::drop('diligencias');
	}
}
