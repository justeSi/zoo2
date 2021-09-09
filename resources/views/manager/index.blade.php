@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h2>List of Managers</h2>
        </div>

        <div class="card-body">
          @foreach ($managers as $manager)
          <h1>Manager: {{$manager->name}} {{$manager->surname}} </h1>
          <h4>Specie: {{$manager->managergetSpecie->name}}</h4>
          <form method="POST" action="{{route('manager.destroy', [$manager])}}">
            @csrf
            <a class="btn btn-secondary" href="{{route('manager.edit',[$manager])}}">Edit</a>
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
List of Managers
@endsection