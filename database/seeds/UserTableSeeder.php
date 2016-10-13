<?php
/**
 * 
 */
use Illuminate\Database\Seeder;
 class UserTableSeeder extends Seeder
 {
 	
 	public function run()
 	{
 		\DB::table('users')->insert(array(
			'name' => 'edwin',
			'email' => 'edwin@edwin.me',
			'password' => \Hash::make('secret') 
 		));
 	}
 } 
 ?>