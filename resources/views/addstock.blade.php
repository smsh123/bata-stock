@extends('layouts.app')

@section('content')
<style>

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="insertstock" method="POST" class="form-floating" id="myForm">
                    @csrf
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6" onclick="window.location.href='/stock';">
                                <i class="bi bi-arrow-left-square"></i> {{ __('Add Artical to stock') }}
                            </div>
                            <div class="col-md-6 text-right">
                                <button style="" type="submit" class="btn theme-color">Save</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body ">
                        @if (session('status'))
                        {{-- <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                    </div> --}}
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Artical Type</label>
                            <select id="articalType" name="articalType"
                                class=" form-control form-select form-select-lg mb-3"
                                aria-label=".form-select-lg example">
                                <option selected>--select--</option>
                                <option value="Remo">Remo</option>
                                <option value="Power">Power</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-floating">
                            <label class="form-label">Artical Number</label>
                            <input type="text" id="articalNumber" name="articalNumber"
                                value="@if (isset($data->web_url)){{$data->web_url}}@endif" class="form-control"
                                required>
                            <input type="hidden" name="id" value="@if (isset($data->id)){{$data->id}}@endif"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Age Group</label>
                            <select id="ageGroup" name="ageGroup" class=" form-control form-select form-select-lg mb-3"
                                aria-label=".form-select-lg example">
                                <option selected>--select--</option>
                                <option value="Adult">Adult</option>
                                <option value="Child">Child</option>
                            </select>
                        </div>

                        <div class="col-md-12 text-center">
                            <h5>Artical Sizes</h5>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 1</label>
                            <input type="number" onchange="totalProductCount();" id="size_1" name="size_1" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 2</label>
                            <input type="number" onchange="totalProductCount();" id="size_2" name="size_2" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 3</label>
                            <input type="number" onchange="totalProductCount();" id="size_3" name="size_3" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 4</label>
                            <input type="number" onchange="totalProductCount();" id="size_4" name="size_4" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 5</label>
                            <input type="number" onchange="totalProductCount();" id="size_5" name="size_5" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 6</label>
                            <input type="number" onchange="totalProductCount();" id="size_6" name="size_6" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 7</label>
                            <input type="number" onchange="totalProductCount();" id="size_7" name="size_7" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 8</label>
                            <input type="number" onchange="totalProductCount();" id="size_8" name="size_8" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 9</label>
                            <input type="number" onchange="totalProductCount();" id="size_9" name="size_9" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 10</label>
                            <input type="number" onchange="totalProductCount();" id="size_10" name="size_10" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 11</label>
                            <input type="number" onchange="totalProductCount();" id="size_11" name="size_11" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 12</label>
                            <input type="number" onchange="totalProductCount();" id="size_12" name="size_12" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size 13</label>
                            <input type="number" onchange="totalProductCount();" id="size_13" name="size_13" value="0"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Total Product</label>
                            <input type="number" name="totalProduct" id="totalProduct" value="0" class="form-control"
                            disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Price</label>
                            <input type="text" id="price" name="price" value="" class="form-control" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@push('scriptBottom')
<script>
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
</script>
@endpush