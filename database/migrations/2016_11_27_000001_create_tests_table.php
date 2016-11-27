<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$this->down();
		
		Schema::create('tests', function (Blueprint $table)
		{
			$table->increments('id');
			
			$table->json('json_col')->nullable();
			$table->jsonb('jsonb_col')->nullable();
			
			$table->timestamps();
			$table->softDeletes();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::disableForeignKeyConstraints();
		Schema::dropIfExists('tests');
		Schema::enableForeignKeyConstraints();
	}
}
