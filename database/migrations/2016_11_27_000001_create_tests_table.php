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
			// bigint(20)
			$table->bigInteger('bigInteger')->default(0);
			
			// bigint(20)
// 			$table->bigIncrements('id');// AIなので主キーになる
			
			// int(11)
			$table->integer('integer')->default(0);
			
			// int(10) UNSIGNED
			$table->increments('id');// AIなので主キーになる
			
			// mediumint(9)
			$table->mediumInteger('mediumInteger')->default(0);
			
			// mediumint(8)
// 			$table->mediumIncrements('id');// AIなので主キーになる
			
			// smallint(6)
			$table->smallInteger('smallInteger')->default(0);
			
			// smallint(5) UNSIGNED
// 			$table->smallIncrements('smallIncrements');// AIなので主キーになる
			
			// smallint(5) UNSIGNED
// 			$table->unsignedSmallInteger('unsignedSmallInteger', true);// AIなので主キーになる
			
			// tinyint(4)
			$table->tinyInteger('tinyInteger')->default(0);
			
			// tinyint(3)
			$table->unsignedTinyInteger('unsignedTinyInteger')->default(0);
			
			// tinyint(1)
			$table->boolean('boolean')->default(false);
			
			// decimal(8,2) (8桁中小数点以下2桁)
			$table->decimal('decimal')->default(0.00);
			
			// double(8,2)(8桁中小数点以下2桁)
			$table->float('float', 10, 5)->default(12345.00001);
			
			// enum('') (文字列定数をリストする)
			$table->enum('enum', ['red', 'blue', 'yellow'])->nullable();
			
			// longtext
			$table->longText('longText')->nullable();
			
			// mediumtext
			$table->mediumText('mediumText')->nullable();
			
			// text
			$table->text('text')->nullable();
			
			// char(5) おそらく固定長
			$table->char('char', 5)->nullable();
			
			// varchar(255) おそらく可変長
			$table->string('string', 255)->nullable();
			
			// json
// 			$table->json('json_col')->nullable();
			
			// jsonb
// 			$table->jsonb('jsonb_col')->nullable();
			
			// datetime
			$table->dateTimeTz('dateTimeTz')->nullable();
			
			// time
			$table->timeTz('timeTz')->nullable();
			
			// char(36)
			$table->uuid('uuid')->default('uuid');// 用途不明、ユニークID?
			
			// timestamp(null許可) (created_at, updated_at)
			$table->timestampsTz('timestampsTz');
// 			$table->nullableTimestamps();
			
			// timestamp (created_at, updated_at)
// 			$table->timestamps();
			
			// timestamp(null許可) (deleted_at)
			$table->softDeletesTz();
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
