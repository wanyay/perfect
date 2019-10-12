    <div class="field">
        <label style="text-align: left">Name</label>
        {!! Form::text('name',null,['required','placeholder' => 'Name'])!!}
    </div>
    <div class="field">
        <label style="text-align: left">Unit</label>
        {!! Form::select('unit_id',$units,$unit_selected,['required','placeholder' => 'Select One'])!!}
    </div>
    <div class="field">
        <label style="text-align: left">Product Type</label>
        {!! Form::select('producttype_id',$types,$type_selected,['required','placeholder' => 'Select One'])!!}
    </div>

    <div class="field">
        <label style="text-align: left">Quantity</label>
        {!! Form::number('qty',null,['required','rows'=>'4','placeholder' => 'Quantity'])!!}
    </div>
    <div class="field">
        <label style="text-align: left">Wholesale Price</label>
        {!! Form::number('wholesale_price',null,['required','rows'=>'4','placeholder' => 'Price'])!!}
    </div>
    <div class="field">
        <label style="text-align: left">Retail Price</label>
        {!! Form::number('retail_price',null,['required','rows'=>'4','placeholder' => 'Price'])!!}
    </div>
    <div class="field">
        <label style="text-align: left">Cost</label>
        {!! Form::number('cost',null,['rows'=>'4','placeholder' => 'Cost'])!!}
    </div>
    <div class="field">
        <label style="text-align: left">Company Cost</label>
        {!! Form::number('company_cost',null,['required','rows'=>'4','placeholder' => 'Cost'])!!}
    </div>
    {!! Form::submit($submitButtonText,['class' => 'ui primary button saving','style'=>'margin-right:5px','id'=>'add']) !!}
