<div class="row">
  <div class="col-md-12" style="text-align: center">
    <h2>Saytanar</h2>
    <small>Make Your Desired</small><br>
    <small>No-45,Baho Street,Seikgyi Kanaungto Township,Yangon. Ph-09448000401,01-268268</small>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <br>
    @if($sale->customer)
      Customer Name : {{ $sale->customer->name }}</br>
    @endif
    Invoice No : {{ $sale->code  }}</br>
    Date : {{ $sale->created_at}}
  </div>
</div>
<div class="row">
  <div class="col-md-12">
  <br>
    <div class="table-responsive">
      <table class="table table-bordered">
        <tr>
          <td>Item</td>
          <td>Price</td>
          <td>Quantity</td>
          <td>Total</td>
        </tr>
        @foreach($saleitems as $si)
        <tr>
          <td>{{$si->item->name}}</td>
          <td>{{$si->price}}</td>
          <td>{{$si->qty }}</td>
          <td>{{$si->total_price}}</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="3" class="text-right" >Grand Total</td>
          <td>{{ $sale->total }}</td>
        </tr>
        @if($sale->customer)
        <tr>
          <td colspan="3" class="text-right" >Cash</td>
          <td>{{ $sale->cash }}</td>
        </tr>
        <tr>
          <td colspan="3" class="text-right" >Credit</td>
          <td>{{ $sale->total - $sale->cash }}</td>
        </tr>
        @endif
      </table>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-10">
      &nbsp;
  </div>
  <div class="col-md-2">
      <button type="button" onclick="printInvoice()" class="btn btn-primary pull-right hidden-print">Print</button>
  </div>
</div>
