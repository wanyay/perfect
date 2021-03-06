@extends('layouts.app');

@section('title','Product Type List')

@section('styles')
<link rel="stylesheet" type="text/css" href="{!! asset('css/sweetalert.css') !!}">
<link rel="stylesheet" type="text/css" href="{{ url('plugins/datatable/dataTables.semanticui.min.css')}}">
@endsection

@section('content')
		    @include('errors.validation')
        <div class="ui equal width left aligned padded grid stackable">

            <div class="row">
                <div class="sixteen wide column">
                    <div class="ui segments">
											<div class="ui segment no-padding-bottom">
												<h5 class="ui left floated header">New Product Type</h5>
												<h5 class="ui right floated header">
													<a href="{{url('/producttype/create')}}" class="tiny ui greenli button"><i class="plus icon"></i>New</a>
												</h5>
												<div class="clearfix"></div>
											</div>
                        <div class="ui segment">
                          <div class="table-responsive">
                            <table id="data_table_info" class="ui compact selectable striped celled table" cellspacing="0" width="100%">
                              <thead>
                              <tr>
                                  <th>Code</th>
                                  <th>Description</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($product_types as $type)
                              <tr>
                                  <td>{{$type->code}}</td>
                                  <td>{{$type->desp}}</td>
                                  <td>
                                      <center>
                                        <a href="{{ url('/producttype/'.$type->id).'/edit'}}"><i class="edit icon"></i></a>

                                        <a onclick="fun_delete({{ $type->id }})"><i class="red trash icon"></i></a>
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
              url: '/producttype/'+ id,
              type:"POST",
              data: {'id':id,'_token': "{{ csrf_token() }}",'_method' : "DELETE"},
              success: function(response){

                console.log(response);

                swal({
                    title: 'Deleted!',
                    text: 'Product Type has been successfully deleted.' ,
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
