@extends('layouts.app')

@section('content')
  <!-- Main Contacts component -->
  <div class="container">
    <div class="row justify-content-md-center mt-5">
      <div class="col-md-8">
        <div class="card">

          <div class="card-header text-light bg-dark">
            <strong>Contacts</strong>
            <div class="float-right">
              <a href="{{ route('contacts.create') }}" class="btn btn-success btn-sm">Add Contact</a>
            </div>
          </div>

          <!-- Show this if no contacts are found -->
          @if(!count($peoples))
            <div class="card-body"><p>Add some contacts!</p></div>
          @else

            <div class="card-body">
              <table id="contacts-table" class="table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>First</th>
                  <th>Last</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th></th>
                  <th></th>

                </tr>
                </thead>
                <tbody>
                @foreach($peoples as $people)
                  <tr>
                    <td>{{$people->firstname}}</td>
                    <td>{{$people->lastname}}</td>
                    <td>{{$people->email}}</td>
                    <td>{{$people->phone}}</td>
                    <td>{{$people->address}}, {{$people->city}}
                      , {{$people->state}} {{$people->zipcode}}</td>
                    <td>
                      <!-- Button to edit the contact -->
                      <a class="btn btn-info btn-sm" href="/contacts/{{ $people->id }}/edit">edit</a>
                    </td>
                    <td>
                      <!-- Button to delete contact from db -->
                      <form method="POST" action="{{ route('contacts.destroy', ['id' => $people->id]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm">delete</button>
                      </form>
                    </td>
                @endforeach
                </tbody>
              </table>
            </div>
          @endif

        </div>
      </div>
    </div>
  </div>
@endsection
