<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final  class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $model = User::class;
    private $faker;

//     /**
//      * UserSeeder constructor.
//      */
//     public function __construct()
//     {
//         $this->faker = $this->withFaker();
//     }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = Role::where('slug','admin')->first();
        $manager = Role::where('slug', 'manager')->first();
        $user = Role::where('slug', 'userRole')->first();
        $createTasks = Permission::where('slug','create-tasks')->first();
        $manageUsers = Permission::where('slug','manage-users')->first();
        // $today = date("Y-m-d H:i:s");

    
        $user1 = new User();
        $user1->name = 'Admin';
        $user1->email ='admin@gmail.com';
        $user1->password = Hash::make('password');
        $user1->role_id = '1'; 
        $user1->save();
        
        $user1->roles()->attach($admin);
        $user1->permissions()->attach($manageUsers);
      
                
            
        $user2 = new User();    
        $user2->name ='ManagerTest';
        $user2->email = 'managertest@gmail.com';
        $user2->password = Hash::make('password');
                // 'password' => bcrypt(Str::random(10)),
        $user2->role_id = '2';        
        $user2->save();        
                // 'role_id'  => 2,
        $user2->roles()->attach($manager);
        $user2->permissions()->attach($createTasks);
                
            
        $user3 = new User();     
        $user3->name = 'UserTest';
        $user3->email = 'usertest@gmail.com';
        $user3->password = Hash::make('password');
                // 'password' => bcrypt(Str::random(10)),
        $user3->role_id = '3';         
        $user3->save();        
        $user3->roles()->attach($user);
        $user3->permissions()->attach($createTasks);
               
              
    }
}
