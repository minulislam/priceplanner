<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModulePricingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('module_pricings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('qty');
			$table->integer('module_id');
			$table->integer('pricing_id')->unsigned()->index();
			$table->foreign('pricing_id')->references('id')->on('pricings')->onDelete('cascade');

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
		Schema::drop('module_pricings');
	}

}
