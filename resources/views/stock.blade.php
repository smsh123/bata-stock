@extends('layouts.app')

@section('content')
<div class="container">
    <div class="add-btn">
        <a href="add-stock" class="btn theme-color">Add single Article</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Stock Artical list') }} </div>

                <div class="card-body table-responsive">
                    @if (session('status'))
                    {{-- <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                </div> --}}
                @endif
                <table id="myTable" class="table  table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Article type</th>
                            <th scope="col">Article Number</th>
                            <th scope="col">Age group</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($stock_all as $key => $stock)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$stock->article_type}}</td>
                            <td>{{$stock->article_no}}</td>
                            <td>{{$stock->age_group}}</td>
                            <td>{{$stock->price}}</td>
                            <td>{{$stock->s_1+$stock->s_2+$stock->s_3+$stock->s_4+$stock->s_5+$stock->s_6+$stock->s_7+$stock->s_8+$stock->s_9+$stock->s_10+$stock->s_11+$stock->s_12+$stock->s_13}}
                            </td>
                            <td><button type="button" class="btn theme-color" data-bs-toggle="modal"
                                    data-bs-target="#Modal{{$key}}" title="Size list"><i
                                        class="bi bi-card-list"></i></button></td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="Modal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Artical Information</h5>
                                        <button type="button" class="bi bi-x-lg" data-bs-dismiss="modal"
                                            aria-label="Close" style="border: none;"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="insertstock" method="POST" class="form-floating" id="myForm">
                                            @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">Artical Type</label>
                                                <select id="articalType" name="articalType"
                                                    class=" form-control form-select form-select-lg mb-3"
                                                    aria-label=".form-select-lg example">
                                                    <option selected>--select--</option>
                                                    <option value="Remo" @if ($stock->article_type == 'Remo') selected @endif>Remo</option>
                                                    <option value="Power" @if ($stock->article_type == 'Power') selected @endif>Power</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-floating">
                                                <label class="form-label">Artical Number</label>
                                                <input type="text" id="articalNumber" name="articalNumber"
                                                    value="{{$stock->article_no}}" class="form-control"
                                                    required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Age Group</label>
                                                <select id="ageGroup" name="ageGroup" class=" form-control form-select form-select-lg mb-3"
                                                    aria-label=".form-select-lg example">
                                                    <option selected>--select--</option>
                                                    <option value="Adult" @if ($stock->age_group == 'Adult') selected @endif>Adult</option>
                                                    <option value="Child" @if ($stock->age_group == 'Child') selected @endif>Child</option>
                                                </select>
                                            </div>
                    
                                            <div class="col-md-12 text-center">
                                                <h5>Artical Sizes</h5>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 1</label>
                                                <input type="number" onchange="totalProductCount();" id="size_1" name="size_1" value="{{$stock->s_1}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 2</label>
                                                <input type="number" onchange="totalProductCount();" id="size_2" name="size_2" value="{{$stock->s_2}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 3</label>
                                                <input type="number" onchange="totalProductCount();" id="size_3" name="size_3" value="{{$stock->s_3}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 4</label>
                                                <input type="number" onchange="totalProductCount();" id="size_4" name="size_4" value="{{$stock->s_4}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 5</label>
                                                <input type="number" onchange="totalProductCount();" id="size_5" name="size_5" value="{{$stock->s_5}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 6</label>
                                                <input type="number" onchange="totalProductCount();" id="size_6" name="size_6" value="{{$stock->s_6}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 7</label>
                                                <input type="number" onchange="totalProductCount();" id="size_7" name="size_7" value="{{$stock->s_7}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 8</label>
                                                <input type="number" onchange="totalProductCount();" id="size_8" name="size_8" value="{{$stock->s_8}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 9</label>
                                                <input type="number" onchange="totalProductCount();" id="size_9" name="size_9" value="{{$stock->s_9}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 10</label>
                                                <input type="number" onchange="totalProductCount();" id="size_10" name="size_10" value="{{$stock->s_10}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 11</label>
                                                <input type="number" onchange="totalProductCount();" id="size_11" name="size_11" value="{{$stock->s_11}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 12</label>
                                                <input type="number" onchange="totalProductCount();" id="size_12" name="size_12" value="{{$stock->s_12}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Size 13</label>
                                                <input type="number" onchange="totalProductCount();" id="size_13" name="size_13" value="{{$stock->s_13}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Total Product</label>
                                                <input type="number" name="totalProduct" id="totalProduct" value="{{$stock->s_1+$stock->s_2+$stock->s_3+$stock->s_4+$stock->s_5+$stock->s_6+$stock->s_7+$stock->s_8+$stock->s_9+$stock->s_10+$stock->s_11+$stock->s_12+$stock->s_13}}" class="form-control"
                                                    disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Price</label>
                                                <input type="text" id="price" name="price" value="{{$stock->price}}" class="form-control" required>
                                            </div>
                                            {{-- <div class="col-md-12 text-right">
                                                <button style="" type="submit" class="btn theme-color">Save</button>

                                            </div> --}}
                                        </div>
                                   
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
                        @endforeach
                    </tbody>
                </table>
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
{{-- @if (session('download-url'))
<script>
downloadFile("{{session('download-url')}}");
// window.open("{{session('download-url')}}",'_blank');
</script>
{{session()->forget('download-url');}} --}}
{{-- @endif --}}
@endpush