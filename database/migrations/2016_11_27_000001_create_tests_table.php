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
// 			$table->increments('id');
// 			$table->smallIncrements('smallIncrements');
// 			$table->mediumIncrements('mediumIncrements');
// 			$table->bigIncrements('bigIncrements');
			
			$table->bigInteger('bigInteger');
			$table->boolean('boolean');
			
			$table->char('char', 5);
			
			$table->dateTimeTz('dateTimeTz');
			$table->decimal('decimal');
			
			$table->enum('enum', []);
			
			$table->float('float');
			
			$table->integer('integer');
// 			$table->integer('integer_ai_unsigned', true, true);
			
			$table->longText('longText');
			
			$table->mediumInteger('mediumInteger');
			$table->mediumText('mediumText');
			
// 			$table->nullableTimestamps();
			
			$table->softDeletesTz();
			
			$table->timestampsTz('timestampsTz');
			$table->timeTz('timeTz');
			$table->tinyInteger('tinyInteger');
// 			$table->tinyInteger('tinyInteger_ai_unsigned', true, true);
			
			$table->unsignedSmallInteger('unsignedSmallInteger',true);
			$table->uuid('uuid');
			
			
			
// 			$table->json('json_col')->nullable();
// 			$table->jsonb('jsonb_col')->nullable();
			
// 			$table->timestamps();
// 			$table->softDeletes();
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
