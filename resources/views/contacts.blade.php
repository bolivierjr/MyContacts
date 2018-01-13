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

          <!-- Show this if no contacts are found -->
          @if(!count($peoples))
            <div class="panel-body"><p>Add some contacts!</p></div>
          @endif
          <div class="panel-body">
            <table data-toggle="table" data-pagination="true" data-search="true">
              <thead>
              <tr>
                <th data-sortable="true" data-field="firstname">First</th>
                <th data-sortable="true" data-field="lastname">Last</th>
                <th data-sortable="true" data-field="email">Email</th>
                <th data-sortable="true" data-field="phone">Phone</th>
                <th data-sortable="true" data-field="address">Address</th>
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
                  <td>{{$people->address}}, {{$people->city}}, {{$people->state}} {{$people->zipcode}}</td>
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
                    {{--<div class="clearfix"></div>--}}
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>

          {{--@foreach($peoples as $people)--}}

            {{--<div class="panel-heading">--}}
              {{--<p>{{$people->firstname}}</p>--}}
              {{--<!-- Button to edit the contact -->--}}
              {{--<a class="pull-left" href="/contacts/{{ $people->id }}/edit">Edit</a>--}}

              {{--<!-- Button to delete contact from db -->--}}
              {{--<form method="POST" action="{{ route('contacts.destroy', ['id' => $people->id]) }}">--}}
                {{--{{ csrf_field() }}--}}
                {{--<input type="hidden" name="_method" value="DELETE">--}}
                {{--<button type="submit" class="btn btn-primary btn-sm pull-right">Delete</button>--}}
              {{--</form>--}}

              {{--<div class="clearfix"></div>--}}
            {{--</div>--}}
          {{--@endforeach--}}

        </div>
      </div>
    </div>
  </div>
@endsection
