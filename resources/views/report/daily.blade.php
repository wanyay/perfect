@extends('layouts.app')

@section('title', 'Daily')

@section('styles')
@endsection

@section('content')

		    <div class="ui equal width center aligned padded grid stackable"
        ng-controller="angularDailyController">
			      <div class="two column row">
              <div class="column">
                <div class="ui segments">
                    <div class="ui segment inverted blueli">
                      <h5 class="ui header">Daily Info</h5>
                    </div>
                       <div class="ui segment">
                           <table class="table ui">
                             <tr>
                                 <td>Date</td>
                                 <td>
                                    <div class="ui input">
                                     <input type="date" name="date" placeholder="Selete Date" id="date-input" ng-model='date' ng-change="change()">
                                    </div>
                                  </td>
                             </tr>
                             <tr>
                                 <td>Sale Invoices</td>
                                 <td>@{{ data.info.invoices }}</td>
                             </tr>
														 <tr>
														 		 <td>Income</td>
																 <td>@{{ data.info.s_total }}Ks</td>
														 </tr>
                             <tr>
                                 <td>Credit</td>
                                 <td>@{{ data.info.credit }}Ks</td>
                             </tr>
                             <tr>
                               <td>Profit</td>
                                 <td>@{{ data.info.profit }}Ks</td>
                             </tr>
                             <tr>
                                 <td>Purchase Invoices</td>
                                 <td>@{{ data.info.p_invoices }}</td>
                             </tr>
														 <tr>
														 	<td>Outcome</td>
															<td>@{{ data.info.p_total }}Ks</td>
														 </tr>
                             <tr>
                               <td>Purchase Credit</td>
                               <td>@{{ data.info.p_credit }}Ks</td>
                             </tr>
                             <tr>
                               <td>Expense</td>
                               <td>@{{ data.info.expense }}Ks</td>
                             </tr>
                           </table>
                       </div>
                   </div>
              </div>
              <!-- <div class="column">

              </div> -->
              
            </div>
            <div class="row">
              <div class="column">
                <div class="eight wide column">
                    <div class="ui segments">
                        <div class="ui segment inverted blueli">
                            <h5>Item List</h5>
                        </div>
                        <div class="ui segment">
                          <div class="table-responsive">
                            <table id="data_table_info" class="ui compact selectable striped celled table" cellspacing="0" width="100%">
                              <thead>
                              <tr>
                                <th>Item Name</th>
                                <th>Total</th>
                              </tr>
                              </thead>
                              <tbody>
                               <tr ng-repeat="d in data.itmes">
                                <th>@{{d.item.name}}</th>
                                <th>@{{d.total}}</th>
                               </tr>
                              </tbody>
                            </table>
                            
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
@endsection
@section('scripts')
<!--   <script src="{{url('plugins/datatable/jquery.dataTables.js')}}"></script>
  <script src="js/customjs/custom-datatable.js"></script> -->
  <script type="text/javascript" src="{{url('js/angular.min.js')}}"></script>
  <script type="text/javascript" src="{{url('js/angular-daily.js')}}"></script>
@endsection
