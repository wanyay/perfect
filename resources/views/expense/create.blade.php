@extends('layouts.app')

@section('title', 'Add Item')

@section('content')
@include('errors.validation')

<div class="ui equal width center aligned padded grid stackable">
  <div class = "row">
    <div class="eight wide column">
       <div class="ui segments">
           <div class="ui segment">
             <h5 class="ui header">New Expense</h5>
           </div>
           <div class="ui segment">
              {!! Form::open(['url' => '/expenses','class' => 'ui form'])!!}

              <div class="tow field">
                <div class="tow field">
                    {!! Form::date('created_at', now(),null, ['required']) !!}
                </div>

              </div>

              <div class="tow field">
                  <div class="tow field">
                        
                      {!! Form::select('category_id',$categories,null,['required','placeholder' => 'Select One'])!!}

                  </div>

              </div>

              <div class="tow field">

                <div class="tow field">

                          {!! Form::number('amount',null,['required','placeholder' => 'Amount'])!!}

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
@section('scripts')

@endsection
