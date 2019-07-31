@extends('layouts.app')

@section('title', 'Add Item')

@section('styles')
<link rel="stylesheet" type="text/css" href="{!! asset('css/sweetalert.css') !!}">
@endsection

@section('content')

    <div class="ui equal width center aligned padded grid stackable">
        <div class="two column row">
            <div class="column">
                <div class="ui segments">
                    <div class="ui segment inverted blueli">
                        <h5 class="ui header">Customer Info</h5>
                    </div>
                        <div class="ui segment">
                            <table class="table ui">
                                <tr>
                                    <td>Name</td>
                                    <td>{{$customer->name}}</td>
                                </tr>
                                <tr>
                                    <td>Total Credit</td>
                                    <td>{{$total}} Ks</td>
                                </tr>
                                <tr>
                                    {!! Form::open(['url' => '/payback','class' =>'ui form'])!!}
                                    <td>Amount</td>
                                    <td>
                                        <div class="ui input">
                                            <input type="number" name="amount" value="" required="required">
                                            <input type="hidden" name="customer_id" value="{{ $customer->id}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td>
                                        <div class="ui input">
                                            <input type="date" name="date" value="{{ now() }}" required="required">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" class="ui primary button saving">
                                    </td>
                                </tr>
                                {!! Form::close() !!}
                           </table>
                       </div>
                   </div>
            </div>
        </div>
    </div>
    <div class="ui equal width center aligned padded grid stackable">
        <div class="two column row">
            <div class="column">
                <div class="eight wide column">
                    <div class="ui segments">
                        <div class="ui segment inverted blueli">
                            <h5>List of all changes</h5>
                        </div>
                        <div class="ui segment">
                            <div class="ui top attached tabular menu">
                                <a class="item red active" data-tab="first">Credits</a>
                                <a class="item teal" data-tab="second">Payback</a>
                            </div>
                            <div class="ui bottom attached tab segment active" data-tab="first">
                                <div class="table-responsive">
                                    <table id="data_table_info" class="ui compact selectable striped celled table" cellspacing="0" width="100%">
                                        <thead>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Remark</th>
                                        </thead>
                                        <tbody>
                                        @foreach($credits as $credit)
                                            <tr>
                                                <td>{{ $credit->created_at}}</td>
                                                <td>{{ $credit->amount}}</td>
                                                <td>
                                                    @if($credit->is_payback == 0)
                                                        Credit
                                                    @else
                                                        Payback
                                                    @endif
                                                </td>
                                                <td>{{ $credit->remark}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @if ($credits->lastPage() > 1)
                                        <div class="ui pagination menu">
                                            <a href="{{ $credits->previousPageUrl() }}" class="{{ ($credits->currentPage() == 1) ? ' disabled' : '' }} item">
                                                Previous
                                            </a>
                                            @for ($i = 1; $i <= $credits->lastPage(); $i++)
                                                <a href="{{ $credits->url($i) }}" class="{{ ($credits->currentPage() == $i) ? ' active' : '' }} item">
                                                    {{ $i }}
                                                </a>
                                            @endfor
                                            <a href="{{ $credits->nextPageUrl() }}" class="{{ ($credits->currentPage() == $credits->lastPage()) ? ' disabled' : '' }} item">
                                                Next
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="ui bottom attached tab segment" data-tab="second">
                                <div class="table-responsive">
                                    <table id="data_table_info" class="ui compact selectable striped celled table" cellspacing="0" width="100%">
                                        <thead>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Remark</th>
                                        <th>Delete</th>
                                        </thead>
                                        <tbody>
                                        @foreach($paybacks as $payback)
                                            <tr>
                                                <td>{{ $payback->created_at}}</td>
                                                <td>{{ $payback->amount}}</td>
                                                <td> Payback </td>
                                                <td>{{ $payback->remark}}</td>
                                                <td>
                                                    <a onclick="fun_delete({{ $payback->id }})"><i class="red trash icon"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @if ($paybacks->lastPage() > 1)
                                        <div class="ui pagination menu">
                                            <a href="{{ $paybacks->previousPageUrl() . '#second' }}" class="{{ ($paybacks->currentPage() == 1) ? ' disabled' : '' }} item">
                                                Previous
                                            </a>
                                            @for ($i = 1; $i <= $paybacks->lastPage(); $i++)
                                                <a href="{{ $paybacks->url($i) .'#second' }}" class="{{ ($paybacks->currentPage() == $i) ? ' active' : '' }} item">
                                                    {{ $i }}
                                                </a>
                                            @endfor
                                            <a href="{{ $paybacks->nextPageUrl() . '#second'}}" class="{{ ($paybacks->currentPage() == $paybacks->lastPage()) ? ' disabled' : '' }} item">
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
        </div>
    </div>
@endsection
@section('scripts')
  <script src="{{ url('plugins/adress/jquery.address.js') }}"></script>
  <script type="text/javascript" src="{{url('js/customjs/custom-tab.js')}}"></script>
  <script type="text/javascript">
      function fun_delete(id)
      {
          swal({
                  title: "Are you sure?",
                  text: "You will not be able to recover!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, delete it!",
                  closeOnConfirm: false
              },

              function() {
                  $.ajax({
                      url: '/credit/'+ id,
                      type:"POST",
                      data: {'id':id,'_token': "{{ csrf_token() }}",'_method' : "DELETE"},
                      success: function(response) {
                          swal({
                                  title: 'Deleted!',
                                  text: 'Category has been successfully deleted.' ,
                                  type: "success",
                                  confirmButtonColor: "teal"
                              },

                              function() {
                                  window.location = "{{ url('/credit/' . $customer->id) }}";
                              }
                          );

                      },
                      error:function (response){
                          swal({
                              title: response.status + '!',
                              text: response.statusText ,
                              type: "error",
                              confirmButtonColor: "teal"
                          });
                          console.log(response);
                      }
                  });

              });
      };
  </script>
@endsection
