<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
            $table->integer('id', true);
			$table->integer('user_id');
			$table->integer('product_id');
			$table->decimal('value', 10);
			$table->integer('status')->comment('{"\'Pending\' ":" 1","Paid\' ":" 2","Canceled\' ":" 3","Refunded\' ":" 4",}');
			$table->text('transaction_hash', 65535);
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
		Schema::drop('payments');
	}

}
