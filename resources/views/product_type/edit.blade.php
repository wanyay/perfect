@extends('layouts.app')

@section('title', 'Add Category')

@section('styles')

    <style type="text/css">

        .ibox-footer{
            height:60px;
        }
    </style>

@endsection

@section('content')

            @include('errors.validation')


        <div class="ui equal width center aligned padded grid stackable">
          <div class = "row">
            <div class="eight wide column">
               <div class="ui segments">
                   <div class="ui segment">
                     <h5 class="ui header">Edit Customer</h5>
                   </div>
                   <div class="ui segment">
                     {!! Form::model($product_type,['route' => ['producttype.update', $product_type->id],'class' => 'ui form'])!!}
                             <input type="hidden" name="_method" value="PATCH">
                             @include('product_type.form',['submitButtonText' => 'Update'])
                     {!! Form::close() !!}
                   </div>

               </div>
             </div>
           </div>
        </div>
@endsection
