<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Type::truncate();

        $types = config('types');

        foreach ($types as $type) {
            $new_type = new Type();

            $new_type->title  = $type['title'];
            $new_type->slug = Str::of($new_type->title)->slug('-');
            $new_type->description = $type['description'];

            $new_type->save();
        }

        Schema::enableForeignKeyConstraints();
    }
}
