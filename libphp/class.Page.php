<?php
define('DS', DIRECTORY_SEPARATOR);
define('XNG_BASE_PATH', $folders['absoluta']);
define('XNG_WEBSITE_URL', $SERVER_NAME);
class Page {

    private $_vars = array();

    public function __construct() {
        
    }
    
    public static function loadVars() {
        $init_values = array();
        $init_values['XNG_WEBSITE_URL'] = XNG_WEBSITE_URL;
        $init_values['SESSION_USER_ID'] = ((isset($_SESSION["userid"]))) ? $_SESSION["userid"] : 0;
        $init_values['SESSION_ACTIVE'] = ((isset($_SESSION['userid']))) ? true : false;
        $init_values['XNG_URI_QUERY'] = $_SERVER['REQUEST_URI'];
        $init_values['XNG_SERVER_NAME'] = $_SERVER['SERVER_NAME'];
        $init_values['XNG_PARAMS'] = $_REQUEST;
        $init_values['XNG_MOBILE'] = self::isMobile();
        return $init_values;
    }

    public static function isMobile() {


        if (preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
            return true;
        else
            return false;
    }

    public static function loadClass($name) {

        $file = XNG_CLASS_PATH . 'class.' . $name . '.php';

        if (file_exists($file)) {
            require_once($file);
        }
    }
    
    public static function clean_string($string){
        return strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($string))));
    }
    /**
     * Returns logged user Id
     */
    public static function getUserId() {
        $returnValue = 0;
        if (isset($_SESSION["userid"])) {
            $returnValue = $_SESSION["userid"];
        }
        return $returnValue;
    }

    public static function getRandomContainerGallery() {
        $returnValue = 0;
        self::loadClass('FileAccess');
        $returnValue = FileAccess::getRandomUrl();
        return $returnValue;
    }

    public static function getContentInAjax($filename) {
        if (is_file($filename)) {
            ob_start();
            include $filename;
            return json_encode(ob_get_clean());
        }
        return false;
    }

    public static function getContentHtml($filename, $Params = array()) {
        if (is_file($filename)) {
            ob_start();
            include $filename;
            return ob_get_clean();
        }
        return false;
    }

    public static function getPageUrl() {
        $returnValue = XNG_WEBSITE_URL;
        if (isset($_SERVER['HTTP_REFERER'])) {
            $returnValue = $_SERVER['HTTP_REFERER'];
        }
        return $returnValue;
    }

    function getDateTimeFromString($str) {
        $date = DateTime::createFromFormat('d-m-y', $str);
        if ($date !== false)
            return $date;

        return new DateTime($str);
    }

    public static function FormValidator() {
        self::loadClass('FormValidator');
        return new FormValidator();
    }

    public static function merge_object($obj, $obj2) {
        $vars = get_object_vars($obj2);
        foreach ($vars as $var => $value) {
            $obj->$var = $value;
        }
        return $obj;
    }

    public static function getFormatDate($date = '0000-00-00 00:00:00') {

        if (isset($date)) {
            $date = reset(explode(' ', $date));
            $date = explode('-', $date);
            $date = $date[1] . '/' . $date[2] . '/' . $date[0];
        } else {
            return false;
        }
        return $date;
    }

    public static function isValidatedAffiliated() {
        $User = self::getUserAffiliated();
        if ($User['validate'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function getPercentAccountStatus($totalVideos = 0, $totalSites = 0) {
        $User = self::getUserAffiliated();
        $RepoAfilliates = new \Masturbate\Data\AffiliateRepository();
        $Percent = 0;
        if ($User) {
            $Percent += 15;
        }
        if ($User['validate'] == 1) {
            $Percent += 25;
        }
        if ($totalVideos > 0) {
            $Percent += 30;
        }
        if ($totalSites > 0) {
            $Percent += 30;
        }
        return $Percent . '%';
    }

    public static function isLoggedAffiliate() {
        return (isset($_SESSION['user_affiliate_id'])) ? TRUE : FALSE;
    }

    public static function isLoggedUser() {
        return (isset($_SESSION['userid'])) ? TRUE : FALSE;
    }
    
    public static function getUserIdAffiliate() {
        $UserId = 0;
        if (self::isLoggedAffiliate()) {
            $UserId = $_SESSION['user_affiliate_id'];
        }
        return $UserId;
    }

    public static function getUserAffiliated($UserId = false) {
        $Affiliates = new \Masturbate\Data\AffiliateRepository();
        if (!$UserId) {
            if (self::isLoggedAffiliate()) {
                $UserSession = $Affiliates->findUserAffiliateById(self::getUserIdAffiliate());
            } 
            else{
                $UserSession = false;
            }
        } else {
            $UserSession = $Affiliates->findUserAffiliateById($UserId);
        }
        return $UserSession;
    }
    
     public static function getDataUserAffiliated($UserId = false) {
        $Affiliates = new \Masturbate\Data\AffiliateRepository();
        if (!$UserId) {
            if (self::isLoggedAffiliate()) {
                $UserSession = $Affiliates->findUserAffiliateById(self::getUserIdAffiliate());
            } 
            else{
                $UserSession = false;
            }
        } else {
            $UserSession = $Affiliates->findUserAffiliateById($UserId);
        }
        return $UserSession;
    }
    
    public static function getUser($UserId = false) {
        $Pics = new \Masturbate\Data\PhotoRepository();
        if (!$UserId) {
            $UserId = (($_SESSION['userid'])) ? $_SESSION['userid'] : FALSE;
        }

        if ($UserId) {
            $UserSession = $Pics->findUserById($UserId);
        } else {
            $UserSession = array('username' => 'Anonymus', 'record_num' => 0);
        }
        return $UserSession;
    }

    public static function getUserById($UserId = null) {
        return self::getUser($UserId);
    }

    public function setVar($name, $value) {
        $this->_vars[$name] = $value;
        return true;
    }

}
