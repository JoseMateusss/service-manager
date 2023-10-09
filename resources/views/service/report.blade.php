<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $service->title }}</title>
    <style>
        .container {
            display: table;
            width: 80%;
            margin-left: 15%;
            margin-right: 15%;
        }
        .personal-data, .plan-data {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .plan-data{
            text-align: ;
        }
        h2, h3{
            text-align: center;
        }
    </style>
</head>
<body>
<div class="image" style="text-align: center;">
    <h1>{{ $service->title }}</h1>
</div>

<div class="container">
    <div class="personal-data">
        <p><b>Solicitante:</b> {{ $service->user->name }}</p>
        <p><b>Protocolo:</b> {{ $service->protocol }}</p>
        <p><b>Data de criação:</b> {{ date('d/m/Y', strtotime($service->created_at)) }}</p>
    </div>
    <div class="plan-data">
        <p><b>Data de conclusão:</b> {{ date('d/m/Y', strtotime($service->completion_date)) }}</p>
        <p><b>Última atualização:</b> {{ $service->created_at->format('d/m/y h:i:s') }}</p>
    </div>
</div>
<hr>
<div class="container">
    <p><b>Descrição:</b> {{ $service->description }}</p>
</div>
</body>
</html>
