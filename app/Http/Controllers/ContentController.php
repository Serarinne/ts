<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller{
    public function ContentEditor(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        if ($request->session()->has('session')) {
            $UserData = $ConnectDB->table("users")->where("session", "=", $request->session()->get('session'))->first();

            if(empty($UserData)){
                $request->session()->forget('session');
                $request->session()->flush();
              	$UserData = null;
            }
        }else{
          	$UserData = null;
        }

        if ($request->session()->has('session')) {
            $UserData = $ConnectDB->table("users")->where("session", "=", $request->session()->get('session'))->first();
          
          	if(empty($UserData)){
              	$request->session()->forget('session');
            	$request->session()->flush();
                $UserData = null;
            }
        }else{
            $UserData = null;
        }

        return response()->view("Content/ContentEditor", 
        [
            "UserData" => $UserData, 
            "ServerDomain" => $serverDomain
        ]);
    }

    public function ContentProccess(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        if ($request->session()->has('session')) {
            $UserData = $ConnectDB->table("users")->where("session", "=", $request->session()->get('session'))->first();

            if(empty($UserData)){
                $request->session()->forget('session');
                $request->session()->flush();
              	$UserData = null;
            }
        }else{
          	$UserData = null;
        }

        if ($request->session()->has('session')) {
            $UserData = $ConnectDB->table("users")->where("session", "=", $request->session()->get('session'))->first();
            
            $PostId = $ConnectDB->table('posts')->insertGetId([
                'thumbnail' => $request->image,
                'title' => $request->title,
                'content' => $request->content,
                'tag' => str_replace(",", "#", $request->tag),
                'keyword' => $request->keyword,
                'description' => $request->description,
                'author' => $UserData->id
            ]);

            if($request->hasFile('image')) {
                if($request->file('image')->getSize() > 2400000){
                    return redirect()->back()->with('errmsg', 'Image size is too large!');
                }
                $fileExt = $request->file('image')->getClientOriginalExtension();
                $fileName = $PostId.'.'.$fileExt;
        
                Storage::disk('public')->put($fileName, fopen($request->file('image'), 'r+'));
                shell_exec('/home/waifuwall/uploader/uploadPostThumbnail.sh '.$fileName.' '.$PostId);

                $fileUrl = "https://storage.waifuwall.com/blog/thumbnail-".$PostId.".webp";

                $ConnectDB->table('posts')->where("id", "=", $PostId)->update([
                    'thumbnail' => $fileUrl
                ]);
            }

            $ConnectDB->table('posts')->where("id", "=", $PostId)->update([
                'slug' => str_replace(" ", "-", preg_replace('!\s+!', ' ', str_replace(array('\'', '"', ',' , ';', '<', '>', ':', '-'), '', strtolower($request->title))))."-".$PostId,
                'published' => 1
            ]);
            
            return redirect("/blog/".str_replace(" ", "-", preg_replace('!\s+!', ' ', str_replace(array('\'', '"', ',' , ';', '<', '>', ':', '-'), '', strtolower($request->title))))."-".$PostId);
        }else{
            $UserData = null;
            return redirect("/signin");
        }
    }

    public function UploadImage(Request $request){
        $ConnectDB = DB::connection("Database");
        
        if ($request->session()->has('session')) {
            $UserData = $ConnectDB->table("users")->where("session", "=", $request->session()->get('session'))->first();

            if(empty($UserData)){
                $request->session()->forget('session');
                $request->session()->flush();
              	$UserData = null;
            }
        }else{
          	$UserData = null;
        }
        
        if ($request->session()->has('session')) {
            if($request->hasFile('image')) {
                $currentName = strtotime(date("Y-m-d H:i:s"));
                $fileExt = $request->file('image')->getClientOriginalExtension();
                $fileName = $currentName.'.'.$fileExt;
        
                Storage::disk('public')->put($fileName, fopen($request->file('image'), 'r+'));
                shell_exec('/home/waifuwall/uploader/uploadPostImage.sh '.$fileName.' '.$currentName);

                $fileUrl = "https://storage.waifuwall.com/blog/post-".$currentName.".webp";
            }
            return "READY:".$fileUrl;
        }else{
            $UserData = null;
            return redirect("/signin");
        }
    }
}