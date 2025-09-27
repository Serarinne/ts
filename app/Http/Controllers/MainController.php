<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MainController extends Controller{
    public function Index(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

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
            ->orderBy("date", "desc")
          	->whereLike("nsfw", $NSFW_FILTER)
            ->where("image_filesize", "!=", "0")
            ->where("slug", "!=", "")
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
                'keyword' => $data->keyword,
                'seo_title' => $data->seo_title,
                'width' => $data->image_width,
                'height' => $data->image_height,
                'file_size' => $data->image_filesize,
                'character' => $this->GetCharacterByID($data->character)
            ];
        });

        return response()->view("/Index", 
        [
            "WallpaperData" => $Data, 
            "PaginationData" => $WallpaperSQL,
            "UserData" => $UserData,
            "ServerDomain" => $serverDomain
        ]);
    }

    public function ViewImage(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();
        $WallpaperID = $request->WallpaperID;

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

        if($ConnectDB->table("redirect_1")->where("source", "=", $request->getPathInfo())->exists()){
            $RedirectData = $ConnectDB->table("redirect_1")->where("source", "=", $request->getPathInfo())->first();
            return redirect($RedirectData->destination)->withStatus(301);
        }

        if (!is_numeric($WallpaperID)){
            if($ConnectDB->table("wallpapers_1")->where("slug", "=", $WallpaperID)->where("image_filesize", "!=", "0")->doesntExist()){
                return app(SeriesController::class)->SeriesWallpaper($request->WallpaperID, $UserData, $NSFW_FILTER);
            }else{
                $WallpaperSQL = $ConnectDB->table("wallpapers_1")->where("slug", "=", $WallpaperID)->get();
            }
        }else{
            $WallpaperSQL = $ConnectDB->table("wallpapers_1")->where("id", "=", $WallpaperID)->get();
        }

        if ($WallpaperSQL->isNotEmpty()) {
          	if(($WallpaperSQL[0]->nsfw != 0) && (!$request->session()->has('session'))){
              	return redirect("/signin")->withStatus(302);
            }

          	if(filter_var($WallpaperID, FILTER_VALIDATE_INT) == true){
                return Redirect::to('https://waifuwall.com/'.$WallpaperSQL[0]->slug, 301);
            }

            $Data = $WallpaperSQL->map(function ($data, $key) use ($WallpaperSQL, $ConnectDB) {
                $UserData = $ConnectDB->table("users")->where("id", "=", $data->uploader)->first();
                return [
                    'id' => (int) $data->id,
                    'slug' => $data->slug,
                    'thumbnail' => $data->thumbnail,
                    'preview' => $data->preview,
                    'image' => $data->image,
                    'tag' => $this->GetTagByID($data->tag),
                    'keyword' => $data->keyword,
                    'width' => $data->image_width,
                    'height' => $data->image_height,
                    'file_size' => $data->image_filesize,
                    'seo_title' => $data->seo_title,
                    'seo_keyword' => $data->seo_keyword,
                    'seo_description' => $data->seo_description,
                    'artist' => $data->artist,
                    'real_source' => $data->real_source,
                    'nsfw' => $data->nsfw,
                    'uploader_name' => $UserData->name,
                    'uploader_slug' => $UserData->username,
                    'date' => $data->date,
                    'date_modified' => $data->date_modified,
                    'character' => $this->GetCharacterByID($data->character)
                ];
            });

            return response()->view("/ViewImage", 
            [
                "WallpaperData" => $Data[0],
                "UserData" => $UserData,
                "ServerDomain" => $serverDomain
            ]);
        } else {
            return abort(404);
        }
    }

    public function DownloadImage(Request $request){
        $ConnectDB = DB::connection("Database");
        $WallpaperID = $request->WallpaperID;

        $WallpaperData = $ConnectDB->table("wallpapers_1")->where("id", "=", $WallpaperID)->orWhere("slug", "=", $WallpaperID)->first();
        return Redirect::to($WallpaperData->image.'&download')->header('Referrer-Policy', 'no-referrer');
    }

    public function Search(Request $request){
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

        if (!empty($request->q)) {
            $Query = explode(" ", urldecode($request->q));
            $WallpaperSQL = $ConnectDB->table("wallpapers_1")
                ->where(function ($WhereQuery) use ($Query) {
                    foreach ($Query as $q) {
                        $WhereQuery->whereLike('keyword', "%".$q."%");
                    }
                })
                ->where("slug", "!=", "")
                ->where("image_filesize", "!=", "0")
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
                    'keyword' => $data->keyword,
                    'seo_title' => $data->seo_title,
                    'width' => $data->image_width,
                    'height' => $data->image_height,
                    'file_size' => $data->image_filesize,
                    'character' => $this->GetCharacterByID($data->character)
                ];
            });

            return response()->view("/Search/SearchQuery", 
            [
                "WallpaperData" => $Data, 
                "PaginationData" => $WallpaperSQL,
                "UserData" => $UserData,
                "ServerDomain" => $serverDomain
            ]);
        } else {
            $totalWallpaper = $ConnectDB->table("wallpapers_1")->count();
            $totalCharacter = $ConnectDB->table("characters")->count();
            $totalSeries = $ConnectDB->table("series")->count();
            return response()->view("/Search/Search",
            [
                "totalWallpaper" => $totalWallpaper,
                "totalCharacter" => $totalCharacter,
                "totalSeries" => $totalSeries,
                "UserData" => $UserData,
                "ServerDomain" => $serverDomain
            ]);
        }
    }

    public function GetCharacterByID($CharacterId){
        $ConnectDB = DB::connection("Database");

        $IdList = explode("#", $CharacterId);
        $CharacterData = $ConnectDB->table("characters")->select("id","image","name","slug","series")->whereIn("id", $IdList)->get();

        $Characters = $CharacterData->map(function ($data, $key) use ($ConnectDB){
            $characterSeries = explode("#", $data->series);
            return [
                "id" => (int) $data->id,
                "image" => $data->image,
                "name" => $data->name,
                "slug" => $data->slug,
                "series_name" => $ConnectDB->table("series")->select("name")->where("id", $characterSeries[0])->pluck('name')->first(),
                "series_slug" => $ConnectDB->table("series")->select("slug")->where("id", $characterSeries[0])->pluck('slug')->first()
            ];
        });

        return $Characters;
    }

    public function GetTagByID($TagId){
        $ConnectDB = DB::connection("Database");

        $IdList = explode("#", $TagId);

        $TagData = $ConnectDB->table("tags")->whereIn('id', $IdList)->get();
        return $TagData;
    }
}