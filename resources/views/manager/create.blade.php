@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">PAVADINIMAS</div>

                <div class="card-body">
                    <form method="POST" action="{{route('manager.store')}}">
                        name: <input type="text" name="manager_name">
                        surname: <input type="text" name="manager_surname">
                        <select name="specie_id">
                            @foreach ($species as $specie)
                            <option value="{{$specie->id}}">{{$specie->name}} {{$specie->surname}}</option>
                            @endforeach
                        </select>
                        @csrf
                        <button type="submit">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection