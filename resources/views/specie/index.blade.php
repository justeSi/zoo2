@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">PAVADINIMAS</div>

                <div class="card-body">
                    @foreach ($species as $specie)
                    {{$specie->name}}
                    <a href="{{route('specie.edit',[$specie])}}" class="btn btn-outline-dark"> EDIT </a>
                    <form method="POST" action="{{route('specie.destroy', $specie)}}">
                        @csrf
                        <button type="submit">DELETE</button>
                    </form>
                    <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection