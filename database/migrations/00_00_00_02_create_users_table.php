<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('user_id')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->integer('user_position_id')->nullable()->unsigned();
            $table->foreign('user_position_id')->references('id')->on('user_positions');
            $table->string('username');
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->boolean('active')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        // <editor-fold defaultState="collapsed" desc="RECORD INSERTION">
        $users = [
            [
                'user_id' => 'user-001',
                'last_name' => 'Magno',
                'first_name' => 'Bien Dave',
                'middle_name' => 'Bendico',
                'user_position_id' => 1,
                'username' => 'superadmin',
                'password' => \Illuminate\Support\Facades\Hash::make('admin'),
                'email' => 'bien@email.com',
                'contact' => '0911111111111',
            ],
            [
                'user_id' => 'user-002',
                'last_name' => 'test',
                'first_name' => 'admin',
                'middle_name' => 'aaa',
                'user_position_id' => 1,
                'username' => 'test',
                'password' => \Illuminate\Support\Facades\Hash::make('test'),
                'email' => 'user-test@email.com',
                'contact' => '0911111111111',
            ],
            [
                'user_id' => 'user-003',
                'last_name' => 'guest',
                'first_name' => 'guest',
                'middle_name' => 'aaa',
                'user_position_id' => 3,
                'username' => 'guest_user',
                'password' => \Illuminate\Support\Facades\Hash::make('test'),
                'email' => 'guest@email.com',
                'contact' => '0911111111111',
            ],

        ];

//        foreach ($users as $u) {
//            $user = new \App\Models\User($u);
//            $user->active = true;
//            $user->password = $u['password'];
//            $user->save();
//        }

        foreach ($users as $u) {
            $user = new \App\Models\myapp\User($u);
            $user->user_id = $u['user_id'];
            $user->user_position_id = $u['user_position_id'];
            $user->username = $u['username'];
            $user->middle_name = $u['middle_name'];
            $user->active = true;
            $user->password = $u['password'];
            $user->save();
        }
        // </editor-fold>

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
