@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="add-btn">
        <a href="add-stock" class="btn theme-color">Add single Article</a>
    </div> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                <div class="card-header">{{ __('All Sell list') }} </div>

                <div class="card-body">
                    @if (session('status'))
                    {{-- <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                </div> --}}
                @endif
                <table id="myTable" class="table  table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Bill no.</th>
                            <th scope="col">Customer name</th>
                            <th scope="col">Customer mobile</th>
                            <th scope="col">No. of articles</th>
                            <th scope="col">Total amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($sells as $key => $sell)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$sell->bill_no}}</td>
                            <td>{{$sell->cust_name}}</td>
                            <td>{{$sell->cust_mobile}}</td>
                            <td>{{count(json_decode($sell->article_no))}}</td>
                            <td>{{$sell->total_price}}</td>
                            <td>{{ date('d-m-Y h:i:s A',strtotime($sell->created_at)) }}</td>
                            <td><button onclick="window.location.href='/bill/{{$sell->bill_no}}';" type="button" class="btn theme-color" title="View details"><i
                                        class="bi bi-card-list"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@push('scriptBottom')
{{-- <script>
    function totalProductCount() {
        var size_1 = parseInt(document.getElementById('size_1').value);
        var size_2 = parseInt(document.getElementById('size_2').value);
        var size_3 = parseInt(document.getElementById('size_3').value);
        var size_4 = parseInt(document.getElementById('size_4').value);
        var size_5 = parseInt(document.getElementById('size_5').value);
        var size_6 = parseInt(document.getElementById('size_6').value);
        var size_7 = parseInt(document.getElementById('size_7').value);
        var size_8 = parseInt(document.getElementById('size_8').value);
        var size_9 = parseInt(document.getElementById('size_9').value);
        var size_10 = parseInt(document.getElementById('size_10').value);
        var size_11 = parseInt(document.getElementById('size_11').value);
        var size_12 = parseInt(document.getElementById('size_12').value);
        var size_13 = parseInt(document.getElementById('size_13').value);
        var myForm = document.forms['myForm'];
        myForm['totalProduct'].value = size_1 + size_2 + size_3 + size_4 + size_5 + size_6 + size_7 + size_8 +
            size_9 + size_10 + size_11 + size_12 + size_13;

    }
</script> --}}
{{-- @if (session('download-url'))
<script>
downloadFile("{{session('download-url')}}");
// window.open("{{session('download-url')}}",'_blank');
</script>
{{session()->forget('download-url');}} --}}
{{-- @endif --}}
@endpush