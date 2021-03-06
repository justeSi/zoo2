@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List of Species</div>

                    <div class="card-body column inner-login-wrapper">
                        @foreach ($species as $specie)
                            <span style="align-self: center;" class="m-3 ">{{ $specie->name }}</span>
                            <div class="p-3 border-bottom">
                                <form class="btn-inline" action="{{ route('specie.destroy', $specie) }}" method="post">
                                    <a type="button" class="btn btn-dark btn-sm"
                                        href="{{ route('specie.edit', $specie) }}">Edit</a>
                                    <button class="btn btn-danger btn-sm" type="submit"><i
                                            class="fas fa-trash-alt"></i></button>
                                    @csrf
                                </form>
                            </div>
                        @endforeach
                        {{-- <div class="mt-3 pagination-dark justify-content-center pagination-md  ">{{$species->links()}}</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('title')
    List of Species
@endsection
