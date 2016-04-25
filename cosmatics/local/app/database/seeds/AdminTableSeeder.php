<?php
class AdminTableSeeder extends Seeder {

    public function run()
    {
        DB::table('admins')->delete();

        Admin::create(array('username' => 'adnan','password'=>Hash::make('adnan')));
        Admin::create(array('username' => 'admin','password'=>Hash::make('admin')));
    }

}
?>