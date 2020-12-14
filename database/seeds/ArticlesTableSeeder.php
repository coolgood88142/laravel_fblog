<?php

use App\Models\Articles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     *  Adding dummy articles
     */
    public function run()
    {
        factory(Articles::class, 5)->create();
    }
}
