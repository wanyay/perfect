@extends('layouts.app');

@section('title','Product Type List')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{!! asset('css/sweetalert.css') !!}">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/datatable/dataTables.semanticui.min.css')}}">
@endsection

@section('content')
<div class="ui equal width left aligned padded grid stackable">

    <div class="row">
        <div class="sixteen column">
            <div class="ui segments">
                <div class="ui segment no-padding-bottom">
                  <h5 class="ui left floated header">New Customer</h5>
                  <h5 class="ui right floated header">
                    <a href="{{url('/customers/create')}}" class="tiny ui greenli button"><i class="plus icon"></i>New</a>
                  </h5>
                  <div class="clearfix"></div>
                </div>
                <div class="ui segment">
                  <div class="table-responsive">
                    <table id="data_table_info" class="ui compact selectable striped celled table" cellspacing="0" width="100%">
                      <thead>
                      <tr>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Total Credit</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($customers as $customer)
                      <tr>
                          <td>{{$customer->name}}</td>
                          <td>{{$customer->phone}}</td>
                          <td>{{$customer->address}}</td>
                          <td>{{$customer->total_credits}}</td>
                          <td>
                              <center>
                                <a href="{{ url('/credit/'.$customer->id)}}"><i class="eye icon"></i></a>
                                <a href="{{ url('/customers/'.$customer->id).'/edit'}}"><i class="edit icon"></i></a>
                                <a onclick="fun_delete({{ $customer->id }})"><i class="red trash icon"></i></a>
                              <center>
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
              url: '/customers/'+ id,
              type:"POST",
              data: {'id':id,'_token': "{{ csrf_token() }}",'_method' : "DELETE"},
              success: function(response){

                console.log(response);

                swal({
                    title: 'Deleted!',
                    text: 'Customer has been successfully deleted.' ,
                    type: "success",
                    confirmButtonColor: "teal"
                },

                function(){ location.reload();});

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
