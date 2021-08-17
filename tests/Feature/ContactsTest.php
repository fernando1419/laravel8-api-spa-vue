<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactsTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   public function it_can_add_a_contact()
   {
      $this->withoutExceptionHandling();

      $this->post('api/contacts', ['name' => 'First Contact Name']);

      $this->assertCount(1, Contact::all());
   }
}
