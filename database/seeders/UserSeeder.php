<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'name' => 'Admin',
            'username' => 'Admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@gmail.com',
            'role' => UserRole::Admin,
            'is_verified' => 1,
        ]);

        DB::table('accounts')->insert([
            'name' => 'Mr. Teacher',
            'username' => 'teacher',
            'password' => Hash::make('teacher'),
            'email' => 'teacher@gmail.com',
            'role' => UserRole::Instructor,
            'is_verified' => 1,
        ]);
        DB::table('instructors')->insert([
            'account_id' => 2,
            'introduce' => 'Đây là giảng viên thử nghiệm',
        ]);

        DB::table('accounts')->insert([
            'name' => 'Mr. Student',
            'username' => 'student',
            'password' => Hash::make('student'),
            'email' => 'student@gmail.com',
            'role' => UserRole::Student,
            'is_verified' => 1,
        ]);

        DB::table('students')->insert([
            'account_id' => 3,
        ]);
    }
}
