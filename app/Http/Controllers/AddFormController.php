<?php

namespace App\Http\Controllers;

use Validator;
use App\People;
use Illuminate\Http\Request;

class AddFormController extends ContactController
{
    public function addEmail(Request $request, $id)
    {
        $request->validate([
            'newemail' => 'sometimes|email|max:64',
        ]);

        $contact = People::find($id);

        $input_request = $request->input('newemail');

        $array_count = count($contact->email) + 1;
        $add_element = $contact->email;
        $add_element['email_' . $array_count] = $input_request;
        $contact->email = $add_element;

        $contact->save();

        return redirect('contacts/'. $id . '/edit');
    }

    public function addPhone(Request $request, $id)
    {

    }
}
