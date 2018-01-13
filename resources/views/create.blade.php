@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">

          <div class="panel-heading">
            <strong>Add Contact</strong>
          </div>

          <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('contacts.store') }}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                <label for="firstname" class="col-md-4 control-label">First Name</label>

                <div class="col-md-6">
                  <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" autofocus>

                  @if ($errors->has('firstname'))
                    <span class="help-block">
                      <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label for="lastname" class="col-md-4 control-label">Last Name</label>

                <div class="col-md-6">
                  <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

                  @if ($errors->has('lastname'))
                    <span class="help-block">
                      <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Email</label>

                <div class="col-md-6">
                  <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">

                  @if ($errors->has('email'))
                    <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="col-md-4 control-label">Phone #</label>

                <div class="col-md-6">
                  <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                  @if ($errors->has('phone'))
                    <span class="help-block">
                      <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="address" class="col-md-4 control-label">Street Address</label>

                <div class="col-md-6">
                  <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}">

                  @if ($errors->has('address'))
                    <span class="help-block">
                      <strong>{{ $errors->first('address') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                <label for="city" class="col-md-4 control-label">City</label>

                <div class="col-md-6">
                  <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}">

                  @if ($errors->has('city'))
                    <span class="help-block">
                      <strong>{{ $errors->first('city') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                <label for="state" class="col-md-4 control-label">State</label>

                <div class="col-md-6">
                  <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}">

                  @if ($errors->has('state'))
                    <span class="help-block">
                      <strong>{{ $errors->first('state') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                <label for="zipcode" class="col-md-4 control-label">Zipcode</label>

                <div class="col-md-6">
                  <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ old('zipcode') }}">

                  @if ($errors->has('zipcode'))
                    <span class="help-block">
                      <strong>{{ $errors->first('zipcode') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    Save
                  </button>
                </div>
                <div class="col-md-8 col-md-offset-4">
                  <a class="btn btn-default pull-left" href="/contacts">
                    Back
                  </a>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection