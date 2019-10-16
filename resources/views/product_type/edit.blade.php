@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <edit-ptype :ptype= "{{ $productType }}"></edit-ptype>
        </div>
    </div>
@endsection
