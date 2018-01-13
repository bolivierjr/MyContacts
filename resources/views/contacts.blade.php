@extends('layouts.app')

@section('content')
  <!-- Main Contacts component -->
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">

          <div class="panel-heading">
            <strong>Contacts</strong>
            <div class="text-center pull-right">
              <a href="{{ route('contacts.create') }}" class="btn btn-success btn-sm">Add Contact</a>
            </div>
            <div class="clearfix"></div>
          </div>

          @if(!count($peoples))
            <div class="panel-heading">
              <p>Add some contacts!</p>
            </div>
          @endif

          @foreach($peoples as $people)
            <div class="panel-heading">
              @if(!count($peoples))
                <p>Add some contacts!</p>
              @endif
              <p>{{ $people->firstname }}</p>

              <!-- Button to edit the contact -->
              <a class="pull-left" href="/contacts/{{ $people->id }}/edit">Edit</a>

              <!-- Button to delete contact from db -->
              <form method="POST" action="{{ route('contacts.destroy', ['id' => $people->id]) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-primary btn-sm pull-right">Delete</button>
              </form>

              <div class="clearfix"></div>
            </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
@endsection
