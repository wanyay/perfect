@extends('layouts.app')

@section('title', 'Add Suppliers')

@section('content')



            <div class="ui equal width center aligned padded grid stackable">
              @include('errors.validation')
              <div class = "row">
                <div class="eight wide column">
                   <div class="ui segments">
                       <div class="ui segment">
                         <h5 class="ui header">New Supplier</h5>
                       </div>
                       <div class="ui segment">
                         {!! Form::open(['url' => '/suppliers','class' => 'ui form'])!!}
                                 @include('supplier.form',['submitButtonText' => 'Add'])
                         {!! Form::close() !!}
                       </div>
                   </div>
                 </div>
               </div>
            </div>
@endsection
