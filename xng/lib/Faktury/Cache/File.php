<?php

namespace Faktury\Cache;

class File {
    
    /**
     * Base path where cached files are stored
     * 
     * @var string
     */
    protected $_basePath = '';


    /**
     * Constructor
     * 
     * @param array Array of settings. 'basePath' = Base folder where cache files are stored
     */
    public function __construct($basePath) {
        /*if (!is_dir($basePath)) {
            throw new \InvalidArgumentException('Folder does not exist ("' . $basePath . '")');
        }*/
        $this->_basePath = rtrim($basePath, '/') . '/';
    }


    protected function getCacheFile($key) {
        return $this->_basePath . $key . '.cache';
    }


    /**
     * Retrieves an item from cache
     * 
     * @param  string $key             Key used to store the value
     *
     * @throws \InvalidArgumentException If file is not readable.
     * 
     * @return mixed Retrieves an item on success, or null if item does not exist in cache.
     */
    public function retrieve($key) {
        $cacheFile = $this->getCacheFile($key);
        if (!file_exists($cacheFile)) {
            return null;
        }
        if (!is_readable($cacheFile)) {
            throw new \InvalidArgumentException('Cache file is not readable ("' . $cacheFile . '")');
        }
        $data = file_get_contents($cacheFile);
        $value = null;
        if ($data !== false) {
            $item = unserialize($data);
            $expirationInSeconds = $item['expiration'];
            if ($expirationInSeconds === 0) {
                $value = $item['value'];
            } else {
                // Is cached item alive?
                if (filemtime($cache_file) > (time() - $expirationInSeconds )) {
                    $value = $item['value'];
                } 
            }
        } 
        if (is_null($value)) {   // Try to delete file
            @unlink($cacheFile);
        }
        return $value;
    }


    /**
     * Stores an item into cache
     * 
     * @param  string $key                 Key used to store the value
     * @param  mixed  $value               Value to store
     * @param  int    $expirationInSeconds Expiration time in seconds. 0 = Item does not expire.
     * 
     * @return boolean Returns true on success, or false on failure
     */
    public function store($key, $value, $expirationInSeconds = 0) {
        $item = array(
            'expiration' => $expirationInSeconds,
            'value' => $value
        );
        $cacheFile = $this->getCacheFile($key);
        $bytesWritten = file_put_contents($cacheFile, serialize($item), LOCK_EX);
        return $bytesWritten !== false;
    }


    /**
     * Removes a key from cache
     * 
     * @param  string $key   Key used to store the value
     * 
     * @return boolean Returns true on success, or false on failure
     */
    public function remove($key) {
        $cacheFile = $this->getCacheFile($key);
        $deleted = true;
        if (file_exists($cacheFile)) {
            $deleted = unlink($cacheFile);
        }
        return $deleted;
    }


}