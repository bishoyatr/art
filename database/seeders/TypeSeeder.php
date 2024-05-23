<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "id"=>1,
                "name" => "packaging",
            ],
            [
                "id"=>2,
                "name" => "visibility",

            ]
        ];


        foreach ($data as $value) {
            $model = Type::find($value['id']);
            if ($model) {
                $model->update([
                    "name"=>$value['name']
                ]);
            }else
                Type::create($value);
        }
    }
}
