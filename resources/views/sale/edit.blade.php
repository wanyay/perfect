@extends('layouts.app')

@section('styles')

    <style type="text/css">

        .ibox-footer{
            height:60px;
        }
    </style>

@endsection

@section('content')
<div class="ui equal width left aligned padded grid stackable" ng-controller ="angularSaleController">
  @include('errors.validation')

  <div class="row">
      <div class="three wide column">

        <div class="ui segments">
            <div class="ui segment">
                <h5 class="ui header">
                    Item
                </h5>
            </div>
            <div class="ui segment">
                <div class="ui vertical fluid menu no-border no-radius">
                  <div class="ui input">
                    <input id="bCode" ng-model="searchKeyword" type="text" placeholder="Item Code" style="padding-right:25px">
                  </div>
                  <div class="scroll_content">
                    <a ng-repeat="item in items  | filter: searchKeyword" class="item"  ng-click="addSaleTemp(item)">
                      @{{item.name}}</i>
                    </a>
                  </div>

                </div>
            </div>
            <barcode-scanner separator-char="separatorChar" trigger-char="triggerChar" scan-callback="scanCallback"
                            trigger-callback="triggerCallback"></barcode-scanner>
        </div>
      </div>

    <div class="thirteen wide column">
            <div class="ui segments">
                  <div class="ui segment">
                      <h5 class="ui header">Invoice</h5>
                  </div>
                    {!! Form::model($sale,['route' => ['sales.update', $sale->id],'class' => 'ui form segment form3'])!!}
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="two fields">
                      <div class="field">
                        <label>Code</label>
                        {!! Form::text('code',null,['class'=>'form-control','required','placeholder' => 'Code'])!!}
                      </div>
                      <div class="field">
                      </div>
                    </div>
                    <div class="two fields">
                      <div class="field">
                        <label>Payment Type</label>
                        <select name="payment_type" id="payment_type">
                          @if($sale->payment_type == 'cash')
                            <option selected value="cash">Cash</option>
                            <option value="credit">Credit</option>
                          @else
                            <option value="cash">Cash</option>
                            <option selected value="credit">Credit</option>
                          @endif
                        </select>
                      </div>
                      <div class="field">
                      </div>
                    </div>
                    <div class="two fields" id="customer">
                      <div class="field">
                        <label>Customer</label>
                        {!! Form::select('customer_id',$customers,$customer_selected,['class'=>'form-control','placeholder' => 'Select One'])!!}
                      </div>
                      <div class="field">
                      </div>
                    </div>
                    <div class="two fields" id="cash">
                      <div class="field">
                        <label>Cash</label>
                        <input type="text" class="form-control" name="cash" value={{$sale->cash}}>
                      </div>
                      <div class="field">
                      </div>
                    </div>
                    <div class="two fields">
                      <div class="field">
                        <label>Grand Total</label>
                        <input type="text" value="@{{sum(saledata)}}" disabled>
                        <input type="hidden" name="total" value="@{{sum(saledata)}}">
                        <input type="hidden" name="profix" value="@{{total_profix(saledata)}}">
                      </div>
                      <div class="field">
                      </div>
                    </div>
              <table class="ui small table" ng-init="getSaleItem({{$sale->id}})">
                 <thead>
                   <tr>
                     <th>Code</th>
                     <th>Name</th>
                     <th>Price</th>
                     <th style="width:100px">Qty</th>
                     <th>Total</th>
                     <th>Delete</th>
                   </tr>
                 </thead>
                 <input type="hidden" name="saleitems" value="@{{saledata}}">
                 <tbody>
                   <tr ng-repeat="newsaletemp in saledata">
                     <td>@{{newsaletemp.code}}</td>
                     <td>@{{newsaletemp.name}}</td>
                     <td>@{{newsaletemp.price | currency}}</td>
                     <td>
                        <input type="number" class="form-control" style="text-align:center" autocomplete="off"  ng-change="updateSaleTemp(newsaletemp)" ng-model="newsaletemp.qty" size="1">
                     </td>
                     <td>@{{newsaletemp.price * newsaletemp.qty | currency}}</td>
                     <td>
                       <a class="btn btn-danger btn-xs" type="button" ng-click="removeSaleTemp(newsaletemp.id)">
                       <i class="icon red trash" aria-hidden="true"></i></a>
                     </td>
                   </tr>
                 </tbody>
             </table>
             <center>{!! Form::submit('Add',['class' => 'ui primary button saving','style'=>'margin-right:5px','id'=>'add']) !!}</center>
                    {!! Form::close() !!}
              </div>
            </div>
  </div>

</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{url('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/angular.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/angular-barcode-scanner.js')}}"></script>
<script type="text/javascript" src="{{url('js/angular-sale.js')}}"></script>
<script type="text/javascript" src="{{url('js/sale.js')}}"></script>
<script type="text/javascript">
$(window).ready(function(){
	$('.scroll_content').slimscroll({
			height: '375px'
	});
  @if($sale->payment_type != 'cash')

  $('#customer').show();
  $('#cash').show();
  @endif
});

</script>

@endsection
