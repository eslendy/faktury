<?php

namespace Faktury\Db;

/**
 * This class provides a generic API to access data stored in a relational database.
 */
 interface ConnectionInterface {

    /**
     * Replaces named parameters in a SQL string for real values.
     * 
     * @param  string $sql    SQL
     * @param  array  $params Optional. Associative array of parameters
     * 
     * @return string Returns a SQL string.
     */
    public function prepare($sql, $params);


    /**
     * Executes an SQL statement and return the number of affected rows.
     * 
     * @param  string $sql    SQL
     * @param  array  $params Optional. Associative array of parameters
     * 
     * @return bool Returns the number of affected rows on success, or -1 if the last query failed.
     */
    public function execute($sql, $params = array());


    /**
     * Creates a new row and returns the last ID generated
     * 
     * @param  string $sql    SQL
     * @param  array  $params Optional. Associative array of parameters
     *
     * @return int Returns the last ID generated, or 0 if the previous query does not generate an AUTO_INCREMENT value
     */
    public function insertAndGetId($sql, $params = array());


    /**
     * Retrieves a sequential array of all rows.
     * 
     * @param  string $sql    SQL
     * @param  array  $params Optional. Associative array of parameters
     * 
     * @return array Returns an array of all rows.
     */
    public function fetchAll($sql, $params = array());


    /**
     * Retrieves an array with paginated data
     * 
     * @param  string $sql          SQL
     * @param  array  $params       Optional. Associative array of parameters     
     * @param  int    $itemsPerPage Number of items per page
     * @param  bool   $isFirstPage  True if you are retrieving the first page, otherwise false
     * 
     * @return array Returns an array with paginated data
     */
    public function fetchAllPaginated($sql, $params = array(), $itemsPerPage, $isFirstPage);


    /**
     * Retrieves an associative array of two columns. Each key is the first column and each value is the second column.
     * 
     * @param  string $sql    SQL
     * @param  array  $params Optional. Associative array of parameters.
     * 
     * @return array Returns an associative array of all rows.
     */
    public function fetchPairs($sql, $params = array());


    /**
     * Retrieves a single row where the keys are the column names.
     * 
     * @param  string $sql    SQL
     * @param  array  $params Optional. Associative array of parameters.
     * 
     * @return array Returns an associative array on success, or false if the row is not found.
     */
    public function fetchOne($sql, $params = array());


    /**
     * Returns a single value from a query. The value is the first column in the first row
     * 
     * @param  string $sql    SQL
     * @param  array  $params Optional. Associative array of parameters.
     * 
     * @return string Returns the value as a string on success, or false if the value is not found.
     */
    public function fetchValue($sql, $params = array());

}


