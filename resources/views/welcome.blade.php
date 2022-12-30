@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @foreach ($albums as $album)
                <div class="col-sm-4">
                    <div class="item">
                        <a href="albums/{{ $album->id }}">
                            @if (!empty($album->image))
                                <img src="{{ asset('storage/'.$album->image) }}" class="img-thumbnail">
                            @else
                                <img src="{{ asset('images/1.png') }}" class="img-thumbnail">
                            @endif
                            <a href="albums/{{ $album->id }}" class="center">{{ $album->name }}</a>
                        </a>

                    </div>
                    @if(Auth::check() && Auth::user()->user_type == 'admin')
                    <!-- Button trigger modal --><br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $album->id }}">
                        Add Album Image
                    </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $album->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Album Image</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{route('album.image.store')}}" method="post" enctype="multipart/form-data">@csrf
                                <div class="modal-body">
                                        <input type="hidden" name="album_id" value="{{ $album->id }}">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Add Album Image</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    .item {
        left: 0;
        top: 0;
        position: relative;
        overflow: hidden;
        margin-top: 50px;
    }

    .item img {
        -webkit-transition: 0.6s ease;
        transition: 0.6s ease;
    }

    .item img:hover {
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
    }

    .center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 24px;
    }

    .img-thumbnail {
        border: 0px;
        border-radius: 0px;
    }
</style>
