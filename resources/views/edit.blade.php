@extends('layouts.app')

@section('content')
  {{-- Edit form component --}}
  <div class="container">
    <div class="row justify-content-md-center mt-5">
      <div class="col-md-7">
        <div id="rip" class="card">

          <div class="card-header text-light bg-dark">
            <strong>Edit Contact</strong>
          </div>

          <div class="card-body">
            <form id="editForm" class="form-horizontal" method="POST"
                  action="{{ route('contacts.update', ['id' => $contact->id]) }}">
              {{ csrf_field() }}

              <div class="form-group row">
                <label for="firstname" class="col-lg-3 col-form-label text-lg-right">First Name</label>

                <div class="col-lg-6">
                  <input
                      id="firstname"
                      type="text"
                      class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                      name="firstname"
                      value="{{ $contact->firstname  }}"
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
                      value="{{ $contact->lastname }}"
                  >

                  @if ($errors->has('lastname'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              {{-- If email array is empty --}}
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

              {{-- If email array is not empty, loop through and add inputs for each element --}}
              @foreach($contact->email as $email)
                @php
                  $number = $loop->iteration
                @endphp

                <div class="form-group row">
                  <label for="email{{ $number }}" class="col-lg-3 col-form-label text-lg-right">
                    Email{{ $number > 0 ? ' ' . $number : '' }}
                  </label>

                  <div class="col-lg-6">
                    <input
                        id="email{{ $number }}"
                        type="text"
                        class="form-control{{ $errors->has('email' . $number) ? ' is-invalid' : '' }}"
                        name="email{{ $number }}"
                        value="{{ $email }}"
                    >
                    <input type="hidden" name="email{{ $number }}_variable" value="{{ $email }}">

                    @if ($errors->has('email' . $number))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('email' . $number) }}</strong>
                      </span>
                    @endif
                  </div>

                  {{--
                  Do not show add button if phone array has 5+ elements, only the delete button.
                  --}}
                  @if(count($contact->email) >= 5)
                    <div id="delete1" class="col-lg-1">
                      <span>
                        <button
                            class="btn btn-danger float-right"
                            id="deleteEmail{{ $number }}"
                            type="button"
                            data-toggle="modal"
                            data-target="#deleteEmailModal"
                            data-index="{{ $loop->index }}"
                        >
                          <i class="icon ion-close-circled"></i>
                        </button>
                      </span>
                    </div>

                  {{-- Show add button only on the top input --}}
                  @elseif($loop->index < 1)
                    <div class="col-lg-1">
                      <span>
                        <button
                            id="addEmail"
                            class="btn btn-primary float-right"
                            type="button"
                            data-toggle="modal"
                            data-target="#addEmailModal"
                        >
                          <i class="icon ion-plus-round"></i>
                        </button>
                      </span>
                    </div>

                  {{-- Show the delete buttons on the inputs only after the top input --}}
                  @elseif($loop->index >= 1)
                    <div class="col-lg-1">
                      <span>
                        <button
                            class="btn btn-danger float-right"
                            id="deleteEmail{{ $number }}"
                            type="button"
                            data-toggle="modal"
                            data-target="#deleteEmailModal"
                            data-index="{{ $loop->index }}"
                        >
                          <i class="icon ion-close-circled"></i>
                        </button>
                      </span>
                    </div>
                  @endif
                </div>

              @endforeach

              {{-- If phone array is empty --}}
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

              {{-- If phone array is not empty, loop through and add inputs for each element --}}
              @foreach($contact->phone as $phone)
                @php
                  $number = $loop->iteration;
                @endphp

                <div class="form-group row">
                  <label for="phone{{ $number }}" class="col-lg-3 col-form-label text-lg-right">
                    Phone{{ $number > 0 ? ' ' . $number : '' }}
                  </label>

                  <div class="col-lg-6">
                    <input
                        id="phone{{ $number }}"
                        type="text"
                        class="form-control{{ $errors->has('phone' . $number) ? ' is-invalid' : '' }}"
                        name="phone{{ $number }}"
                        value="{{ $phone }}"
                    >

                    <input type="hidden" name="phone{{ $number }}_variable" value="{{ $phone }}">

                    @if ($errors->has('phone' . $number))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('phone' . $number) }}</strong>
                      </span>
                    @endif
                  </div>

                  {{--
                  Do not show add button if phone array has 5+ elements, only the delete button.
                  --}}
                  @if(count($contact->phone) >= 5)
                    <div class="col-lg-1">
                      <span>
                        <button
                            class="btn btn-danger float-right"
                            id="deletePhone{{ $number }}"
                            data-toggle="modal"
                            data-target="#deletePhoneModal"
                            data-index="{{ $loop->index }}"
                        >
                          <i class="icon ion-close-circled"></i>
                        </button>
                      </span>
                    </div>

                  {{-- Show add button only on the top input --}}
                  @elseif($loop->index < 1)
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

                  {{-- Show the delete buttons on the inputs only after the top input --}}
                  @elseif($loop->index >= 1)
                    <div class="col-lg-1">
                      <button
                          id="deletePhone{{ $number }}"
                          class="btn btn-danger float-right"
                          type="button" data-toggle="modal"
                          data-target="#deletePhoneModal"
                          data-index="{{ $loop->index }}"
                      >
                        <i class="icon ion-close-circled"></i>
                      </button>
                    </div>
                  @endif
                </div>
              @endforeach

              <div class="form-group row">
                <label for="city" class="col-lg-3 col-form-label text-lg-right">Contacted</label>

                <div class="col-lg-6">

                  @if(!empty($contact->last_contact))
                  <input
                      id="date"
                      type="date"
                      class="form-control"
                      name="date"
                      value="{{ \Carbon\Carbon::parse($contact->last_contact)->toDateString() }}"
                  >
                  @else
                    <input
                        id="date"
                        type="date"
                        class="form-control"
                        name="date"
                        value="{{ $contact->last_contact }}"
                    >
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
                      value="{{ $contact->address }}"
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
                      value="{{ $contact->city }}"
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
                      value="{{ $contact->state }}"
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
                      value="{{ $contact->zipcode }}"
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
                  <a id="back" class="btn btn-info float-left" href="/contacts">
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
  @include('modals.addmodals')
  @include('modals.deletemodals')

@endsection