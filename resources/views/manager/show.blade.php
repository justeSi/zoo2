@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            {{ $manager->name }} {{ $manager->surname }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="manager-container">
                            <div>
                                Specie - {{ $manager->managerGetSpecie->name }}
                            </div>
                            <div>
                                @foreach ($animals as $animal) 
                                <ul class="list-group">
                                    <li class="list-group-item mb-1"><b>{{$animal->name}}:  </b> ( <i>{{$animal->birth_year}} m.) {!!$animal->animal_book!!}</i></li>
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
                        {{-- <a href="{{ route('manager.pdf', [$manager]) }}" class="btn btn-info m-2">PDF</a></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title') {{ $manager->name }} @endsection
