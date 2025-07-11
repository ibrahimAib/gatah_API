<?php

namespace Database\Seeders;

use App\Models\Balance;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $customersData = [
            [
                'name' => 'أبو سلمان',
                'phone' => '0532960686',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'إلياس',
                'phone' => '0582222565',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'أبو عبدالملك',
                'phone' => '0551290287',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'المؤسس',
                'phone' => '0550070510',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'أبو حسام',
                'phone' => '0551861378',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'عاصم بيك',
                'phone' => '0555266068',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'أبو نورة',
                'phone' => '0533552258',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'أبو تميم',
                'phone' => '0535356750',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'أبو المثنى',
                'phone' => '0554476605',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'إبراهيم',
                'phone' => '0533301365',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'أبو أوس',
                'phone' => '0556817126',
                'password' => Hash::make('123456')
            ]
        ];

        foreach ($customersData as $data) {
            User::factory()->create($data);
        }
        Balance::create(['balance' => 4000]);
    }
}
