@extends('layouts.app')

@section('title', 'Add Item')

@section('styles')
@endsection

@section('content')

		    <div class="ui equal width center aligned padded grid stackable">
			      <div class="two column row">
              <div class="column">
                <div class="ui segments">
                    <div class="ui segment inverted blueli">
                      <h5 class="ui header">Item Info</h5>
                    </div>
                       <div class="ui segment">
                           <table class="table ui">
                             <tr>
                                 <td>Code</td>
                                 <td>{{$item->code}}</td>
                             </tr>
                             <tr>
                                 <td>Name</td>
                                 <td>{{$item->name}}</td>
                             </tr>
                             <tr>
                                 <td>Unit</td>
                                 <td>{{$item->unit->code}}</td>
                             </tr>
                             <tr>
                                 <td>Type</td>
                                 <td>{{$item->producttype->code}}</td>
                             </tr>
                             <tr>
                                 <td>Current Quantity</td>
                                 <td>{{$item->qty}}</td>
                             </tr>
                             <tr>
                                 <td>Cost</td>
                                 <td>{{ $item->cost }} Ks</td>
                             </tr>
                             <tr>
                                 <td>Price</td>
                                 <td>{{$item->price}} Ks</td>
                             </tr>
                           </table>
                       </div>
                   </div>
              </div>
              <!-- <div class="column">

              </div> -->
              <div class="column">
                <div class="eight wide column">
                    <div class="ui segments">
                        <div class="ui segment inverted blueli">
                            <h5>List of all changes</h5>
                        </div>
                        <div class="ui segment">
                          <div class="table-responsive">
                            <table id="data_table_info" class="ui compact selectable striped celled table" cellspacing="0" width="100%">
                              <thead>
                                <th>Date</th>
                                <th>In/Out Quantity</th>
                                <th>Remark</th>
                              </thead>
                              <tbody>
                                @foreach($inventories as $inventory)
                                <tr>
                                  <td>{{ $inventory->created_at}}</td>
                                  <td>{{ $inventory->in_out_qty}}</td>
                                  <td>{{ $inventory->remark}}</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            @if ($inventories->lastPage() > 1)
                                <div class="ui pagination menu">
                                    <a href="{{ $inventories->previousPageUrl() }}" class="{{ ($inventories->currentPage() == 1) ? ' disabled' : '' }} item">
                                        Previous
                                    </a>
                                    @for ($i = 1; $i <= $inventories->lastPage(); $i++)
                                        <a href="{{ $inventories->url($i) }}" class="{{ ($inventories->currentPage() == $i) ? ' active' : '' }} item">
                                            {{ $i }}
                                        </a>
                                    @endfor
                                    <a href="{{ $inventories->nextPageUrl() }}" class="{{ ($inventories->currentPage() == $inventories->lastPage()) ? ' disabled' : '' }} item">
                                        Next
                                    </a>
                                </div>
                            @endif
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="row">

            </div>
        </div>
@endsection
@section('scripts')
@endsection
