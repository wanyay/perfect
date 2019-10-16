@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <edit-unit :unit= "{{ $unit }}"></edit-unit>
        </div>
    </div>
@endsection
