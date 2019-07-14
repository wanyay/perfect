<div class="tow field">
    <div class="field">
      {!! Form::text('code',null,['class'=>'form-control','placeholder' =>'Code','required'])!!}
    </div>
</div>

<div class="tow field">
    <div class="field">
      {!! Form::textarea('desp',null,['class'=>'form-control','placeholder' =>'Description','required','rows'=>'4'])!!}
</div>
{!! Form::submit($submitButtonText,['class' => 'ui primary button saving','style'=>'margin-right:5px','id'=>'add']) !!}
