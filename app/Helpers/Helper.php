<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
class Helper
{
    public static function IDGenerator($model, $trow, $length = 4, $prefix){
        $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '';
        } else {
            $code = substr($data->$trow, strlen($prefix) + 1);
            $actial_last_number = ($code / 1) * 1;
            $increment_last_number = ((int)$actial_last_number) + 1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = (string)$increment_last_number; // Explicitly cast to string
        }
        $zeros = str_repeat("0", $og_length);
        return $prefix . '' . $zeros . $last_number;
    }
}
?>

