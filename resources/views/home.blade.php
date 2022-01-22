@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ __('Top Selling Article') }}</div>

                <div class="card-body">
                    <canvas style="/*max-width: 160px;max-height: 160px;*/" id="topComChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6" >
                            {{ __('Active Order') }}
                        </div>
                        <div class="col-md-6 text-right">
                            <button style="margin-bottom: -8px; margin-top: -8px;" type="button" class="btn theme-color"
                            data-bs-toggle="modal" data-bs-target="#newSellModal" >New Bill</button>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="min-height: 244px;">
                   
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ __('Today\'s Sell') }}</div>
                <div class="card-body">
                    <table class="table" >
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bill_No.</th>
                                <th scope="col">Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>1000</td>
                                <td>599</td>
                                <td><button style="padding: 2px 5px 0px 5px;" type="button" class="btn theme-color"
                                        data-bs-toggle="modal" data-bs-target="#Modal" title="Bill information"><i
                                            class="bi bi-card-list"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- new sell model start --}}
<div class="modal fade" id="newSellModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog  modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New Bill </h5>
                                        <button type="button" class="bi bi-x-lg" data-bs-dismiss="modal"
                                            aria-label="Close" style="border: none;"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="insertbill" method="POST" class="form-floating" id="myForm">
                                            @csrf
                                            <h5>Bill No.:#{{$last_bill_no+1}}</h5>
                                            <input type="hidden" name="bill_no" id="bill_no" value="{{$last_bill_no+1}}" class="form-control">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h4>Bata Show Room</h4>
                                                    <div class="row mb-1">
                                                        <label for="cust_name" class="col-sm-2 col-form-label">Cust.Name</label>
                                                        <div class="col-sm-7">
                                                          <input type="text" class="form-control" name="cust_name" id="cust_name" value="Aman Kumar">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <label for="cust_mobile"  class="col-sm-2 col-form-label">Mobile_No.</label>
                                                        <div class="col-sm-7">
                                                          <input type="number" class="form-control" name="cust_mobile" id="cust_mobile" value="9876543210">
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-1"></div> --}}
                                                <div class="col-md-4  ">
                                                    <p>Date: {{ date('d-m-Y h:i:s A') }}</p>
                                                    {{-- <p>Payment Mode: cash </p> --}}
                                                    <fieldset class="row mb-1 ">
                                                        <div class="col-form-label col-sm-6 pt-0">Payment Mode</div>
                                                        <div class="col-sm-3">
                                                          <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cash" id="cash" value="cash" onclick="hideTxnLayout();" >
                                                            <label class="form-check-label" for="gridRadios1">
                                                              cash
                                                            </label>
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                          <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="upi" id="upi" value="upi" onclick="showTxnLayout();">
                                                            <label class="form-check-label" for="gridRadios2">
                                                              upi
                                                            </label>
                                                          </div>
                                                        </div>
                                                      </fieldset>
                                                      <div class="row mb-1" id="txnLayout" style="display:none;">
                                                        <label for="inputEmail3" class="col-sm-5 col-form-label">Txn_No.</label>
                                                        <div class="col-sm-7">
                                                          <input type="number" class="form-control" name="txnNo" id="txnNo" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table" id="billTable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Artical No.</th>
                                                        <th scope="col">Size</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="row1" data-uid="123">
                                                        <th scope="row">1</th>
                                                        <td><select class="form-select form-control" name="article_no[]" id="artical_no1" onchange="articleFetch(this);">
                                                            <option value="0" selected>Selecct Article</option>
                                                            @foreach ($articles as $key => $article )
                                                            <option value="{{$article->article_no}}" >{{$article->article_no}}</option>
                                                            @endforeach
                                                          </select></td>
                                                        <td><select class="form-select form-control" name="article_size[]" id="artical_size1">
                                                            <option value="0" selected>0</option>
                                                        </select>
                                                    </td>
                                                        <td><input type="number" class="form-control col-sm-4" name="quantity[]" id="quantity1" value="1" onchange="updateSinglePrice(this)"></td>
                                                        <td id="article_price1">0</td>
                                                        <input type="hidden" name="article_price[]" id="article_price_single1">
                                                        <td class="text-center"><i title="Add new row" class="bi bi-plus-circle" onclick="addARow();"></i></td>
                                                        <td id="unit_price1" style="display: none;"></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <td></td>
                                                        <td></td>
                                                        <th scope="row">Total</th>
                                                        <th scope="row" id="total_price">0</th>
                                                        <input type="hidden" id="total_sum_price" name="total_price">
                                                        <th scope="row" class="text-center"><i title="Remove last row" class="bi bi-dash-circle" onclick="removeARow();"></i></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                   
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn theme-color">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        {{-- new sell model end --}}
                        {{-- <p id="demo"></p> --}}


