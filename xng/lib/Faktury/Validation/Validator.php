<?php

namespace Faktury\Validation;

class Validator {

    /**
     * Array of items. This array contains rules and messages.
     * 
     * @var array
     */
    protected $_items = array();

    /**
     * Array of validation errors.
     * 
     * @var array
     */
    protected $_validationErrors = array();

    /**
     * Name of last item added. 
     *  
     * @var string
     */
    protected $_lastItemName = '';

    /**
     * Name of last rule added
     * 
     * @var string
     */
    protected $_lastRuleName = '';

    
    /**
     * Adds an item to the validator chain
     * 
     * @param  string $itemName           Item Name
     * @param  string $itemLabelToDisplay Optional. A custom string to display in error messages (e.g. "Credit Card" instead of "creditCard_id")
     *
     * @return \Faktury\Validation\Validation Returns itself (it's a fluent interface).
     */
    public function addItem($itemName, $itemLabelToDisplay = ''){
        $this->_items[$itemName] = array(
            'rules' => array(),
            'label' => ($itemLabelToDisplay == ''? $itemName: $itemLabelToDisplay)
        );
        $this->_lastItemName = $itemName;
        $this->_lastRuleName = '';
        return $this;
    }


    /**
     * Attaches a validation rule to an item,
     * 
     * @param string $ruleName   Rule Name. A rule is the name of a method of this class able to perform a single validation (e.g. "required").
     * @param array  $ruleParams Optional. Associative array of parameters for the rule (e.g. array('regex' => '/^sitemaps/'));
     *
     * @return \Faktury\Validation\Validation Returns itself (it's a fluent interface).
     */
    public function setRule($ruleName, $ruleParams = array()) {
        $this->_items[$this->_lastItemName]['rules'][$ruleName] = array(
            'ruleParams'  => $ruleParams,
            'ruleMessage' => ''
        );
        $this->_lastRuleName = $ruleName;
        return $this;
    }

    
    /**
     * Attaches a custom message to the last validation rule added.
     * 
     * @param  string $ruleMessage A message. It can optionally contain a placeholder for the label. (e.g.; "{{label}} is not a valid email")
     * 
     * @return \Faktury\Validation\Validation Returns itself (it's a fluent interface).
     */
    public function withMessage($ruleMessage) {
        $this->_items[$this->_lastItemName]['rules'][$this->_lastRuleName]['ruleMessage'] = $ruleMessage;
        return $this;
    }


    /**
     * Retrieves the default message for a rule.
     * 
     * @param  string $ruleName Rule name
     * 
     * @return string Returns the default message on success, or an empty string if not found.
     */
    public function getRuleMessage($ruleName) {
        $messages = array(
            'required'          => '{{label}} cannot be blank.',
            'binary'            => '{{label}} must be 0 or 1.',
            'maxStringLength'   => '{{label}} is more than {{max}}} characters long.',
            'minStringLength'   => '{{label}} is less than {{min}} characters long.',
            'integer'           => '{{label}} is not an integer number.',
            'unsignedInteger'   => '{{label}} is not an unsigned integer number.',
            'inArray'           => '{{label}} is not a valid option.',
            'regex'             => '{{label}} does not match against pattern.',
            'id'                => '{{label}} is not a valid ID.',
            'ip'                => '{{label}} is not a valid IP address.',
            'date'              => '{{label}} is not a valid date.',
            'dateTime'          => '{{label}} is not a valid datetime.'
        );
        return (isset($messages[$ruleName])? $messages[$ruleName]: '{{label}} is not valid');
    }


    /**
     * Validates an associative array against rules.
     * 
     * @param  array   $data Associative array of data to validate,
     *
     * @throws \InvalidArgumentException If a rule does not exist
     * 
     * @return boolean Returns true if data is valid, otherwise false.
     */
    public function isValid($data) {
        $this->_validationErrors = array();
        foreach($this->_items as $itemName => $itemInfo) {
            $label = $itemInfo['label'];
            $rules = $itemInfo['rules'];
            foreach ($rules as $ruleName => $ruleInfo) {
                $ruleParams  = $ruleInfo['ruleParams'];
                $isValid = false;
                $valueToTest = isset($data[$itemName])? $data[$itemName]: '';
                if (method_exists($this, $ruleName)) {
                    $isValid = $this->$ruleName($valueToTest, $ruleParams);
                } else {
                    $x = strpos($ruleName, '::');
                    $found = false;
                    if ($x !== false) {
                        $className  = substr($ruleName, 0, $x);
                        $methodName = substr($ruleName, $x + 2);
                        if (method_exists($className, $methodName)) {
                            $isValid = $className::$methodName($valueToTest, $ruleParams);
                            $found = true;
                        }
                    }
                    if (!$found) {
                        throw new \InvalidArgumentException(get_class($this) . '->isValid() Message: Rule does not exist ("' . $ruleName . '")');    
                    }
                }
                if (!$isValid) {
                    $ruleMessage = $ruleInfo['ruleMessage'];
                    if ($ruleMessage == '') $ruleMessage = $this->getRuleMessage($ruleName);
                    $ruleMessage = str_replace('{{label}}', $label, $ruleMessage);
                    if (!empty($ruleParams)) {
                        foreach($ruleParams as $ruleParamKey => $ruleParamValue) {
                            if (is_string($ruleParamValue)) {
                                $ruleMessage = str_replace('{{' . $ruleParamKey . '}}', $ruleParamKey, $ruleParamValue);
                            }
                        }
                    }
                    if (!isset($this->_validationErrors[$itemName])) {
                        $this->_validationErrors[$itemName] = array();
                    }
                    $this->_validationErrors[$itemName][$ruleName] = $ruleMessage;
                }
            }
        }
        return (count($this->_validationErrors) == 0);
    }


