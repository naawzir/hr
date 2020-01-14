<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'uuid'       => (string) \Uuid::generate(4),
            'title'      => 'Mr',
            'firstname'  => 'Joe',
            'lastname'   => 'Bloggs',
            'gender'     => 'male',
            'name'       => 'Joe Bloggs',
            'email'      => 'jbloggs@test.com',
            'password'   => bcrypt('password'),
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'is_admin'   => 1,
        ]);
    }
}
