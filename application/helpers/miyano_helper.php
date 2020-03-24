<?php
/**
 * Created by PhpStorm.
 * User: miyano
 * Date: 2019/01/13
 * Time: 午前 1:18
 */

if (!function_exists('hsc')) {
    function hsc($text)
    {
        return htmlspecialchars($text, ENT_QUOTES);
    }
}

if (!function_exists('SeparateString')) {
    /**文字列指定位置分割関数
     * 文字列の $position 文字目にスペースを入れる
     * @param $string
     * @param $position
     * @return string
     */
    function SeparateString($string, $position)
    {
        $last = mb_substr($string, $position);
        $first = mb_substr($string, 0, $position);
        return $first." ".$last;
    }
}

if (!function_exists('ConvertDateString')) {
    function ConvertDateString($date, $type)
    {
        switch ($type) {
            case 'slash':
                return date('n/j', strtotime($date));
            case 'ja':
                return date('n月j日', strtotime($date));
            case 'ja_year':
                return date('Y年n月j日', strtotime($date));
            default:
                return false;
        }
    }
}

if (!function_exists('GetCurrentUrl')) {
    function GetCurrentUrl()
    {
        $protocol = !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
        return $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }
}

if (!function_exists('Post')) {
    function Post($url, $data)
    {
        $curl=curl_init($url);
        $data = json_encode($data);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookie');
        curl_setopt($curl, CURLOPT_COOKIEFILE, 'tmp');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $res = curl_exec($curl);
        $res = json_decode($res, true);
        return $res;
    }
}

if (!function_exists('ConvertRuby')) {
    function ConvertRuby($string, $start = '(', $end = ')')
    {
        if (!mb_strpos($string, $start) || !mb_strpos($string, $end)) {
            return hsc($string);
        }
        $start_pos = mb_strpos($string, $start);
        $end_pos = mb_strpos($string, $end);
        $return  = "<ruby>".hsc(mb_substr($string, 0, $start_pos));
        $return .= "<rp>".hsc($start)."</rp>";
        $return .= "<rt>".hsc(mb_substr($string, $start_pos + 1, $end_pos - ($start_pos + 1)))."</rt>";
        $return .= "<rp>".hsc($end)."</rp>";
        $return .= "</ruby>";
        return $return;
    }
}
