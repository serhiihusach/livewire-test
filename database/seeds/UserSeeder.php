<?php

use App\Car;
use App\Post;
use App\User;
use App\Planet;
use App\Weapon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 2000)->create();
    }
}
