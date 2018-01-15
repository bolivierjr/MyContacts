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
              <div class="table-responsive">
                <table data-pagination="true" data-search="true" data-toggle="table">
                  <thead>
                  <tr>
                    <th></th>
                    <th data-sortable="true">First</th>
                    <th data-sortable="true">Last</th>
                    <th data-sortable="true">City</th>
                    <th data-sortable="true">State</th>
                    <th data-sortable="true">Zipcode</th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>

                  @foreach($peoples as $people)
                    <tr>
                      <td data-toggle="modal" data-target="#{{$people->id}}">
                        <div class="text-center">
                          <i class="icon ion-plus-round"></i>
                        </div>
                      </td>
                      <td>{{$people->firstname}}</td>
                      <td>{{$people->lastname}}</td>
                      <td>{{$people->city}}</td>
                      <td>{{$people->state}}</td>
                      <td>{{$people->zipcode}}</td>

                      <!-- Button to edit the contact -->
                      <td class="text-center">
                        <a class="btn btn-info btn-sm" href="/contacts/{{ $people->id }}/edit"><i class="icon ion-edit"></i></a>
                      </td>

                      <!-- Button to delete contact from db -->
                      <td class="text-center">
                        <form method="POST" action="{{ route('contacts.destroy', ['id' => $people->id]) }}">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="btn btn-sm"><i class="icon ion-trash-a"></i></button>
                        </form>
                      </td>
                    </tr>

                    @include('modals.contact')
                  @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          @endif

        </div>
      </div>
    </div>
  </div>
@endsection
