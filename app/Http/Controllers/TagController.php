<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TagController extends Controller{
    public function IndexTag(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        $Query = explode(" ", urldecode($request->q));

        if (!empty($Query)) {
            $TagSQL = $ConnectDB->table("tags")
                ->where("slug", "!=", "")
                ->where(function ($WhereQuery) use ($Query) {
                    foreach ($Query as $q) {
                        $WhereQuery->whereLike('name', "%".$q."%");
                    }
                })
                ->orderBy("name", "asc")
                ->paginate(28)
                ->withQueryString();
        } else {
            $TagSQL = $ConnectDB->table("tags")
                ->where("slug", "!=", "")
                ->orderBy("name", "asc")
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

        return response()->view("/Tag/Tag", 
        [
            "TagData" => $TagSQL,
            "UserData" => $UserData,
            "ServerDomain" => $serverDomain
        ]);
    }

    public function TagWallpaper(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        $TagSlug = $request->TagSlug;

        $TagSQL = $ConnectDB->table("tags")
            ->where("slug", "=", $TagSlug)
            ->first();
      
      	if($ConnectDB->table("tags")->where("name", "=", str_replace("+", " ", $TagSlug))->where("slug", "!=", $TagSlug)->where("slug", "!=", "")->exists()){
          	$RealTagSQL = $ConnectDB->table("tags")->where("name", "=", str_replace("+", " ", $TagSlug))->where("slug", "!=", $TagSlug)->first();
          	return redirect('/tag/'.$RealTagSQL->slug, 301);
        }

        if (empty($TagSQL)) {
            return abort(404);
        }

        if ($request->session()->has('session')) {
          	$NSFW_FILTER = "%";
            $UserData = $ConnectDB->table("users")->where("session", "=", $request->session()->get('session'))->first();
          
          	if(empty($UserData)){
              	$request->session()->forget('session');
            	$request->session()->flush();
                $UserData = null;
            }
        }else{
          	$NSFW_FILTER = "0";
            $UserData = null;
        }
      
      	$WallpaperSQL = $ConnectDB->table("wallpapers_1")
          	->whereLike("nsfw", $NSFW_FILTER)
            ->where("tag", "=", $TagSQL->id)
            ->orWhereLike("tag", $TagSQL->id."#%")
            ->orWhereLike("tag", "%#".$TagSQL->id)
            ->orWhereLike("tag", "%#".$TagSQL->id."#%")
            ->where("slug", "!=", "")
            ->orderBy("date", "desc")
            ->paginate(28)
            ->withQueryString();

        $Data = $WallpaperSQL->map(function ($data, $key) use ($WallpaperSQL) {
            return [
                'id' => (int) $data->id,
                'slug' => $data->slug,
                'thumbnail' => $data->thumbnail,
                'image' => $data->image,
                'tag' => $data->tag,
                'date' => $data->date,
                'date_modified' => $data->date_modified,
                'keyword' => $data->keyword,
                'width' => $data->image_width,
                'height' => $data->image_height,
                'file_size' => $data->image_filesize,
                'artist' => $data->artist,
                'seo_title' => $data->seo_title,
                'seo_description' => $data->seo_description,
                'seo_keyword' => $data->seo_keyword,
                'character' => $this->GetCharacterByID($data->character)
            ];
        });

        return response()->view("/Tag/TagWallpaper", 
        [
            "WallpaperData" => $Data, 
            "PaginationData" => $WallpaperSQL, 
            "TagData" => $TagSQL,
            "UserData" => $UserData,
            "ServerDomain" => $serverDomain
        ]);
    }

    public function GetCharacterByID($CharacterID){
        $ConnectDB = DB::connection("Database");
        
        $Id = explode("#", $CharacterID);
        $Char = $ConnectDB->table("characters")->select(
            "id",
            "image",
            "name",
            "series"
        )->whereIn('id', $Id)->get();
        return $Char;
    }

}