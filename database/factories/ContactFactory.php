<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'facebook_link' => '105982023423242',
            'viber' => '0912345678',
            'telegram' => '0912345678',
            'agent_number' => '09123456789',
            'additional_phone_numbers' => '0912345679,092343252525,09133213553533',
            'additional_viber_phone_numbers' => '098080234234,09234245643,09256423423423',
        ];
    }
}
