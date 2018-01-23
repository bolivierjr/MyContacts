<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Validator;
use App\User;
use App\People;
use Auth;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // In case I needed the api for ajax request
    public function getJson()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $contacts = User::find($user_id)->peoples;

            return response()->json($contacts, 200);
        }

        return response()->json(['error' => 'You are not authorized.'], 401);
    }

    /**
     * Checks to see if address, city, state, zip field is populated.
     * If so, then require all.
     */
    public function mainFormValidation(Request $request)
    {
        if ($request->address || $request->city || $request->state || $request->zipcode) {
            Validator::make($request->all(), [
                'firstname' => 'required|string|max:64',
                'lastname' => 'required|string|max:64',
                'email1' => 'sometimes|nullable|email|max:64',
                'email2' => 'sometimes|nullable|email|max:64',
                'email3' => 'sometimes|nullable|email|max:64',
                'email4' => 'sometimes|nullable|email|max:64',
                'email5' => 'sometimes|nullable|email|max:64',
                'phone1' => 'sometimes|nullable|max:20|regex:/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i',
                'phone2' => 'sometimes|nullable|max:20|regex:/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i',
                'phone3' => 'sometimes|nullable|max:20|regex:/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i',
                'phone4' => 'sometimes|nullable|max:20|regex:/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i',
                'phone5' => 'sometimes|nullable|max:20|regex:/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i',
                'address' => 'required|string|max:64',
                'city' => 'required|string|max:32',
                'state' => 'required|string|size:2|regex:/([a-zA-Z])$/',
                'zipcode' => 'required|string|max:10|regex:/^[0-9]{5}(\-[0-9]{4})?$/',
            ])->validate();
        } else {  // If not, then do not require those fields
            Validator::make($request->all(), [
                'firstname' => 'required|string|max:64',
                'lastname' => 'required|string|max:64',
                'email1' => 'sometimes|nullable|email|max:64',
                'email2' => 'sometimes|nullable|email|max:64',
                'email3' => 'sometimes|nullable|email|max:64',
                'email4' => 'sometimes|nullable|email|max:64',
                'email5' => 'sometimes|nullable|email|max:64',
                'phone1' => 'sometimes|nullable|max:20|regex:/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i',
                'phone2' => 'sometimes|nullable|max:20|regex:/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i',
                'phone3' => 'sometimes|nullable|max:20|regex:/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i',
                'phone4' => 'sometimes|nullable|max:20|regex:/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i',
                'phone5' => 'sometimes|nullable|max:20|regex:/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i',
            ])->validate();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Find all contacts for authenticated user
         */
        $user_id = auth()->user()->id;
        $user = User::find($user_id)->peoples;

        // Pass the array of contacts to the contacts page for viewing
        return view('contacts')->with('peoples', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->mainFormValidation($request);

        // Create a new contact from form inputs and store to db
        $contacts = new People();

        $contacts->user_id = auth()->user()->id;
        $contacts->firstname = $request->input('firstname');
        $contacts->lastname = $request->input('lastname');
        $contacts->address = $request->input('address');
        $contacts->city = $request->input('city');
        $contacts->state = $request->input('state');
        $contacts->zipcode = $request->input('zipcode');
        $contacts->created_at = \Carbon\Carbon::now();

        /**
         * Support for multiple emails and phone numbers using JSON casting.
         * Takes a php assoc array and converts it to JSON to store in the
         * MySQL database.
         */
        $multiples = ['phone', 'email'];
        foreach ($multiples as $multiple) {
            if (empty($request->input($multiple . '1'))) {
                $contacts->$multiple = [];
            } else {
                $contacts->$multiple = [
                    $request->input($multiple . '1'),
                ];
            }
        }

        $contacts->save();

        return redirect('/contacts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Search for contact to edit
        $contact = People::find($id);

        // If the user does not own the contact, redirect back
        if (auth()->user()->id != $contact->user_id) {
            return redirect('/contacts');
        }

        return view('edit')->with('contact', $contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        $this->mainFormValidation($request);

        // Find contact by Id and update
        $contact = People::find($id);

        $contact->firstname = $request->input('firstname');
        $contact->lastname = $request->input('lastname');

        $date = $request->input('date');
        if (empty($date)) {
            $contact->last_contact = $date;
        } elseif ($date == \Carbon\Carbon::today()->toDateString()) {
            $contact->last_contact = \Carbon\Carbon::now();
        } else {
            $contact->last_contact = \Carbon\Carbon::parse($date)->toDateTimeString();
        }

        $contact->address = $request->input('address');
        $contact->city = $request->input('city');
        $contact->state = $request->input('state');
        $contact->zipcode = $request->input('zipcode');

        $fields = [
            'email1', 'email2', 'email3', 'email4', 'email5',
            'phone1', 'phone2', 'phone3', 'phone4', 'phone5'
        ];

        foreach ($fields as $field) {
            $db_field = substr($field, 0, -1);

            $input_request = $request->input($field);
            Log::info(print_r($input_request, true));
            $hidden_input = $field . '_variable';
            $hidden_variable = $request->$hidden_input;

            /*
             * Compares old and new input values if changed in edit form.
             * If changed to a new value, replace.
             */
//            return $input_request . ' '. $hidden_variable;
            if (strcmp($input_request, $hidden_variable)) {
//                return $hidden_variable .' '. $hidden_input .' '. $input_request;
                $search = array_search($hidden_variable, $contact->$db_field);
                $newfield = $contact->$db_field;
                array_splice($newfield, $search, 1, $input_request);
                $contact->$db_field = $newfield;
//                return $contact->$db_field;
            } elseif (empty($input_request)) {
                // do nothing
            } else {
            }
        }

        $contact->save();

        return redirect('/contacts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = People::find($id);

        if (auth()->user()->id != $contact->user_id) {
            return response()->json(['error' => "You are not authorized."], 401);
        }

        $contact->delete();

        return response()->json(['success' => true], 200);
    }

}
