<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sale Invoice</title>

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
        border :1px solid black;
        font-weight:bold;
    }

    .invoice-box table tr.item td{
        border: 1px solid black !important;
    }

    .invoice-box table tr.total td{
        border: 1px solid black;
        font-weight:bold;
    }

    .invoice-box table tr.total td:nth-child(1){
        border: none;
        font-weight:bold;
    }

    .invoice-box table tr.total td:nth-child(2){
        border: none;
        font-weight:bold;
    }
    .invoice-box table tr.total td:nth-child(3){
        border: none;
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
    <div class="invoice-box" id="print">
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
									Invoice No : {{ $sale->code  }}</br>
									Date : {{ $sale->created_at}}
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
                                {{ env('SHOP_NAME') }}<br>
                                {{ env('ROAD_NAME') }}<br>
                                {{ env('CITY_NAME')}}<br>
                                Phone Number-{{ env('PH_NO')}}
                            </td>
							<td></td>
							<td></td>
                            <td style="text-align:right">
								@if($sale->customer)
                                    Customer Name : {{ $sale->customer->name }}</br>
                                @endif
                                @if($sale->credit_due_date)
                                    Credit Due Date : {{ $sale->credit_due_date }}</br>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td style="width: 15px;">No</td>
				<td style="text-align:left;">Item</td>
				<td style="text-align:right;width: 20px;">Quantity</td>
				<td style="text-align:right;width: 150px;">Price</td>
				<td style="text-align:right">Total</td>
            </tr>
				@foreach($saleitems as $key => $si)
		        <tr class="item">
                  <td>{{ $key + 1 }}</td>
		          <td style="text-align:left">{{$si->item->name}}</td>
		          <td style="text-align:right">{{$si->qty }}</td>
		          <td style="text-align:right">{{$si->price}} Ks</td>
		          <td style="text-align:right">{{$si->total_price}} Ks</td>
                </tr>
		        @endforeach
                <tr class="total">
    				<td></td>
    				<td></td>
                    <td></td>
    				<td style="text-align:right">Total</td>
    				<td style="text-align:right">{{ $sale->total  + $sale->discount}} Ks</td>
				</tr>
                @if($sale->discount)
                <tr class="total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">Discount</td>
                    <td style="text-align:right">{{ $sale->discount }} Ks</td>
                </tr>
                @endif
				@if($sale->customer)
				<tr class="total">
					<td></td>
					<td></td>
                    <td></td>
					<td style="text-align:right">Cash</td>
					<td style="text-align:right">{{ $sale->cash }} Ks</td>
				</tr class="total">
				<tr class="total">
					<td></td>
					<td></td>
                    <td></td>
					<td style="text-align:right">Credit</td>
					<td style="text-align:right">{{ $sale->total - $sale->cash }} Ks</td>
				</tr>
				@endif
                <tr class="total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">Grand Total</td>
                    <td style="text-align:right">{{ $sale->total  }}  Ks</td>
                </tr>
        </table>
    </div>
    <a class="button notable" type="button" onclick="invoiceprint()">Print</a>
    <a class="btn-back notable" href="{{url('sales')}}" type="button" >Back</a>
</body>
  <script type="text/javascript">
    function invoiceprint() {
        // var divToPrint = document.getElementById('print');
        // var htmlToPrint = '' +
        //     '<style type="text/css">' +
            
        //     '.invoice-box{'+
        //         'max-width:800px;'+
        //         'margin:auto;'+
        //         'padding:30px;'+
        //         'border:1px solid #eee;'+
        //         'font-size:16px;'+
        //         'line-height:24px;'+
        //         'color:#555;'+
        //     '}'+

        //     '.invoice-box table{'+
        //        ' width:100%;'+
        //         'line-height:inherit;'+
        //         'text-align:left;'+
        //     '}'+

        //     '.invoice-box table td{'+
        //         'padding:5px;'+
        //         'vertical-align:top;'+
        //     '}'+

        //     '.invoice-box table tr td:nth-child(2){'+
        //         'text-align:right;'+
        //     '}'+

        //     '.invoice-box table tr.top table td{'+
        //         'padding-bottom:20px;'+
        //     '}'+

        //     '.invoice-box table tr.top table td.title{'+
        //         'font-size:45px;'+
        //         'line-height:45px;'+
        //         'color:#333;'+
        //     '}'+

        //     '.invoice-box table tr.information table td{'+
        //         'padding-bottom:40px;'+
        //     '}'+

        //     '.invoice-box table tr.heading td{'+
        //         'border:1px solid black;'+
        //         'font-weight:bold;'+
        //     '}'+

        //     '.invoice-box table tr.item td{'+
        //         'border-right:1px solid black;'+
        //     '}'+

        //     '.invoice-box table tr.item.last td{'+
        //         'border-bottom:none;'+
        //     '}'+

        //     '.invoice-box table tr.total td:nth-child(4){' +
        //         'border-top:2px solid #eee;' +
        //         'font-weight:bold;' +
        //     '}' +

        //     '</style>';
        // htmlToPrint += divToPrint.outerHTML;
        // newWin = window.open("");
        // newWin.document.write(htmlToPrint);
        // newWin.print();
        // newWin.close();
        window.print();
    }
  </script>
</html>
