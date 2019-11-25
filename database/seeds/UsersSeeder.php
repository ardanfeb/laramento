<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Category;
use App\Label;
use App\Product;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{

    public function run()
    {

        // Random Unique Code

        $hasil = [];
        for ($i = 0; $i < 3; $i++) {
            $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
            shuffle($seed);
            $rand = '';
            foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];
            $hasil[$i] = $rand;
        }


        // Role

        $ownerRole = new Role();
        $ownerRole->name = "owner";
        $ownerRole->display_name = "Owner";
        $ownerRole->save();

        $employeeRole = new Role();
        $employeeRole->name = "employee";
        $employeeRole->display_name = "Employee";
        $employeeRole->save();

        $resellerRole = new Role();
        $resellerRole->name = "reseller";
        $resellerRole->display_name = "Reseller";
        $resellerRole->save();


        // Sample User

        $owner = new User();
        $owner->codeuser = 'OWNER' . $hasil[0];
        $owner->name = 'Owner';
        $owner->email = 'owner@gmail.com';
        $owner->phone = '08123';
        $owner->address = 'Jl. Kehidupan';
        $owner->birthdate = '2017-09-12';
        $owner->gender = 'laki-laki';
        $owner->password = bcrypt('password');
        $owner->save();
        $owner->attachRole($ownerRole);

        $admin = new User();
        $admin->codeuser = 'EMPLOYEE' . $hasil[1];
        $admin->name = 'Administrator';
        $admin->email = 'admin@gmail.com';
        $admin->phone = '08111';
        $admin->address = 'Jl. Kehidupan';
        $admin->birthdate = '2017-09-12';
        $admin->gender = 'laki-laki';
        $admin->password = bcrypt('password');
        $admin->save();
        $admin->attachRole($employeeRole);

        $member = new User();
        $member->codeuser = 'LARAMENTO' . $hasil[2];
        $member->name = 'Reseller';
        $member->email = 'reseller@gmail.com';
        $member->phone = '08222';
        $member->address = 'Jl. Kehidupan';
        $member->birthdate = '2017-09-12';
        $member->gender = 'perempuan';
        $member->password = bcrypt('password');
        $member->save();
        $member->attachRole($resellerRole);


        // Product
        $category = new Category();
        $category->category_name = "Baju";
        $category->save();

        $label = new Label();
        $label->label_name = "Small";
        $label->save();

        $product = new Product();
        $product->categories_id = 1;
        $product->labels_id = 1;
        $product->product_name = "Gildan Stripe";
        $product->price_buy = 130000;
        $product->price_sell = 150000;
        $product->save();

        DB::table('marketplaces')->insert([
            'name' => 'Tokopedia',
            'code' => 'TOKPED'
        ]);

    }
}
