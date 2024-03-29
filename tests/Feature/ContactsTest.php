<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Contact;
use Carbon\Carbon;
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
      //   dd($contact);

      //   $this->assertCount(1, $contact);
      $this->assertEquals('First Contact Name', $contact->name);
      $this->assertEquals('test@test.com', $contact->email);
      $this->assertEquals('1988-05-14', $contact->birthday->format('Y-m-d')); // using carbon to format it.
   $this->assertEquals('05/14/1988', $contact->birthday->format('m/d/Y')); // using carbon to format it.
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

   /** @test */
   public function it_must_be_a_valid_email()
   {
      $response = $this->post('api/contacts', array_merge($this->data(), ['email' => 'NOT VALID EMAIL ADDRESS']));

      $response->assertSessionHasErrors('email');
      $this->assertCount(0, Contact::all()); // assert that it doesn't create any contact if the email is invalid.
   }

   /** @test */
   public function it_validates_that_birthday_is_stored_properly()
   {
      $response     = $this->post('api/contacts', array_merge($this->data()));
      $firstContact = Contact::first();

      $this->assertCount(1, Contact::all());
      $this->assertInstanceOf(Carbon::class, $firstContact->birthday);
      $this->assertEquals('05-14-1988', $firstContact->birthday->format('m-d-Y'));
      $this->assertEquals('14-05-1988', $firstContact->birthday->format('d-m-Y'));
   }

   /** @test */
   public function it_retrieves_a_single_contact()
   {
      // given an existing contact (now created using ContactFactory)
   $contact = Contact::factory()->create(); // dd($contact);

   // when I call this api
      $response = $this->get('/api/contacts/' . $contact->id);

      // then it should retrive the existing contact data, json structure and 200 status code.
      $response->assertStatus(200);
      $response->assertJsonStructure(['name', 'email', 'birthday', 'company']);
      $response->assertJsonFragment([
         'name'     => $contact->name,
         'email'    => $contact->email,
         'birthday' => $contact->birthday,
         'company'  => $contact->company
      ]);
   }

   /** @test */
   public function it_updates_a_single_contact()
   {
      $this->withoutExceptionHandling();

      $contact = Contact::factory()->create(); // given an existing contact (with random data);

      $this->patch('/api/contacts/' . $contact->id, $this->data()); // when calling this endpoint with $this->data()

      $contact = $contact->fresh(); // refresh the contact (goes to DB again and get it), another option is this: $contact = Contact::first();

      $this->assertEquals('First Contact Name', $contact->name);
      $this->assertEquals('test@test.com', $contact->email);
      $this->assertEquals('1988-05-14', $contact->birthday->format('Y-m-d'));
      $this->assertEquals('05/14/1988', $contact->birthday->format('m/d/Y')); // using carbon to format it.
      $this->assertEquals('ABC company', $contact->company);
   }

   /** @test */
   public function it_deletes_a_single_contact()
   {
      $contact = Contact::factory()->create(); // given only one existing contact (with random data);

      $this->delete('/api/contacts/' . $contact->id); // when calling this endpoint

      $this->assertCount(0, Contact::all()); // no contact should be in our DB.
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
