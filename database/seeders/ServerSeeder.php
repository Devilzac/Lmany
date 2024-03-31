<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Stringable;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servers = ['SEA','SEA2', 'USW', 'USW2', 'UST', 'USE', 'EU', 'BR', 'LDN', 'USE2', 'SA','Unknown'];
        asort($servers);// Order Alphabetically
        foreach ($servers as $server) {
            DB::table('servers')->insert([
                'name' => $server
            ]);
        }
    }
}