@endsection
@push('scriptBottom')
{{-- <script>
    document.getElementById("demo").innerHTML = 
    "Screen width is " + screen.width;
    </script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    var top_json = JSON.parse('{"name":["Remo","Power"],"value":[8,5],"color":["#fc9f69","#07b770"]}');
    Chart.defaults.global.legend.display = false;
    var ctx = document.getElementById('topComChart');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: top_json.name,
            datasets: [{
                label: 'My First Dataset',
                data: top_json.value,
                backgroundColor: top_json.color,
                hoverOffset: 4
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    });

function showTxnLayout (){
    document.getElementById('txnLayout').style.display='flex';
    document.getElementById('cash').checked=false;
} 
function hideTxnLayout (){
    document.getElementById('txnLayout').style.display='none';
    document.getElementById('upi').checked=false;
} 
var key='0';
function addARow(){
    // var key1=1;
     key=$('#billTable > tbody > tr:last-child > th:first-child').text();
    var temKey=parseInt(key);
    var newKey=temKey+1;
    console.log(key);
    $("#billTable > tbody").append('<tr id="row'+newKey+'"><th scope="row">'+newKey+'</th> <td><select class="form-select form-control" name="article_no[]" id="artical_no'+newKey+'" onchange="articleFetch(this);"> <option value="0" selected>Selecct Article</option> @foreach ($articles as $key => $article ) <option value="{{$article->article_no}}" >{{$article->article_no}}</option> @endforeach </select></td> <td><select class="form-select form-control" name="article_size[]" id="artical_size'+newKey+'"> <option value="0" selected>0</option> </select> </td> <td><input type="number" class="form-control col-sm-4" name="quantity[]" id="quantity'+newKey+'" value="1" onchange="updateSinglePrice(this)" ></td> <td id="article_price'+newKey+'">0</td><input type="hidden" name="article_price[]" id="article_price_single'+newKey+'"> <td class="text-center"><i title="Add new row" class="bi bi-plus-circle" onclick="addARow();"></i></td> <td id="unit_price'+newKey+'" style="display: none;"></td></tr>');
    console.log($('#billTable > tbody > tr').last());
   
}
function removeARow(){
    key=$('#billTable > tbody > tr:last-child > th:first-child').text();
    if(key > 1){
document.getElementById('row'+key).remove();
    }
    key=$('#billTable > tbody > tr:last-child > th:first-child').text();
    var temKey=parseInt(key);
    if(key != 1){var newKey=temKey-1;key=newKey;}
    else{key=$('#billTable > tbody > tr:last-child > th:first-child').text();}
console.log(key);

}

 function articleFetch (artical_no) {
    // var temKey=parseInt(key);
    // var newKey=temKey+1;
    // console.log(artical_no.id);
    
    var matches = artical_no.id.match(/(\d+)/);
    newKey=matches[0];
    var settings = {
  "url": "/api/articles/" + artical_no.value,
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Authorization": "Bearer {!! session('token') !!}"
  },
};

$.ajax(settings).done(function (response) {
    console.log(response);
    console.log(response[0].s_1);
    var optionText='';
    if(response[0].s_1 != 0){optionText='<option value="1">1</option>';}
    if(response[0].s_2 != 0){optionText+='<option value="2">2</option>';}
    if(response[0].s_3 != 0){optionText+='<option value="3">3</option>';}
    if(response[0].s_4 != 0){optionText+='<option value="4">4</option>';}
    if(response[0].s_5 != 0){optionText+='<option value="5">5</option>';}
    if(response[0].s_6 != 0){optionText+='<option value="6">6</option>';}
    if(response[0].s_7 != 0){optionText+='<option value="7">7</option>';}
    if(response[0].s_8 != 0){optionText+='<option value="8">8</option>';}
    if(response[0].s_9 != 0){optionText+='<option value="9">9</option>';}
    if(response[0].s_10 != 0){optionText+='<option value="10">10</option>';}
    if(response[0].s_11 != 0){optionText+='<option value="11">11</option>';}
    if(response[0].s_12 != 0){optionText+='<option value="12">12</option>';}
    if(response[0].s_13 != 0){optionText+='<option value="13">13</option>';}
    $('#artical_size'+newKey).children().remove().end();
    $('#artical_size'+newKey).append(optionText);
    $('#unit_price'+newKey).text(response[0].price);
    var quantity=$('#quantity'+newKey).val();
    var rowPrice=parseInt(quantity) * response[0].price ;
    $('#article_price'+newKey).text(rowPrice);
    $('#article_price_single'+newKey).val(rowPrice);
    totalPrice();
});
    // $('#artical_no').blur();
    };

function updateSinglePrice(quantity){
    var matches = quantity.id.match(/(\d+)/);
    newKey=matches[0];
    var unitPrice= parseInt($('#unit_price'+newKey).text());
    var quantity=$('#quantity'+newKey).val();
    var rowPrice=parseInt(quantity) * unitPrice ;
    $('#article_price'+newKey).text(rowPrice);
    $('#article_price_single'+newKey).val(rowPrice);
    console.log("key-> "+matches[0]);
    totalPrice();
}

function totalPrice(){
    var rowCount = $("#billTable tbody tr").length;
    console.log('tr count -> '+rowCount);
    var sum=0;
    for (let index = 1; index <= rowCount; index++) {
        sum+= parseInt($('#article_price'+index).text());
        
    }
    $('#total_price').text(sum);
    $('#total_sum_price').val(sum);
}

</script>
<script>
    var settings = {
  "url": "/api/articles",
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Authorization": "Bearer {!! session('token') !!}"
  },
};

$.ajax(settings).done(function (response) {
  console.log(response);
});
</script>
@endpush
