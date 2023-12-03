<?php

namespace Database\Seeders;

use App\Models\MstCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            ['name' => '1700 - ABC'],
            ['name' => '1800 - XYZ'],
            ['name' => '1900 - CCC'],
            ['name' => '7500 - DDD'],
        ];
        DB::table((new MstCompany())->getTable())->delete();
        DB::table((new MstCompany())->getTable())->insert($companies);
    }
}
