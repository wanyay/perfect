<div class="tow field">
    <div class="field">
      {!! Form::text('code',null,['class'=>'form-control','required','placeholder' => 'Code'])!!}
    </div>
</div>

<div class="tow field">
    <div class="field">
      {!! Form::textarea('desp',null,['class'=>'form-control','required','rows'=>'4','placeholder' => 'Description'])!!}
    </div>
</div>
{!! Form::submit($submitButtonText,['class' => 'ui primary button saving','style'=>'margin-right:5px','id'=>'add']) !!}
