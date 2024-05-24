<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Administrador;
use App\Models\Empresa; 
use App\Models\Cliente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /*$admin = User::create([
            'email' => 'raphael@adminraphael.com',
            'email_verified_at' => '2023-02-07 13:33:19',
            'name' => 'Raphael',
            'password' => Hash::make('qwerasdf')
        ]);*/

        $admin = Administrador::create(['name' => 'Raphael AdmTeste'])->user()->create([
            'email' => 'raphael@adminraphael.com',
            'email_verified_at' => '2023-02-07 13:33:19',
            'password' => Hash::make('qwerasdf')
        ]);

        $empresa = Empresa::create(['name' => 'EasyTeste', 'cnpj' => '12345678912345', 'time_sla' => 15]);



        $cliente = Cliente::create(['name' => 'Raphael ClienteTeste', 'empresa_id' => 1])->user()->create([
            'email' => 'raphael@clienteraphael.com',
            'email_verified_at' => '2023-02-07 13:33:19',
            'password' => Hash::make('qwerasdf')
        ]);
    }
}
