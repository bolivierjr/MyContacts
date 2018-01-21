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

        $add_email = $contact->email;
        $input_request = $request->input('newemail');
        array_push($add_email, $input_request);
        $contact->email = $add_email;

        $contact->save();

        return redirect('contacts/'. $id . '/edit');
    }

    public function addPhone(Request $request, $id)
    {
        $request->validate([
            'newphone' => 'sometimes|nullable|max:20',
        ]);

        $contact = People::find($id);

        $add_phone = $contact->phone;
        $input_request = $request->input('newphone');
        array_push($add_phone, $input_request);
        $contact->phone = $add_phone;


        $contact->save();

        return redirect('contacts/'. $id . '/edit');
    }
}
