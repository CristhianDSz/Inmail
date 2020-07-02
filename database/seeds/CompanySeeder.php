<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Inmail',
            'identification' => '890200876-9',
            'email' => 'support@inmail.com',
            'phone' => '+57 76387455',
            'address' => 'Sector 17, Bloque 3-11 Apto. 303'
        ]);
    }
}
