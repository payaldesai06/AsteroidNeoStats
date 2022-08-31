<?php

namespace App;
use Config;
use Mail;
use Storage;

class Commonhelper
{
    public static function sendmail($toemail, $data, $template, $subject) {
        //$from = Config::get('constants.MAIL_FROM_ADDRESS');
        $appname = Config::get('constants.APP_NAME');
        Mail::send('emails.'.$template, $data, function($message) use ($toemail,$appname,$subject) {
            $message->to($toemail, $appname)
            ->subject($subject);
        });
    }

    public static function uploadFile($target_dir,$file) {
      $extension = $file->getClientOriginalExtension();
      if(!in_array(strtolower($extension),['jpg','jpeg','png','gif','webp'])) {
        return;
      }else{
        $filename = rand(100000, 999999).time(). ".".$extension;
        @Storage::disk(Config::get('constants.DISK'))->put($target_dir.$filename, file_get_contents($file), 'public');
        return $target_dir.$filename;
      }
    }

    public static function deleteFile($path) {
      Storage::disk(Config::get('constants.DISK'))->delete($path);
    }

    public static function active($path, $active = 'active') {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }

}
