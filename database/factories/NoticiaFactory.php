<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NoticiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Aquí simularemos una imagen en base64
        $imagePath = 'public/especialidades/obstetricia.png'; // Asegúrate de tener una imagen en esta ruta
        $imageBase64 = base64_encode(file_get_contents($imagePath));

        return [
            'titulo' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph,
            'foto' => $imageBase64,
        ];
    }
}
