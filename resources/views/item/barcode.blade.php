<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Barcode</title>
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css')}}">
  </head>
  <body>
    <?php
    use \Milon\Barcode\DNS1D;
     ?>
      <div class="head">
          <div class="row">
                <center><h3>Barcode for Item "{{ $item->name}}"</h3></center>
          </div>
      </div>
      <table class="table table-bordered">
      	@for($i = 1 ; $i <= 10 ; $i++)
        <tr>
          <td>
            <center>
              <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($item->code, 'C128')}}" alt="barcode" style="margin-top:20px;margin-bottom:20px" /><br>
            </center>
            <div class="pull-left">
            	{{ $item->code}} 	
            </div>
           	<div class="pull-right">
            	{{ $item->price}}Ks
           	</div>
          </td>
          <td>
            <center>
              <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($item->code, 'C128')}}" alt="barcode" style="margin-top:20px;margin-bottom:20px" /><br>
            </center>
            <div class="pull-left">
            	{{ $item->code}} 	
            </div>
           	<div class="pull-right">
            	{{ $item->price}}Ks
           	</div>
          </td>
          <td>
            <center>
              <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($item->code, 'C128')}}" alt="barcode" style="margin-top:20px;margin-bottom:20px" /><br>
            </center>
           	<div class="pull-left">
            	{{ $item->code}} 	
            </div>
           	<div class="pull-right">
            	{{ $item->price}}Ks
           	</div>
          </td>
          <td>
            <center>
              <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($item->code, 'C128')}}" alt="barcode" style="margin-top:20px;margin-bottom:20px" /><br>
            </center>
            <div class="pull-left">
            	{{ $item->code}} 	
            </div>
           	<div class="pull-right">
            	{{ $item->price}}Ks
           	</div>
          </td>
<!--           <td>
            <center>
              <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($item->code, 'C128')}}" alt="barcode" style="margin-top:20px;margin-bottom:20px" /><br>
            </center>
           	<div class="pull-left">
            	{{ $item->code}} 	
            </div>
           	<div class="pull-right">
            	{{ $item->price}}Ks
           	</div>
          </td> -->
        </tr>
        @endfor        
      </table>
  </body>
</html>
