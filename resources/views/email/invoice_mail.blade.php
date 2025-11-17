{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Email</title>
    <style>
        body {
            background: #f4f7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-wrapper {
            max-width: 700px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .header {
            background: #2e89ff;
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-height: 50px;
        }
        .content {
            padding: 30px;
        }
        .content h1 {
            font-size: 26px;
            margin-bottom: 20px;
        }
        .details p {
            margin: 10px 0;
            font-size: 16px;
        }
        .highlight {
            font-weight: bold;
            color: #000;
        }
        .cta {
            text-align: center;
            margin-top: 30px;
        }
        .cta a {
            background: #2e89ff;
            color: #fff;
            padding: 14px 28px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            transition: background 0.3s ease;
        }
        .cta a:hover {
            background: #216bd9;
        }
        .footer {
            /* background: #1a1a1a;
            color: #ccc; */
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
        .footer .social-icons {
            margin-top: 15px;
        }
        .footer .social-icons a {
            margin: 0 8px;
            display: inline-block;
        }
        .footer .social-icons img {
            height: 24px;
        }
    </style>
</head>
<body>

    <div class="email-wrapper">
        <!-- Header -->
        <div class="header">
            <img src="{{ url('public/assets/upload/logo/'.get_settings('dark_logo')) }}" alt="{{ get_settings('system_title') }} Logo">
        </div>

        <!-- Body -->
        <div class="content">
            <h1>🧾 {{ $data['status'] == 'approved' ? 'Your Order is Confirmed!' : 'We Received Your Order' }}</h1>

            <p>Hello <span class="highlight">{{ $data['user_name'] }}</span>,</p>

            @if($data['status'] == 'approved')
                <p>We're excited to let you know that your order has been approved. You can now access your item(s).</p>
            @else
                <p>Thank you for your order! We're reviewing it and will notify you once it's approved.</p>
            @endif

            <div class="details">
                <p>💰 <span class="highlight">Amount Paid:</span> {{ $data['amount'] }} BDT</p>
                <p>💳 <span class="highlight">Payment Type:</span> {{ $data['payment_type'] }}</p>
                <p>🆔 <span class="highlight">Transaction ID:</span> {{ $data['transaction_id'] }}</p>
            </div>

            @if($data['status'] == 'approved' && !empty($data['download_link']))
                <div class="cta">
                    <a href="{{ $data['download_link'] }}" target="_blank">Download Your Item</a>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} {{ get_settings('system_title') }}. All rights reserved.<br>
            This email was sent to {{ $data['email'] }}

            <div class="social-icons">
                <a href="https://facebook.com/yourpage" target="_blank">
                    <img src="{{ asset('assets/email/facebook.png') }}" alt="Facebook">
                </a>
                <a href="https://instagram.com/yourpage" target="_blank">
                    <img src="{{ asset('assets/email/instagram.png') }}" alt="Instagram">
                </a>
                <a href="https://linkedin.com/yourpage" target="_blank">
                    <img src="{{ asset('assets/email/linkedin.png') }}" alt="LinkedIn">
                </a>
            </div>
        </div>
    </div>

</body>
</html> --}}


<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-user_info-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <!-- HIDDEN PREHEADER TEXT -->
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> We're thrilled to have you here! Get ready to dive into your new account.
    </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td bgcolor="#FFA73B" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <img src=" https://img.icons8.com/clouds/100/000000/handshake.png" width="125" height="120" style="display: block; border: 0px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <div class="content">
                        <h1>🧾 {{ $data['status'] == 'approved' ? 'Your Order is Confirmed!' : 'We Received Your Order' }}</h1>
            
                        <p>Hello <span class="highlight">{{ $data['user_name'] }}</span>,</p>
            
                        @if($data['status'] == 'approved')
                            <p>We're excited to let you know that your order has been approved. You can now access your item(s).</p>
                        @else
                            <p>Thank you for your order! We're reviewing it and will notify you once it's approved.</p>
                        @endif
            
                        <div class="details">
                            <p>💰 <span class="highlight">Amount Paid:</span> {{ $data['amount'] }} BDT</p>
                            <p>💳 <span class="highlight">Payment Type:</span> {{ $data['payment_type'] }}</p>
                            <p>🆔 <span class="highlight">Transaction ID:</span> {{ $data['transaction_id'] }}</p>
                        </div>
            
                        @if($data['status'] == 'approved' && !empty($data['download_link']))
                            <div class="cta">
                                <a href="{{ $data['download_link'] }}" target="_blank">Download Your Item</a>
                            </div>
                        @endif
                    </div>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
                            <p style="margin: 0;"><a href="{{url('/support')}}" target="_blank" style="color: #FFA73B;">We&rsquo;re here to help you out</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br>
                            <p style="margin: 0;">&copy; {{ date('Y') }} {{ get_settings('system_title') }}. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>