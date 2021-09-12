@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>List of Animals</h2>
                    </div>

                    <div class="card-body">
                        @foreach ($animals as $animal)
                            <div class="p-3 border-bottom d-flex justify-content-between">
                                <div>
                                    <h3> {{ $animal->name }}</h3>
                                    <h4>Specie: {{ $animal->animalGetSpecie->name }}</h4>
                                    <h5>Manager: {{ $animal->animalGetManager->name }}
                                        {{ $animal->animalGetManager->surname }}
                                    </h5>
                                </div>
                                <form method="POST" action="{{ route('animal.destroy', [$animal]) }}">
                                    @csrf
                                    <div class="button-group">
                                        <a class="btn btn-sm btn-secondary"
                                            href="{{ route('animal.show', [$animal]) }}">VIEW</a>
                                        <a class="btn btn-sm btn-secondary"
                                            href="{{ route('animal.edit', [$animal]) }}">EDIT</a>
                                        <button class="btn btn-sm btn-secondary" type="submit">DELETE</button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                        <div class="mt-3 pagination-dark justify-content-center pagination-md d-flex flex-sm-wrap">
                            {{ $animals->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('title')
    List of Animals
@endsection
