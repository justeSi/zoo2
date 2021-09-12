@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Add animal specie</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('specie.store') }}" method="post">
                            <div class="form-group">
                                <label>Type of species</label>
                                <input type="text" class="form-control" name="specie_name"
                                    value="{{ old('specie_name') }}">
                                <small class="form-text text-muted">Enter the type of specie you want to add.</small>
                            </div>
                            <button class="btn btn-secondary" type="submit">Add</button>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('title')
    Add new Specie
@endsection
