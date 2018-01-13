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
                @foreach($peoples as $people)
                    <div class="panel-heading">
                        <p>{{ $people->firstname }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
