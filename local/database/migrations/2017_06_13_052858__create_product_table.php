<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('product', function (Blueprint $table) {
			$table->increments('id');
			$table->string('pro_name');
			$table->float('pro_price', 11, 2);
			$table->string('img');
			$table->string('accessories');
			$table->integer('warranty');
			$table->string('promotion');
			$table->string('condition');
			$table->string('des');
			$table->integer('cat_id');
			$table->integer('total_qtt');
			$table->integer('remaining_qtt');
			$table->integer('hot');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('product');
	}
}
