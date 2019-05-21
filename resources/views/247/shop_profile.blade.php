@extends($theme.'.shop_layout')
@section('banner')
@endsection

@section('breadcrumb')
<ul id="home-page-tabs" class="nav nav-tabs clearfix">
    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
    <li><a>/</a></li><li><a>Hố sơ của bạn</a></li>
</ul>
@endsection
<style>
.help-block-error{
    color: red;
}
</style>
@section('content')

<div class="container">
    <div class="col-xs-12">
       @if (session('status'))
       <div class="alert alert-success">{{ session('status') }}</div>
       @endif
   </div>
    <!-- Thong tin nguoi dung -->
    <div class="row">
        <div class="col-md-6">
            <div id="grid-user-info">
                <h1><strong>Thông tin tài khoản</strong></h1>
                <form action="{{ route('user.change_info') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-form-label">Tên tài khoản</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                @if ($errors->has('name'))
                                <span class="help-block-error">
                                    {{ $errors->first('name') }}
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Email</label>
                                <input type="email" readonly="readonly" value="{{ $user->email }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">
                                    Địa chỉ
                                </label>
                                <input type="text" value="{{ $user->address1 }}" name="address1" class="form-control" placeholder="Địa chỉ">
                                @if ($errors->has('address1'))
                                <span class="help-block-error">
                                    {{ $errors->first('address1') }}
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">
                                    Địa chỉ khác
                                </label>
                                <input type="text" value="{{ $user->address2 }}" name="address2" class="form-control" placeholder="Địa chỉ">
                                @if ($errors->has('address2'))
                                <span class="help-block-error">
                                    {{ $errors->first('address2') }}
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">
                                    Phone
                                </label>
                                <input type="text" value="{{ $user->phone }}" name="phone" class="form-control" placeholder="Số điện thoại">
                                @if ($errors->has('phone'))
                                <span class="help-block-error">
                                    {{ $errors->first('phone') }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (count($orders) ==0)
    <div class="col-md-12 text-danger">
        Quý khách chưa có đơn hàng nào!!
    </div>
    @else
    <div class="col-md-6 col-md-offset-3">
    <h1><strong>Thông tin đơn hàng</strong></h1>
    </div>
    <table class="table box  table-bordered table-responsive">
        <thead>
          <tr>
            <th style="width: 50px;">TT</th>
            <th style="width: 100px;">Mã đơn hàng</th>
            <th>Giá trị đơn hàng</th>
            <th>Trạng thái</th>
            <th>Ngày mua</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        @php
        $n = (isset($n)?$n:0);
        $n++;
        // $order = App\Models\ShopProduct::find($item->id);
        @endphp
        <tr>
            <td><span class="item_21_id">{{ $n }}</span></td>
            <td><span class="item_21_sku">#{{ $order->id }}</span></td>
            <td align="right">
                {{ number_format($order->total) }} VNĐ
            </td>
            <td>{{ $statusOrder[$order->status]}}</td>
            <td>{{ $order->created_at }}</td>
            <td>
                <a data-toggle="modal" data-target="#order-{{ $order->id }}" href="#"><i class="glyphicon glyphicon-list-alt"></i> Chi tiết</a>
            </td>
        </tr>
        <!-- Modal -->
        <div id="order-{{ $order->id }}" class="modal fade" role="dialog" style="z-index: 9999;">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chi tiết đơn hàng #{{ $order->id }}</h4>
            </div>
            <div class="modal-body">
                @foreach($order->details as $detail)
                <div class="row">
                    <div class="col-md-4">{{ $detail->name }} (<b>SKU:</b> {{ $detail->sku }})</div>
                    <div class="col-md-3" align="right">{{ number_format($detail->price) }} VNĐ</div>
                    <div class="col-md-2">{{$detail->attribute }}</div>
                    <div class="col-md-1">x {{ $detail->qty }}</div>
                    <div class="col-md-2"   align="right">{{ number_format($detail->total_price) }} VNĐ</div>
                </div>
                @endforeach
                <hr>
                @foreach($order->orderTotal as $total)
                @if ($total->value !=0)
                <div class="row">
                    <div class="col-md-10" align="right">
                        {!! $total->title !!}
                    </div>
                    <div class="col-md-2"  align="right">{{ number_format($total->value) }} VNĐ</div>
                </div>
                @endif

                @endforeach

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
</tbody>
</table>
@endif
</div>
@endsection


