<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;

class DatabaseSeeder extends Seeder {

    public function run() {


        // Create initial data and send admin(myself) an email to set password.
        DB::insert('insert into roles (name) values (?)', ['administrator']);
        DB::insert('insert into roles (name) values (?)', ['subscriber']);

        $profile = Profile::create([]);


        $user = User::create([
            'name' => 'Trevor Uehlin',
            'email' => 'tuehlin.web.dev@gmail.com',
            'role_id' => '1',
            'password' => Hash::make('kjldjfo9ksjv36'),
            'profile_id' => $profile->id
        ]);

        $user->sendNewAccountNotification();

        \App\Models\User::factory(5)->create();
    }
}
