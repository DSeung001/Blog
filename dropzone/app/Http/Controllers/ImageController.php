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
        $lists = $this->image->all();
        return view('image/index', compact("lists"));
    }

    public function create()
    {
        return view('image/create');
    }

    public function store(Request $request)
    {
        $files = $request->file('file');
        foreach ($files as $file) {
            $originName = $file->getClientOriginalName();
            $path = Storage::putFileAs(
                "uploads/" . date('y-m-d'),
                $file,
                substr(now()->timestamp, -4, null) . '_' . $originName
            );
            $this->image->create([
                'origin_name' => $originName,
                'path' => $path
            ]);
        }
        return response()->json(['success' => true]);
    }

    public function destroy(Request $request)
    {
        $filename = $request->get('filename');
        Image::where('filename', $filename)->delete();
        $path = public_path() . '/images/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
