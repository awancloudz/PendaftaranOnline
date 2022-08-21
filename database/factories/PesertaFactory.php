<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PesertaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pilihan_id' => mt_rand(1,6),
            'kodepeserta' => Str::random(3).'-'.$this->faker->numerify('##########'),
            'nama' => $this->faker->name(),
            'nohandphone' => $this->faker->numerify('####-####-####'),
            'email' => $this->faker->unique()->safeEmail(),
            'nostr' => $this->faker->numerify('############'),
            'asalpengcab' => 'Semarang',
            'provinsi' => 'Jateng',
            'totalbayar' => $this->faker->numerify('######')
        ];
    }
}
