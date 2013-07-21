<?php

namespace Faktury\Data;

/**
 * A Repository for PornStars
 */
class FakturyRepository extends AbstractRepository {

    public function __construct() {
        parent::__construct();
    }

    public function FindIdParentBySeoName($seo_name) {
       
        if ($seo_name != '') {
             $sql = "SELECT * FROM `menu` where enlace = '$seo_name'";
            return $this->_db->fetchOne($sql);
        }
    }

}
