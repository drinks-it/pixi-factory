<?php

namespace Pixi\AppsFactory;
    /**
     * @property of pixi*Software GmbH
     * @author cschmitt
     * @date 19.9.2014
     */

/**
 * @author cschmitt
 */
class GoogleAnalytics
{
    /**
     * @return string   js code or the Google Analytics tracking
     */
    public static function getCode(){

        if($_SERVER['SERVER_NAME'] != 'localhost'){
            $id = Environment::getAppId();
        }else{
            $id = 'localApp';
        }


        return "<script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-54919261-1', 'auto');
            ga('set', 'dimension1', '". strtolower($id)."');
            ga('set', 'dimension2', '". Environment::getCustomer() ."');
            ga('set', 'dimension3', '". Environment::getEnvironment() ."');
            ga('set', 'dimension4', '". Environment::getUser() ."');
            ga('send', 'pageview');

        </script>";
    }
}