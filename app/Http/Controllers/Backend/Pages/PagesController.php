<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Pages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;

class PagesController extends Controller
{
    public function getPages(){
        $pages = Pages::all();
        return view('backend.pages.pages')->with('pages',$pages);
    }

    public function getPagesAdd(){
        return view('backend.pages.page-add');
    }

    public function getPagesEdit($pageId){
        $pages = Pages::where('id',$pageId)->first();
        return view('backend.pages.page-edit')->with('pages',$pages);
    }

    public function postPages(Request $request){

        if(isset($request->delete)){
            try {
                $pages =  Pages::where('id',$request->id)->first();
                File::delete(public_path($pages->page_image));
                Pages::where('id', $request->id)->delete();
                if (isset($request->page_image)){
                    File::delete(public_path($request->page_image));
                }
                return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Sayfa Silindi']);
            } catch (\Exception $e) {
                return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Sayfa Silinemedi']);
            }
        }

        elseif(isset($request->page_status)){
            try {
                Pages::where('id', $request->id)->update($request->all());
                return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Sayfa Durumu Değiştirildi']);
            } catch (\Exception $e) {
                return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'Sayfa Durumu Değiştirilemedi']);
            }
        }
    }

    public function postPagesAdd(Request $request){
        try {
            $date = Str::slug(Carbon::now());
            $imageName = Str::slug($request->page_name) . '-' . $date;
            Image::make($request->file('image'))->save(public_path('/uploads/pages/') . $imageName . '.jpg')->encode('jpg','50');
            $request->merge(['page_image' => '/uploads/pages/'.$imageName.'.jpg']);
            $request->merge(['page_status' => $request->page_status == 'on' ? 'on' : 'off']);
            Pages::create($request->all());
            return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Sayfa Eklendi']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'Sayfa Eklenemedi']);
        }
    }

    public function postPagesEdit(Request $request, $pageId){
        try {
            $pages =  Pages::where('id',$pageId)->first();
            if ($request->hasFile('page_image')){
                File::delete(public_path($pages->page_image));
                $date = Str::slug(Carbon::now());
                $imageName = Str::slug($request->page_name) . '-' . $date;
                Image::make($request->file('page_image'))->save(public_path('/uploads/pages/') . $imageName . '.jpg')->encode('jpg','50');
            }

            Pages::where('id',$pageId)->update([
                'page_name' => $request->page_name,
                'page_description'=> $request->page_description,
                'page_tags'=> $request->page_tags,
                'page_content'=> $request->page_content,
                'page_image'=> $request->hasFile('page_image') ? '/uploads/pages/' . $imageName . '.jpg' : $pages->page_image,
                'page_status'=> $request->page_status == 'on' ? 'on' : 'off',
            ]);

            return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Sayfa Güncellendi ']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'Sayfa Güncellenemedi']);
        }
    }
}
