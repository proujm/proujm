<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    public function index()
    {
        return view('admin/news')
            ->with('news', News::NewsPaginate(10));
    }

    public function create()
    {
        return view('admin/newsCreate');
    }

    public function store(Request $request, News $news)
    {
        $submit = $request->input("submitAdd");
        if(isset($submit)) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'video' => 'max:2500',
                'note' => 'max:25000'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            if($request->input('title')){
                $news->title = $request->input('title');
            }
            if($request->input('video')){
                $news->video = $request->input('video');
            }
            if($request->input('note')){
                $news->note = $request->input('note');
            }
            $news->user_id = Auth()->user()->id;

            $file = $request->file('img');//загруженная картинка
            if ($file) {
                $fileName = date_create('now')->format('YmdHis') . '__' . $file->getClientOriginalName();
                $news->image = $fileName;
                if(strpos($fileName,'.gif') !== false){//если это гифка не меняем ее размер(стает просто картинкой)
                    $file->move('images/carusel/', $fileName);
                }else{//остальные все изображения меняем размер
                    Image::make($file)->resize(1024, 768, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save('../public/images/news/' .$fileName);
                }
            }

            $news->save();
        }
        return redirect(route('news.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('admin/newsEdit')
            ->with('item', News::find($id));
    }

    public function update(Request $request, $id)
    {
        $submit = $request->input("submitSave");
        if(isset($submit)) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'video' => 'max:2500',
                'note' => 'max:25000'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            $item = News::find($id);
            $item->title = $request->input('title');
            if($request->input('video')){
                $item->video = $request->input('video');
            } else{
                $item->video = '';
            }
            if($request->input('note')){
                $item->note = $request->input('note');
            } else{
                $item->note = '';
            }
            $item->user_id = Auth()->user()->id;
            $this->deleteImage($request, $item);

            $file = $request->file('img');//загруженная картинка
            if ($file) {
                if($item->image){
                    Storage::delete('images/news/' . $item->image);
                }
                $fileName = date_create('now')->format('YmdHis') . '__' . $file->getClientOriginalName();
                $item->image = $fileName;
                if(strpos($fileName,'.gif') !== false){//если это гифка не меняем ее размер(стает просто картинкой)
                    $file->move('images/news/', $fileName);
                }else{//остальные все изображения меняем размер
                    Image::make($file)->resize(1024, 768, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save('../public/images/news/' .$fileName);
                }
            }

            $item->save();
        }
        return redirect(route('news.index'));
    }

    public function destroy($id)
    {
        $item = News::find($id);
        News::deleteImage($item);
        $item->delete();
        return redirect()->back();
    }

    // получение ID видео из URL
    private function getYoutubeVideoID($url){
        // допустимые доменые имена в ссылке
        $names = array('www.youtube.com','youtube.com');
        // разбор адреса
        $up = parse_url($url);
        // проверка параметров
        if (isset($up['host']) && in_array($up['host'],$names) &&
            isset($up['query']) && strpos($up['query'],'v=') !== false){
            // достаем параметр ID
            $lp = explode('v=',$url);
            // отсекаем лишние параметры
            $rp = explode('&',$lp[1]);
            // возвращаем строку, либо false
            return (!empty ($rp[0]) ? $rp[0] : false);
        }
        return false;
    }
    //проверяет удаляет картинки из бд и с сервера
    private function deleteImage($request, $item){
        $dbFilesStr = $request->input('dbImg');//картинка
        if(!$dbFilesStr && $item->image){//если строка картинок с сайта пустая
            Storage::delete('images/news/' . $item->image);//значит картинка была удалена
            $item->image = '';
        }
    }
}
