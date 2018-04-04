<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderdetailsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('orderdetails', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('ord_id');
			$table->integer('pro_id');
			$table->string('pro_name');
			$table->integer('qty');
			$table->float('pro_price', 10, 2);
			$table->float('total_price', 10, 2);
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
		Schema::dropIfExists('orderdetails');
	}
}
