<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColUsernameFullname extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn('first_name', 'last_name');
			$table->string('username')->unique()->after('id');
			$table->string('full_name')->after('reset_password_code')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn('username', 'full_name');
			$table->string('first_name')->after('reset_password_code')->nullable();
			$table->string('last_name')->after('first_name')->nullable();
		});
	}

}
