@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h2>List of Animals</h2>
        </div>

        <div class="card-body">
          @foreach ($animals as $animal)
          <h1>Name: {{$animal->name}}</h1>
          <h3>Specie: {{$animal->animalGetSpecie->name}}</h3>
          <h5>Manager: {{$animal->animalGetManager->name}} {{$animal->animalGetManager->surname}} </h5>
          <form method="POST" action="{{route('animal.destroy', [$animal])}}">
            @csrf
            <a class="btn btn-secondary" href="{{route('animal.edit',[$animal])}}">Edit</a>
            <button class="btn btn-secondary" type="submit">DELETE</button>
          </form>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('title')
List of Animals 
@endsection