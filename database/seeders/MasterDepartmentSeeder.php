<?php

namespace Database\Seeders;

use App\Models\MstCompany;
use App\Models\MstDepartment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            ['name' => 'Agency'],
            ['name' => 'BOC'],
            ['name' => 'BOD'],
            ['name' => 'Chartering'],
            ['name' => 'Corporate Planning & ERM'],
            ['name' => 'Crewing'],
            ['name' => 'CSR'],
            ['name' => 'Finance & Accounting'],
            ['name' => 'Fleet Scheduling'],
            ['name' => 'Floating Crane Operations'],
            ['name' => 'Fuel & Fleet Monitoring'],
            ['name' => 'General Affairs'],
            ['name' => 'HSE'],
            ['name' => 'Human Capital'],
            ['name' => 'Insurance'],
            ['name' => 'Internal Audit'],
            ['name' => 'IT Project Management'],
            ['name' => 'IT Support'],
            ['name' => 'Legal & Corsec'],
            ['name' => 'Operation East Kal'],
            ['name' => 'Operation HO'],
            ['name' => 'Operation Jasumba'],
            ['name' => 'Operation South Kal'],
            ['name' => 'PMO'],
            ['name' => 'Procurement'],
            ['name' => 'Secretary'],
            ['name' => 'Strategy Sourcing'],
            ['name' => 'Supply Chain Management'],
            ['name' => 'Tax'],
            ['name' => 'Technical'],
            ['name' => 'Warehouse & Logistic'],
        ];
        DB::table((new MstDepartment())->getTable())->delete();
        DB::table((new MstDepartment())->getTable())->insert($departments);
    }
}
