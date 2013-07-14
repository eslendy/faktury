<?php

namespace Faktury\Cache;

class Memcached {
    
    /**
     * Memcache instance
     * 
     * @var \Memcache
     */
    protected $_memcached;


    /**
     * Constructor
     * 
     * @param string $host Memcached host
     * @param int $port    Memcached port
     */
    public function __construct($host = 'localhost', $port = '11211') {
        $this->_memcached = new \Memcached();
        $this->_memcached->addServer($host, $port);
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
        $value = $this->_memcached->get($key);
        if ($value === false) $value = null;
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
        return $this->_memcached->set($key, $value, $expirationInSeconds);
    }


    /**
     * Removes a key from cache
     * 
     * @param  string $key   Key used to store the value
     * 
     * @return boolean Returns true on success, or false on failure
     */
    public function remove($key) {
        return $this->_memcached->delete($key);
    }


}