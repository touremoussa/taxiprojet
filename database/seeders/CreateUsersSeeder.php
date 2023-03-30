<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehicule;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'name'=>'Admin',
               'email'=>'admin@taxi.com',
               'type'=>1,
               'password'=> bcrypt('passer'),
            ],
            [
               'name'=>'Chauffeur',
               'email'=>'chauffeur@taxi.com',
               'type'=> 2,
               'password'=> bcrypt('passer'),
            ],
            [
               'name'=>'Client',
               'email'=>'client@taxi.com',
               'type'=>0,
               'password'=> bcrypt('passer'),
            ],
        ];

        $cars=[
            [
                'marque'=>'hyundai',
                'couleur'=>'Noire',
                'places'=>4
            ],
            [
                'marque'=>'peugeot',
                'couleur'=>'blanc',
                'places'=>6
            ],
            [
                'marque'=>'toyota',
                'couleur'=>'Noire',
                'places'=>6
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
        foreach ($cars as $key => $car) {
            Vehicule::create($car);
        }
    }
}