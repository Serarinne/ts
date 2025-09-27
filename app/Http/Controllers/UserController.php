<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Coderflex\LaravelTurnstile\Facades\LaravelTurnstile;
use Coderflex\LaravelTurnstile\Rules\TurnstileCheck;

class UserController extends Controller{
    public function SignupView(Request $request){
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
            return redirect("/");
        }else{
            return response()->view("/Signup", 
            [
                "ServerDomain" => $serverDomain
            ]);
        }
    }

    public function SignupProccess(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

      	$response = LaravelTurnstile::validate();
      	
      	if (! $response['success']) {
          	return redirect()->back()
              	->with('cf-msg', 'The CAPTCHA thinks you are a robot! Please refresh and try again.')
                ->with('username', $request->username)
                ->with('fullname', $request->fullname)
                ->with('email', $request->email);
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
      
        if ($request->session()->has('session')) {
            return redirect("/");
        }else{
            if(strlen($request->username) < 3 || strlen($request->username) > 12){
                return redirect()->back()
                ->with('msg', 'Username must have 3-12 characters.')
                ->with('username', $request->username)
                ->with('fullname', $request->fullname)
                ->with('email', $request->email);
            }

            if(md5($request->password) != md5($request->cpassword)){
                return redirect()->back()
                ->with('msg', 'The password you entered is not the same.')
                ->with('username', $request->username)
                ->with('fullname', $request->fullname)
                ->with('email', $request->email);
            }

            if(strlen($request->password) < 8 || strlen($request->password) > 16){
                return redirect()->back()
                ->with('msg', 'Password must have 8-16 characters.')
                ->with('username', $request->username)
                ->with('fullname', $request->fullname)
                ->with('email', $request->email);
            }

            if($ConnectDB->table("users")->where("username", "=", $request->username)->exists()){
                return redirect()->back()
                ->with('msg', 'Username has been used, please use another username.')
                ->with('username', $request->username)
                ->with('fullname', $request->fullname)
                ->with('email', $request->email);
            }

            if($ConnectDB->table("users")->where("email", "=", $request->email)->exists()){
                return redirect()->back()
                ->with('msg', 'Email address has been used, please use another email address.')
                ->with('username', $request->username)
                ->with('fullname', $request->fullname)
                ->with('email', $request->email);
            }

            $id = $ConnectDB->table('users')->insertGetId([
                'username' => $request->username,
                'email' => $request->email,
                'password' => md5($request->password),
                'name' => $request->fullname,
                'validate_token' => md5($request->email)
            ]);
            
            //send email
            $regData['fullName'] = $request->fullname;
            $regData['userToken'] = md5($request->email);
            $regData['userEmail'] = $request->email;
            $this->SendEmail($regData, 1);

            $userSession = md5($id."_".$request->email."_".time());
            $ConnectDB->table('users')->where("id", "=", $id)->update(['session' => $userSession]);
            $request->session()->put("session", $userSession);
            $request->session()->save();
            return redirect("/");
        }
    }

    public function SigninView(Request $request){
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
            return redirect("/profile");
        }else{
            return response()->view("/Signin", 
            [
                "ServerDomain" => $serverDomain
            ]);
        }
    }

    public function SigninProccess(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();
      	$response = LaravelTurnstile::validate();
      	
      	if (! $response['success']) {
          	return redirect()->back()
              	->with('cf-msg', 'The CAPTCHA thinks you are a robot! Please refresh and try again.')
                ->with('username', $request->username);
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
      
        if ($request->session()->has('session')) {
            return redirect("/profile");
        }else{
            $UserData = $ConnectDB->table("users")->where("username", "=", $request->username)->where("password", "=", md5($request->password))->first();

            if(empty($UserData)){
                return redirect()->back()
                ->with('msg', 'The username or password you entered is incorrect.')
                ->with('username', $request->username);
            }else{
                $userSession = md5($UserData->id."_".$UserData->email."_".time());

                $ConnectDB->table('users')->where("id", "=", $UserData->id)->update(['session' => $userSession]);
                
                $request->session()->put("session", $userSession);
                $request->session()->save();

                return redirect("/profile");
            }
        }
    }

    public function SignoutProccess(Request $request){
        if ($request->session()->has('session')) {
            $request->session()->forget('session');
            $request->session()->flush();
            return redirect("/");
        }else{
            return redirect("/");
        }
    }

    public function UserProfile(Request $request){
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

        $Username = $request->Username;
        
        $UserData2 = $ConnectDB->table("users")->where("username", "=", $Username)->first();

        if($request->view == "posts"){
            $BlogData = $ConnectDB->table("posts")
            ->where("published", "=", 1)
            ->where("author", "=", $UserData2->id)
            ->orderBy('id', 'DESC')
            ->paginate(28)
            ->withQueryString();

            return response()->view("/User/UserBlog", 
            [
                "UserData" => $UserData, 
              	"UserData2" => $UserData2, 
                "BlogData" => $BlogData, 
                "ServerDomain" => $serverDomain
            ]);
        }else{
            $WallpaperData = $ConnectDB->table("wallpapers_1")
            ->where("uploader", "=", $UserData2->id)
            ->where("image_filesize", "!=", "0")
            ->where("slug", "!=", "")
            ->whereLike("nsfw", $NSFW_FILTER)
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
                    'keyword' => $data->keyword,
                    'seo_title' => $data->seo_title,
                    'width' => $data->image_width,
                    'height' => $data->image_height,
                    'file_size' => $data->image_filesize,
                    'character' => $this->GetCharacterByID($data->character)
                ];
            });

            return response()->view("/User/UserWallpaper", 
            [
                "UserData" => $UserData, 
              	"UserData2" => $UserData2, 
                "WallpaperData" => $Data,
                "PaginationData" => $WallpaperData,
                "ServerDomain" => $serverDomain
            ]);
        }
    }

    public function UpdateProfile(Request $request){
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

        $UserData = $ConnectDB->table("users")->where("session", "=", $request->session()->get('session'))->first();

        if($request->type == "profile"){
            if($request->hasFile('image')) {
                if($request->file('image')->getSize() > 2400000){
                    return redirect()->back()->with('errmsg', 'Image size is too large!');
                }
                $fileExt = $request->file('image')->getClientOriginalExtension();
                $fileName = $UserData->id.'.'.$fileExt;
        
                Storage::disk('public')->put($fileName, fopen($request->file('image'), 'r+'));
                shell_exec('/home/waifuwall/uploader/uploadProfile.sh '.$fileName.' '.$UserData->id);

                $fileUrl = "https://storage.waifuwall.com/profile/".$UserData->id.".webp";

                $ConnectDB->table("users")->where("id", "=", $UserData->id)->update([
                    'name' => $request->fullname,
                    'image' => $fileUrl
                ]);
            }else{
                $ConnectDB->table("users")->where("id", "=", $UserData->id)->update([
                    'name' => $request->fullname
                ]);
            }

            return redirect()->back()->with('msg', 'Data has been updated');
        }
        
        if($request->type == "password"){
            if(md5($request->password) != md5($request->cpassword)){
                return redirect()->back()->with('pmsg', 'The password you entered is not the same.');
            }

            if(strlen($request->password) < 8 || strlen($request->password) > 16){
                return redirect()->back()->with('pmsg', 'Password must have 8-16 characters.');
            }

            $ConnectDB->table("users")->where("id", "=", $UserData->id)->update([
                'password' => md5($request->password)
            ]);

            return redirect()->back()->with('pmsg', 'Password has been updated');
        }
    }

    public function MyProfile(Request $request){
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

            if($request->view == "favorites"){
                $FavoriteData = $ConnectDB->table("favorites_1")->where("user", "=", $UserData->id)->paginate(28)->withQueryString();
                $FavoriteID = $FavoriteData->pluck("wallpaper_id")->toArray();

                $WallpaperData = $ConnectDB->table("wallpapers_1")->whereIn("id", $FavoriteID)->orderBy("date", "desc")->where("image_filesize", "!=", "0")->where("slug", "!=", "")->get();

                $Data = $WallpaperData->map(function ($data, $key) use ($WallpaperData) {
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
                
                return response()->view("/User/MyFavorites", 
                [
                    "UserData" => $UserData,
                    "WallpaperData" => $Data,
                    "PaginationData" => $FavoriteData,
                    "ServerDomain" => $serverDomain
                ]);
            }elseif($request->view == "wallpapers"){
                $WallpaperData = $ConnectDB->table("wallpapers_1")
                ->where("uploader", "=", $UserData->id)
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
                        'keyword' => $data->keyword,
                        'seo_title' => $data->seo_title,
                        'width' => $data->image_width,
                        'height' => $data->image_height,
                        'file_size' => $data->image_filesize,
                        'character' => $this->GetCharacterByID($data->character)
                    ];
                });

                return response()->view("/User/MyWallpapers", 
                [
                    "UserData" => $UserData, 
                    "WallpaperData" => $Data,
                    "PaginationData" => $WallpaperData,
                    "ServerDomain" => $serverDomain
                ]);
            }elseif($request->view == "posts"){
                $BlogData = $ConnectDB->table("posts")
                ->where("published", "=", 1)
                ->where("author", "=", $UserData->id)
                ->orderBy('id', 'DESC')
                ->paginate(28)
                ->withQueryString();

                return response()->view("/User/MyPosts", 
                [
                    "UserData" => $UserData, 
                    "BlogData" => $BlogData, 
                    "ServerDomain" => $serverDomain
                ]);
            }elseif($request->view == "edit"){
                return response()->view("/User/EditProfile", 
                [
                    "UserData" => $UserData,
                    "ServerDomain" => $serverDomain
                ]);
            }else{
                $WallpaperData = $ConnectDB->table("wallpapers_1")->where("uploader", "=", $UserData->id)->count();
                $BlogData = $ConnectDB->table("posts")->where("author", "=", $UserData->id)->count();
                $FavoriteData = $ConnectDB->table("favorites_1")->where("user", "=", $UserData->id)->count();

                return response()->view("/User/MyAccount", 
                [
                    "UserData" => $UserData,
                    "WallpaperData" => $WallpaperData,
                    "BlogData" => $BlogData, 
                    "FavoriteData" => $FavoriteData, 
                    "ServerDomain" => $serverDomain
                ]);
            }
        }else{
            return redirect("/signin");
        }
    }

    public function ForgotView(Request $request){
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
            return redirect("/");
        }else{
            return response()->view("/Forgot", 
            [
                "ServerDomain" => $serverDomain
            ]);
        }
    }

    public function ForgotProccess(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

      	$response = LaravelTurnstile::validate();
      	
      	if (! $response['success']) {
          	return redirect()->back()
              	->with('cf-msg', 'The CAPTCHA thinks you are a robot! Please refresh and try again.')
                ->with('email', $request->email);
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
      
        if ($request->session()->has('session')) {
            return redirect("/");
        }else{
            $UserData = $ConnectDB->table("users")->where("email", "=", $request->email)->first();

            if(!empty($UserData)){
                $resetToken = md5("Reset_".$UserData->id."_".$UserData->email."_".time());
            
                $ConnectDB->table('users')->where("id", "=", $UserData->id)->update(['reset_token' => $resetToken]);

                //send email
                $regData['fullName'] = $UserData->name;
                $regData['userName'] = $UserData->username;
                $regData['resetToken'] = $resetToken;
                $regData['userEmail'] = $UserData->email;
                $this->SendEmail($regData, 3);
            }
            
            return redirect()->back()
                ->with('msg', 'If the username or email you entered is registered, the system automatically sends a password reset link to your email.');
        }
    }

    public function SendVerification(Request $request){
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
            $UserData = $ConnectDB->table("users")->where("session", "=", $request->session()->get('session'))->where("validate_token", "!=", "")->where("validate_token", "!=", NULL)->first();

            if(empty($UserData)){
                return redirect("/profile");
            }else{
                //send email
                $regData['fullName'] = $UserData->name;
                $regData['userToken'] = md5($UserData->email);
                $regData['userEmail'] = $UserData->email;
                $this->SendEmail($regData, 2);

                return redirect("/profile")->with('msg', 'We have sent a verification link to your email, please check your email.');
            }
        }else{
            return abort(403);
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

    public function SendEmail($userData, $emailType){
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        if($emailType == 1){
            $subject = "Welcome to WaifuWall";
            $content = view("/Email/RegistrationEmail", [
              "fullName" => $userData["fullName"], 
              "userToken" => $userData["userToken"], 
              "ServerDomain" => $serverDomain
            ])->render();
        }
        if($emailType == 2){
            $subject = "WaifuWall Re-Verification";
            $content = view("/Email/ReVerificationEmail", [
              "fullName" => $userData["fullName"], 
              "userToken" => $userData["userToken"], 
              "ServerDomain" => $serverDomain
            ])->render();
        }
        if($emailType == 3){
            $subject = "WaifuWall Reset Password";
            $content = view("/Email/ForgotEmail", [
              "fullName" => $userData["fullName"], 
              "resetToken" => $userData["resetToken"], 
              "userName" => $userData["userName"], 
              "userEmail" => $userData["userEmail"], 
              "ServerDomain" => $serverDomain
            ])->render();
        }

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Port = env('MAIL_PORT');
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($userData['userEmail']);
          	$mail->Hostname = env('MAIL_HOST');
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $content;

            //if( !$mail->send() ) {
            //    return $mail->ErrorInfo;
            //}else {
            //    return "Email has been sent.";
            //}
        } catch (Exception $e) {
            //return 'Message could not be sent.';
        }
    }

    public function ResetView(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

        if ($request->session()->has('session')) {
            return redirect("/");
        }else{
            if(strlen($request->token) > 0){
                $UserData = $ConnectDB->table("users")->where("reset_token", "=", $request->token)->first();

                $getServer = new ServerController();
                $serverDomain = $getServer->serverDomain();

                if(empty($UserData)){
                    return redirect("/");
                }else{
                    return response()->view("/Reset", 
                    [
                        "UserData" => $UserData,
                        "ServerDomain" => $serverDomain
                    ]);
                }
            }else{
                return redirect("/");
            }
        }
    }

    public function ResetProccess(Request $request){
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
            return redirect("/");
        }else{
            if(md5($request->password) != md5($request->cpassword)){
                return redirect()->back()
                ->with('msg', 'The password you entered is not the same.');
            }

            if(strlen($request->password) < 8 || strlen($request->password) > 16){
                return redirect()->back()
                ->with('msg', 'Password must have 8-16 characters.');
            }

            $UserData = $ConnectDB->table("users")->where("reset_token", "=", $request->userToken)->first();

            if(!empty($UserData)){
                $ConnectDB->table('users')->where("id", "=", $UserData->id)->update(
                    [
                        'reset_token' => NULL,
                        'password' => md5($request->password)
                    ]);
            }
            
            return redirect("/signin")->with('msg', 'Your password has been changed, please login using your new password.');
        }
    }

    public function VerifyProccess(Request $request){
        $ConnectDB = DB::connection("Database");
        $getServer = new ServerController();
        $serverDomain = $getServer->serverDomain();

      	if ($request->session()->has('session')) {
            $ConnectDB = DB::connection("Database");
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
            $UserData = $ConnectDB->table("users")->where("validate_token", "=", $request->token)->first();

            if(!empty($UserData)){
                $ConnectDB->table('users')->where("id", "=", $UserData->id)->update(['validate_token' => '']);
                return redirect("/profile")->with('msg', 'Congratulations, your email has been successfully verified.');
            }else{
                return redirect("/profile")->with('msg', 'Sorry, it seems the verification link you clicked is wrong or has expired, please try sending the verification code again.');
            }
        }else{
            $UserData = $ConnectDB->table("users")->where("validate_token", "=", $request->token)->first();

            if(!empty($UserData)){
                $ConnectDB->table('users')->where("id", "=", $UserData->id)->update(['validate_token' => '']);
                return redirect("/signin")->with('msg', 'Congratulations, your email has been successfully verified.');
            }else{
                return redirect("/signin")->with('msg', 'Sorry, it seems the verification link you clicked is wrong or has expired, please try sending the verification code again.');
            }
        }
    }
}