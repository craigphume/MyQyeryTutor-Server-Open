<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; background-color: #f8fafc; color: #74787e; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
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

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="header" style="box-sizing: border-box; padding: 25px 0; text-align: center;">
                        <a href="https://mqt-server.com" style="box-sizing: border-box; color: #bbbfc3; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
                            {{ config('app.name') }} Invitation
                        </a>
                    </td>
                </tr>

                <!-- Email Body -->
                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; background-color: #ffffff; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                        <table class="inner-body" align="center" width="800" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 800px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 800px;">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell" style="box-sizing: border-box; padding: 35px;">
                                    <h1 style="box-sizing: border-box; color: #3d4852; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">
                                        Hello {{ $user->name }}</h1>
                                    <p style="box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                        You are receiving this email because you have been added as a teacher to <strong>{{ $user->school->name }}</strong>, in {{ config('app.name') }}.</p>
                                    <p style="box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                        To use {{ config('app.name') }}, please click the link below to set your password.</p>
                                    <p style="box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                        This email will expire at {{ \Carbon\Carbon::now()->addDays(2)->toDayDateTimeString() }}.</p>
                                    <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; margin: 30px auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                                        <tr>
                                            <td align="center" style="box-sizing: border-box;">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box;">
                                                    <tr>
                                                        <td align="center" style="box-sizing: border-box;">
                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box;">
                                                                <tr>
                                                                    <td style="box-sizing: border-box;">
                                                                        <a href="{{ route('password.reset', ['token' => $token, 'email' => $user->email]) }}"
                                                                           class="button button-primary"
                                                                           target="_blank"
                                                                           style="box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #fff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3490dc; border-top: 10px solid #3490dc; border-right: 18px solid #3490dc; border-bottom: 10px solid #3490dc; border-left: 18px solid #3490dc;">
                                                                            Set Your Password
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>

                                    <p
                                        style="box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                        Regards,<br>
                                        {{ config('app.name') }}</p>

                                    <table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; border-top: 1px solid #edeff2; margin-top: 25px; padding-top: 25px;">
                                        <tr>
                                            <td style="box-sizing: border-box;">
                                                <p style="box-sizing: border-box; color: #3d4852; line-height: 1.5em; margin-top: 0; text-align: left; font-size: 12px;">
                                                    If you’re having trouble clicking the "Set Your Password" button, copy and paste the URL below
                                                    into your web browser:
                                                    <a href="{{ route('password.reset', ['token' => $token, 'email' => $user->email]) }}" style="box-sizing: border-box; color: #3869d4;">
                                                        {{ route('password.reset', ['token' => $token, 'email' => $user->email]) }}
                                                    </a>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="box-sizing: border-box;">
                        <table class="footer" align="center" width="800" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 800px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 800px;">
                            <tr>
                                <td class="content-cell" align="center" style="box-sizing: border-box; padding: 35px;">
                                    <p style="box-sizing: border-box; line-height: 1.5em; margin-top: 0; color: #aeaeae; font-size: 12px; text-align: center;">
                                        © 2020 {{ config('app.name') }}. All rights reserved.
                                    </p>
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
