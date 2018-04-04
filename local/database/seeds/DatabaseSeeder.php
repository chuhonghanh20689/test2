<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this->call(CatDatabaseSeeder::class);
		$this->call(LevelDatabaseSeeder::class);
		$this->call(UserDatabaseSeeder::class);
	}

}
class UserDatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('users')->insert(
			[
				[
					'name' => 'admin',
					'email' => 'admin@gmail.com',
					'level_id' => 1,
					'password' => bcrypt('123456'),

				],
				[
					'name' => 'mod',
					'email' => 'mod@gmail.com',
					'level_id' => 2,
					'password' => bcrypt('123456'),
				],
				[
					'name' => 'user1',
					'email' => 'user1@7gmail.com',
					'level_id' => 3,
					'password' => bcrypt('123456'),
				],
				[
					'name' => 'user2',
					'email' => 'user2@gmail.com',
					'level_id' => 3,
					'password' => bcrypt('123456'),
				],

			]
		);
	}
}
class LevelDatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('userlevels')->insert(
			[
				[
					'level_name' => 'admin',

				],
				[
					'level_name' => 'mod',
				],
				[
					'level_name' => 'user',

				],
			]
		);
	}
}
class CatDatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('categories')->insert(
			[
				[
					'cat_name' => 'iPhone',

				],
				[
					'cat_name' => 'Samsung',
				],
				[
					'cat_name' => 'Sony',
				],
				[
					'cat_name' => 'HTC',
				],
				[
					'cat_name' => 'LG',
				],
				[
					'cat_name' => 'OPPO',
				],
				[
					'cat_name' => 'Blackery',
				],
			]
		);
	}
}
