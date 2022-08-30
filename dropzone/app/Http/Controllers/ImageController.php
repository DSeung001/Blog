<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    // ioc
    private $image;

    public function __construct(Image $image)
    {
        // ioc
        $this->image = $image;
    }

    public function index()
    {
        $lists = $this->image->orderBy('created_at','desc')->paginate(10);
        return view('image/index', compact("lists"));
    }

    public function create()
    {
        return view('image/create');
    }

    public function store(Request $request)
    {
        // 업로드한 파일
        $files = $request->file('file');
        // dropzone sending 이벤트에서 추가하 원래 파일의 이름들
        $originNames = $request->input('origin_name');

        foreach ($files as $key => $file) {
            /*
             * Storage::putFileAs은 storage/app을 의미합니다, 그렇기에 결과적으로 저장되는 경로는 아래와 같습니다.
             * storage/app/uploads/22-08-29/1661757373818_git cat.png
             * $file->getClientOriginalName은 dropzone에서 renameFile로 바꾼 이름입니다.
             */
            $path = Storage::putFileAs(
                "uploads/" . date('y-m-d'), $file, $file->getClientOriginalName()
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
        // 실제 이미지 삭제
        Storage::delete($image->path);
        return redirect()->route('image.index');
    }

    public function ajaxDestroy(Request $request)
    {
        $image = $this->image->where("path", "like", "%".$request["file_name"])->first();
        /*
         * 업로드 된 데이터라면 여기서 데이터를 가져옵니다.
         * 그것은 이미지가 업로드 되었다는 의미로 이미지도 같이 삭제해줍니다.
         */
        if($image != null){
            Storage::delete($image->path);
            $image->delete();
        }
        return response()->json(['success' => true]);
    }
}
