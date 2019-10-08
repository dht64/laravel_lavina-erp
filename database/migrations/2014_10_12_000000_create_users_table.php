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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('role_id')->unsigned()->default(5);
            $table->boolean('is_active')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
        $pwd = bcrypt("12345678");
        DB::table('users')->insert([['id' => 1, 'name' => 'Admin', 'email' => 'admin@lavina.com', 'username' => 'admin', 'password' => $pwd, 'role_id' => "1", 'is_active' => true], ['id' => 2, 'name' => 'Business', 'email' => 'business@lavina.com', 'username' => 'business', 'password' => $pwd, 'role_id' => "2", 'is_active' => true], ['id' => 3, 'name' => 'Manager', 'email' => 'manager@lavina.com', 'username' => 'manager', 'password' => $pwd, 'role_id' => "3", 'is_active' => true], ['id' => 4, 'name' => 'Employee', 'email' => 'employee@lavina.com', 'username' => 'employee', 'password' => $pwd, 'role_id' => "4", 'is_active' => true]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