    /**
     * Retrieves an array of validation errors created by the method "isValid"
     * 
     * @return array Returns an array of validation errors
     */
    public function getValidationErrors() {
        return $this->_validationErrors;
    }


    /**
     * Rule: required
     *
     * <code>
     * <?php
     *      $validator = new \Faktury\Validation\Validator();
     *      if ($validator->required($value)) {
     *          echo('Valid!');
     *      }
     * ?>
     * </code>
     * 
     * @param  mixed $value      Value to test
     * @param  array $ruleParams Not used here.
     * 
     * @return bool Returns true on success, otherwise false
     */
    public function required($value, $ruleParams = array()) {
        if (is_object($value)) return false;
        return ($value . '' != '');
    }


    /**
     * Rule: maxStringLength - Allows to validate if the length in characters of a given value equals to or greather than a defined length. 
     *
     * <code>
     * <?php
     *      $validator = new \Faktury\Validation\Validator();
     *      if ($validator->maxStringLength($value, array('max' => 10)) {
     *          echo('Valid!');
     *      }
     * ?>
     * </code>
     * 
     * @param  mixed $value      Value to test
     * @param  array $ruleParams Value for key 'max' is the maximum string length allowed.
     *
     * @throws \InvalidArgumentException If parameter 'max' is missing
     * 
     * @return bool Returns true on success, otherwise false
     */
    public function maxStringLength($value, $ruleParams) {
        if (is_object($value) || (is_null($value) || $value === false)) return false;
        if (!isset($ruleParams['max'])) {
            throw new \InvalidArgumentException(get_class($this) . '->maxStringLength() error: Missing parameter ("max")');
        }
        $value = $value . '';
        return mb_strlen($value) <= intval($ruleParams['max']);
    }


    /**
     * Rule: minStringLength - Allows to validate if the length in characters of a given value is lower than or equals to a defined length. 
     *
     * <code>
     * <?php
     *      $validator = new \Faktury\Validation\Validator();
     *      if ($validator->minStringLength($value, array('min' => 5)) {
     *          echo('Valid!');
     *      }
     * ?>
     * </code>
     * 
     * @param  mixed $value      Value to test
     * @param  array $ruleParams Value for key 'min' is the minimum allowed length for the string.
     *
     * @throws \InvalidArgumentException If parameter 'min' is missing
     * 
     * @return bool Returns true on success, otherwise false
     */
    public function minStringLength($value, $ruleParams) {
        if (is_object($value)) return false;
        $value = $value . '';
        if (!isset($ruleParams['min'])) {
            throw new \InvalidArgumentException(get_class($this) . '->minStringLength() Message: Missing parameter ("min")');
        }
        return mb_strlen($value) >= intval($ruleParams['min']);
    }


    /**
     * Rule: id - Allows to validate if a given value is a standard ID (unsigned integer number greather than zero)
     *
     * <code>
     * <?php
     *      $validator = new \Faktury\Validation\Validator();
     *      if ($validator->id($value)) {
     *          echo('Valid!');
     *      }
     * ?>
     * </code>
     * 
     * @param  mixed $value      Value to test
     * @param  array $ruleParams Not used here.
     * 
     * @return bool Returns true on success, otherwise false
     */
    public function id($value, $ruleParams = array()) {
        if (is_object($value)) return false;
        $value = $value . '';
        return $this->unsignedInteger($value, $ruleParams = array()) && $value != '0';
    }


    /**
     * Rule: integer - Allows to validate if a given value is an integer number
     *
     * <code>
     * <?php
     *      $validator = new \Faktury\Validation\Validator();
     *      if ($validator->integer($value)) {
     *          echo('Valid!');
     *      }
     * ?>
     * </code>
     * 
     * @param  mixed $value      Value to test
     * @param  array $ruleParams Not used here.
     * 
     * @return bool Returns true on success, otherwise false
     */
    public function integer($value, $ruleParams = array()) {
        if (is_object($value)) return false;
        return (!preg_match("/^\s*[-]?\d+\s*$/", $value . ''))? false: true;
    }


    /**
     * Rule: unsignedInteger - Allows to validate if a given value is an unsigned integer number
     *
     * <code>
     * <?php
     *      $validator = new \Faktury\Validation\Validator();
     *      if ($validator->unsignedInteger($value)) {
     *          echo('Valid!');
     *      }
     * ?>
     * </code>
     * 
     * @param  mixed $value      Value to test
     * @param  array $ruleParams Not used here.
     * 
     * @return bool Returns true on success, otherwise false
     */
    public function unsignedInteger($value, $ruleParams = array()) {
        if (is_object($value)) return false;
        return ctype_digit($value . '');
    }


