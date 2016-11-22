<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();
		
		DB::table('users')->truncate();
		DB::table('users')->insert([
			[
				'id'		   => 1,
				'name'		 => 'test',
				'email'		=> 'test@user.jp',
				'password'	 => Hash::make('p1p1p1p1'),
				'status'	   => 1,
				'created_at'   => Carbon::now(),
				'updated_at'   => Carbon::now(),
				'confirmed_at' => Carbon::now(),
			]
		]);
		
		Schema::enableForeignKeyConstraints();
	}
}
