<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Http\Request;

class AddFormController extends ContactController
{
    public function addEmail(Request $request, $id)
    {
        $validator = $request->validate([
            'newemail' => 'sometimes|email|max:64',
        ]);

        return back()->withInput();
    }

    public function addPhone(Request $request, $id)
    {

    }
}
