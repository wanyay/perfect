$(document).ready(function () {
      $('#customer').hide();
      $('#cash').hide();
});

$('#payment_type').on('change',function () {
    var value = $(this).find(":selected").val();

    if(value == 'credit')
    {
      $('#customer').show();
      $('#cash').show();
    }
    if(value == 'cash')
    {
      $('#customer').hide();
      $('#cash').hide();
    }

})
