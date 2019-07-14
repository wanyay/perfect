@extends('layouts.app')

@section('title', 'Add Category')

@section('content')

        <div class="ui equal width center aligned padded grid stackable">
          <div class = "row">
            <div class="eight wide column">
               <div class="ui segments">
                   <div class="ui segment">
                     <h5 class="ui header">Edit Category</h5>
                   </div>
                   <div class="ui segment">
                     {!! Form::model($category,['route' => ['category.update', $category->id],'class' => 'ui form'])!!}
                             <input type="hidden" name="_method" value="PATCH">
                             <div class="tow field">
							    <div class="field">
							      {!! Form::text('name',null,['class'=>'form-control','placeholder' =>'Name','required'])!!}
							    </div>
							</div>
							{!! Form::submit('Add',['class' => 'ui primary button saving','style'=>'margin-right:5px','id'=>'add']) !!}
                     {!! Form::close() !!}
                   </div>

               </div>
             </div>
           </div>
        </div>
@endsection
