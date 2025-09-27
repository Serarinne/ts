<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SeriesController extends Controller{
    public function IndexSeries(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        $Query = explode(" ", urldecode($request->q));

        if (!empty($Query)) {
            $SeriesData = $ConnectDB->table("series")
                ->where(function ($WhereQuery) use ($Query) {
                    foreach ($Query as $q) {
                        $WhereQuery->whereLike('keyword', "%".$q."%");
                    }
                })
                ->orderBy("name", "asc")
                ->paginate(28)
                ->withQueryString();
        } else {
            $SeriesData = $ConnectDB->table("series")
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

        return response()->view("Series/Series", 
        [
            "Data" => $SeriesData,
            "UserData" => $UserData,
            "ServerDomain" => $serverDomain
        ]);
    }

    public function SeriesWallpaper($SeriesSlug, $UserData, $NSFW_FILTER){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        $SeriesData = $ConnectDB->table("series")
            ->where("slug", "=", $SeriesSlug)
            ->first();

        if (empty($SeriesData)) {
            return abort(404);
        }

        $WallpaperData = $ConnectDB->table("wallpapers_1")
          	->whereLike("nsfw", $NSFW_FILTER)
            ->whereLike("keyword", "%".$SeriesData->name."%")
            ->where("image_filesize", "!=", "0")
            ->where("slug", "!=", "")
            ->orderBy("date", "desc")
            ->paginate(28)
            ->withQueryString();

        $Data = $WallpaperData->map(function ($data, $key) use ($WallpaperData) {
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

        return response()->view("Series/SeriesWallpaper", 
        [
            "WallpaperData" => $Data, 
            "PaginationData" => $WallpaperData, 
            "SeriesData" => $SeriesData,
            "UserData" => $UserData,
            "ServerDomain" => $serverDomain
        ]);
    }

    public function SeriesCharacter(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        $SeriesSlug = htmlspecialchars_decode(urldecode($request->SeriesSlug));

        $SeriesData = $ConnectDB->table("series")
            ->where("slug", "=", $SeriesSlug)
            ->first();

        if (empty($SeriesData)) {
            return response()->abort(404);
        }

        $CharacterData = $ConnectDB->table("characters")
            ->where("series", "=", $SeriesData->id)
            ->orWhereLike("series", $SeriesData->id."#%")
            ->orWhereLike("series", "%#".$SeriesData->id)
            ->orWhereLike("series", "%#".$SeriesData->id."#%")
            //->where("tag", "LIKE", "%Female%")
            ->orderBy("name", "asc")
            ->paginate(28)
            ->withQueryString();
        // return $CharacterData;

        $CharacterDataFinal = $CharacterData->map(function ($data, $key) use ($ConnectDB) {
            $characterSeries = explode("#", $data->series);
            return [
                "id" => (int) $data->id,
                "slug" => $data->slug,
                "image" => $data->image,
                "name" => $data->name,
                "series" => $ConnectDB->table("series")->select("name")->where("id", $characterSeries[0])->pluck('name')->first(),
                "series_slug" => $ConnectDB->table("series")->select("slug")->where("id", $characterSeries[0])->pluck('slug')->first()
            ];
        });
        
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

        return response()->view("Series/SeriesCharacter", 
        [
            "CharacterData" => $CharacterDataFinal, 
            "PaginationData" => $CharacterData, 
            "SeriesData" => $SeriesData,
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