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
             <h5 class="ui header">Edit Expense</h5>
           </div>
           <div class="ui segment">

                            {!! Form::model($expense,['route' => ['expenses.update', $expense->id],'class' => 'ui form'])!!}
                                    <input type="hidden" name="_method" value="PATCH">
                                    <div class="tow field">
                                        <div class="field">
                                           {!! Form::select('category_id',$categories,$category_selected,['required','placeholder' => 'Select One'])!!}
                                        </div>
                                    </div>
                                    <div class="tow field">

                                      <div class="tow field">

                                                {!! Form::number('amount',null,['required','placeholder' => 'Amount'])!!}

                                        </div>

                                    </div>
                                    {!! Form::submit('Update',['class' => 'ui primary button saving','style'=>'margin-right:5px','id'=>'add']) !!}
              {!! Form::close() !!}
                            {!! Form::close() !!}
                          </div>

                      </div>
                    </div>
                  </div>
               </div>
@endsection
