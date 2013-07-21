<?php

namespace Faktury\Cache;

class Memory {
    
    /**
     * Just a simple associative array.
     * 
     * @var array
     */
    protected $_data;


    /**
     * Constructor
     * 
     */
    public function __construct() {
        $this->_data = array();
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
        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        } else {
            return null;
        }
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
        $this->_data[$key] = $value;    // expiration time is ignored
        return true;
    }


    /**
     * Removes a key from cache
     * 
     * @param  string $key   Key used to store the value
     * 
     * @return boolean Returns true on success, or false on failure
     */
    public function remove($key) {
        unset($this->_data[$key]);
        return true;
    }


}