<?php

use App\Representative;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
                Model::unguard();

                $this->call('UserSeeder');
        }

}

class House_locDataSeeder extends Seeder {

        public function run() {
                DB::table('house_loc')->delete();

                House_loc::create(array('zipcode' => '00501','city' => "Holtsville", 'state' => "NY", 'county' => "Suffolk", 'location' => '-72.637078,40.922326'));
        }

}

class UserSeeder extends Seeder{
        public function run(){
                DB::table('Representative')->delete();
                Representative::create(array('repID'=>1,'active'=>1,'repUserName'=>'lindawang@91bnb.com','password'=>bcrypt('1234') ,'repPriority'=>1,'repPosition'=>'Admin','repFirstName'=> 'Linda','repLastName'=>'Wang'));
                Representative::create(array('repID'=>2,'active'=>1 ,'repUserName'=>'joshliu@91bnb.com','password'=>bcrypt('1234') ,'repPriority'=>3,'repPosition'=>'BD','repFirstName'=> 'Josh','repLastName'=>'Liu'));
                Representative::create(array('repID'=>3,'active'=>1 ,'repUserName'=> 'jadeguo@91bnb.com','password'=>bcrypt('1234') ,'repPriority'=> 2,'repPosition'=>'ACCT','repFirstName'=>'Jade','repLastName'=>'Guo'));
                Representative::create(array('repID'=>4,'active'=>1 ,'repUserName'=> 'intern@91bnb.com','password'=>bcrypt('1234') ,'repPriority'=>4,'repPosition'=>'BD','repFirstName'=>'Intern','repLastName'=>'Inter'));
                Representative::create(array('repID'=>5,'active'=>1 ,'repUserName'=>'vinccitang@91bnb.com','password'=>bcrypt('1234') ,'repPriority'=>1,'repPosition'=>'Admin','repFirstName'=>'Vincci','repLastName'=>'Tang'));
                Representative::create(array('repID'=>8,'active'=>1 ,'repUserName'=> 'erikali@91bnb.com','password'=>bcrypt('1234') ,'repPriority'=>5,'repPosition'=>'Marketing','repFirstName'=>'Erika','repLastName'=>'Li'));
                Representative::create(array('repID'=>9,'active'=>0 ,'repUserName'=> 'VT','password'=>bcrypt('91888') ,'repPriority'=>3,'repPosition'=>'BD','repFirstName'=>'V','repLastName'=>'T'));
                Representative::create(array('repID'=>10,'active'=>1 ,'repUserName'=> 'seanluo@91bnb.com','password'=>bcrypt('1234') ,'repPriority'=>2,'repPosition'=>'BD', 'repFirstName'=>'Sean','repLastName'=>'Luo'));

                Representative::create(array('repID'=>11,'active'=>1 ,'repUserName'=> 'moki@91bnb.com','password'=>bcrypt('123456') ,'repPriority'=>1,'repPosition'=>'IT','repFirstName'=>'Moki','repLastName'=>'Pang'));
                Representative::create(array('repID'=>12,'active'=>1 ,'repUserName'=> 'yy@91bnb.com','password'=>bcrypt('123456') ,'repPriority'=>1,'repPosition'=>'IT','repFirstName'=>'Yichen','repLastName'=>'Yao'));
        }
}