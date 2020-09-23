@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{!! asset('css/sweetalert.css') !!}">
<link rel="stylesheet" type="text/css" href="{{ url('plugins/datatable/dataTables.semanticui.min.css')}}">
@endsection

@section('content')
@include('errors.validation')
<div class="ui equal width left aligned padded grid stackable" id="app">
    <div class="row">
        <div class="sixteen column">
            <div class="ui segments">
                <div class="ui segment no-padding-bottom">
                  <h5 class="ui left floated header">Sale List</h5>
                  <h5 class="ui right floated header">
                    <a href="{{url('/sales/create')}}" class="tiny ui greenli button"><i class="plus icon"></i>New</a>
                  </h5>
                  <div class="clearfix"></div>
                </div>
                <sale-list></sale-list>
                </div>
              </div>
            </div>
          </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
@endsection
