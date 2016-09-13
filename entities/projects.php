<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of projects
 *
 * @author Aaron
 */
class project {
    public $projectId;
    public $projectAera; 
    public $projectName;
    public $projectCode;
    public $siteCode;
    public $constrType;
    public $constrDetail;
    public $ydPc;
    public $dxPc;
    public $ltPc;
    public $proStatus = 0;  /* 0-4:未落实，落实，开工，完工，交付 */
    public $remark; /* 备注信息 */
    public function getProjectId() {
        return $this->projectId;
    }

    public function getProjectAera() {
        return $this->projectAera;
    }

    public function getProjectName() {
        return $this->projectName;
    }

    public function getProjectCode() {
        return $this->projectCode;
    }

    public function getSiteCode() {
        return $this->siteCode;
    }

    public function getConstrType() {
        return $this->constrType;
    }

    public function getConstrDetail() {
        return $this->constrDetail;
    }

    public function getYdPc() {
        return $this->ydPc;
    }

    public function getDxPc() {
        return $this->dxPc;
    }

    public function getLtPc() {
        return $this->ltPc;
    }

    public function getRemark() {
        return $this->remark;
    }

    public function setProjectId($projectId) {
        $this->projectId = $projectId;
    }

    public function setProjectAera($projectAera) {
        $this->projectAera = $projectAera;
    }

    public function setProjectName($projectName) {
        $this->projectName = $projectName;
    }

    public function setProjectCode($projectCode) {
        $this->projectCode = $projectCode;
    }

    public function setSiteCode($siteCode) {
        $this->siteCode = $siteCode;
    }

    public function setConstrType($constrType) {
        $this->constrType = $constrType;
    }

    public function setConstrDetail($constrDetail) {
        $this->constrDetail = $constrDetail;
    }

    public function setYdPc($ydPc) {
        $this->ydPc = $ydPc;
    }

    public function setDxPc($dxPc) {
        $this->dxPc = $dxPc;
    }

    public function setLtPc($ltPc) {
        $this->ltPc = $ltPc;
    }

    public function setRemark($remark) {
        $this->remark = $remark;
    }

    public function setProStatus($proStatus) {
        $this->proStatus = $proStatus;
    }

        /**
     * 获取工程状态
     * @return string
     */
    public function getProStatus() {
        return $this->proStatus;
    }
    
     /**
     * 获取工程状态
     * @return string
     */
     public static function displayProStatusByParam($status) {
        switch ($status) {
            case 0: return STATUS_NOT_CONFIRMED;
            case 1: return STATUS_CONFIRMED;
            case 2: return STATUS_STARTED;
            case 3: return STATUS_FINISHED;
            case 4: return STATUS_DELIVERED;
            default : return "";
        }
    }
}
