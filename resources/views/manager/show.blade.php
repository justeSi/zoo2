@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <h4 class="text-center">{{ $manager->name }} {{ $manager->surname }} </h4>
                            <div>
                                <h5 class="text-center">Manager of {{ $manager->managerGetSpecie->name }}</h5>
                            </div>
                        </h3>
                    </div>
                    <div class="card-body inner-login-wrapper">
                        <div class="manager-container">
                            <h2 class="text-center"> Responsible for animals:</h2>
                            <div>
                                @foreach ($animals as $animal)
                                    <ul class="list-group">
                                        @if ($animal->animalGetSpecie->name === $manager->managerGetSpecie->name)

                                            <li class="list-group-item mb-1">
                                                <details>
                                                    <summary> <b>{{ $animal->name }}: </b> </summary>
                                                    <p>(
                                                        <i>{{ $animal->birth_year }} m.)
                                                            {!! $animal->animal_book !!}</i>
                                                    </p>
                                            </li>
                                            </details>
                                        @endif
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                        <div class="manager-container">
                            <div class="manager-container__about">
                                {!! $manager->mangerGetSpecies !!}
                            </div>
                        </div>
                        <a href="{{ route('manager.edit', [$manager]) }}" class="btn btn-dark m-2">Edit</a></a>
                        <a href="{{ route('manager.pdf', [$manager]) }}" class="btn btn-dark m-2">PDF</a></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title') {{ $manager->name }} @endsection
