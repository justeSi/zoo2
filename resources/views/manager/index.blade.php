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
          <div class="p-3 border-bottom d-flex justify-content-between">
            <div>
              <h3>Manager: {{ $manager->name }} {{ $manager->surname }} </h3>
              <h4>Specie: {{ $manager->managergetSpecie->name }}</h4>
            </div>
            <form method="POST" action="{{ route('manager.destroy', [$manager]) }}">
              @csrf
              <div class="button-group">
                <a class="btn btn-secondary" href="{{ route('manager.edit', [$manager]) }}">EDIT</a>
                <button class="btn btn-secondary" type="submit">DELETE</button>
              </div>
          </div>
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