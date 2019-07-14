@extends('layouts.app')

@section('title', 'Add Item')

@section('content')
@include('errors.validation')

<div class="ui equal width center aligned padded grid stackable">
  <div class = "row">
    <div class="eight wide column">
       <div class="ui segments">
           <div class="ui segment">
             <h5 class="ui header">New Item</h5>
           </div>
           <div class="ui segment">
              {!! Form::open(['url' => '/items','class' => 'ui form'])!!}
              <div class="tow field">
                  <div class="field">
                      <input type="text" name="code" value="{{mt_rand(1111111111,mt_getrandmax())}}">
                  </div>
              </div>
                @include('item.form',['submitButtonText' => 'Add','unit_selected' => null,'type_selected' => null])
              {!! Form::close() !!}
                          </div>
                      </div>
                    </div>
                  </div>
                </div>

@endsection
@section('scripts')

@endsection
