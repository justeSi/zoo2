<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($manager->name) }} {{ ucfirst($manager->surname) }}</title>
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
    <h1>{{ $manager->name }} {{ $manager->surname }}</h1>
    <h2>{{ $manager->managerGetSpecie->name }}</h2>
    @foreach ($animals as $animal)
                                    <ul class="list-group">
                                        @if ( $animal->animalGetSpecie->name  ===  $manager->managerGetSpecie->name )
                                            
                                        <li class="list-group-item mb-1"><b>{{ $animal->name }}: </b>  {{ $animal->animalGetSpecie->name }} (
                                            <i>{{ $animal->birth_year }} m.) 
                                                {!! $animal->animal_book !!}</i></li>
                                        @endif
                                    </ul>
                                @endforeach
                                    

</body>

</html>
