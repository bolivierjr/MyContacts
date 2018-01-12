<?php

namespace App\Http\Controllers;

use Validator;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contacts');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Checks to see if address, city, state, zip field is populated. If so, then require all.
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
                'firstname' => 'required|string|max:64|regex:/[a-zA-Z]/',
                'lastname' => 'required|string|max:64',
                'email' => 'sometimes|nullable|email|max:64',
                'phone' => 'sometimes|nullable|max:20',
            ])->validate();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
