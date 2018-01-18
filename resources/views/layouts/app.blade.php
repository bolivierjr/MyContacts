<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'MyContacts') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-table.min.css') }}">
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body>
<div id="app">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/contacts') }}">
        {{ config('app.name', 'MyContacts') }}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
          @if (Auth::guest())
            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
          @else
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a href="{{ route('logout') }}" class="dropdown-item"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                  {{ csrf_field() }}
                </form>
              </div>
            </li>
          @endif
        </ul>
      </div>

    </div>
  </nav>

  @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap-table.min.js') }}"></script>
{{--<script type="text/javascript">--}}
  {{--$('document').ready(function() {--}}

    {{--// $('#addModal').modal('hide');--}}
    {{--//--}}
    {{--// $('button').click()--}}

    {{--// $('body').on('click', '#submitForm', function(){--}}
    {{--//--}}
      {{--// var registerForm = $("#addForm");--}}
      {{--// var formData = registerForm.serialize();--}}
      {{--// $( '#email-error' ).html( "" );--}}
      {{--//--}}
      {{--// $('#addModal').modal('show');--}}
      {{--$.ajax({--}}
        {{--url:"{{ route('contacts.email', ['id' => $contact->id]) }}",--}}
        {{--type:'POST',--}}
        {{--data: formData,--}}
        {{--success:function(data) {--}}

          {{--if(data.errors) {--}}
            {{--if(data.errors.email){--}}
              {{--$( '#email-error' ).html( data.errors.email[0] );--}}
            {{--}--}}

          {{--}--}}
          {{--if(data.success) {--}}
            {{--setInterval(function(){--}}
              {{--$('#addModal').modal({show: true});--}}
            {{--}, 3000);--}}
          {{--}--}}
        {{--},--}}
      {{--});--}}
  {{--});--}}
{{--</script>--}}
</body>
</html>

