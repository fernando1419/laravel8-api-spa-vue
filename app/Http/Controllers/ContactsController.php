<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactsController extends Controller
{
   public function store()
   {
      $data = request()->validate([
         'name'     => 'required',
         'email'    => 'required|email',
         'birthday' => 'required',
         'company'  => 'required'
      ]);

      Contact::create($data);
   }

   public function show(Contact $contact)
   {
      return $contact; // laravel returns json automatically for us.
   }

   public function update(Contact $contact)
   {
      return $contact->update([
         'name'     => request('name'),
         'email'    => request('email'),
         'birthday' => request('birthday'),
         'company'  => request('company'),
      ]);
   }
}
