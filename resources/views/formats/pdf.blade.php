<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Radicados PDF</title>
    <style>
        @page { size: 21.59cm 27.94cm landscape; }

       .format {
           width: 100%;
           border-collapse: collapse;
           margin-top: 0;
       }

       .format thead th {
            height: 50px;
            border: 1px solid black;
            text-align: center;
            padding-left: 3px;         
       }

       .format tbody td {
           border: 1px solid black;
           height: 35px;
           padding-left: 3px;   
           text-align: center;
       }

       .table-header {
           width: 100%;
           border-top: 1px solid black;
           border-left: 1px solid black;
           border-right: 1px solid black;
           padding-bottom: 0;
           border-spacing: 0;
       }

       .table-header tbody tr {
           padding: 0;
       }
       .table-header tbody td {
           border-right: 1px solid black;
           padding-bottom: 0;
       }
       .table-header tbody td:last-child {
           border-right: none;
           padding-bottom: 0;
       }
       .table-header img {
           width: 150px;
       }
       .table-header h2 {
           text-align: center;
           font-weight: 500;
           margin-bottom: 0;
           padding-bottom: 10px;
       }

       .table-header tbody td .empty-item {
           height: 16px;
       }

       .table-header tbody td .text-item,
       .table-header tbody td .empty-item {
           margin: 0;
           text-transform: uppercase;
           font-size: 14px;
       }
       .table-header tbody td .text-item:first-child,
       .table-header tbody td .empty-item:first-child
        {
          border-bottom: 1px solid black;
       }
       .table-header tbody td .text-item:last-child,
       .table-header tbody td .empty-item:last-child
        {
          border-top: 1px solid black;
       }

       .page-break {
            page-break-after: always;  
        }
      
    </style>
</head>
<body>
    <table class="table-header">
        <tbody>
            <tr>
                <td style="width:21%">
                <img src="{{asset('img/logo.png') }}" alt="Logo empresa">

                </td>
                <td style="width:49%">
                    <h2>Planilla de correspondencia {{$company->name}}</h2>
                </td>
                <td style="width: 16%">
                    <p class="text-item">Página</p>
                    <p class="text-item">Código</p>
                    <p class="text-item">Fecha</p>
                </td>
                <td style="width: 14%">
                    <p class="empty-item"> </p>
                    <p class="empty-item"> </p>
                    <p class="empty-item"> </p>
                </td>
            </tr>
        </tbody>
    </table>
   <table class="format">
       <thead>
           <tr>
               <th style="width:3%">Nro.</th>
               <th style="width:8%">Fecha</th>
               <th style="width:9%">Registro</th>
               <th style="width:20%">Remitente</th>
               <th style="width:20%">Descripción</th>
               <th style="width:25%">Destinatario</th>
               <th>Firma</th>
           </tr>
       </thead>
       <tbody>
            @forelse ($records as $record)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$record->format_datetime}}</td>
                    <td>{{$record->number}}</td>
                    <td>{{$record->thirdParty->name}}</td>
                    <td>{{$record->description}}</td>
                    <td>{{$record->employee->fullname}}</td>
                    <td></td>
                </tr>
            @empty
                <p>No existen registros</p>
            @endforelse
  
       </tbody>
   </table>
    
</body>
</html>