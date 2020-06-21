<?php
namespace App\Helpers;

class Utilities {

    public static function wrap($data)
    {
        return response()->json($data, 200);
    }

    public static function wrapStatus($data, int $httpCode)
    {
        return response()->json($data, $httpCode);
    }

}
