<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    private $create_user_num = 10;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory($this->create_user_num)->create();
    }
}
