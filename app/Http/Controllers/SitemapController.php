<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SitemapController extends Controller{
    public function IndexSitemap(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();
        $Wallpaper = $ConnectDB->table("wallpapers_1")->orderBy("date", "desc")->whereNotLike("image", "%mp4%")->where("image_filesize", "!=", "0")->where("slug", "!=", "")->first();
        $Series = $ConnectDB->table("series")->orderBy("date", "desc")->first();
        $Character = $ConnectDB->table("characters")->orderBy("date", "desc")->first();
        $Blog = $ConnectDB->table("posts")->orderBy("date", "desc")->first();

        $Index = '<?xml version="1.0" encoding="UTF-8"?>
        <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            <sitemap>
                <loc>'.str_replace(request()->getHost(), $serverDomain, url('/')).'/sitemap-post.xml</loc>
                <lastmod>'. date(DATE_W3C, strtotime($Wallpaper->date_modified)) .'</lastmod>
            </sitemap>
            <sitemap>
                <loc>'.str_replace(request()->getHost(), $serverDomain, url('/')).'/sitemap-series.xml</loc>
                <lastmod>'. date(DATE_W3C, strtotime($Series->date_modified)) .'</lastmod>
            </sitemap>
            <sitemap>
                <loc>'.str_replace(request()->getHost(), $serverDomain, url('/')).'/sitemap-character.xml</loc>
                <lastmod>'. date(DATE_W3C, strtotime($Character->date_modified)) .'</lastmod>
            </sitemap>
            <sitemap>
                <loc>'.str_replace(request()->getHost(), $serverDomain, url('/')).'/sitemap-blog.xml</loc>
                <lastmod>'. date(DATE_W3C, strtotime($Blog->date_modified)) .'</lastmod>
            </sitemap>
        </sitemapindex>';

        return response($Index, 200, ['Content-Type' => 'application/xml']);
    }

    public function IndexPost(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        $WallpaperSQL = $ConnectDB->table("wallpapers_1")->whereNotLike("image", "%mp4%")->where("image_filesize", "!=", "0")->where("slug", "!=", "")->count();
        $Data = round($WallpaperSQL/200,0,PHP_ROUND_HALF_ODD);
        $Date = array();

        for ($x = 1; $x <= $Data; $x++) {
            $Offset = $x*200;
            if($WallpaperSQL < $Offset){
                $WallpaperMod = $ConnectDB->table("wallpapers_1")->select("date_modified")->orderBy("date_modified", "desc")->whereNotLike("image", "%mp4%")->where("image_filesize", "!=", "0")->where("slug", "!=", "")->first();
            }else{
                $WallpaperMod = $ConnectDB->table("wallpapers_1")
                    ->select("date_modified")
                    ->orderBy("date_modified", "desc")
                    ->whereNotLike("image", "%mp4%")
                    ->where("image_filesize", "!=", "0")
                    ->where("slug", "!=", "")
                    ->offset($Offset)
                    ->first();
            }
            array_push($Date, $WallpaperMod);
        }

        return response()->view("/Sitemap/IndexPost", ["Data" => $Data, "Date" => $Date, "ServerDomain" => $serverDomain])->header('Content-Type', 'application/xml');
    }

    public function SitemapPost(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        $WallpaperSQL = $ConnectDB->table("wallpapers_1")
            ->whereNotLike("image", "%mp4%")
            ->where("image_filesize", "!=", "0")
            ->where("slug", "!=", "")
            ->count();
        $Data = round($WallpaperSQL/200,0,PHP_ROUND_HALF_ODD)+1;
        
        if($request->PostIndex > $Data){
            return abort(404);
        }

        $Offset = ($request->PostIndex-1)*200;

        $WallpaperSQL = $ConnectDB->table("wallpapers_1")
            ->orderBy("date", "asc")
            ->whereNotLike("image", "%mp4%")
            ->where("image_filesize", "!=", "0")
            ->where("slug", "!=", "")
            ->offset($Offset)
            ->limit(200)
            ->get();

        $Data = $WallpaperSQL->map(function ($data, $key) use ($WallpaperSQL) {
            return [
                'id' => (int) $data->id,
                'slug' => $data->slug,
                'thumbnail' => $data->thumbnail,
                'image' => $data->image,
                'date' => $data->date,
                'date_modified' => $data->date_modified,
                'seo_title' => $data->seo_title,
                'width' => $data->image_width,
                'height' => $data->image_height,
                'file_size' => $data->image_filesize
            ];
        });

        return response()->view("/Sitemap/SitemapPost", ["Data" => $Data, "ServerDomain" => $serverDomain])->header('Content-Type', 'application/xml');      
    }

    public function IndexSeries(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        $SeriesSQL = $ConnectDB->table("series")->count();
        //return $SeriesSQL;
        $Data = round($SeriesSQL/500,0,PHP_ROUND_HALF_ODD)+1;
        //return $Data;
        $Date = array();
        if($Data == 0){
            $Data = 1;
        }

        for ($x = 1; $x <= $Data; $x++) {
            $Offset = $x*500;
            if($SeriesSQL < $Offset){
                $WallpaperMod = $ConnectDB->table("series")
                    ->select("date_modified")
                    ->orderBy("date_modified", "desc")
                    ->first();
            }else{
                $WallpaperMod = $ConnectDB->table("series")
                    ->select("date_modified")
                    ->orderBy("date_modified", "desc")
                    ->offset($Offset)
                    ->first();
            }
            array_push($Date, $WallpaperMod);
        }

        return response()->view("/Sitemap/IndexSeries", ["Data" => $Data, "Date" => $Date, "ServerDomain" => $serverDomain])->header('Content-Type', 'application/xml');
    }

    public function SitemapSeries(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        $SeriesSQL = $ConnectDB->table("series")->count();
        $Data = round($SeriesSQL/500,0,PHP_ROUND_HALF_ODD)+1;
        
        if($request->PostIndex > $Data){
            return abort(404);
        }

        $Offset = ($request->SeriesIndex-1)*500;

        $SeriesSQL = $ConnectDB->table("series")
            ->orderBy("date", "asc")
            ->offset($Offset)
            ->limit(500)
            ->get();

        $Data = $SeriesSQL->map(function ($data, $key) use ($SeriesSQL) {
            return [
                'id' => (int) $data->id,
                'slug' => $data->slug,
                'image' => $data->image,
                'date' => $data->date,
                'date_modified' => $data->date_modified
            ];
        });

        return response()->view("/Sitemap/SitemapSeries", ["Data" => $Data, "ServerDomain" => $serverDomain])->header('Content-Type', 'application/xml');      
    }

    public function IndexCharacter(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        $CharacterSQL = $ConnectDB->table("characters")->count();
        //return $CharacterSQL;
        $Data = round($CharacterSQL/500,0,PHP_ROUND_HALF_ODD)+1;
        //return $Data;
        $Date = array();
        if($Data == 0){
            $Data = 1;
        }

        for ($x = 1; $x <= $Data; $x++) {
            $Offset = $x*500;
            if($CharacterSQL < $Offset){
                $WallpaperMod = $ConnectDB->table("characters")
                    ->select("date_modified")
                    ->orderBy("date_modified", "desc")
                    ->first();
            }else{
                $WallpaperMod = $ConnectDB->table("characters")
                    ->select("date_modified")
                    ->orderBy("date_modified", "desc")
                    ->offset($Offset)
                    ->first();
            }
            array_push($Date, $WallpaperMod);
        }

        return response()->view("/Sitemap/IndexCharacter", ["Data" => $Data, "Date" => $Date, "ServerDomain" => $serverDomain])->header('Content-Type', 'application/xml');
    }

    public function SitemapCharacter(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        $CharacterSQL = $ConnectDB->table("characters")->count();
        $Data = round($CharacterSQL/500,0,PHP_ROUND_HALF_ODD);
        
        if($request->PostIndex > $Data){
            return abort(404);
        }

        $Offset = ($request->CharacterIndex-1)*500;
        //return $Offset;

        $CharacterSQL = $ConnectDB->table("characters")
            ->rightJoin('series', 'characters.series', '=', 'series.name')
            ->select(
                    "characters.id",
                    "characters.slug",
                    "characters.date_modified",
                    "series.slug as series_slug"
                )
            ->orderBy("characters.date", "asc")
            ->offset($Offset)
            ->limit(500)
            ->get();

        $Data = $CharacterSQL->map(function ($data, $key) use ($CharacterSQL) {
            return [
                'id' => (int) $data->id,
                'slug' => $data->slug,
                'series_slug' => $data->series_slug,
                'date_modified' => $data->date_modified
            ];
        });

        return response()->view("/Sitemap/SitemapCharacter", ["Data" => $Data, "ServerDomain" => $serverDomain])->header('Content-Type', 'application/xml');      
    }

    public function IndexBlog(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        $BlogSQL = $ConnectDB->table("posts")->where("published", "=", "1")->count();
        //return $SeriesSQL;
        $Data = round($BlogSQL/500,0,PHP_ROUND_HALF_ODD)+1;
        //return $Data;
        $Date = array();
        if($Data == 0){
            $Data = 1;
        }

        for ($x = 1; $x <= $Data; $x++) {
            $Offset = $x*500;
            if($BlogSQL < $Offset){
                $BlogMod = $ConnectDB->table("posts")
                    ->where("published", "=", "1")
                    ->select("date_modified")
                    ->orderBy("date_modified", "desc")
                    ->first();
            }else{
                $BlogMod = $ConnectDB->table("posts")
                    ->where("published", "=", "1")
                    ->select("date_modified")
                    ->orderBy("date_modified", "desc")
                    ->offset($Offset)
                    ->first();
            }
            array_push($Date, $BlogMod);
        }

        return response()->view("/Sitemap/IndexBlog", ["Data" => $Data, "Date" => $Date, "ServerDomain" => $serverDomain])->header('Content-Type', 'application/xml');
    }

    public function SitemapBlog(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();
        
        $BlogSQL = $ConnectDB->table("posts")->count();
        $Data = round($BlogSQL/500,0,PHP_ROUND_HALF_ODD);
        
        if($request->PostIndex > $Data){
            return abort(404);
        }

        $Offset = ($request->BlogIndex-1)*500;
        //return $Offset;

        $BlogSQL = $ConnectDB->table("posts")
            ->where("published", "=", "1")
            ->orderBy("date", "asc")
            ->offset($Offset)
            ->limit(500)
            ->get();

        return response()->view("/Sitemap/SitemapBlog", ["Data" => $BlogSQL, "ServerDomain" => $serverDomain])->header('Content-Type', 'application/xml');      
    }
}
