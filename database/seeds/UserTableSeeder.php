<?php


use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->delete();
        User::create(array('name'=>'Foo Bar','email' => 'foo@bar.com','password'=>bcrypt('Foo123')));
        $this->command->info('User table seeded!');

    }
}
