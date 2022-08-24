<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function index()
    {
        $lists = $this->image->paginate(10);
        return view('image/index', compact("lists"));
    }

    public function create()
    {
        return view('image/create');
    }

    public function store(Request $request)
    {
        $files = $request->file('file');
        $originNames = $request->input('origin_name');

        foreach ($files as $key => $file) {
            $path = Storage::putFileAs(
                "uploads/" . date('y-m-d'),
                $file,
                $file->getClientOriginalName()
            );
            $this->image->create([
                'origin_name' => $originNames[$key],
                'path' => $path
            ]);
        }
        return response()->json(['success' => true]);
    }


    public function destroy(Image $image, Request $request)
    {
        $image->delete();
        Storage::delete($image->path);
        $page = $request->input("page", 1);
        return redirect()->route('image.index', ["page" => $page]);
    }

    public function ajaxDestroy(Request $request)
    {
        $image = $this->image->where("path", "like", "%".$request["file_name"])->first();
        if($image != null){
            Storage::delete($image->path);
            $image->delete();
        }
        return response()->json(['success' => true]);
    }
}
