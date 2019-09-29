@extends('layouts.app');

@section('title','Units List')

@section('styles')
<link rel="stylesheet" type="text/css" href="{!! asset('css/sweetalert.css') !!}">
<link rel="stylesheet" type="text/css" href="{{ url('plugins/datatable/dataTables.semanticui.min.css')}}">
@endsection

@section('content')
		    @include('errors.validation')
        <div class="ui equal width left aligned padded grid stackable">

            <div class="row">
                <div class="sixteen wide column">
                    <div class="ui segments">
                        <div class="ui segment no-padding-bottom">
                            <h5 class="ui left floated header">Today Due Credits</h5>
                            <div class="clearfix"></div>
                        </div>
                        <div class="ui segment">
                            <div class="table-responsive">
                                <table id="data_table_info" class="ui compact selectable striped celled table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Customer</th>
                                            <th>Credit Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($totalDueDateCredits as $sale)
                                    <tr>
                                        <td>{{$sale->code}}</td>
                                        @if($sale->customer)
                                        <td>{{$sale->customer->name}}</td>
                                        @else
                                        <td>N/A</td>
                                        @endif
                                        <td>
                                            {{ $sale->total - $sale->cash}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
@endsection
@section('scripts')
<script src="{{url('plugins/datatable/jquery.dataTables.js')}}"></script>
<script src="js/customjs/custom-datatable.js"></script>

@endsection
