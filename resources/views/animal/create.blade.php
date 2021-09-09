@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Add new Animal</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('animal.store') }}" method="post">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input class="form-control" type="text" name="animal_name">
                            <small class="form-text text-muted">Enter animals name.</small>
                            <label for="Birth">Year of Birth</label>
                            <input class="form-control" type="text" name="birth_year">
                            <small class="form-text text-muted">Enter animal birth date in YYYY format</small>
                            <label for="AnimalBook">Description</label>
                            <textarea class="form-control" id="summernote" type="text" name="animal_book"></textarea>
                            <div class="list-group">
                                <div class="list-group-item">
                                    <span>Species</span>
                                    <div style="justify-self: self-end;">
                                        <select style="width: 150px" class="select2" name="specie_id">
                                            @foreach ($species as $specie)
                                            <option value="{{ $specie->id }}">{{ $specie->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <span>Managers</span>
                                    <div style="justify-self: self-end;">
                                        <div class="form-group">
                                        <select style="width: 150px" class="select2" name="manager_id">
                                            @foreach ($managers as $manager)
                                            <option value="{{ $manager->id }}">{{ $manager->name }}
                                                {{ $manager->surname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-secondary" type="submit">Add</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script>
window.addEventListener('DOMContentLoaded', (event) => {
$('#summernote').summernote();
$('.select2').select2({
width: 'resolve'
});
});
</script> --}}
@endsection
@section('title')
Create an Animal
@endsection