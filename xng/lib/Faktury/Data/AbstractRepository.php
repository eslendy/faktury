<?php
namespace Faktury\Data;

/**
 * A Base Repository
 *
 */
abstract class AbstractRepository {

    /**
     * Database connection
     * 
     * @var \Faktury\Db\ConnectionInterface
     */
    protected $_db;

    /**
     * Cache component
     * 
     * @var \Faktury\Cache\File
     */
    protected $_cache;


    /**
     * Path where cached files are stored
     * 
     * @var string
     */
    protected $_cachePath  = '';


    /**
     * Constructor
     */
    public function __construct() {
        $this->_db = new \Faktury\Db\MySqlExtensionConnection();
        //$cacheFolder = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/cache/data';
        //$this->setCachePath($cacheFolder);
        $this->setCache(new \Faktury\Cache\Memcache());
    }


    /**
     * Creates an array with requested parameters.
     * 
     * @param  array $data       Associative array of data
     * @param  array $paramNames Array of names of parameters
     * @param  array $toSanitize Array of columns to sanitize
     * 
     * @return array Returns an associative array with parameters filled with data.
     */
    protected function createParams($data, $paramNames, $toSanitize = array()) {
        if (!is_array($data))
            $data = array();
        $params = array();
        foreach ($paramNames as $paramName) {
            $params[$paramName] = isset($data[$paramName]) ? $data[$paramName] : '';
        }
        foreach($toSanitize as $paramName) {
            $params[$paramName] = $this->sanitizeString($data[$paramName]);
        }
        return $params;
    }


    /**
     * Sanitizes a string
     * 
     * @param  string $s String to be sanitized
     * 
     * @return string Returns a string sanitized
     */
    protected function sanitizeString($s) {
        return filter_var($s, FILTER_SANITIZE_STRING);
    }


    /**
     * Sets the cache component
     * 
     * @param object $cache A valid cache component
     */
    public function setCache($cache) {
        $this->_cache = $cache;
    }


    /**
     * Sets the path where cache files are stored
     * 
     * @param  string $cachePath 
     *
     * @return void 
     */
    public function setCachePath($cachePath) {
        $this->_cachePath = $cachePath;
    }


    /**
     * Retrieves the path where cache files are stored
     * 
     * @return string Returns the path
     */
    public function getCachePath() {
        return $this->_cachePath;
    }


}