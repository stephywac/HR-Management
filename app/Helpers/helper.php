<?php

use App\Models\CallSign;
use App\Models\ExploreComponents;
use App\Models\File;
use App\Models\User;
use App\Models\Post;
use App\Models\Product;

/**
 * This File contains helper functions that can be globally accessed throughout the project.
 *
 * @author Arun <arun.webandcrafts@gmail.com>
 */


if (!function_exists('gull_asset')) {
    /**
     * Returns full path to gull assets
     *
     * @param string $path The path to the file.
     * @return string
     */
    function gull_asset($path): string
    {
        return asset('gull/assets/' . $path);
    }
}

if (!function_exists('public_asset')) {
    /**
     * Returns full path to public assets (used by the main site)
     *
     * @param string $path The path to the file.
     * @return string
     */
    function public_asset($path): string
    {
        return asset('html/assets/' . $path);
    }
}


if (!function_exists('dummy_image')) {
    /**
     * Returns full path to dummy profile picture
     *
     * @return string
     */
    function dummy_image(): string
    {
        return asset('images/users/dummy.png');
    }
}
if (!function_exists('getFlag')) {
    /**
     * Returns full path to dummy profile picture
     *
     * @return string
     */
    function getFlag($code): string
    {
        $flagCode = strtoupper($code);

        return '<img src="' . asset('images/HamFlags/' . $flagCode . '.png') . '">';
    }
}
if (!function_exists('getFlagStoragePath')) {
    /**
     * Returns full path to dummy profile picture
     *
     * @return string
     */
    function getFlagStoragePath(): string
    {

        return asset('images/HamFlags/');
    }
}
function def_cs()
{

    $user_id = Auth::id();

    $data = CallSign::where('user_id', $user_id)->where('default_flag', 1)->first();

    // $id=$data->id;

    return $data;
}

function slugify($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '_', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '_');

    // remove duplicate -
    $text = preg_replace('~-+~', '_', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return null;
    }

    return $text;
}
function totalUsersCount()
{
    $count = User::whereNull('deleted_at')->count();
    return $count;
}
function totalPostsCount()
{
    $count = Post::withoutGlobalScope('type')->whereNull('deleted_at')->count();
    return $count;
}
function userCountryCode()
{
    $ip = Request::ip();
    if ($ip) {
        try {
            $countryWithIp = Location::get($ip)->countryCode;
        } catch (\Exception $e) {
            // Log::error($e);
            return null;
        }
    } else {
        $countryWithIp = null;
    }
    return $countryWithIp;
}
function getIp()
{
    $ip = Request::ip();
    return $ip;
}

function generateFileName()
{
    $name = Str::random(8);

    // $defaultDisk = config('filesystems.default');
    // $path = config('filesystems.disks.' . $defaultDisk . '.root');
    // $matchingFiles = \Illuminate\Support\Facades\File::glob("$path.'/'.$name.*", GLOB_NOSORT);
    // return $matchingFiles;
    // $user = User::where('profile_pic', 'like', '%' . $name . '%')->count();
    // $file = File::where('file', 'like', '%' . $name . '%')->count();
    // $pdf = ExploreComponents::where('url', 'like', '%' . $name . '%')->count();
    // $product = Product::where('image', 'like', '%' . $name . '%')->count();

    // if ($user > 0 || $file > 0 || $pdf > 0 || $product > 0) {
    //     return generateFileName();
    // } else {
        return $name;
    //}
}

function storage_url($filepath = '')
{
    $defaultDisk = config('filesystems.default');
    $path = config('filesystems.disks.' . $defaultDisk . '.url');
    $path = rtrim($path, '/') . '/';
    $filepath = ltrim($filepath, '/');
    $url = $path . $filepath;
    return $url;
}

function humanTiming($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time < 1) ? 1 : $time;
    $tokens = array(
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
    }
}

function linkify($string)
{
    $url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
    $string = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $string);
    return $string;
}

function humanFileSize($size,$unit="") {
    if( (!$unit && $size >= 1<<30) || $unit == "GB")
      return number_format($size/(1<<30),2)." GB";
    if( (!$unit && $size >= 1<<20) || $unit == "MB")
      return number_format($size/(1<<20),2)." MB";
    if( (!$unit && $size >= 1<<10) || $unit == "KB")
      return number_format($size/(1<<10),2)." KB";
    return number_format($size)." bytes";
  }