<?php

namespace App\Http\Controllers;

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

            return response()->json($contacts);
        }

        return 'You are not authenticated';
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
                'email' => 'sometimes|nullable|email|max:64',
                'phone' => 'sometimes|nullable|max:20',
                'address' => 'required|string|max:64',
                'city' => 'required|string|max:32',
                'state' => 'required|string|size:2|regex:/([a-zA-Z])$/',
                'zipcode' => 'required|string|max:10|regex:/^[0-9]{5}(\-[0-9]{4})?$/',
            ])->validate();
        } else {  // If not, then do not require those fields
            Validator::make($request->all(), [
                'firstname' => 'required|string|max:64',
                'lastname' => 'required|string|max:64',
                'email' => 'sometimes|nullable|email|max:64',
                'phone' => 'sometimes|nullable|max:20',
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

        /**
         * Support for multiple emails and phone numbers using JSON casting.
         * Takes a php assoc array and converts it to JSON to store in the
         * MySQL database.
         */
        $multiples = ['phone', 'email'];
        foreach ($multiples as $multiple) {
            if (empty($request->input($multiple))) {
                $contacts->$multiple = [];
            } else {
                $contacts->$multiple = [
                    $multiple . '_1' => $request->input($multiple),
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
    public function show($id)
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
    public function update(Request $request, $id)
    {
        $this->mainFormValidation($request);

        // Find contact by Id and update
        $contact = People::find($id);

        $contact->firstname = $request->input('firstname');
        $contact->lastname = $request->input('lastname');
        $contact->address = $request->input('address');
        $contact->city = $request->input('city');
        $contact->state = $request->input('state');
        $contact->zipcode = $request->input('zipcode');

        $email_request = $request->input('email');
        $email_variable = $request->email_variable;
        $phone_request = $request->input('phone');
        $phone_variable = $request->phone_variable;

        /**
         *  Fix this mess tomorrow!
         */
        if (!empty($email_request) && strcmp($email_request, $email_variable)) {
            $email_count = count($contact->email) + 1;
            $add_email = $contact->email;
            $add_email['email_' . $email_count] = $email_request;
            $contact->email = $add_email;

            // Delete old input value
            $search = array_search($email_variable, $contact->email);
            $email = $contact->email;
            unset($email[$search]);
            $contact->email = $email;
        } elseif (!strcmp($email_request, $email_variable)) {
            // do nothing
        } else {
            $email = $contact->email;
            $search = array_search($email_variable, $contact->email);
            unset($email[$search]);
            $contact->email = $email;
        }

        /**
         *
         */
        if (!empty($phone_request) && strcmp($phone_request, $phone_variable) ) {
            $phone_count = count($contact->phone) + 1;
            $add_phone = $contact->phone;
            $add_phone['phone_' . $phone_count] = $phone_request;
            $contact->phone = $add_phone;

            // Delete old input value
            $search = array_search($phone_variable, $contact->phone);
            $phone = $contact->phone;
            unset($phone[$search]);
            $contact->phone = $phone;
        } elseif (!strcmp($phone_request, $phone_variable)) {
            // do nothing
        } else {
            $phone = $contact->phone;
            $search = array_search($phone_variable, $contact->phone);
            unset($phone[$search]);
            $contact->phone = $phone;
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
        $contact->delete();

        return redirect('/contacts');
    }

}
