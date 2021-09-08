@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">PAVADINIMAS</div>

        <div class="card-body">
          @foreach ($animals as $animal)
          <h1>{{$animal->name}}</h1>
          <h3>{{$animal->animalGetSpecie->name}}</h3> {{$animal->animalGetManager->name}}
          {{$animal->animalGetManager->surname}}
          <a href="{{route('animal.edit',[$animal])}}">Edit</a>
          <form method="POST" action="{{route('animal.destroy', [$animal])}}">
            @csrf
            <button type="submit">DELETE</button>
          </form>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection