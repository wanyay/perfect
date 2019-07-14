@extends('layouts.app')

@section('title', 'Edit Item')

@section('styles')
@endsection

@section('content')
<div class="ui equal width center aligned padded grid stackable">
  @include('errors.validation')
  <div class = "row">
    <div class="eight wide column">
       <div class="ui segments">
           <div class="ui segment">
             <h5 class="ui header">Edit Customer</h5>
           </div>
           <div class="ui segment">

                            {!! Form::model($item,['route' => ['items.update', $item->id],'class' => 'ui form'])!!}
                                    <input type="hidden" name="_method" value="PATCH">
                                    <div class="tow field">
                                        <div class="field">
                                            {!! Form::text('code',null,['required','placeholder' => 'Code'])!!}
                                        </div>
                                    </div>
                                    @include('item.form',['submitButtonText' => 'Update','unit_selected' => $unit_selected,'type_selected' => $type_selected])
                            {!! Form::close() !!}
                          </div>

                      </div>
                    </div>
                  </div>
               </div>
@endsection
