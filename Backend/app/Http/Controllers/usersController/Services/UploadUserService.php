<?php

namespace App\Http\Controllers\usersController\Services;

use App\Constants\Constant;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UploadUserService
{

    public static function upload(Request $request){

            $user = Auth::user();

            $exist = self::ExistPhoto($user);

            if(!$exist){

                self::CreateImage($user, $request);

            }else{

                $file = self::ExistFile($exist);

                if(!$file){
                    self::UpdateImage($exist->url, $user, $request);
                }else{
                    self::UpdateImage($exist->url, $user, $request);
                }

            }

            return response()->json([
                'data'    => $user->image,
                'success' => 'Imagen de perfil actualizado',
            ]);

  
    }


    public static function ExistPhoto($user){

        $image = Image::where('imageable_id', $user->id)
            ->where('imageable_type', 'App\\Models\\User')->first();

        return $image;
    }


    public static function ExistFile($exist){

        $path = public_path() . '/imagenes/'.$exist->url;

        if(File::exists($path)){

            return true;

        }else{

            return false;

        }

    }

    public static function CreateImage($user, $request){
        $appUrl = Constant::APP; 
        $path = public_path() . '/imagenes';
        $file = $request->file('image');
        $name = time() . $file->getClientOriginalName();
        $file->move($path, $name);

        $input['url'] = $appUrl.'/imagenes/'.$name;
        $input['imageable_id'] = $user->id;
        $input['imageable_type'] = 'App\Models\User';

        Image::create($input);

        return true;

    }
    

    public static function UpdateImage($url, $user, $request){
        $appUrl = Constant::APP;

        // = 'http://127.0.0.1:8000/imagenes/1693451051las-personas-vitamina-0_ai1.webp';
        $substring = Str::after($url, '/imagenes');

        $path = public_path() . '/imagenes/'.$substring;

        File::delete($path);
        $path = public_path() . '/imagenes';

        $file = $request->file('image');
        $name = time() . $file->getClientOriginalName();
        $file->move($path, $name);


        Image::where('imageable_id', $user->id)
            ->where('imageable_type', 'App\Models\User')
            ->update(['url' => $appUrl.'/imagenes/'.$name]);

        return true;

    }
}