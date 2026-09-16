<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ISUFSTPASS</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f6f9;-webkit-font-smoothing:antialiased;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f6f9;padding:32px 12px;">
    <tr>
        <td align="center">

            <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;font-family:Arial,Helvetica,sans-serif;border-radius:16px;overflow:hidden;background-color:#ffffff;">

                {{-- ================= CONTENT ================= --}}
                <tr>
                    <td style="padding:36px 36px 8px 36px;">
                        @yield('content')
                    </td>
                </tr>

                {{-- ================= FOOTER ================= --}}
                <tr>
                    <td style="padding:12px 36px 36px 36px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="border-top:1px solid #e5e7eb;padding-top:20px;text-align:center;">
                                    <div style="color:#102d5b;font-size:13px;font-weight:bold;">
                                        ISUFSTPASS VERIFIED
                                    </div>
                                    <div style="color:#9ca3af;font-size:11px;margin-top:3px;">
                                        Secure &bull; Reliable &bull; Official
                                    </div>
                                    <div style="color:#9ca3af;font-size:11px;margin-top:10px;line-height:1.6;">
                                        This is an automated message from the ISUFSTPASS system.<br>
                                        Please do not reply directly to this email.
                                    </div>
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
