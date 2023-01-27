<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        @media (max-width: 600px) {
            div {
                padding-left: 35px !important;
                padding-right: 35px !important;
            }
        }
    </style>
</head>


<body style="width: 100%; background-color:#181624;">
    <div style="color: white; padding: 80px 194px;">
        <img style="display: block; margin-left: auto; margin-right: auto;"
            src="{{ $message->embed(public_path() . '/images/quote.png') }}" alt='quote' />
        <p style="text-align: center; font-size: 12px; color:#DDCCAA; font-family: sans-serif">MOVIE QUOTES</p>

        <p style="margin-bottom: 39px; font-family: sans-serif">Please click th
            button
            below to reset your password:</p>
        <a style="background-color: #E31221; padding: 7px 13px; border-radius: 4px; color:white; text-decoration:none; font-family: sans-serif"
            href="{{ env('APP_FRONTEND_URL') }}/password-reset?token={{ $token }}">Reset
        </a>

        <p style='margin-bottom: 24px; margin-top:24px; font-family: sans-serif;'>If you have any problems, please
            contact us:
            support@moviequotes.ge</p>
        <p style="font-family: sans-serif">MovieQuotes Crew</p>
    </div>
</body>

</html>
