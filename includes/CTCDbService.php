<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './resources/CTCCodes.php';
require_once './entities/projects.php';

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
 * 工程进度管理类
 */
class ProjectPlanService {
    
    public function getProjectByName($name) {
          
        $dbServ = CTCDbService::getInstance();
        $projectName = $dbServ->real_escape_string($name);

        $results = $dbServ->query("SELECT * FROM ctc_projectinfo WHERE project_name like '%"
                . $projectName . "%'");
        while ($row = mysqli_fetch_array($results)) {
            $status = project::displayProStatusByParam($row['pro_status']);
            $row['pro_status'] = $status;
            $list[] = $row;
        }
        return $list;
    }
    
    public function createProject($project) {
        if(!$project) {
            die("无工程信息");
        } else {
            $dbServ = CTCDbService::getInstance();
            $sql = "insert into ctc_projectinfo (project_aera, project_name, project_code, site_code, constr_type,"
                    . "constr_detail, yd_pc, dx_pc, lt_pc) values ('". $project->getProjectAera()
                    ."','". $project->getProjectName()."','". $project->getProjectCode()."','". $project->getSiteCode()
                    ."','". $project->getConstrType()."','". $project->getConstrDetail()
                    ."','". $project->getYdPc()."','". $project->getLtPc()."','". $project->getDxPc(). "')";
            $dbServ->query($sql);
            if ($dbServ->errno != 0) {
                throw new Exception($dbServ->error);
            }
        }
    }
    
    public function updateProject($project) {
        if(!$project) {
            die("无工程信息");
        } else {
            $dbServ = CTCDbService::getInstance();
            $sql = "update ctc_projectinfo set project_aera = '". $project->getProjectAera() . "', project_code = '"
                    . $project->getProjectCode() . "', site_code = '" . $project->getSiteCode() . "', constr_type = '" 
                    . $project->getConstrType() . "', constr_detail = '" . $project->getConstrDetail() . "', yd_pc = '" 
                    . $project->getYdPc() . "', dx_pc = '" . $project->getDxPc() .  "', lt_pc = '"
                    . $project->getLtPc() . "' where project_id = " . strval($project->getProjectId());
            $dbServ->query($sql);
            if ($dbServ->errno != 0) {
                throw new Exception($dbServ->error ."<br/>" . $sql);
            }
        }
    }
    
    public function deleteProject($projectId) {
        if($projectId <= 0) {
            die("无工程信息");
        } else {
            $dbServ = CTCDbService::getInstance();
            $sql = "delete from ctc_projectinfo where project_id = " . strval($projectId);
            $dbServ->query($sql);
            if ($dbServ->errno != 0) {
                throw new Exception($dbServ->error ."<br/>" . $sql);
            }
        }
    }
}
