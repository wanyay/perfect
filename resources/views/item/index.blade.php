@extends('layouts.app');

@section('title','Items List')

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
                    <h5 class="ui left floated header">Items</h5>
                    <h5 class="ui right floated header">
                        <a href="{{ route('items.create') }}" class="tiny ui greenli button"><i class="plus icon"></i>New</a>
                        <a href="{{ route('items.export') }}" class="tiny ui blueli button"><i class="download icon"></i>Export</a>
                    </h5>
                  <div class="clearfix"></div>
                </div>
                <div class="ui segment">
                  <div class="table-responsive">
                    <table id="data_table_info" class="ui compact selectable striped celled table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{$item->code}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->qty}}</td>
                        <td>{{$item->price}}</td>
                        <td>
                            <center>
                              <a href="{{ url('/items/'.$item->id).'/barcode'}}" ><i class="barcode icon"></i></a>
                              <a href="{{ url('/inventory/'.$item->id)}}" ><i class="eye icon"></i></a>

                              <a href="{{ url('/items/'.$item->id).'/edit'}}"><i class="edit icon"></i></a>

                              <a onclick="fun_delete({{ $item->id }})"><i class="red trash icon"></i></a>
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
              url: '/items/'+ id,
              type:"POST",
              data: {'id':id,'_token': "{{ csrf_token() }}",'_method' : "DELETE"},
              success: function(response){

                console.log(response);

                swal({
                    title: 'Deleted!',
                    text: 'Item has been successfully deleted.' ,
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
      }
</script>

@endsection
