<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CharacterController extends Controller{
    public function IndexCharacter(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();
        $Query = explode(" ", urldecode($request->q));

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

        if (!empty($Query)) {
            $CharacterSQL = $ConnectDB->table("characters")
            ->where(function ($WhereQuery) use ($Query) {
                foreach ($Query as $q) {
                    $WhereQuery->whereLike('characters.keyword', "%".$q."%");
                }
            })
            ->orderBy("characters.name", "asc")
            ->paginate(28)
            ->withQueryString();
        } else {
            $CharacterSQL = $ConnectDB->table("characters")
                ->orderBy("characters.name", "asc")
                ->paginate(28)
                ->withQueryString();
        }
        // return $CharacterSQL;

        $CharacterDataFinal = $CharacterSQL->map(function ($data, $key) use ($ConnectDB) {
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
        // return $CharacterDataFinal;

        if ($request->session()->has('session')) {
            $UserData = $ConnectDB->table("users")->where("session", "=", $request->session()->get('session'))->first();
          
          	if(empty($UserData)){
              	$request->session()->forget('session');
            	$request->session()->flush();
            }
        }else{
            $UserData = null;
        }

        return response()->view("Character/Character", 
        [
            "CharacterData" => $CharacterDataFinal, 
            "PaginationData" => $CharacterSQL, 
            "UserData" => $UserData, 
            "ServerDomain" => $serverDomain
        ]);
    }

    public function CharacterWallpaper(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        if($ConnectDB->table("redirect_1")->where("source", "=", $request->getPathInfo())->exists()){
            $RedirectData = $ConnectDB->table("redirect_1")->where("source", "=", $request->getPathInfo())->first();
            return redirect($RedirectData->destination)->withStatus(301);
        }

        $SeriesSlug = $request->SeriesSlug;
        $CharacterSlug = $request->CharacterSlug;

        $SeriesData = $ConnectDB->table("series")
            ->where("slug", "=", $SeriesSlug)
            ->first();
        // return $SeriesData;

        $CharacterSQL = $ConnectDB->table("characters")
            ->where("slug", "=", $CharacterSlug)
            ->where("series", "=", $SeriesData->id)
            ->orWhereLike("series", $SeriesData->id."#%")
            ->orWhereLike("series", "%#".$SeriesData->id)
            ->orWhereLike("series", "%#".$SeriesData->id."#%")
            ->first();
        // return $CharacterSQL;

        $FirstSeriesData = $ConnectDB->table("series")
            ->where("id", "=", explode("#", $CharacterSQL->series)[0])
            ->first();
        // return $FirstSeriesData;

        if (empty($CharacterSQL)) {
            return response()->abort(404);
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
          	->where("slug", "!=", "")
            ->where("image_filesize", "!=", "0")
            ->where("character", "=", $CharacterSQL->id)
            ->orWhereLike("character", $CharacterSQL->id . "#%")
            ->orWhereLike("character", "%#" . $CharacterSQL->id)
            ->orWhereLike("character", "%#" . $CharacterSQL->id . "#%")
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

        return response()->view("Character/CharacterWallpaper", 
        [
            "WallpaperData" => $Data, 
            "PaginationData" => $WallpaperSQL, 
            "CharacterData" => $CharacterSQL, 
            "FirstSeriesData" => $FirstSeriesData, 
            "SeriesData" => $SeriesData, 
            "UserData" => $UserData, 
            "ServerDomain" => $serverDomain
        ]);
    }

    public function GetCharacterByID($CharacterID){
        $ConnectDB = DB::connection("Database");

        $AId = explode("#", $CharacterID);
        $Id = array_reverse($AId);
        $SId = implode(',',$AId);
        $Char = $ConnectDB->table("characters")
        ->rightJoin('series', 'characters.series', '=', 'series.name')
        ->select(
            "characters.id",
            "characters.image",
            "characters.name",
            "series.name as series",
            "characters.slug",
            "series.slug as series_slug"
        )
        ->whereIn('characters.id', $Id)->get();
        return $Char;
    }

}