<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkAdmin', ['only' => ['index', 'addImage', 'addAlbumImage', 'store', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::get();
        return view('home', compact('images'));
    }

    public function album(){
        $albums = Album::with('images')->get();
        return view('welcome', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'album' => 'required|min:3|max:50',
            'image' => 'required'
        ]);
        // dd($request->all());
        $album = Album::create([
            'name' => request('album')
        ]);
        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $path = $image->store('uploads', 'public');
                Image::create([
                    'name' => $path,
                    'album_id' =>$album->id
                ]);
            }
        }
        return "<div class='alert alert-success'>Success</div>";
    }

    public function addImage(Request $request){
        $this->validate($request, [
            'album_id' => 'required',
            'image' => 'required'
        ]);
        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $path = $image->store('uploads', 'public');
                Image::create([
                    'name' => $path,
                    'album_id' =>$request->album_id
                ]);
            }
        }
        return redirect()->back()->with('message', "Success");
    }

    public function addAlbumImage(Request $request){
        $this->validate($request, [
            'album_id' => 'required',
            'image' => 'required'
        ]);

        if($request->hasFile('image')){
                $path = $request->image->store('uploads/new-files', 'public');
                Album::where('id', $request->album_id)->update([
                    'image' => $path,
                ]);
        }
        return redirect()->back()->with('message', "Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        $images = $album->images;
        return view('gallery', compact('images', 'album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        Storage::delete('public/'.$image->name);
        $image->delete();
        return redirect()->back()->with('message', 'Image Deleted Successfully');
    }
}
