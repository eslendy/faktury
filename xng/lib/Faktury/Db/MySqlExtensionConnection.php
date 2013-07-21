<?php

namespace Faktury\Db;


/**
 * This class uses the old mysql extension to connect to MySQL.
 *
 * Important: It is not recommended to use the old mysql extension for new development, as it has been deprecated as of PHP 5.5.0 and will be removed in the future.
 *
 * @link http://www.php.net/manual/en/mysqlinfo.api.choosing.php
 */
class MySqlExtensionConnection implements ConnectionInterface {


    /**
     * Runs a query
     * 
     * @param  string $sql    SQL
     * @param  array  $params Optional. Associative array of parameters
     *
     * @throws \Exception on error.
     * 
     * @return mixed For queries returns a resource on success, or false on error. For statements returns true on success or false on error.
     */
    protected function query($sql, $params = array()) {
		$sql = $this->prepare($sql, $params);
		$result = mysql_query($sql);
		if (!$result) throw new \Exception(get_class($this) . '->query() error: Unable to execute query. ' . mysql_errno() . ': ' . mysql_error() . '. (Query "' . $sql . '")');
		return $result;
    }


    public function prepare($sql, $params) {
        $search  = array();
        $replace = array();
        foreach($params as $key => $value) {
            $search[]  = ':' . $key;
            $replace[] = ($value === ''? 'NULL': "'" . mysql_real_escape_string($value) . "'");
        }
        return str_replace($search, $replace, $sql);
    }


    public function execute($sql, $params = array()) {
        $this->query($sql, $params);
        return mysql_affected_rows();
    }


    public function insertAndGetId($sql, $params = array()) {
    	$this->execute($sql, $params);
    	return mysql_insert_id();
    }


    public function fetchAll($sql, $params = array()) {
		$result = $this->query($sql, $params);
		$rows = array();
		while ($row = mysql_fetch_assoc($result)) {
            $rows[] = $row;
		}
		return $rows;
    }


    public function fetchAllPaginated($sql, $params = array(), $itemsPerPage, $isFirstPage) {
        $data = $this->fetchAll($sql, $params);
        if (!is_array($data)) {
            return false;
        }
        $results = array(
            'prevPage' => false,
            'nextPage' => false,
            'data'     => array()
        );
        if ($isFirstPage) {
            if (count($data) > $itemsPerPage) {
                $results['nextPage'] = true;
                $results['data'] = array_slice($data, 0, $itemsPerPage); // First N items
            } else {
                $results['data'] = $data;   // All items.
            }
        } else {
            if (!empty($data)) {
                if (count($data) == $itemsPerPage + 2) {  // N items in the middle. Prev & Next
                    $results['prevPage'] = true;
                    $results['nextPage'] = true;
                    $results['data'] = array_slice($data, 1, $itemsPerPage);
                } else {  // Pop first item (last seen). Prev
                    $results['prevPage'] = true;
                    array_shift($data);
                    $results['data'] = $data;
                }
            }
        }
        return $results;
    }


	public function fetchPairs($sql, $params = array()) {
        $result = $this->query($sql, $params);
        $rows = array();
        while ($row = mysql_fetch_array($result)) {
            $rows['' . $row[0]] = $row[1] . '';
        }
        return $rows;
    }


    public function fetchOne($sql, $params = array()) {
        $result = $this->query($sql, $params);
        if (mysql_num_rows($result) == 0) return false;
        return mysql_fetch_assoc($result);
    }


    public function fetchValue($sql, $params = array()) {
        $result = $this->query($sql, $params);
        if (mysql_num_rows($result) == 0) return false;
        $a = mysql_fetch_array($result);
        return $a[0];
    }


}
