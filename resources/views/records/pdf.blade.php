<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Radicados PDF</title>
    <style>
        body{
            margin-top: 40px;
            margin-left: 80px;
            margin-right: 80px;
        }

        ul {
            list-style: none;
            margin: 0 auto;
            display: block;
            width: 10cm;
            padding: 0;
        }

        ul>li {
            border:1px solid black;
            width: 5.7cm;
            height: 3.2cm;
            margin: 20px auto;

        }

       ul li  .info {
           display: inline-block;
           width: 100%;
           margin-top: 10px auto;
       }
       ul li .info img {
           width: 100px;
           float: left;
           padding-left: 5px;
           display: block;
       }
       ul li .info .record {
            width: 100;
            text-align: center;
            padding-top: 2px;
       }
       ul li .info .record span{
            text-align: center;
            padding-top: 2px;
            display: block;
            font-size: 13px;
       }

       ul li .info .record .cite {
           font-size: 10px;
       }

       .page-break {
            page-break-after: always;  
        }
      
    </style>
</head>
<body>
  <ul>
    @foreach ($records as $record)
            @if ($record['copy'] > 0)
                  @for ($i = 0; $i < $record['copy']; $i++,$counter++)
                  @if ($counter > 4)
                      <div class="page-break"></div>
                      @php
                        $counter = 0;    
                      @endphp
                  @endif
                  <li>
                    <div class="info">
                            <img src="{{public_path('img/Sticker.png')}}">
                            <p class="record">
                                <span>Radicado:</span>
                                {{$record['number']}}
                                <span class="cite">(Citar en caso de respuesta)</span>
                            <span class="cite">{{$record['datetime']}}</span>
                            <span class="cite">Correspondencia {{$record['type'] === 'Entrada' ? 'Recibida' : 'Enviada'}}</span>
                            </p>
                    </div>
                    </li>
                  @endfor 
            @endif
    @endforeach
  </ul>
    
</body>
</html>