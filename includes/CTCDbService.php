<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './resources/CTCCodes.php';
require_once './entities/sites.php';

class CTCDbService extends mysqli {

    /** 单例变量 */
    private static $instance = null;

    /** 数据库配置 */
    private $user = DB_USER;
    private $pass = DB_PWD;
    private $dbName = DB_NAME;
    private $dbHost = DB_HOST;

    /**
     * 实例
     * @return type
     */
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct() {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
        parent::query("SET NAMES utf8");
    }

    public function get_wisher_id_by_name($name) {

        $name = $this->real_escape_string($name);

        $wisher = $this->query("SELECT id FROM wishers WHERE name = '"
                . $name . "'");
        if ($wisher->num_rows > 0) {
            $row = $wisher->fetch_row();
            return $row[0];
        } else
            return null;
    }

    public function get_wishes_by_wisher_id($wisherID) {
        return $this->query("SELECT id, description, due_date FROM wishes WHERE wisher_id=" . $wisherID);
    }

    public function create_wisher($name, $password) {
        $name = $this->real_escape_string($name);
        $password = $this->real_escape_string($password);
        $this->query("INSERT INTO wishers (name, password) VALUES ('" . $name . "', '" . $password . "')");
    }

    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

}

/**
 * 站点配置管理类
 */
class SiteService {
    
    public function getSiteByName($name) {
          
        $dbServ = CTCDbService::getInstance();
        $siteName = $dbServ->real_escape_string($name);

        $results = $dbServ->query("SELECT * FROM ctc_dcload WHERE site_name like '%"
                . $siteName . "%'");
        while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            $list[] = $row;
        }
        return $list;
    }
    
    public function createSite($site) {
        if(!$site) {
            die("无站点信息");
        } else {
            $dbServ = CTCDbService::getInstance();
            $sql = "insert into ctc_dcload (site_area, site_code, site_name, share_info, meter_user, yd_dcload, lt_dcload, dx_dcload, remark) "
                    . "values ('". $site->getSiteArea()
                    ."','". $site->getSiteCode()."','". $site->getSiteName()."','". $site->getShareInfo()
                    ."','". $site->getMeterUser()."',". strval($site->getYdDcload())
                    .",". strval($site->getLtDcload()) .",". strval($site->getDxDcload()) .",'". $site->getRemark(). "')";
            $dbServ->query($sql);
            if ($dbServ->errno != 0) {
                throw new Exception($dbServ->error);
            }
        }
    }
    
    public function updateSite($site) {
        if(!$site) {
            die("无站点信息");
        } else {
            $dbServ = CTCDbService::getInstance();
            $sql = "update ctc_dcload set site_area = '". $site->getSiteArea() . "', site_code = '"
                    . $site->getSiteCode() . "', site_name = '" . $site->getSiteName() . "', share_info = '" 
                    . $site->getShareInfo() . "', meter_user = '" . $site->getMeterUser() . "', yd_dcload = " 
                    . strval($site->getYdDcload()) . ", lt_dcload = " . strval($site->getLtDcload()) .  ", dx_dcload = "
                    . strval($site->getDxDcload()) . ", remark = '"
                    . $site->getRemark() . "' where dc_id = " . strval($site->getDcId());
            $dbServ->query($sql);
            if ($dbServ->errno != 0) {
                throw new Exception($dbServ->error ."<br/>" . $sql);
            }
        }
    }
    
    public function deleteSite($dcId) {
        if($dcId <= 0) {
            die("无站点信息");
        } else {
            $dbServ = CTCDbService::getInstance();
            $sql = "delete from ctc_dcload where dc_id = " . strval($dcId);
            $dbServ->query($sql);
            if ($dbServ->errno != 0) {
                throw new Exception($dbServ->error ."<br/>" . $sql);
            }
        }
    }
}
