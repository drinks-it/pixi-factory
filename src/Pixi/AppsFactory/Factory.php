<?php

namespace Pixi\AppsFactory;

class Factory
{
    
    private static $options;
    
    private static $objects;
    
    public static function createObject($objectName, $optionsKey = false, $objectKey = false)
    {
        if($objectKey) {
        	
            if(isset(Factory::$objects[$objectKey]) AND Factory::$objects[$objectKey] instanceof $objectName) {
            	
                return Factory::$objects[$objectKey];
                
            } else {
            	
                $object = new $objectName;
                
                if($optionsKey AND method_exists($object, 'setPixiOptions')) {
                    $object->setPixiOptions(Factory::$options[$optionsKey]);
                }
                
                Factory::$objects[$objectKey] = $object;
                
                return Factory::$objects[$objectKey];
                
            }
            
        }
        
        $object = new $objectName;
        
        if($optionsKey AND method_exists($object, 'setPixiOptions')) {
            $object->setPixiOptions(Factory::$options[$optionsKey]);
        }
        
        return $object;
        
    }
    
    public static function addOption($key, $options)
    {
    	
        Factory::$options[$key] = $options;
        
    }
}
