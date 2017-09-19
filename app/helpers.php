<?php

/**
 * Global helpers file with misc functions
 *
 */

if (!function_exists('app_name')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (!function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function
     */
    function access()
    {
        return app('access');
    }
}

if (!function_exists('javascript')) {
    /**
     * Access the javascript helper
     */
    function javascript()
    {
        return app('JavaScript');
    }
}

if (!function_exists('gravatar')) {
    /**
     * Access the gravatar helper
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (!function_exists('getFallbackLocale')) {
    /**
     * Get the fallback locale
     *
     * @return \Illuminate\Foundation\Application|mixed
     */
    function getFallbackLocale()
    {
        return config('app.fallback_locale');
    }
}

if (!function_exists('getLanguageBlock')) {

    /**
     * Get the language block with a fallback
     *
     * @param $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getLanguageBlock($view, $data = [])
    {
        $components = explode("lang", $view);
        $current = $components[0] . "lang." . app()->getLocale() . "." . $components[1];
        $fallback = $components[0] . "lang." . getFallbackLocale() . "." . $components[1];

        if (view()->exists($current)) {
            return view($current, $data);
        } else {
            return view($fallback, $data);
        }
    }
}
function getLink($data)
{
    $request_param = @json_decode($data->request_param, true);
    $param = '';
    if (!empty($request_param)) {
        $param = http_build_query($request_param);
    }
    return env('IR_WEB') . 'preview/' . $data->id . '?' . $param;
    // return false;
}
function checkUser()
{
    $user = access()->user()->toarray();
    return $user['roles'][0]['name'];
}
function genValueLink($person)
{
    switch ($person) {
        case 'vip':
            return 'VIP';
            break;
        case 'vip':
            return 'Normal';
            break;

        default:
            return 'Normal';
            break;
    }
}
if (!function_exists('generateTransection')) {
    function generateTransection()
    {
        return date('YmdHis') . rnd(4);
        return $transectionID;
    }
}
function renderArray($data)
{
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
    } else {

        echo $data;
    }
}
function genTopup($path, $filename)
{
    return env('FRONT') . 'storage/' . $path . '/' . $filename;
}
function genOld($input)
{
    return !empty($input['value']) ? $input['value'] : old($input['name']);
}
function genSelect($input)
{
    return !empty($input['check']) ? $input['check'] : old($input['name']);
}
function genImg($data, $value)
{
    return env('FRONT') . 'storage/' . $data['path'] . '/' . $value;
}
function listAllow()
{
    return ['img_idcard', 'img_bookbank', 'img_company_register_doc', 'img_profile'];
}
function genDate($date)
{
    return date('Y-m-d', strtotime($date));
}
function genType()
{
    $route = \Request::route()->getName();
    if ($route == "wallet.withdraw") {
        return 'Withdrawal';
    } else if ($route == 'wallet.topup') {
        return 'Topup';
    }
}
if (!function_exists('rnd')) {
    function rnd($rang)
    {
        return strtoupper(bin2hex(openssl_random_pseudo_bytes($rang)));
    }
}
function genId($perpage, $page)
{
    return ($page !== 1) ? $perpage * ($page - 1) + 1 : $page;
}
