<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Radicados PDF</title>
    <style>
        @page { size: 3.3cm 5.8cm landscape;  }
        @font-face {
        font-family: 'Arimo';
        src: url({{ storage_path('fonts/Arimo.ttf') }}) format("truetype");
        font-weight: 400;
        font-style: normal; 
        }
        @font-face {
        font-family: 'Arimo Bold';
        src: url({{ storage_path('fonts/Arimo-Bold.ttf') }}) format("truetype");
        font-weight: 400;
        }
    </style>
    <style>
        * {
            margin:0;
            padding:0
        }

        html,body {
            height: 100%;
        }
        body {
            min-height: 100%;
            margin: 0;
            padding: 0;
        }
        
        .container-one {
            width: 25%;
            margin-left: 2.5%;
            margin-right: 2.5%;
            margin-top: 5%;
            height: 40%;
            display: inline-block;
            vertical-align: middle;
        }
        .container-two {
            width: 60%;
            height: 65%;
            margin-top: 5%;
            display: inline-block;
            vertical-align: top ;
        }

        .container-two .row-one {
            height: 34%;
        }
        .container-two .row-two {
            height: 22%;
            padding: 0;
        }

        .container-one img {
            width: 100%;
        }

        .container-two .row-one img {
            width: 100%;
        }

        .container-two .row-two .title-record {
            font-size: 65%;
            margin-top: 0;
            padding-top: 0;
            text-transform: uppercase;
            font-family: 'Arimo';
            margin-right: 7%;
            vertical-align: middle;
        }
        .container-two .row-two .title-record span {
            font-size: 80%;
            text-transform: uppercase;
            font-family: 'Arimo Bold';
            margin-left: 5%;
            display: inline-block;
            vertical-align: top;
            padding: 0;
            margin: 0;
        }

        .container-two .row-two .cite {
            font-size: 40%;
            font-family: 'Arimo';
            text-transform: uppercase;
            margin-left: 3%;
        }

        .container-two .row-two .date {
            font-size: 48%;
            font-family: 'Arimo Bold';
            margin-left: 3%;
        }

        .container-footer {
            width: 70%;
            height: 8%;
            margin: 0 auto;
            margin-top: 3%;
        }

        .container-footer p {
            font-size: 50%;
            text-transform: uppercase;
            font-family: 'Arimo';
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }
       
    </style>
</head>
<body>
    @if (count($records))
        @foreach ($records as $record)
            @if ($record['copy'] > 0)
                @for ($i = 0; $i < $record['copy']; $i++)
                    <div class="container-one">
                        <img src="{{public_path('img/QR.png')}}" alt="QR">
                    </div>
                    <div class="container-two">
                        <div class="row-one">
                        <img src="{{public_path('img/Sticker.png')}}" alt="logo">
                        </div>
                        <div class="row-two">
                        <p class="title-record">Radicado <span>{{$record['number']}}</span></p>
                        <p class="cite">(Citar en caso de respuesta)</p>
                        <p class="date">{{Carbon\Carbon::parse($record['created_at'])->format('d-m-Y H:i')}}</p>
                        </div>
                    </div>
                    <div class="container-footer">
                    <p>Correspondencia {{$record['type'] === 'Entrada' ? 'Recibida' : 'Enviada'}}</p>
                    </div>
                    <div class="{{$loop->last ? '' : 'page-break'}}"></div>
                @endfor
            @endif
            
        @endforeach
        @endif
</body>
</html>