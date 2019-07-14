    <div class="tow field">
        <div class="field">
          <!-- <label style="text-align: left;">Name</label> -->
        </div>
        <div class="field">
          {!! Form::text('name',null,['class'=>'form-control','required','placeholder' => 'Name'])!!}
        </div>
    </div>

    <div class="tow field">
        <div class="field">
          <!-- <label style="text-align: left;">Phone</label> -->
        </div>
        <div class="field">
          {!! Form::text('phone',null,['class'=>'form-control','required','placeholder' => 'Phone'])!!}
        </div>
    </div>

    <div class="tow field">
        <div class="field">
          <!-- <label style="text-align: left;">Address</label> -->
        </div>
        <div class="field">
          {!! Form::textarea('address',null,['class'=>'form-control','required','rows'=>'4','placeholder' => 'Address'])!!}
        </div>
    </div>

  {!! Form::submit($submitButtonText,['class' => 'ui primary button saving','style'=>'margin-right:5px','id'=>'add']) !!}
