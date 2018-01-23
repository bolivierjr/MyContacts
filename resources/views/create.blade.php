@extends('layouts.app')

@section('content')
  {{-- Create form component --}}
  <div class="container">
    <div class="row justify-content-md-center mt-5">
      <div class="col-md-7">
        <div class="card">

          <div class="card-header text-light bg-dark">
            <strong>Add Contact</strong>
          </div>

          <div class="card-body">
            <form id="createForm" class="form-horizontal" method="POST" action="{{ route('contacts.store') }}">
              {{ csrf_field() }}

              <div class="form-group row">
                <label for="firstname" class="col-lg-3 col-form-label text-lg-right">First Name</label>

                <div class="col-lg-6">
                  <input
                      id="firstname"
                      type="text"
                      class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                      name="firstname"
                      value="{{ old('firstname') }}"
                      autofocus
                  >

                  @if ($errors->has('firstname'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="lastname" class="col-lg-3 col-form-label text-lg-right">Last Name</label>

                <div class="col-lg-6">
                  <input
                      id="lastname"
                      type="text"
                      class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                      name="lastname"
                      value="{{ old('lastname') }}"
                  >

                  @if ($errors->has('lastname'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="email1" class="col-lg-3 col-form-label text-lg-right">Email</label>

                <div class="col-lg-6">
                  <input
                      id="email1"
                      type="text"
                      class="form-control{{ $errors->has('email1') ? ' is-invalid' : '' }}"
                      name="email1"
                      value="{{ old('email1') }}"
                  >

                  @if ($errors->has('email1'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('email1') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="phone1" class="col-lg-3 col-form-label text-lg-right">Phone</label>

                <div class="col-lg-6">
                  <input
                      id="phone1"
                      type="text"
                      class="form-control{{ $errors->has('phone1') ? ' is-invalid' : '' }}"
                      name="phone1"
                      value="{{ old('phone1') }}"
                  >

                  @if ($errors->has('phone1'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('phone1') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="address" class="col-lg-3 col-form-label text-lg-right">Street Address</label>

                <div class="col-lg-6">
                  <input
                      id="address"
                      type="text"
                      class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                      name="address"
                      value="{{ old('address') }}"
                  >

                  @if ($errors->has('address'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('address') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="city" class="col-lg-3 col-form-label text-lg-right">City</label>

                <div class="col-lg-6">
                  <input
                      id="city"
                      type="text"
                      class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                      name="city"
                      value="{{ old('city') }}"
                  >

                  @if ($errors->has('city'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('city') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="state" class="col-lg-3 col-form-label text-lg-right">State</label>

                <div class="col-lg-6">
                  <input
                      id="state"
                      type="text"
                      class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}"
                      name="state"
                      value="{{ old('state') }}"
                  >

                  @if ($errors->has('state'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('state') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="zipcode" class="col-lg-3 col-form-label text-lg-right">Zipcode</label>

                <div class="col-lg-6">
                  <input
                      id="zipcode"
                      type="text"
                      class="form-control{{ $errors->has('zipcode') ? ' is-invalid' : '' }}"
                      name="zipcode"
                      value="{{ old('zipcode') }}"
                  >

                  @if ($errors->has('zipcode'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('zipcode') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <div class="col-lg-6 offset-lg-3">
                  <a id="back" class="btn btn-info float-left" href="/contacts">
                    Back
                  </a>
                  <button id="submitCreate" type="submit" class="btn btn-primary float-right">
                    Save
                  </button>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection