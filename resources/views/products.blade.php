@extends('layouts.app')

@section('content')
    @if (session()->has('error'))
        <div class="alert alert-danger col-lg-5 text-center mt-5 mx-auto" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12 mt-5 mb-5">
            <h4>Welcome to <strong>A Pedia</strong>. Happy shopping!</h4>
        </div>
    </div>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-6 col-md-3 mb-5">
                <div class="img_thumbnail productlist">
                    <img src="{{ asset('storage') }}/{{ $product->photo }}" alt="" class="img-fluid">
                    <div class="caption">
                        <div class="productName">
                            <h4>{{ $product->product_name }}</h4>
                        </div>
                        <div>
                            <p>{{ $product->product_descriptions }}</p>
                            <p><strong>Price: Rp. </strong>{{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="btn-holder">
                                <a href="{{ route('add_to_cart', $product->id) }}"
                                    class="btn btn-primary btn-block text-center"role="button">Add to
                                    cart</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
