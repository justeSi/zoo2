@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Change animal specie</h2>
                </div>

                <div class="card-body">
                    <form action="{{route('specie.update', $specie)}}" method="post">
                        <div class="form-group">
                            <label for="Name">Type of specie</label>
                            <input value="{{$specie->name}}" type="text" name="specie_name" class="form-control">
                            <small class="form-text text-muted">Edit information.</small>
                        </div>
                        <button class="btn btn-secondary" type="submit">Save changes</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('title')
Edit Specie
@endsection