<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class FieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $field_types = [
            [
                'name' => "select",
                'has_item' => true
            ],
            [
                'name' => "text",
                'has_item' => false
            ],
            [
                'name' => "textarea",
                'has_item' => false
            ],
            [
                'name' => "radio",
                'hasItem' => true
            ],
        ];
        DB::table('field_types')->insert($field_types);
    }
}
