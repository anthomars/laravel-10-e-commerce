@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Products</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-10" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-10">
        <a href="/dashboard/products/create" class="btn btn-primary mb-3">Create New Product</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th width='5%'>#</th>
                    <th width='15%'>Photo</th>
                    <th width='20%'>Product Name</th>
                    <th width='30%'>Description</th>
                    <th width='15%'>Price</th>
                    <th width='15%'>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        {{-- <td>{{ $loop->iteration }}</td> --}}
                        <td>{{ $products->firstItem() + $loop->index }}</td>
                        <td><img src="{{ asset('storage/' . $product->photo) }}" width="60"></td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_descriptions }}</td>
                        <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            {{-- <a href="/dashboard/products/{{ $product->id }}" class="badge bg-info"><span
                                    data-feather="eye"></span></a> --}}
                            <a href="/dashboard/products/{{ $product->id }}/edit" class="badge bg-warning"><span
                                    data-feather="edit"></span></a>
                            <form action="/dashboard/products/{{ $product->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Are You Sure?')"><span
                                        data-feather="x-circle"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $products->links() }}
        </div>
    </div>
@endsection
