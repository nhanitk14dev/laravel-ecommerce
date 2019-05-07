<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>

    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0">

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                                <!-- Body content -->
                                <tr>
                                    <td>
                                        <b>Tên khách hàng</b>: {{ $name }}<br>
                                        <b>Địa chỉ email</b>: {{ $email }}<br>
                                        <b>Số điện thoại</b>: {{ $phone }}<br>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                            <p style="text-align: center;">Nội dung liên hệ:<br>
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td>{!! $content !!}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="content-cell" align="center">
                                        <p>&nbsp;</p>
                                         &copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>. All rights reserved.
                                        {{-- {{ Illuminate\Mail\Markdown::parse($slot) }} --}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
