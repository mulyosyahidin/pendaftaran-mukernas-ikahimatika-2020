<?php

use App\Models\Setting;

if (!function_exists('getSettings')) {
    function getSettings($key)
    {
        $setting = Setting::select('content')
            ->where('key', $key)
            ->first();

        return $setting->content;
    }
}

if (!function_exists('getSiteName')) {
    function getSiteName()
    {
        return getSettings('siteName');
    }
}

if ( ! function_exists('getPluginUri'))
{
    function getPluginUri($file = '') {
        if ($file === '') {
            return asset('assets/plugins');
        }

        $file_location = '../public/assets/plugins/'. $file;
        if (file_exists($file_location) && is_file($file_location)) {
            return asset('assets/plugins/'. $file);
        }
        else {
            return '{{ PLUGIN_NOT_FOUND }}';
        }
    }
}

if (!function_exists('getCurrentTheme')) {
    function getCurrentTheme()
    {
        return getSettings('currentTheme');
    }
}

if (!function_exists('getThemeUri')) {
    function getThemeUri($file)
    {
        $theme = getCurrentTheme();

        if (file_exists('../public/assets/themes/' . $theme . '/' . $file) && is_file('../public/assets/themes/' . $theme . '/' . $file)) {
            return asset('assets/themes/' . $theme . '/' . $file);
        } else {
            return '{{ FILE_NOT_FOUND }}';
        }
    }
}

if (!function_exists('getController')) {
    function getController()
    {
        $action = app('request')->route()->getAction();
        $route = class_basename($action['controller']);

        list($controller, $action) = explode('@', $route);

        return $controller;
    }
}

if (!function_exists('getAction')) {
    function getAction()
    {
        $action = app('request')->route()->getAction();
        $route = class_basename($action['controller']);

        list($controller, $action) = explode('@', $route);

        return $action;
    }
}

if (!function_exists('isController')) {
    function isController($controller)
    {
        return ($controller === getController());
    }
}

if (!function_exists('isAction')) {
    function isAction($action)
    {
        return ($action === getAction());
    }
}

if (!function_exists('__active')) {
    function __active($controller = '', $action = '', $param = '')
    {
        $phpSelf = $_SERVER['PHP_SELF'];

        if ($controller === '' && $action === '') {
            return ' active';
        }
        else if ($param !== '') {
            if (isController($controller) && isAction($action)) {
                if (strpos($phpSelf, $param) !== FALSE) {
                    return ' active';
                }
            }
        }
        else if (is_array($controller) && count($controller)) {
            foreach ($controller as $c) {
                if (isController($c)) {
                    return ' active';
                    break;
                }
            }
        }
        else if (is_array($action) && count($action) > 0) {
            foreach ($action as $method) {
                if (isController($controller) && isAction($method)) {
                    return ' active';
                    break;
                }
            }
        }
        else if (isController($controller) && isAction($action)) {
            return ' active';
        }
    }
}

if (!function_exists('getSiteLogo')) {
    function getSiteLogo()
    {
        $setting = Setting::find(2);

        if (isset($setting->media[0])) {
            return $setting->media[0]->getFullUrl();
        } else {
            return NULL;
        }
    }
}

if ( ! function_exists('getRole')) {
    function getRole()
    {
        $roles = Auth::user()->getRoleNames();

        return $roles[0];
    }
}

if ( ! function_exists('createAcronym'))
{
    function createAcronym($words)
    {
        $acronym = '';
        $words = explode(' ', $words);
        foreach ($words as $word)
        {
            $first_letter = str_split($word);

            $acronym .= $first_letter[0];
        }

        return $acronym;
    }
}