<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        // <editor-fold defaultState="collapsed" desc="RECORD INSERTION">
        $positions = [
            [
                'code' => 'admin',
                'name' => 'admin',
            ],
            [
                'code' => 'staff',
                'name' => 'staff',
            ],
            [
                'code' => 'guest',
                'name' => 'guest',
            ],

        ];
        foreach ($positions as $pos) {
            $user = new \App\Models\myapp\UserPosition($pos);
            $user->code = $pos['code'];
            $user->name = $pos['name'];
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
        Schema::dropIfExists('user_positions');
    }
}
