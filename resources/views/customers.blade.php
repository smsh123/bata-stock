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
                            <th scope="col">Customer name</th>
                            <th scope="col">Customer mobile</th>
                            <th scope="col">No. of orders</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($customers as $key => $customer)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->mobile}}</td>
                            <td>{{$customer->all_order}}</td>
                            <td>{{ date('d-m-Y h:i:s A',strtotime($customer->created_at)) }}</td>
                            <td><button onclick="window.location.href='';" type="button" class="btn theme-color" title="View details"><i
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

@endpush