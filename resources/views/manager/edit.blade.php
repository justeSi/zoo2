@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Manager</h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('manager.update', [$manager]) }}">
                            <div class="form-group">
                                <label for="manager_name">name: </label>
                                <input class="form-control" type="text" name="manager_name"
                                    value="{{ old('manager_name', $manager->name) }}">
                                <small class="form-text text-muted">Eddit animals name.</small>
                                <label for="manager_surname">surname: </label>
                                <input class="form-control" type="text" name="manager_surname"
                                    value="{{ old('manager_surname', $manager->surname) }}">
                                <small class="form-text text-muted">Enter animals name.</small>
                            </div>

                            <div class="list-group ">
                                <div class="list-group-item ">
                                    <span>Species</span>
                                    <div style="justify-self: self-end;">
                                        <select style="width: 150px" class="select2" name="specie_id">
                                            @foreach ($species as $specie)
                                                <option value="{{ $specie->id }}" @if ($specie->id == $manager->specie_id)
                                                    selected
                                            @endif>{{ $specie->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @csrf
                        </form>
                    </div>
                    <button class="btn btn-secondary mt-3" type="submit">EDIT</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('title')
    Edit Manager
@endsection
