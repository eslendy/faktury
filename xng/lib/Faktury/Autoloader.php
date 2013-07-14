<?php

namespace Faktury;

/**
 * A basic autoloader
 */
class Autoloader {

    /**
     * Base path 
     * 
     * @var string
     */
    public static $basePath = '';

    /**
     * Array of prefixes managed by this autoloader
     * 
     * @var array
     */
    public static $prefixes = array();


    /**
     * Autoloads a class
     * 
     * @param  string $className Class name.
     * 
     * @return boolean Return true on success, or false on error.
     */
    public static function autoload($className) {
        $segments = explode('\\', ltrim($className, '\\'));
        if (in_array($segments[0], self::$prefixes)) {
            $filename = self::$basePath . '/' . str_replace('\\', '/', $className) . '.php';
            if (file_exists($filename)) {
                require $filename;
                return true;
            }
        } 
        return false;
    }

}