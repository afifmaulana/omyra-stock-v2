<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleWarehouse = Role::create(['name' => 'warehouse']);
        $roleStaff = Role::create(['name' => 'staff']);

        $admin1 = new User();
        $admin1->name = "Admin Omyra";
        $admin1->email = "admin@omyraglobal.com";
        $admin1->password = Hash::make("12345678");
        $admin1->save();

        $warehouse1 = new User();
        $warehouse1->name = "M. Khofi";
        $warehouse1->email = "opi@omyraglobal.com";
        $warehouse1->password = Hash::make("12345678");
        $warehouse1->save();

        $staff1 = new User();
        $staff1->name = "Sumiyati";
        $staff1->email = "sumi@omyraglobal.com";
        $staff1->password = Hash::make("12345678");
        $staff1->save();

        $admin1->assignRole('admin');
        $warehouse1->assignRole('warehouse');
        $staff1->assignRole('staff');
    }
}
