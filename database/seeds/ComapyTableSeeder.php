<?php

use Illuminate\Database\Seeder;
use App\Company;
class ComapyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'ruc'=>'1111111111112', 
            'name'=>'juanito Perez',
            'email'=>'juan@perez.com',
            'userApp' =>'1111111111112',
            'password' => encrypt('1111111111112'),
            'address'=>'Quito',
            'city'=>'Quito',
            'state'=>'17',
            'country'=>'EC',
            'postal_code'=>'',
            'type'=>'Juridica',
            'phone1'=>'',
            'contact'=>'',
            'legalRepre'=>'',
            'notes' => '',
            'status'=>1,
            'id_role'=>1
        ]);
    }
}
