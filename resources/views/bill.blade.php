<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <!--bootstrap-icons-->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
     <!-- datatable -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
 
</head>
<body>
  <div style="padding:30px;">
    <div style="width: 100%;text-align: end;"><button class="btn theme-color" onclick="window.print();" >Print</button></div>
        <h5>Bill No.:#{{$bill->bill_no}}</h5>
        <input type="hidden" name="bill_no" id="bill_no" value="" class="form-control">
        <div class="row">
            <div class="col-md-8">
                <h4>Bata Show Room</h4>
                <div class="row mb-1">
                    <label for="cust_name" class="col-sm-2 col-form-label">Cust.Name</label>
                    <div class="col-sm-7">
                      <label for="cust_name" class=" col-form-label">{{$bill->cust_name}}</label>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="cust_mobile"  class="col-sm-2 col-form-label">Mobile_No.</label>
                    <div class="col-sm-7">
                      <label for="cust_name" class=" col-form-label">{{$bill->cust_mobile}}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4  ">
                <p>Date: {{ date('d-m-Y h:i:s A',strtotime($bill->created_at)) }}</p>
                <div class="row mb-1">
                  <label for="cust_mobile"  class="col-sm-4 col-form-label">Payment Mode.</label>
                  <div class="col-sm-4">
                    <label for="cust_name" class=" col-form-label">@if ($bill->txnNo !='0')                      
                    upi({{$bill->txnNo}})
                    @else
                    cash 
                    @endif
                    </label>
                  </div>
              </div>
                   
                  <div class="row mb-1" id="txnLayout" style="display:none;">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">Txn_No.</label>
                    <div class="col-sm-7">
                      <input type="number" class="form-control" name="txnNo" id="txnNo" value="0">
                    </div>
                </div>
            </div>
        </div>
        {{-- {{serialize($items)}} --}}
        <table class="table" id="billTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Artical No.</th>
                    <th scope="col">Size</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
             
              @foreach ($items as $key => $item)
              <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$item->article_no}}</td>
                <td>{{$item->article_size}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->article_price}}</td>
            </tr>
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <th scope="row">Total</th>
                    <th scope="row" id="total_price">{{$bill->total_price}}</th>
                </tr>
            </tfoot>
        </table>
  </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready( function () {
        $.noConflict();
    $('#myTable').DataTable();
     } );
     function downloadFile(filePath) {
      var link = document.createElement('a');
      link.href = filePath;
      link.download = filePath.substr(filePath.lastIndexOf('/') + 1);
      link.click();
      }
    </script>
    @if (session('status'))
    <script>
         Swal.fire({
toast: true,
icon: 'success',
title: "{{ session('status') }}",
animation: false,
position: 'top-end',
animation: true,
showConfirmButton: false,
timer: 3000,
timerProgressBar: true,
didOpen: (toast) => {
  toast.addEventListener('mouseenter', Swal.stopTimer)
  toast.addEventListener('mouseleave', Swal.resumeTimer)
}
})
   </script>
   {{session()->forget('status');}}
   @endif
</div>

