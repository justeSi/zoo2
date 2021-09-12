@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Create Manager</h2>
                    </div>

                    <div class="card-body inner-login-wrapper">
                        <form method="POST" action="{{ route('manager.store') }}">
                            <div class="form-group">
                                <label for="manager_name">name: </label>
                                <input class="form-control" type="text" name="manager_name">
                                <small class="form-text text-muted">Eddit animals name.</small>
                                <label for="manager_surname">surname: </label>
                                <input class="form-control" type="text" name="manager_surname">
                                <small class="form-text text-muted">Enter animals name.</small>
                            </div>
                            <div class="list-group ">
                                <div class="list-group-item ">
                                    <span>Species</span>
                                    <div style="justify-self: self-end;">
                                        <select style="width: 150px" class="select2" name="specie_id">
                                            @foreach ($species as $specie)
                                                <option value="{{ $specie->id }}">{{ $specie->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Select manager name.</small>
                                    </div>
                                    @csrf
                                    <button class="btn btn-dark" type="submit">ADD</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('title')
    Create MAnager
@endsection
