<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Admin();
        $admin->name = "Mr. Admin";
        $admin->email = "admin@bizstatefiling.com";
        $admin->login_name = "biz_state_filing";
        $admin->password = Hash::make("admin@123");
        $admin->save();
    }
}
