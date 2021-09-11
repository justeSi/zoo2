@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of Species</div>

                <div class="card-body ">
                    <ul class="list-group">
                        @foreach ($species as $specie)
                        <li class="list-group-item">
                            <span style="align-self: center;">{{ $specie->name }}</span>
                            <div class="list-align-right">
                                <form class="btn-inline" action="{{ route('specie.destroy', $specie) }}" method="post">
                                    <a type="button" class="btn btn-secondary btn-sm"
                                        href="{{ route('specie.edit', $specie) }}">Edit</a>
                                    <button class="btn btn-secondary btn-sm" type="submit">Delete</button>
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                        @endforeach
                    <div class="mt-3 pagination-dark justify-content-center pagination-md  ">{{$species->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('title')
List of Species
@endsection