<?php

namespace Faktury\Validation;

/**
 * An Exception for validations
 * 
 * <code>
 * <?php
 *      ...
 *      try {
 *          $user->save($_POST);
 *      } catch (\Faktury\Validation\Exception $ve) {
 *          $validationErrors = $ve->getValidationErrors();
 *      }
 *      ---
 * ?>
 * </code>
 */
class Exception extends \Exception {

    /**
     * Array containing validation errors
     * 
     * @var array
     */
    protected $_validationErrors = array();
    

    /**
     * Constructor
     * 
     * @param array  $validationErrors Array of validation error messages.
     * @param string  $message         The exception message.
     */
    function __construct($validationErrors, $message = '') {
        $this->validationErrors = $validationErrors;
        parent::__construct($message);
    }

    /**
     * Retrieves an array of validation errors
     * 
     * @return array Returns an array of validation errors
     */
    function getValidationErrors() {
        return $this->validationErrors;
    }   
    
}