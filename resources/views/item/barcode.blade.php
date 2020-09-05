<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Barcode</title>
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css')}}">
    <style>
        .pull-left{
            font-size: 10px
        }
        .pull-right{
            font-size: 10px
        }
    </style>
</head>
  <body>
      <div class="head">
          <div class="row">
                <center><h3>Barcode for Item "{{ $item->name}}"</h3></center>
          </div>
      </div>
      <table class="table table-bordered">
      	  @for($i = 1 ; $i <= 10 ; $i++)
              <tr>
                  @for($j = 1 ; $j <= 5 ; $j++ )
                      <td>
                          <div class="pull-left">
                              {{ $item->code}}
                          </div>
                          <img src="data:image/png;base64,{{ $barcode }}" alt="barcode" style="margin-top:10px;margin-bottom:10px" />
                          <div class="pull-right">
                              {{ $item->price}}Ks
                          </div>
                      </td>
                  @endfor
              </tr>
          @endfor
      </table>
  </body>
</html>
