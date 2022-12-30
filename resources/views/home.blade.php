@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="show"></div>
                <div id="error-msg"></div>
                <div class="card">
                    <div class="card-header">{{ __('Create album') }}</div>
                    <div class="card-body">
                        <form action="{{ route('album.store') }}" method="post" enctype="multipart/form-data" id="form">@csrf
                            <div class="form-group">
                                <input type="text" name="album" id="album" class="form-control" placeholder="Name your album">
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
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

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

<script>
    $(document).ready(function(){
        $('#form').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url:"/album",
                type:"POST",
                // data:new FormData(this),
                data:new FormData($('#form')[0]),
                contentType:false,
                processData:false,
                success:function(response){
                    $('.show').html(response);
                    $('#error-msg').empty();
                    $('#form')[0].reset(); 
                },
                error:function(res){
                    var error = res.responseJSON;
                    $('#error-msg').empty();
                    $.each(error.errors, function(key, value){
                        $('#error-msg').append('<p class="text-center text-danger">'+value+'</p>');
                    })
                }
            });
        });
    })
</script>
<style>
</style>