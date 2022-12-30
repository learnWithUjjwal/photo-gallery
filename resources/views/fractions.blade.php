<h1>{{ $album->name }} ({{ count($images) }}) 
    @if(Auth::check() && Auth::user()->user_type == 'admin')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        Add Image
    </button>
    @endif
</h1>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $album->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="album_id" class="form-control" value="{{ $album->id }}">
                    </div><br>
                    <div class="input-group control-group initial-add-more">
                        <input type="file" name="image[]" class="form-control" id="image">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-success btn-add-more">Add</button>
                        </div>
                    </div>
                    <div class="copy" style="display: none">
                        <div class="input-group control-group add-more" style="margin-top: 12px">
                            <input type="file" name="image[]" class="form-control" id="image">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-danger remove">Remove</button>
                            </div>
                        </div>
                    </div><br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

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
        border: 2px sloid red;
        border-radius: 0px;
    }
</style>

<script>
    $(document).ready(function(E) {
        $('.btn-add-more').click(function() {
            var html = $('.copy').html();
            console.log(html);
            $('.initial-add-more').after(html);
        })

        $("body").on('click', '.remove', function() {
            $(this).parents(".control-group").remove();
        })
    });
</script>
