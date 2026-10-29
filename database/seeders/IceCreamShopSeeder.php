<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class IceCreamShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Users
        User::updateOrCreate(
            ['email' => 'owner@icecream.com'],
            [
                'name' => 'Shop Owner',
                'password' => Hash::make('owner123'),
                'role' => 'owner',
            ]
        );

        User::updateOrCreate(
            ['email' => 'manager@icecream.com'],
            [
                'name' => 'Shop Manager',
                'password' => Hash::make('manager123'),
                'role' => 'manager',
            ]
        );

        User::updateOrCreate(
            ['email' => 'cashier@icecream.com'],
            [
                'name' => 'Shop Cashier',
                'password' => Hash::make('cashier123'),
                'role' => 'cashier',
            ]
        );

        // Seed Inventory Items
        Item::insert([
            [
                'name' => 'Imorich Chocolate and Peanut Butter Ice Cream',
                'category' => 'Chocolate',
                'price' => 220,
                'stock' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Magic Ice Cream',
                'category' => 'Vanilla',
                'price' => 160,
                'stock' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wonder Strawberry Blast',
                'category' => 'Strawberry',
                'price' => 120,
                'stock' => 22,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // SeedCustomers
        Customer::insert([
            [
                'name' => 'Jonathan Mark',
                'phone' => '0761680534',
                'loyalty_points' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michel Johnson',
                'phone' => '0774742151',
                'loyalty_points' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
