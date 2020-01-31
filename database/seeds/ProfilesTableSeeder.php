<?php

use App\Profile;
use App\User;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = User::all();

        foreach ($users as $user) {
            $profile = factory(Profile::class)->make();
            $profile->user_id = $user->id; //Primary key of users table
            $profile->save();
        }
    }
}
