@extends('layouts.app')

@section('content')
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
              <a class="pull-left" href="/contacts/{{ $people->id }}/edit">Edit</a>
                <form action="{{ route('contacts.delete') }}">
                  <a class="pull-right" href="">Delete</a>
                  <input type="hidden" name="_method" value="DELETE">
                </form>
              <div class="clearfix"></div>
            </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
@endsection
