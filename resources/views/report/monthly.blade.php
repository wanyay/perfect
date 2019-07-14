@extends('layouts.app')

@section('title', 'Daily')

@section('styles')
@endsection

@section('content')

		    <div class="ui equal width center aligned padded grid stackable"
        ng-controller="angularMonthlyController">
            <div class="row">
              <div class="column">
                <div class="ui segments">
                  <div class="ui segment inverted blueli">
                      <h5 class="ui header">Month</h5>
                  </div>
                <div class="ui segment">
                  <table class="table ui">
                        <tr>
                         <td>Month</td>
                         <td>
                           <form class="ui form">
                             <div class="ui input">
                              <select name="month" required="required" id="month">
                               <option selected="selected">Select Month</option>
                               <option value="01" >Junuary</option>
                               <option value="02" >February</option>
                               <option value="03" >March</option>
                               <option value="04" >April</option>
                               <option value="05" >May</option>
                               <option value="06" >June</option>
                               <option value="07" >July</option>
                               <option value="08" >August</option>
                               <option value="09" >September</option>
                               <option value="10">October</option>
                               <option value="11">November</option>
                               <option value="12">December</option>
                              </select>
                            </div>
                            <div class = "ui input">
                                <input type="text" name="year" id ="year" style="width: 70px" placeholder="Year" required="required">
                            </div>
                            <button class="ui primary button" ng-click="getFormData()">Get</button>
                           </form>
                          </td>
                        </tr>
                      </table>
                </div>
                </div>
                
              </div>
            </div>
			      <div class="column row">
              <div class="column">
                <div class="ui segments">
                    <div class="ui segment inverted blueli">
                      <h5 class="ui header">Month Info</h5>
                    </div>
                       <div class="ui segment">
                           <table class="table ui">
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
  <script type="text/javascript" src="{{url('js/angular-monthly.js')}}"></script>
@endsection
