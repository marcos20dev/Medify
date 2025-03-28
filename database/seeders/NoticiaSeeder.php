<?php

namespace Database\Seeders;

use App\Models\Noticia;
use Illuminate\Database\Seeder;

class NoticiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Noticia::factory()->count(500)->create(); // Genera 30 noticias
    }
}
