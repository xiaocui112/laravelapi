<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class UserLastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_actived_at')->nullable();
        });
    }
}
