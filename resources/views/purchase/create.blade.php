@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    @include('errors.validation')
    <div class="ui equal width left aligned padded grid stackable" ng-controller="angularPurchaseController">
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
                                <input id="bCode" ng-model="searchKeyword" type="text" placeholder="Item Code"
                                       style="padding-left:-15px">
                            </div>
                            <div class="scroll_content">
                                <a ng-repeat="item in items  | filter: searchKeyword" class="item"
                                   ng-click="addPurchaseTemp(item)">
                                    @{{item.name}}<i class="icon green plus"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                    <barcode-scanner separator-char="separatorChar" trigger-char="triggerChar"
                                     scan-callback="scanCallback"
                                     trigger-callback="triggerCallback"></barcode-scanner>
                </div>
            </div>

            <div class="eleven wide column">
                <div class="ui segments">
                    <div class="ui segment">
                        <h5 class="ui header">Invoice</h5>
                    </div>
                    {!! Form::open(['url' => '/purchases','class' => 'ui form segment form3'])!!}
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
                                <option value="cash" selected>Cash</option>
                                <option value="credit">Credit</option>
                            </select>
                        </div>
                        <div class="field">
                        </div>
                    </div>
                    <div class="two fields" id="customer">
                        <div class="field">
                            <label>Supplier</label>
                            <select id="supplier" class="form-control" name="supplier_id"
                                    ng-options="su.id as su.name for su in suppliers track by su.id"
                                    data-ng-model="selectedOption" required="required">
                                <option value="">Select Supplier</option>
                            </select>
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
                            <label>Grand Total</label>
                            <input type="text" value="@{{sum(purchasedata)}}" disabled>
                            <input type="hidden" name="total" value="@{{sum(purchasedata)}}">
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
                            <th>Cost</th>
                            <th style="width:100px">Qty</th>
                            <th>Total</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <input type="hidden" name="purchaseitems" value="@{{purchasedata}}">
                        <tbody>
                        <tr ng-repeat="newpurchasetemp in purchasedata | reverse">
                            <td>@{{newpurchasetemp.code}}</td>
                            <td>@{{newpurchasetemp.name}}</td>
                            <td>@{{newpurchasetemp.price | currency}}</td>
                            <td>@{{newpurchasetemp.cost | currency}}</td>
                            <td>
                                <input type="number" class="form-control" style="text-align:center" autocomplete="off"
                                       ng-change="updatePurchaseTemp(newpurchasetemp)" ng-model="newpurchasetemp.qty"
                                       size="1">
                            </td>
                            <td>@{{newpurchasetemp.cost * newpurchasetemp.qty | currency}}</td>
                            <td>
                                <a class="btn btn-danger btn-xs" type="button"
                                   ng-click="showUpdatePurchaseTemp(newpurchasetemp)">
                                    <i class="icon blue edit" aria-hidden="true"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-danger btn-xs" type="button"
                                   ng-click="removePurchaseTemp(newpurchasetemp.id)">
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

        <div class="ui small item modal">
            <div class="header">
                Edit Item
            </div>
            <div class="content">
                <div class="ui form">
                    <div class="tow field">
                        <div class="field">
                            <label style="text-align: left;">Code</label>
                        </div>
                        <div class="field">
                            <input type="text" ng-model="editpurchasecode" class="form-control" placeholder="Name"
                                   ng-required>
                            <input type="hidden" ng-model="editpurchaseid" class="form-control" ng-required>
                        </div>
                    </div>

                    <div class="tow field">
                        <div class="field">
                            <label style="text-align: left;">Name</label>
                        </div>
                        <div class="field">
                            <input class="form-control" type="text" ng-model="editpurchasename" placeholder="Phone"
                                   ng-required>
                        </div>
                    </div>

                    <div class="tow field">
                        <div class="field">
                            <label style="text-align: left;">Price</label>
                        </div>
                        <div class="field">
                            <input class="form-control" type="text" ng-model="editpurchaseprice" placeholder="Phone"
                                   ng-required>
                        </div>
                    </div>

                    <div class="tow field">
                        <div class="field">
                            <label style="text-align: left;">Cost</label>
                        </div>
                        <div class="field">
                            <input class="form-control" type="text" ng-model="editpurchasecost" placeholder="Phone"
                                   ng-required>
                        </div>
                    </div>

                    <div class="tow field">
                        <div class="field">
                            <label style="text-align: left;">Quantity</label>
                        </div>
                        <div class="field">
                            <input class="form-control" type="text" ng-model="editpurchaseqty" placeholder="Phone"
                                   ng-required>
                        </div>
                    </div>

                </div>

            </div>
            <div class="actions">
                <div class="ui negative button">
                    Cancel
                </div>
                <a type="button" class="ui greenli button"
                   ng-click="updatePurchase(editpurchaseid,editpurchasecode,editpurchasename,editpurchaseprice,editpurchasecost,editpurchaseqty)">Update</a>
            </div>
        </div>

    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{url('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/angular.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/angular-barcode-scanner.js')}}"></script>
    <script type="text/javascript" src="{{url('js/angular-purchase.js')}}"></script>
    <script type="text/javascript">
        $(window).ready(function () {
            $('.scroll_content').slimscroll({
                height: '700px'
            });
        });

        function showModal() {
            $('.ui.test').modal('show');
        }

    </script>
@endsection
