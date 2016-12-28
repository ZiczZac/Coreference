<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//clear database
        DB::table('users')->delete();

        //Users
        $user1 = User::create(
        	array(
        		'id' => 1,
        		'fullname' => 'Nguyễn Vũ Minh Hương',
        		'email'    => 'huongnvm@gmail.com',
        		'activated' => 0,
        		'account_type' => 1,
        		'password' => ('111111')
        	)
        );

        $user2 = User::create(
        	array(
        		'id' => 2,
        		'fullname' => 'Nguyễn Thị Tâm',
        		'email'    => 'tamnt@gmail.com',
        		'activated' => 0,
        		'account_type' => 1,
        		'password' => ('222222')
        	)
        );


        $user3 = User::create(
        	array(
        		'id' => 3,
        		'fullname' => 'Hà Hữu Cường',
        		'email'    => 'cuonghh@gmail.com',
        		'activated' => 0,
        		'account_type' => 1,
        		'password' => ('333333')
        	)
        );


        $user4 = User::create(
        	array(
        		'id' => 4,
        		'fullname' => 'Nguyễn Vũ Minh Hương',
        		'email'    => 'huongnvm@gmail.com',
        		'activated' => 1,
        		'account_type' => 1,
        		'password' => ('444444')
        	)
        );


        $user5 = User::create(
        	array(
        		'id' => 5,
        		'fullname' => 'Nguyễn Thị Ân',
        		'email'    => 'annt@gmail.com',
        		'activated' => 1,
        		'account_type' => 1,
        		'password' => ('555555')
        	)
        );


        $user6 = User::create(
        	array(
        		'id' => 6,
        		'fullname' => 'Trần Thị Ngọc Ánh',
        		'email'    => 'anhttn@gmail.com',
        		'activated' => 1,
        		'account_type' => 2,
        		'password' => '666666'
        	)
        );



    }
}
