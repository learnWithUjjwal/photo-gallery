@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Add Image -->
            @include('fractions')
            <!-- /Add Image -->
            @foreach ($images as $image)
                <div class="col-sm-4">
                    <div class="item">
                        <img src="{{ asset('storage/' . $image->name) }}" class="img-thumbnail">
                        </a>
                    </div>

                    <!-- Button trigger modal -->
                    @if(Auth::check() && Auth::user()->user_type == 'admin')

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal{{ $image->id }}">
                        Delete
                    </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $image->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Do you want to delete?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('image.delete', $image->id) }}" method="POST">@csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Modal -->

                </div>
            @endforeach
        </div>
    </div>
@endsection


