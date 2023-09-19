@extends('layout')

@section('content')
    <div class="table-responsive">
        <table id="cart" class="table align-middle table-hover text-center">
            <thead>
                <tr\>
                    <th style="width: 35%">Product</th>
                    <th style="width: 20%">Price</th>
                    <th style="width: 15%">Quantity</th>
                    <th style="width: 20%">Subtotal</th>
                    <th style="width: 10%"></th>
                    </tr>
            </thead>
            <tbody>
                @php $total=0 @endphp
                @if (session('cart'))
                    @foreach (session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr data-id="{{ $id }}">
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-lg-3 hidden-xs"><img
                                            src="{{ asset('storage') }}/{{ $details['photo'] }}" width="80px"
                                            height="80px" class="img-responsive"></div>
                                    <div class="col-lg-9 mt-3">
                                        <h4>{{ $details['product_name'] }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price">Rp. {{ number_format($details['price'], 0, ',', '.') }}
                            </td>
                            <td data-th="Quantity">
                                {{-- <input type="number" value="{{ $details['quantity'] }}"
                                    class="form-control quantity cart_update" min="1"> --}}
                                {{-- <input type="hidden" class="product_id" value="{{ $id }}"> --}}
                                <div class="input-group input-group-sm quantity row">
                                    <span class="input-group-text decrement-btn bg-dark cart_update col-4"
                                        style="cursor: pointer; color:#fff"><i class="fa fa-minus mx-auto"></i></span>
                                    <input type="text" class="form-control qty-input col-4 text-center"
                                        value="{{ $details['quantity'] }}">
                                    <span class="input-group-text increment-btn bg-dark cart_update col-4 text-center"
                                        style="cursor: pointer; color:#fff"><i class="fa fa-plus mx-auto"></i></span>
                                </div>
                            </td>
                            <td data-th="Subtotal">Rp.
                                {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                            <td class="actions" data-th="">
                                <button class="btn btn-danger btn-sm cart_remove"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="5" style="text-align:right;">
                        <h3><strong>Total Rp. {{ number_format($total, 0, ',', '.') }}</strong></h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right;">
                        <form action="/session" method="POST">
                            <a href="{{ url('/') }}" class="btn btn-danger"> <i class="fa fa-arrow-left"></i> Continue
                                Shopping</a>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-success" type="submit" id="checkout-live-button"><i
                                    class="fa fa-money"></i>
                                Checkout</button>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.increment-btn').click(function(e) {
            e.preventDefault();
            var incre_value = $(this).parents('.quantity').find('.qty-input').val();
            var value = parseInt(incre_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value < 10) {
                value++;
                $(this).parents('.quantity').find('.qty-input').val(value);
            }

        });

        $('.decrement-btn').click(function(e) {
            e.preventDefault();
            var decre_value = $(this).parents('.quantity').find('.qty-input').val();
            var value = parseInt(decre_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                value--;
                $(this).parents('.quantity').find('.qty-input').val(value);
            }
        });


        $('.cart_update').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('update_cart') }}',
                method: 'patch',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: $(this).parents('tr').attr('data-id'),
                    quantity: $(this).parents('tr').find('.qty-input').val()
                },
                success: function(response) {
                    window.location.reload();
                }

            });
        });

        $('.cart_remove').click(function(e) {
            e.preventDefault();

            var ele = $(this);

            if (confirm('Do you really want to remove?')) {
                $.ajax({
                    url: '{{ route('remove_from_cart') }}',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents('tr').attr('data-id')
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection
