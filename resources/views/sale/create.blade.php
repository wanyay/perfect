@extends('layouts.app')

@section('styles')
@endsection

@section('content')
      @include('errors.validation')
		<div class="ui equal width left aligned padded grid stackable" ng-controller ="angularSaleController">
      <div class="row">
          <div class="five wide column">

            <div class="ui segments">
                <div class="ui segment">
                    <h5 class="ui header">
                        Item
                    </h5>
                </div>
                <div class="ui segment">
                    <div class="ui vertical fluid menu no-border no-radius">
											<div class="ui input">
												<input id="bCode" ng-model="searchKeyword" type="text" placeholder="Item Code" style="padding-left:75px">
											</div>
											<div class="scroll_content">
												<a ng-repeat="item in items  | filter: searchKeyword" class="item"  ng-click="addSaleTemp(item)">
													@{{item.name}}
												</a>
											</div>

                    </div>
                </div>
								<barcode-scanner separator-char="separatorChar" trigger-char="triggerChar" scan-callback="scanCallback"
																trigger-callback="triggerCallback"></barcode-scanner>
            </div>
          </div>

        <div class="eleven wide column">
                <div class="ui segments">
                      <div class="ui segment">
                          <h5 class="ui header">Invoice</h5>
                      </div>
                        {!! Form::open(['url' => '/sales','class' => 'ui form segment form3'])!!}
												<div class="two fields">
													<div class="field">
														<label>Code</label>
														{!! Form::text('code',$invoiceNo,['class'=>'form-control','required','placeholder' => 'Code'])!!}
													</div>
													<div class="field">
													</div>
                        </div>
                        <div class="two fields">
                          <div class="field">
                            <label>Date</label>
                            {!! Form::date('created_at', now(),null, ['required']) !!}
                          </div>
                        </div>
												<div class="two fields">
													<div class="field">
														<label>Payment Type</label>
														<select name="payment_type" id="payment_type">
								              <option value="cash" selected>Cash</option>
								              <option value="credit">Credit</option>
								            </select>
													</div>
													<div class="field">
													</div>
												</div>
												<div id="customer">
                        <div class="two fields">
													<div class="field">
														<label>Customer</label>
                            <select id="customer" class="form-control" name = "customer_id" ng-options="cu.id as cu.name for cu in customers track by cu.id" data-ng-model="selectedOption">
                                <option value="">Select Customer</option>
                            </select>
                          </div>
                          @if (auth()->user()->hasRole('admin'))
                            <div class="field">
                              <label> &nbsp;</label>
                              <a href="" onclick="showModal()" class="ui green icon button basic small modalfour"><i class="green plus icon"></i></a>
                            </div>
                           @endif
                        </div>
                        <div class="two fields"> 
                          <div class="field">
                            <label>Credit Due Date</label>
                            {!! Form::date('credit_due_date', nextWeek(),null, ['required']) !!}
                          </div>
                        </div>
                        </div>
												<div class="two fields" id="cash">
													<div class="field">
														<label>Cash</label>
														<input type="text" class="form-control" name="cash" value="0">
													</div>
													<div class="field">
													</div>
												</div>
                        <div class="two fields">
                          <div class="field">
                            <label>Discount</label>
                            <input type="number"  name="discount" value="0">
                          </div>
                          <div class="field">
                          </div>
                        </div>
												<div class="two fields">
													<div class="field">
														<label>Grand Total</label>
														<input type="text" value="@{{sum(saledata)}}" disabled>
             								<input type="hidden" name="total" value="@{{sum(saledata)}}">
                            <input type="hidden" name="profit" value="@{{total_profix(saledata)}}">
													</div>
													<div class="field">
													</div>
												</div>
									<table class="ui small table">
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
                            <input type="number" class="form-control" style="text-align:center" autocomplete="off" ng-change="updateSaleTemp(newsaletemp)" ng-model="newsaletemp.qty" size="1">
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

      <div class="ui small test modal">
          <div class="header">
              Create New Customer
          </div>
          <div class="content">
            <div class="ui form">
              <div class="tow field">
                  <div class="field">
                    <label style="text-align: left;">Name</label>
                  </div>
                  <div class="field">
                    <input type="text" ng-model="customer.name" class = "form-control" placeholder="Name" ng-required>
                  </div>
              </div>

              <div class="tow field">
                  <div class="field">
                    <label style="text-align: left;">Phone</label>
                  </div>
                  <div class="field">
                    <input class="form-control" type="text"  ng-model="customer.phone" placeholder="Phone" ng-required>
                  </div>
              </div>

              <div class="tow field">
                  <div class="field">
                    <label style="text-align: left;">Address</label>
                  </div>
                  <div class="field">
                    <textarea  class="form-control" type="text" ng-model="customer.address" placeholder="Address" rows="4" ng-required></textarea>
                  </div>
              </div>

            </div>

          </div>
          <div class="actions">
              <div class="ui negative button">
                  Cancel
              </div>
                  <a type="button" class="ui greenli button" ng-click="newCustomer()">Add</a>
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
});

function showModal()
{
  $('.ui.modal').modal('show');
}

</script>
@endsection
