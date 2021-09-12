@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <h3 class="text-center">{{ $animal->name }} </h3>
                            <div>
                                <h5 class="text-center">Spiece: {{ $animal->animalGetSpecie->name }}</h5>
                            </div>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="animal-container">

                            <i>{{ $animal->birth_year }} m.
                                <blockquote>{!! $animal->animal_book !!}
                            </i></blockquote>

                            <div>
                                @foreach ($managers as $manager)
                                    @if ($animal->animalGetSpecie->name === $manager->managerGetSpecie->name)

                                        <b>Manager: {{ $manager->name }} {{ $manager->surname }} </b>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <a href="{{ route('animal.edit', [$animal]) }}" class="btn btn-dark m-2">Edit</a>
                        <a href="{{ route('animal.pdf', [$animal]) }}" class="btn btn-dark m-2">PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title') {{ $animal->name }} @endsection
