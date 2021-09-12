@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>List of Managers</h2>
                    </div>

                    <div class="card-body">
                        @foreach ($managers as $manager)
                            <div class="p-3 border-bottom d-flex justify-content-between">
                                <div>
                                    <h3>{{ $manager->name }} {{ $manager->surname }} </h3>
                                    <h4>Specie: {{ $manager->managerGetSpecie->name }}</h4>
                                    @if ($manager->managerGetAnimals->count() > 0)
                                        Animals count of this specie: {{ $manager->managerGetAnimals->count() }}
                                    @else
                                        No animals for this specie
                                    @endif

                                </div>
                                <form method="POST" action="{{ route('manager.destroy', [$manager]) }}">
                                    @csrf
                                    <div class="button-group ">
                                        <a class="btn btn-secondary btn-sm mt-2"
                                            href="{{ route('manager.show', [$manager]) }}">VIEW</a>
                                        <a class="btn btn-secondary btn-sm  mt-2"
                                            href="{{ route('manager.edit', [$manager]) }}">EDIT</a>
                                        <button class="btn btn-secondary btn-sm  mt-2" type="submit">DELETE</button>
                                    </div>
                            </div>
                            </form>
                        @endforeach
                        <div class="mt-3 pagination-dark justify-content-center pagination-md  ">{{ $managers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('title')
    List of Managers
@endsection
