<?php

Namespace App\Helper;
use Illuminate\Support\Str;

Class uniqueGenerateIdLapor
{
    public static function generateUniqueRandomString($length, $model, $field)
    {
        $randomString = "";
        $characters = '123456789';
        $max        = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $randomString .= $characters[$rand];
        }

        while ($model::where($field, $randomString)->exists()) {
            $randomString = "";
            $characters = '123456789';
            $max        = strlen($characters) - 1;
            for ($i = 0; $i < $length; $i++) {
                $rand = mt_rand(0, $max);
                $randomString .= $characters[$rand];
            }
        }

        return $randomString;
    }
}
?>