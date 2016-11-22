<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$this->down();
		
		Schema::create('users', function (Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->smallInteger('status')->default(1);
			$table->rememberToken();
			
			$table->string('confirmation_token')->nullable();	  // 認証用トークン
			$table->timestamp('confirmation_sent_at')->nullable(); // 認証メール送信日時
			$table->timestamp('confirmed_at')->nullable();		 // 承認日時
			
			$table->timestamps();
			$table->softDeletes();
			
			/**
			 * フィールド定義
			 */
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
		Schema::dropIfExists('users');
		Schema::enableForeignKeyConstraints();
	}
}
