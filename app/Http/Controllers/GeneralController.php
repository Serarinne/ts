<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Coderflex\LaravelTurnstile\Rules\TurnstileCheck;
use Coderflex\LaravelTurnstile\Facades\LaravelTurnstile;
use MaxMind\Db\Reader;

class GeneralController extends Controller{
    public function Contact(Request $request){
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

        return response()->view("General/Contact", 
        [
            "Success" => false, 
            "UserData" => $UserData,
            "ServerDomain" => $serverDomain
        ]);
    }

    public function SubmitContact(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();
      	$response = LaravelTurnstile::validate();
      	
      	if (! $response['success']) {
          	return redirect()->back()
              	->with('cf-msg', 'The CAPTCHA thinks you are a robot! Please refresh and try again.');
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

        $SumbitContact = $ConnectDB->table('feedback_1')->insertGetId([
            'message' => "WEB: " . $request->message,
            'user' => $request->name . " - " . $request->email
        ]);

        if (!empty($SumbitContact)) {
            return response()->view("General/Contact", 
            [
                "Success" => true,
                "UserData" => $UserData,
                "ServerDomain" => $serverDomain
            ]);
        } else {
            return response()->view("General/Contact", 
            [
                "Success" => "failed",
                "UserData" => $UserData,
                "ServerDomain" => $serverDomain
            ]);
        }
    }

    public function About(Request $request){
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

        return response()->view("General/About", 
        [
            "UserData" => $UserData,
            "ServerDomain" => $serverDomain
        ]);
    }

    public function Privacy(Request $request){
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

        return response()->view("General/Privacy", 
        [
            "UserData" => $UserData,
            "ServerDomain" => $serverDomain
        ]);
    }

    public function Copyright(Request $request){
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

        return response()->view("General/Copyright", 
        [
            "UserData" => $UserData,
            "ServerDomain" => $serverDomain
        ]);
    }
  
  	public function PrivacyHSR(Request $request){
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

        return response()->view("General/Privacy-HSR", 
        [
            "UserData" => $UserData,
            "ServerDomain" => $serverDomain
        ]);
    }

    public function Terms2(Request $request){
        $ipAddress = '1.1.1.1';
      	$databaseFile = '/home/waifuwall/ipinfo.mmdb';
      	$reader = new Reader($databaseFile);
      	print_r($reader->get($ipAddress));
      	print_r($reader->getWithPrefixLen($ipAddress));
      	$reader->close();
    }

    public function Terms(Request $request){
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

        return response()->view("General/Terms", 
        [
            "UserData" => $UserData,
            "ServerDomain" => $serverDomain
        ]);
    }
}