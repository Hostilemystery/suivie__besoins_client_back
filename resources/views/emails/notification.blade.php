{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            background-color: rgb(89, 150, 190);
        }
    </style>
</head>
<body>
    <div>

    </div>
    <h1 style="font-size:18px;color:aliceblue;text-align:center">{{ $data['subject'] }}</h1>
    <p>{{ $data['message'] }}</p>
</body>
</html> --}}


@component('mail::message')
<h1 style="text-align:center;font-size:xx-large">{{ $data['subject'] }}</h1>


@component('mail::panel')
{{ $data['message'] }}
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
