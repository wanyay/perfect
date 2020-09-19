@extends('layouts.app');

@section('title','Items List')

@section('styles')
<link rel="stylesheet" type="text/css" href="{!! asset('css/sweetalert.css') !!}">
<link rel="stylesheet" type="text/css" href="{{ url('plugins/datatable/dataTables.semanticui.min.css')}}">
@endsection

@section('content')
<div class="ui equal width left aligned padded grid stackable" id="app">
    <div class="row" id="itemList">
        <div class="sixteen column">
            <div class="ui segments">
                <div class="ui segment no-padding-bottom">
                    <h5 class="ui left floated header">Items</h5>
                    <h5 class="ui right floated header">
                        <a href="{{ route('items.create') }}" class="tiny ui greenli button"><i class="plus icon"></i>New</a>
                        <a href="#" class="tiny ui blueli button" id="getExcel"><i class="download icon"></i>Export</a>
                    </h5>
                  <div class="clearfix"></div>
                </div>
                <item-list></item-list>
            </div>
          </div>
        </div>
    <form action="{{ route('items.export') }}" method="POST" id="export">
        @csrf
    </form>
@endsection
@section('scripts')
<script src="{{ asset('js/main.js') }}"></script>
        <script>
                $("#getExcel").on('click', function (e) {
                    e.preventDefault();
                    let search = $("#search").val();
                    $('<input>').attr('type','hidden')
                        .attr('name', 'search')
                        .attr('value', search)
                        .appendTo('#export');
                    $('#export').submit();
                });
        </script>
@endsection
