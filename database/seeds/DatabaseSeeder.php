<?php

use App\House_loc;
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

		$this->call('House_locDataSeeder');
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
		BD::table('representative')->delete();
		Representative::create(array('repID'=>1,'active'=>1,'repUserName'=>'lindawang@91bnb.com','password'=>bcrypt('1234') ,'repFirstName'=> 'Linda','repLastName'=>'Wang'));
		Representative::create(array('repID'=>2,'active'=>1 ,'repUserName'=>'joshliu@91bnb.com','password'=>bcrypt('1234') ,'repFirstName'=> 'Josh','repLastName'=>'Liu'));
		Representative::create(array('repID'=>3,'active'=>1 ,'repUserName'=> 'jadeguo@91bnb.com','password'=>bcrypt('1234') ,'repFirstName'=>'Jade','repLastName'=>'Guo'));
		Representative::create(array('repID'=>4,'active'=>1 ,'repUserName'=> 'intern@91bnb.com','password'=>bcrypt('1234') ,'repFirstName'=>'Intern','repLastName'=>'Inter'));
		Representative::create(array('repID'=>5,'active'=>1 ,'repUserName'=>'vinccitang@91bnb.com','password'=>bcrypt('1234') ,'repFirstName'=>'Vincci','repLastName'=>'Tang'));
		Representative::create(array('repID'=>8,'active'=>1 ,'repUserName'=> 'erikali@91bnb.com','password'=>bcrypt('1234') ,'repFirstName'=>'Erika','repLastName'=>'Li'));
		Representative::create(array('repID'=>9,'active'=>0 ,'repUserName'=> 'VT','password'=>bcrypt('91888') ,'repFirstName'=>'V','repLastName'=>'T'));
		Representative::create(array('repID'=>10,'active'=>1 ,'repUserName'=> 'seanluo@91bnb.com','password'=>bcrypt('1234') ,'repFirstName'=>'Sean','repLastName'=>'Luo'));

	}
}