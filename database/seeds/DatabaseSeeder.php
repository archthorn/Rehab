<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'doctor'];
        $appointments = ['Головний лікар', 'Начальник', 'Завідувач', 'Лікар'];
        $specialties = ['Гастроентеролог', 'Гепатолог', 'Дерматолог', 'Дієтолог', 'Кардіолог',
                        'Лікар лікувальної фізкультури', 'Нарколог', 'Невролог', 'Хірург'];


        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role,
            ]);
        }

        foreach ($appointments as $appointment){
            DB::table('appointments')->insert([
                'name' => $appointment,
            ]);
        }

        foreach ($specialties as $specialty){
            DB::table('specialties')->insert([
                'name' => $specialty,
            ]);
        }

        DB::table('users')->insert([
            'name' => 'admin',
            'surname' => 'admin',
            'middle_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '+380987654321',
            'birth_date' => '2000-01-01',
            'appointment_id' => 1,
            'specialty_id' => 1,
        ]);
        
        DB::table('user_role')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
