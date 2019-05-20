@extends($theme.'.shop_layout')
@section('slide')
@endsection

@section('breadcrumb')
<ul id="home-page-tabs" class="nav nav-tabs clearfix">
    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
    <li><a>/</a></li><li><a>Quên mật khẩu</a></li>
</ul>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
           @if (session('status'))
           <div class="alert alert-success">{{ session('status') }}</div>
           @endif
       </div>

       <div class="row">
        <div class="col-md-6 col-md-offset-3">

           <div id="reset-password-page">
            <h1 class="text-center">
                <strong>Thay Đổi Mật Khẩu</strong>
            </h1>
            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Địa chỉ email của bạn</label>
                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 col-md-offset-4">
                        <button type="submit" name="SubmitLogin" class="btn btn-success btn-md">
                            <span>
                                <i class="glyphicon glyphicon-wrench"></i>
                                Gửi yêu cầu mật khẩu
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
</div>
@endsection
