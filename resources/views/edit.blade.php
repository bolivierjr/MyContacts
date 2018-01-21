@extends('layouts.app')

@section('content')
  <!-- Edit form component -->
  <div class="container">
    <div class="row justify-content-md-center mt-5">
      <div class="col-md-7">
        <div id="rip" class="card">

          <div class="card-header text-light bg-dark">
            <strong>Edit Contact</strong>
          </div>

          <div class="card-body">
            <form id="editForm" class="form-horizontal" method="POST" action="{{ route('contacts.update', ['id' => $contact->id]) }}">
              {{ csrf_field() }}

              <div class="form-group row">
                <label for="firstname" class="col-lg-3 col-form-label text-lg-right">First Name</label>

                <div class="col-lg-6">
                  <input
                      id="firstname"
                      type="text"
                      class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                      name="firstname"
                      value="{{ old('firstname') ? old('firstname') : $contact->firstname }}"
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
                      value="{{ old('lastname') ? old('lastname') : $contact->lastname }}"
                  >

                  @if ($errors->has('lastname'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              @if(empty($contact->email))
                <div class="form-group row">
                  <label for="email1" class="col-lg-3 col-form-label text-lg-right">Email</label>

                  <div class="col-lg-6">
                    <input
                        id="email1"
                        type="text"
                        class="form-control{{ $errors->has('email1') ? ' is-invalid' : '' }}"
                        name="email1"
                        value=""
                    >

                    @if ($errors->has('email1'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('email1') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              @endif

              @foreach($contact->email as $email)
                @php
                  $number = $loop->iteration
                @endphp
                {{--@if($loop->index == 5)--}}
                {{--@break--}}
                {{--@endif--}}
                <div class="form-group row">
                  <label for="email{{ $number }}" class="col-lg-3 col-form-label text-lg-right">
                    Email{{ $loop->iteration > 1 ? ' ' . $number : '' }}
                  </label>

                  <div class="col-lg-6">
                    <input
                        id="email{{ $number }}"
                        type="text"
                        class="form-control{{ $errors->has('email' . $number) ? ' is-invalid' : '' }}"
                        name="email{{ $number }}"
                        value="{{ old('email' . $number) ? old('email' . $number) : $email }}"
                    >
                    <input type="hidden" name="email{{ $number }}_variable" value="{{ $email }}">

                    @if ($errors->has('email' . $number))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('email' . $number) }}</strong>
                      </span>
                    @endif
                  </div>

                  @if($loop->index < 1)
                    <div class="col-lg-1">
                      <span>
                        <button
                            id="addEmail"
                            class="btn btn-primary float-right"
                            type="button" data-toggle="modal"
                            data-target="#addEmailModal"
                        >
                          <i class="icon ion-plus-round"></i>
                        </button>
                        </span>
                    </div>
                  @endif
                </div>
              @endforeach

              @if(empty($contact->phone))
                <div class="form-group row">
                  <label for="phone1" class="col-lg-3 col-form-label text-lg-right">Phone</label>

                  <div class="col-lg-6">
                    <input
                        id="phone1"
                        type="text"
                        class="form-control{{ $errors->has('phone1') ? ' is-invalid' : '' }}"
                        name="phone1"
                        value=""
                    >

                    @if ($errors->has('phone1'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('phone1') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              @endif

              @foreach($contact->phone as $phone)
                @php
                  $number = $loop->iteration
                @endphp

                <div class="form-group row">
                  <label for="phone{{ $number }}" class="col-lg-3 col-form-label text-lg-right">
                    Phone{{ $loop->iteration > 1 ? ' ' . $number : '' }}
                  </label>

                  <div class="col-lg-6">
                    <input
                        id="phone{{ $number }}"
                        type="text"
                        class="form-control{{ $errors->has('phone' . $number) ? ' is-invalid' : '' }}"
                        name="phone{{ $number }}"
                        value="{{ old('phone' . $number) ? old('phone' . $number) : $phone }}"
                    >

                    <input type="hidden" name="phone{{ $number }}_variable" value="{{ $phone }}">

                    @if ($errors->has('phone' . $number))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('phone' . $number) }}</strong>
                      </span>
                    @endif
                  </div>

                  @if($loop->index < 1)
                    <div class="col-lg-1">
                      <span>
                        <button
                            id="addPhone"
                            class="btn btn-primary float-right"
                            type="button" data-toggle="modal"
                            data-target="#addPhoneModal"
                        >
                          <i class="icon ion-plus-round"></i>
                        </button>
                      </span>
                    </div>
                  {{--@elseif($loop->index >= 1)--}}
                    {{--<div class="col-lg-1">--}}
                      {{--<span>--}}
                        {{--<button--}}
                            {{--id="addPhone"--}}
                            {{--class="btn btn-danger float-right"--}}
                            {{--type="button" data-toggle="modal"--}}
                            {{--data-target="#addPhoneModal"--}}
                        {{-->--}}
                          {{--<i class="icon ion-minus-round"></i>--}}
                        {{--</button>--}}
                      {{--</span>--}}
                    {{--</div>--}}
                  @endif
                </div>
              @endforeach

              <div class="form-group row">
                <label for="address" class="col-lg-3 col-form-label text-lg-right">Street Address</label>

                <div class="col-lg-6">
                  <input
                      id="address"
                      type="text"
                      class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                      name="address"
                      value="{{ old('address') ? old('address') : $contact->address }}"
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
                      value="{{ old('city') ? old('city') : $contact->city }}"
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
                      value="{{ old('state') ? old('state') : $contact->state }}"
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
                      value="{{ old('zipcode') ? old('zipcode') : $contact->zipcode }}"
                  >

                  @if ($errors->has('zipcode'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('zipcode') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <input type="hidden" name="_method" value="PUT">

              <div class="form-group row">
                <div class="col-lg-6 offset-lg-3">
                  <a class="btn btn-info float-left" href="/contacts">
                    Back
                  </a>
                  <button id="submitEdit" type="submit" class="btn btn-primary float-right">
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
  @include('modals.addmodal')

@endsection