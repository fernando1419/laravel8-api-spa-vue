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

      $this->post('api/contacts', $this->data());

      $contact = Contact::first();

      //   $this->assertCount(1, $contact);
      $this->assertEquals('First Contact Name', $contact->name);
      $this->assertEquals('test@test.com', $contact->email);
      $this->assertEquals('05/14/1988', $contact->birthday);
      $this->assertEquals('ABC company', $contact->company);
   }

   /** @test */
   public function it_validates_all_required_fields()
   {
      $required_fields = ['name', 'email', 'birthday', 'company'];
      collect($required_fields)->each(function ($field)
      {
         $response = $this->post('api/contacts', array_merge($this->data(), [$field => null]));

         $response->assertSessionHasErrors($field);
         $this->assertCount(0, Contact::all());
      });
   }

   /**
    * Common data for tests
    */
   private function data()
   {
      return [
         'name'     => 'First Contact Name',
         'email'    => 'test@test.com',
         'birthday' => '05/14/1988',
         'company'  => 'ABC company'
      ];
   }
}
