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

        if (auth()->user()->id != $contact->user_id) {
            return response()->json(['error' => 'You are not authorized.'], 401);
        }

        $add_email = $contact->email;
        $input_request = $request->input('newemail');
        array_push($add_email, $input_request);
        $contact->email = $add_email;

        $contact->save();

        return response()->json(['success' => true], 200);
    }

    public function addPhone(Request $request, $id)
    {
        $request->validate([
            'newphone' => 'required|max:20|regex:/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i',
        ]);

        $contact = People::find($id);

        if (auth()->user()->id != $contact->user_id) {
            return response()->json(['error' => 'You are not authorized.'], 401);
        }

        $add_phone = $contact->phone;
        $input_request = $request->input('newphone');
        array_push($add_phone, $input_request);
        $contact->phone = $add_phone;

        $contact->save();

        return response()->json(['success' => true], 200);
    }

    public function deleteEmail(Request $request, $id, $index)
    {
        $contact = People::find($id);

        if (auth()->user()->id != $contact->user_id) {
            return response()->json(['error' => 'You are not authorized.'], 401);
        }

        $email = $contact->email;
        array_splice($email, $index, 1);
        $contact->email = $email;

        $contact->save();

        return response()->json(['success' => true], 200);
    }

    public function deletePhone(Request $request, $id, $index)
    {
        $contact = People::find($id);

        if (auth()->user()->id != $contact->user_id) {
            return response()->json(['error' => 'You are not authorized.'], 401);
        }

        $phone = $contact->phone;
        array_splice($phone, $index, 1);
        $contact->phone = $phone;

        $contact->save();

        return response()->json(['success' => true], 200);
    }
}
