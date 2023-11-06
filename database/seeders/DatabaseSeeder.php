<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        //

      DB::table('users')->insert([
        'username'=>'admin',
        'name'=>'admin',
        'email' => 'admin@mailinator.com',
        'password' => Hash::make('admin'),
        'is_active'=>1,
        'user_type'=>1,
    ]);
        $data = [
            [
                'name' => 'Skin',
                'is_active' => 1,
            ],
            [
                'name' => 'Hair',
                'is_active' => 1,
            ],
             
            [
                'name' => 'Men',
                'is_active' => 1,
            ],
            [
                'name' => 'Bebe',
                'is_active' => 1,
            ],
             [
                'name' => 'Others',
                'is_active' => 1,
            ],
        ];

    DB::table('categories')->insert($data);

    $sub = [
            [
                'name' => 'Skin Care',
                'parent_id'=>1,
                'is_active' => 1,
            ],
            [
                'name' => 'Skin Clinic',
                'parent_id'=>1,
                'is_active' => 1,
            ],
        ];
         DB::table('categories')->insert($sub);

        $products = [
            [
                'name' => 'GPC',
                'category_id'=>1,
                'is_active' => 1,
            ],
             [
                'name' => 'Facial wash',
                'category_id'=>1,
                'is_active' => 1,
            ],
             [
                'name' => 'Hand Wash',
                'category_id'=>1,
                'is_active' => 1,
            ],
        ];
         DB::table('products')->insert($products);
            $products_lines = [
            [
                'name' => 'GPC 1',
                'product_id'=>1,
                'is_active' => 1,
            ],
             [
                'name' => 'Facial wash b',
                'product_id'=>2,
                'is_active' => 1,
            ],
             [
                'name' => 'Hand Wash 500ml',
                'product_id'=>3,
                'is_active' => 1,
            ],
        ];
        //attachment

        DB::table('product_lines')->insert($products_lines);
        DB::table('attachments')->insert([[
            'original_name'=>'',
            'path'=>'images/def_history.png',
            'name'=>'555',
            'type'=>'555',
            'extension'=>'555',
            'size'=>'555',
            'preview_url'=>'images/def_history.png',
            'created_by'=>1,
            'updated_by'=>1
        ],[
            'original_name'=>'',
            'path'=>'pdf/test_pdf.png',
            'name'=>'555',
            'type'=>'555',
            'extension'=>'555',
            'size'=>'555',
            'preview_url'=>'images/test_pdf.png',
            'created_by'=>1,
            'updated_by'=>1
        ]]);
         $products_lines_data_type_1 = [
            [
                'product_id' => 1,
                'history_album_attachments'=>'1,1,1,1',
                'current_pdf_attachment' => 2,
                'is_active' => 1,
            ],
            
        ];
          DB::table('data_type_0')->insert($products_lines_data_type_1);
    
    }
}