    /**
     * Rule: inArray - Allows to validate if a given value is member of an array
     *
     * <code>
     * <?php
     *      $validator = new \Faktury\Validation\Validator();
     *      if ($validator->inArray($value, array('validValues' => array('1', '2')) {
     *          echo('Valid!');
     *      }
     * ?>
     * </code>
     * 
     * @param  mixed $value      Value to test
     * @param  array $ruleParams Value for key 'validValues' is an array of valid elements.
     *
     * @throws \InvalidArgumentException If parameter 'validValues' is missing
     * 
     * @return bool Returns true on success, otherwise false
     */
    public function inArray($value, $ruleParams) {
        if (is_object($value)) return false;
        if (!isset($ruleParams['validValues'])) {
            throw new \InvalidArgumentException(get_class($this) . '->inArray() error: Missing parameter ("validValues")');
        }
        $validValues = array();
        foreach ($ruleParams['validValues'] as $validValue) {
            $validValues[] = $validValue . '';
        }
        return in_array($value . '', $validValues);
    }


    /**
     * Rule: binary - Allows to validate if a given value is a binary digit ('0' or '1')
     *
     * <code>
     * <?php
     *      $validator = new \Faktury\Validation\Validator();
     *      if ($validator->binary($value)) {
     *          echo('Valid!');
     *      }
     * ?>
     * </code>
     * 
     * @param  mixed $value      Value to test
     * @param  array $ruleParams Not used here.
     * 
     * @return bool Returns true on success, otherwise false
     */
    public function binary($value, $ruleParams = array()) {
        if (is_object($value)) return false;
        $value = $value . '';
        return $value == '0' || $value == '1';
    }


    /**
     * Rule: regex - Allows to validate if a given value conforms a defined regular expression.
     * 
     * <code>
     * <?php
     *      $validator = new \Faktury\Validation\Validator();
     *      if ($validator->regex($value, array('pattern' => '/^Once upon a time/')) {
     *          echo('Valid!');
     *      }
     * ?>
     * </code>
     *
     * @param  mixed $value      Value to test
     * @param  array $ruleParams Value for key 'pattern' is the regular expression 
     *
     * @throws \InvalidArgumentException If parameter 'pattern' is missing
     * 
     * @return bool Returns true on success, otherwise false
     */    
    public function regex($value, $ruleParams) {
        if (is_object($value)) return false;
        if (!isset($ruleParams['pattern'])) {
            throw new \InvalidArgumentException(get_class($this) . '->regex() error: Missing parameter ("pattern")');
        }
        return preg_match($ruleParams['pattern'], $value . '') > 0;
    }


    /**
     * Rule: ip - Allows to validate if an IP address is valid.
     * 
     * <code>
     * <?php
     *      $validator = new \Faktury\Validation\Validator();
     *      if ($validator->ip($value)) {
     *          echo('Valid!');
     *      }
     * ?>
     * </code>
     *
     * @param  mixed $value      Value to test
     * @param  array $ruleParams Not used here.
     *
     * @return bool Returns true on success, otherwise false
     */    
    public function ip($value, $ruleParams = array()) {
        if (is_object($value)) return false;
        $l = ip2long($value);
        return $l !== -1 && $l !== false;
    }


    /**
     * Rule: date - Allows to validate if a given value is a date in ISO format ('yyyy-mm-dd')
     * 
     * <code>
     * <?php
     *      if (\Lite\Validation\Validator::date($value)) {
     *          echo('Valid!');
     *      }
     * ?>
     * </code>
     * 
     * @param  mixed $value      Value to test
     * @param  array $ruleParams Not used here.
     * 
     * @return bool Returns true on success, otherwise false
     */
    public function date($value, $ruleParams = array()) {
        if (is_object($value)) return false;
        $value = $value . '';
        if (mb_strlen($value) != 10) return false;
        list($y, $m, $d) = explode('-', $value);
        return checkdate($m, $d, $y);
    }

    
    /**
     * Rule: dateTime - Allows to validate if a given value is a datetime in ISO format ('yyyy-mm-dd hh:mm:ss')
     * 
     * <code>
     * <?php
     *      if (\Lite\Validation\Validator::dateTime($value)) {
     *          echo('Valid!');
     *      }
     * ?>
     * </code>
     * 
     * @param  mixed $value      Value to test
     * @param  array $ruleParams Not used here.
     * 
     * @return bool Returns true on success, otherwise false
     */
    public function dateTime($value, $ruleParams = array()) {
        if (is_object($value)) return false;
        $datetime = \DateTime::createFromFormat('Y-m-d H:i:s', $value, new \DateTimeZone('UTC'));
        $errors   = \DateTime::getLastErrors();
        return ($errors['warning_count'] + $errors['error_count'] === 0);
    }    

}