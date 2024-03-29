<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
   /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
   protected $model = Contact::class;

   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
      return [
         'name'     => $this->faker->name,
         'email'    => $this->faker->email,
         'birthday' => '05/14/1988',
         'company'  => $this->faker->company
      ];
   }
}
