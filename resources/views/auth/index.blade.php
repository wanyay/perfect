@extends('layouts.app');

@section('title','Customers List')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{!! asset('css/sweetalert.css') !!}">
  <link rel="stylesheet" type="text/css" href="{{ url('css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
		    @include('errors.validation')
		    <div class="row">
		    	<div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Units List </h5>
                            <div class="pull-right">
                                <a class="btn btn-primary btn-xs" href="{{ url('/units/create')}}">
                                    <i class="fa fa-plus"></i> Add
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" id='unit-table'>
                                <thead style="font-size: 13px ;text-align: center;">
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody style="font-size: 12px">
                                @foreach($customers as $customer)
                                <tr>
                                    <td>{{$customer->code}}</td>
                                    <td>{{$customer->desp}}</td>
                                    <td>
                                        <center>
                                          <a href="{{ url('/units/'.$unit->id).'/edit'}}" class="btn btn-white btn-bitbucket"><i class="fa fa-edit"></i></a>

                                          <a onclick="fun_delete({{ $unit->id }})" class="btn btn-white btn-bitbucket"><i class="fa fa-trash"></i></a>
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
<script type="text/javascript" src="{!! asset('js/sweetalert.js') !!}"></script>
<script type="text/javascript" src="{{ url('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/responsive.bootstrap.min.js') }}"></script>
<script type="text/javascript">

jQuery(document).ready(function($){

      $('#unit-table').DataTable({
          "responsive" : true,
          "bLengthChange": false,
      });
    });

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
              url: '/units/'+ id,
              type:"POST",
              data: {'id':id,'_token': "{{ csrf_token() }}",'_method' : "DELETE"},
              success: function(response){

                console.log(response);

                swal({
                    title: 'Deleted!',
                    text: 'Unit has been successfully deleted.' ,
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
