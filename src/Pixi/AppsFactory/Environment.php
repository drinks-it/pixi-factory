<?php

namespace Pixi\AppsFactory;
/**
 * @property of pixi*Software GmbH
 * @author mantolovic
 * @date 18.9.2014
 */

/**
 * Description of Enviroment
 *
 * @author mantolovic
 */
class Environment
{

    const ENV_LOCAL = 1;
    const ENV_STAGE = 2;
    const ENV_LIVE = 3;
    const ENV_UNKNOWN = 4;
    
    const LOCALUSER = 'LocalUser';
    const CRONUSEER = 'CronUser';
    const APPACCESSUSER = 'AppAccessUser';

    public static $environment;
    public static $user;
    public static $customer;
    public static $appId;


    public static function getEnvironment()
    {
        if (isset(static::$environment)) {
            return static::$environment;
        }
        
        if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1') {
            static::$environment = static::ENV_LOCAL;
        } elseif ($_SERVER['HTTP_HOST'] == 'apps-stage.pixi.eu' || stropos($_SERVER['HTTP_HOST'], 'app-stage')) {
            static::$environment = static::ENV_STAGE;
        } elseif ($_SERVER['HTTP_HOST'] == 'apps-live.pixi.eu' || stropos($_SERVER['HTTP_HOST'], 'app-deploy')) {
            static::$environment = static::ENV_LIVE;
        } else {
            static::$environment = self::ENV_UNKNOWN;
        }
        
        return static::$environment;
    }
    
    public static function getUser()
    {
        if (isset(static::$user)) {
            return static::$user;
        }

        if (isset($_SESSION['userinfo']['pixi_username']) && $_SESSION['userinfo']['pixi_username'] == 'appaccess') {
            static::$user = static::APPACCESSUSER;
            static::$user = $_SESSION['userinfo']['pixi_username'];
        } elseif (isset($_SESSION['userinfo']['pixi_username']) && $_SESSION['userinfo']['pixi_username'] == 'cronaccess') {
            static::$user = static::CRONUSEER;
        } elseif (isset($_SESSION['userinfo']['pixi_username'])) {
            static::$user = $_SESSION['userinfo']['pixi_username'];
        } else {
            static::$user = static::LOCALUSER;
        }

        return static::$user;
    }
    
    public static function getCustomer()
    {
        if (isset(static::$customer)) {
            return static::$customer;
        }
        
        return static::$customer = $_SESSION['userinfo']['pixi_db'];
    }
    
    public static function getAppId()
    {
        if (defined('APPID')) {
            return static::$appId = APPID;
        } else {
            return static::$appId = 'Not defined';
        }
    }
}

