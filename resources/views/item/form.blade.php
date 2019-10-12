
    <div class="tow field">


        <div class="tow field">

                {!! Form::text('name',null,['required','placeholder' => 'Name'])!!}

        </div>

    </div>



    <div class="tow field">

        <div class="tow field">

                {!! Form::select('unit_id',$units,$unit_selected,['required','placeholder' => 'Select One'])!!}

        </div>

    </div>



    <div class="tow field">

        <div class="tow field">

                {!! Form::select('producttype_id',$types,$type_selected,['required','placeholder' => 'Select One'])!!}

        </div>

    </div>



    <div class="tow field">

      <div class="tow field">

                {!! Form::number('qty',null,['required','rows'=>'4','placeholder' => 'Quantity'])!!}

        </div>

    </div>



    <div class="tow field">

      <div class="tow field">

                {!! Form::number('cost',null,['required','rows'=>'4','placeholder' => 'Cost'])!!}

      </div>

    </div>



    <div class="tow field">



        <div class="tow field">

                {!! Form::number('price',null,['required','rows'=>'4','placeholder' => 'Price'])!!}

        </div>

    </div>
    {!! Form::submit($submitButtonText,['class' => 'ui primary button saving','style'=>'margin-right:5px','id'=>'add']) !!}
