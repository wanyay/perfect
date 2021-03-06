<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Purchase Inovice</title>

    <style>
    .button {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }
		.btn-back {
      background-color: gray;
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }

    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }

    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }

    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }

    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }

    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }

    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }

    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }

    .invoice-box table tr.details td{
        padding-bottom:20px;
    }

    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }

    .invoice-box table tr.item.last td{
        border-bottom:none;
    }

    .invoice-box table tr.total td:nth-child(4){
        border-top:2px solid #eee;
        font-weight:bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }

        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }

    @media print {
      .notable {
        display: none !important;
      }
			.invoice-box table tr.item td{
	        border-bottom:1px solid #eee;
	    }
			.invoice-box table tr.total td:nth-child(4) {
			     border-top: 2px;
			   	 font-weight: bold;
			}
  	}
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{url('img/home.ico')}}" style="width:20%; max-width:300px;">
                            </td>
														<td></td>
														<td></td>
														<td style="text-align:right">
															Invoice No : {{ $purchase->code  }}</br>
															Date : {{ $purchase->created_at}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                {{ $purchase->supplier->name }}<br>
                                {{ $purchase->supplier->address }}<br>
                                Phone - {{ $purchase->supplier->phone}}
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
							<td>Item</td>
							<td style="text-align:right">Cost</td>
							<td style="text-align:right">Quantity</td>
							<td style="text-align:right">Total</td>
            </tr>

						@foreach($purchaseitems as $si)
		        <tr class="item">
		          <td>{{$si->item->name}}</td>
		          <td style="text-align:right">{{$si->cost}} Ks</td>
		          <td style="text-align:right">{{$si->qty }}</td>
		          <td style="text-align:right">{{$si->cost *  $si->qty}} Ks</td>
		        </tr>
		        @endforeach
                <tr class="total">
    				<td></td>
    				<td></td>
    				<td style="text-align:right">Total</td>
    				<td style="text-align:right">{{ $purchase->total  + $purchase->discount}} Ks</td>
				</tr>
                @if($purchase->discount)
                <tr class="total">
                    <td></td>
                    <td></td>
                    <td style="text-align:right">Discount</td>
                    <td style="text-align:right">{{ $purchase->discount }} Ks</td>
                </tr>
                @endif
                @if($purchase->payment_type == 'credit')
                <tr class="total">
                    <td></td>
                    <td></td>
                    <td style="text-align:right">Credit</td>
                    <td style="text-align:right">{{ $purchase->total - $purchase->cash }} Ks</td>
                </tr>
                @endif
                <tr class="total">
                    <td></td>
                    <td></td>
                    <td style="text-align:right">Grand Total</td>
                    <td style="text-align:right">{{ $purchase->total  }}  Ks</td>
                </tr>
        </table>
        <a class="button notable" type="button" onclick="invoiceprint()">Print</a>
				<a class="btn-back notable" href="{{url('purchases')}}" type="button" >Back</a>
    </div>

</body>
  <script type="text/javascript">
    function invoiceprint() {
      window.print();
    }
  </script>
</html>
