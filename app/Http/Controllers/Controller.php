<?php

namespace App\Http\Controllers;

use App\Countries;
use App\States;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\UserMeta;
use Exception;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function updateUserMeta($id, $meta_key = "", $meta_value)
    {
        //
        try {
            UserMeta::updateOrCreate(
                [
                    'user_id' => $id,
                    'key' => $meta_key,
                ],
                ['value' => $meta_value]
            );
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public static function updateUserAllMeta($user_id, $meta_key_value = [])
    {
        //
        foreach ($meta_key_value as $key => $value) {
            # code...
            UserMeta::updateOrCreate(
                ['user_id' => $user_id, 'key' => $key],
                ['value' => ($value) ?? '']
            );
        }
    }


    public static function getUserMeta($id, $key = "", $status = false)
    {
        if (empty($key)) {
            // 
            $user_details_add = UserMeta::where('user_id', $id)->select('key', 'value')
                ->pluck('value', 'key')
                ->toArray();
            return $user_details_add;
        } else {
            //
            if ($status) {
                // 
                $user_details_add = UserMeta::where('user_id', $id)->where('key', $key)->first();
                if (!empty($user_details_add))
                    return $user_details_add->value;
                else
                    return "";
            } else {
                $user_details_add = UserMeta::where('user_id', $id)->where('key', $key)->select('key', 'value')
                    ->pluck('value', 'key')
                    ->toArray();
                return $user_details_add;
            }
        }
    }

    public static function getCountry($shortname = '', $status = false)
    {
        if (empty($shortname)) {
            // 
            $countries = Countries::select('shortname', 'name', 'phonecode')->get()->toArray();
            return $countries;
        } else {
            //
            if ($status) {
                // 
                $country = Countries::where('shortname', $shortname)->first();
                if (!empty($country))
                    return $country->name;
                else
                    return "";
            } else {
                $country = Countries::where('shortname', $shortname)
                    ->select('shortname', 'name', 'phonecode')
                    ->first()
                    ->toArray();
                return $country;
            }
        }
    }

    public static function getState($country_id = '', $state_id = '')
    {
        if (empty($state_id)) {
            if (empty($country_id)) {
                // 
                $states = States::select('name', 'id')->get()->toArray();
                return $states;
            } else {
                //
                $q = States::where('country_id', $country_id);
                $country = Countries::where('shortname', $country_id)->first();
                if (isset($country)) {
                    $q->orWhere('country_id', $country->id);
                }
                $state = $q->get()->toArray();
                if (!empty($state))
                    return $state;
                else
                    return [];
            }
        } else {
            $states = States::pluck('name', 'id')->where('id', $state_id)->first()->toArray();
            return $states;
        }
    }

    public static function shortString($string = '', $limit = 120)
    {
        $string = strip_tags($string);
        return strlen($string) > $limit ? substr($string, 0, $limit) . " ..." : $string;
    }


    public static function getImage($url)
    {
        return url($url);
    }
}
