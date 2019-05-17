@extends($theme.'.shop_layout')
@section('banner')
@endsection

@section('breadcrumb')
<div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="{{ url('/') }}">Trang chủ</a><span>»</span></li>
            <li class=""> <a title="Giỏ hàng" href="{{ url('gio-hang.html') }}">Giỏ hàng</a></li>
        </ul>
    </div>
</div>
</div>
</div>
@endsection

@section('content')
<section class="main-container col1-layout">
    <div class="main container">
      <div class="col-main">
        <div class="cart">

          <div class="page-content page-order">
            <div class="page-title">
                <h2>Shopping Cart</h2>
            </div>
            @if (count($cart) ==0)
            <div class="col-md-12 text-danger">
                Không có sản phẩm nào trong giỏ hàng!!
            </div>
            @else
            <style>
            .shipping_address td{
                padding: 3px !important;
            }
            .shipping_address textarea,.shipping_address input[type="text"]{
                width: 100%;
                padding: 7px !important;
            }
            .row_cart>td{
                vertical-align: middle !important;
            }
            input[type="number"]{
                text-align: center;
                padding:2px;
            }
        </style>
        <div class="table-responsive">
            <table class="table box table-bordered">
                <thead>
                  <tr  style="background: #eaebec">
                    <th style="width: 50px;">TT</th>
                    <th style="width: 100px;">Mã hàng</th>
                    <th>Tên hàng</th>
                    <th>Giá bán</th>
                    <th >Qty</th>
                    <th>Tổng tiền</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                @php
                $n = (isset($n)?$n:0);
                $n++;
                $product = App\Models\ShopProduct::find($item->id);
                @endphp
                <tr class="row_cart">
                    <td >{{ $n }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>
                        {{ $product->name }}<br>
                        <a href="{{ url('san-pham/'.ktc_str_convert($product->name).'_'.$product->id.'.html') }}"><img width="100" src="{{asset('documents/website/'.$product->image)}}" alt=""></a>
                    </td>
                    <td>{!! $product->showPrice() !!}</td>
                    <td><input style="width: 70px;" type="number" data-item-id="{{ $item->id }}" class="cart-item-qty" id="item-{{$item->id}}" data-row="{{$item->rowId}}" name="qty-{{$item->id}}" qty-old="{{$item->qty}}" value="{{$item->qty}}" min="1" max="{{ $product->stock }}">
                        <span class="text-danger item-qty-{{$item->id}}" style="display: none;"></span></td>
                        <td align="right" >
                           <span id="price-item-{{$item->id}}">{{number_format($item->subtotal)}}</span> VNĐ</td>
                           <td>
                            <a onClick="return confirm('Bạn có muốn xóa sản phẩm này?')" title="Remove Item" alt="Remove Item" class="cart_quantity_delete" href="{{url("removeItem/$item->rowId")}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr  style="background: #eaebec">
                        <td colspan="7">
                           <div class="pull-left">
                            <button class="btn btn-default" type="button" style="cursor: pointer;padding:10px 30px" onClick="location.href='{{ url('/') }}'"><i class="fa fa-arrow-left"></i> Tiếp Tục Mua Sắm</button>
                        </div>
                        <div class="pull-right">
                            <a onClick="return confirm('Bạn có muốn bỏ đơn hàng này?')" href="{{url('clear-cart')}}"><button class="btn btn-danger" type="button" style="cursor: pointer;padding:10px 30px">Xóa Toàn Bộ </button></a>

                            <a href="{{ route('cart.checkout') }}"><button class="btn btn-success" type="button" style="cursor: pointer;padding:10px 30px">Thanh Toán Đơn Hàng</button></a>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection

@push('scripts')
<script type="text/javascript">
    function updateCart(id){
        var new_qty = $('#item-'+id).val();
        var row_id = $('#item-'+id).attr('data-row');
        $.ajax({
            url: '{{ action('Shop@updateToCart') }}',
            type: 'POST',
            dataType: 'json',
            async: true,
            cache: false,
            data: {
                id: id,
                new_qty: new_qty,
                rowId: row_id,
                _token:'{{ csrf_token() }}'},
                success: function(data){
                    flg= parseInt(data.flg);
                    var message = data.msg;
                    if(flg ===1)
                    {
                        Swal.fire({
                            type: 'success',
                            title: 'Update cart success!',
                            showConfirmButton: false,
                            timer: 2500
                        })

                        $('#item-'+id).val(data.cart.qty);
                        $('#price-item-'+id).html(data.cart.subtotal);

                    }else{
                        Swal.fire({
                            type: 'error',
                            title: message,
                        })
                    }
                }
            });
    }
    var prev_qty_val;
    var current_qty_val;
    var max_input;
    var current_item_id;

    $(document).on('focusin', '.cart-item-qty', function(){
        $(this).data('val', $(this).val());
    }).on('change','.cart-item-qty', function(){
        prev_qty_val = parseInt($(this).data('val'));
        current_qty_val = parseInt($(this).val());
        max_input = parseInt($(this).attr('max'));
        current_item_id = $(this).attr('data-item-id');

        if (prev_qty_val != current_qty_val && current_qty_val <= max_input) {
            updateCart(current_item_id);
        }

        if (current_qty_val > max_input) {
            Swal.fire({
                type: 'error',
                title: 'Vượt quá số lượng cho phép.',
            })
            $(this).val(max_input);
        }
    });
</script>
@endpush
