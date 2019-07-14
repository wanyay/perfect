@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
@include('errors.validation')

<div class="ui equal width center aligned padded grid stackable">
  @include('errors.validation')
  <div class = "row">
    <div class="eight wide column">
       <div class="ui segments">
           <div class="ui segment">
             <h5 class="ui header">Edit Customer</h5>
           </div>
           <div class="ui segment">
             {!! Form::model($supplier,['route' => ['suppliers.update', $supplier->id],'class' => 'ui form'])!!}
                     <input type="hidden" name="_method" value="PATCH">
                     @include('supplier.form',['submitButtonText' => 'Update'])
             {!! Form::close() !!}
           </div>

       </div>
     </div>
   </div>
</div>
@endsection
