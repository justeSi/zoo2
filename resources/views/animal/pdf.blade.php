<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($animal->name) }} {{ $animal->animalGetSpecie->name }}</title>
    <style>
        @font-face {
            font-family: 'Open Sans';
            src: url({{ asset('fonts/OpenSans-Regular.ttf') }});
            font-weight: normal;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ asset('fonts/OpenSans-Bold.ttf') }});
            font-weight: bold;
        }

        body {
            font-family: 'Open Sans';
        }

        h1 {
            text-align: center;
        }

        div {
            margin: 7px;
            padding: 7px;
        }

        .manager {
            font-size: 18px;
        }

        .about {
            font-size: 11px;
            color: gray;
        }

        .birth_year {
            margin: 12px;
            font-size: 25px;
            text-transform: uppercase;
        }

    </style>
</head>

<body>
    <h1> {{ $animal->name }}</h1>
    <div class="manager">Manager:
        {{ $animal->animalGetManager->name }} {{ $animal->animalGetManager->surname }}</div>
    <div class="birth_year">Born: {{ $animal->birth_year }}</div>
    <div class="specie">{{ $animal->animalGetSpecie->name }}</div>
    <div class="about">{!! $animal->animal_book !!}</div>
</body>

</html>
