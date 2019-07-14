@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
@include('errors.validation')

<div class="ui equal width center aligned padded grid stackable">
  <div class = "row">
    <div class="eight wide column">
       <div class="ui segments">
           <div class="ui segment">
             <h5 class="ui header">New Product Type</h5>
           </div>
           <div class="ui segment">
             {!! Form::open(['url' => '/producttype','class' => 'ui form'])!!}
                     @include('product_type.form',['submitButtonText' => 'Add'])
             {!! Form::close() !!}
           </div>

       </div>
     </div>
   </div>
</div>
@endsection
