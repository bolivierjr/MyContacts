<?php

namespace App\Http\Controllers;

use Validator;
use App\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddFormController extends ContactController
{
    public function addEmail(Request $request, $id)
    {
        $request->validate([
            'newemail' => 'required|email|max:64',
        ]);

        $contact = People::find($id);

        $add_email = $contact->email;
        $input_request = $request->input('newemail');
        array_push($add_email, $input_request);
        $contact->email = $add_email;

        $contact->save();

        return response()->json(['success' => true]);
    }

    public function addPhone(Request $request, $id)
    {
        $request->validate([
            'newphone' => 'required|max:20',
        ]);

        $contact = People::find($id);

        $add_phone = $contact->phone;
        $input_request = $request->input('newphone');
        array_push($add_phone, $input_request);
        $contact->phone = $add_phone;


        $contact->save();

        return response()->json(['success' => true]);
    }

    public function deleteEmail(Request $request, $id, $index)
    {
        $contact = People::find($id);

        $email = $contact->email;
        array_splice($email, $index, 1);
        $contact->email = $email;

        $contact->save();

        return response()->json(['success' => true, ]);

    }

    public function deletePhone(Request $request, $id, $index)
    {
        $contact = People::find($id);

        $phone = $contact->phone;
        array_splice($phone, $index, 1);
        $contact->phone = $phone;

        $contact->save();

        return response()->json(['success' => true, ]);
    }
}
