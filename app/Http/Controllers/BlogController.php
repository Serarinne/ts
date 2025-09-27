<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BlogController extends Controller{
    public function IndexBlog(Request $request){
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();
        $ConnectDB = DB::connection("Database");

        if(isset($request->tag)){
            $BlogSQL = $ConnectDB->table("posts")
            ->where("published", "=", 1)
            ->where("tag", "=", $request->tag)
            ->orWhereLike("tag", "%".$request->tag)
            ->orWhereLike("tag", $request->tag."%")
            ->orWhereLike("tag", "%".$request->tag."%")
            ->orderBy('id', 'DESC')
            ->paginate(28)
            ->withQueryString();
        }else{
            $BlogSQL = $ConnectDB->table("posts")
            ->where("published", "=", 1)
            ->orderBy('id', 'DESC')
            ->paginate(28)
            ->withQueryString();
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

        return response()->view("Blog/Index", 
        [
            "BlogData" => $BlogSQL,
            "UserData" => $UserData, 
            "ServerDomain" => $serverDomain
        ]);
    }

    public function ViewPost(Request $request){
        $blogSlug = $request->BlogSlug;
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();
        $ConnectDB = DB::connection("Database");
        
        $BlogSQL = $ConnectDB->table("posts")->where("slug", "=", $blogSlug)->first();
        $Author = $ConnectDB->table("users")->where("id", "=", $BlogSQL->author)->first();

        $BlogSQL->author = $Author->name;
        $BlogSQL->author_slug = $Author->username;

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

        return response()->view("Blog/ViewPost", 
        [
            "Data" => $BlogSQL, 
            "UserData" => $UserData, 
            "ServerDomain" => $serverDomain
        ]);
    }
}