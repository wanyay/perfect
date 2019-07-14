@extends('layouts.app')

@section('title', 'Add Category')

@section('content')

        <div class="ui equal width center aligned padded grid stackable">
          <div class = "row">
            <div class="eight wide column">
               <div class="ui segments">
                   <div class="ui segment">
                     <h5 class="ui header">Edit Unit</h5>
                   </div>
                   <div class="ui segment">
                     {!! Form::model($unit,['route' => ['units.update', $unit->id],'class' => 'ui form'])!!}
                             <input type="hidden" name="_method" value="PATCH">
                             @include('units.form',['submitButtonText' => 'Update'])
                     {!! Form::close() !!}
                   </div>

               </div>
             </div>
           </div>
        </div>
@endsection
