@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Animal</h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('animal.update', [$animal]) }}">
                            <div class="form-group">
                                <label for="animal_name"> Name: </label>
                                <input type="text" class="form-control" name="animal_name"
                                    value="{{ old('animal_name', $animal->name) }}">
                                <small class="form-text text-muted">Enter animals name.</small>
                                <label for="animal_birth_year"> Birth year:</label>
                                <input type="text" class="form-control" name="animal_birth_year"
                                    value="{{ old('birth_year', $animal->birth_year) }}">
                                <small class="form-text text-muted">Enter animals birth year.</small>
                                <label for="animal_book"> Animal book: </label>
                                <textarea type="text" class="form-control" id="summernote"
                                    name="animal_book">{{ old('animal_book', $animal->animal_book) }}</textarea>
                                <small class="form-text text-muted">Enter info about animal.</small>
                            </div>


                            <div class="list-group ">
                                <div class="list-group-item ">
                                    <span>Species</span>
                                    <div style="justify-self: self-end;">
                                        <select style="width: 250px" class="select2" name="specie_id">
                                            @foreach ($species as $specie)
                                                <option value="{{ $specie->id }}" @if ($specie->id == $animal->specie_id)
                                                    selected
                                            @endif>{{ $specie->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="list-group-item ">
                                    <span>Managers</span>
                                    <div style="justify-self: self-end;">
                                        <select style="width: 250px" class="select2" name="manager_id">
                                            @foreach ($managers as $manager)
                                                <option value="{{ $manager->id }}" @if ($manager->id == $animal->manager_id)
                                                    selected
                                            @endif>{{ $manager->name }}
                                            {{ $manager->surname }} ---- {{ $manager->managerGetSpecie->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            @csrf
                            <button class="btn btn-secondary" type="submit">EDIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('title')
    Edit Animals
@endsection
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        $('#summernote').summernote();
        $('.select2').select2({
            width: 'resolve'
        });
    });
</script>
