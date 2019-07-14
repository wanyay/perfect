
<div class="tow field">
    <div class="field">
      {!! Form::text('name',null,['required','placeholder' => 'Name'])!!}
    </div>
</div>

<div class="tow field">
    <div class="field">
        {!! Form::text('phone',null,['required','placeholder' => 'Phone'])!!}
    </div>
</div>

<div class="tow field">
    <div class="field">
        {!! Form::textarea('address',null,['required','rows'=>'4','placeholder' => 'Address'])!!}
    </div>
</div>

{!! Form::submit($submitButtonText,['class' => 'ui primary button saving','style'=>'margin-right:5px','id'=>'add']) !!}
