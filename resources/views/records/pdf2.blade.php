<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Radicados PDF</title>
    <style>
        @page { size: 3.2cm 5.7cm landscape; }
    </style>
    <style>
       html,body{
            height:97%;
            width:97%;
            margin:0;
            padding:0;
        }

        .container {
            width: 95%;
            text-align: center;
        }

        .container img {
            width: 40%;
            padding-top: 10px;
            display: block;
        }

        .container .title-record {
            width: 30%;
            padding: 0;
            margin: 0 auto;
            font-size: 80%;
            text-align: center;
        }

        .container .record-number {
            width: 40%;
            padding: 0;
            margin: 0 auto;
            font-size: 90%;
            text-align: center;
        }
        .container .cite {
            width: 80%;
            padding: 0;
            margin: 0 auto;
            font-size: 60%;
            text-align: center;
        }

        .container .footer-message {
            width: 80%;
            text-transform: uppercase;
            margin: 0 auto;
            padding-top: 1%;
            font-size: 45%;
            text-align: center;
        }

        .page-break {
            page-break-after: always;
            margin:0;
            padding:0;
        }
       
    </style>
</head>
<body>
   @if (count($records))
        @foreach ($records as $record)
            @if ($record['copy'] > 0)
                @for ($i = 0; $i < $record['copy']; $i++)
                <div class="container">
                    <img src="{{public_path('img/Sticker.png')}}">
                    <p class="title-record">Radicado:</p>
                    <p class="record-number">{{$record['number']}}</p>
                    <p class="cite">(Citar en caso de respuesta)</p>
                    <p class="cite">{{$record['datetime']}}</p>
                    <p class="footer-message">Correspondencia {{$record['type'] === 'Entrada' ? 'Recibida' : 'Enviada'}}</p>
                </div>
                <div class="page-break"></div>
                @endfor
            @endif
        @endforeach
   @endif
    
</body>
</html>