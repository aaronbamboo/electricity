<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sites
 *
 * @author Aaron
 */
class Site {
    public $dcId;
    public $siteAera; 
    public $siteCode;
    public $siteName;
    public $shareInfo;
    public $meterUser;
    public $ydDcload;
    public $ltDcload;
    public $dxDcload;
    public $remark; /* 备注信息 */
    
    public function getDcId() {
        return $this->dcId;
    }

    public function getSiteAera() {
        return $this->siteAera;
    }

    public function getSiteCode() {
        return $this->siteCode;
    }

    public function getSiteName() {
        return $this->siteName;
    }

    public function getShareInfo() {
        return $this->shareInfo;
    }

    public function getMeterUser() {
        return $this->meterUser;
    }

    public function getYdDcload() {
        return $this->ydDcload;
    }

    public function getLtDcload() {
        return $this->ltDcload;
    }

    public function getDxDcload() {
        return $this->dxDcload;
    }

    public function getRemark() {
        return $this->remark;
    }

    public function setDcId($dcId) {
        $this->dcId = $dcId;
    }

    public function setSiteAera($siteAera) {
        $this->siteAera = $siteAera;
    }

    public function setSiteCode($siteCode) {
        $this->siteCode = $siteCode;
    }

    public function setSiteName($siteName) {
        $this->siteName = $siteName;
    }

    public function setShareInfo($shareInfo) {
        $this->shareInfo = $shareInfo;
    }

    public function setMeterUser($meterUser) {
        $this->meterUser = $meterUser;
    }

    public function setYdDcload($ydDcload) {
        $this->ydDcload = $ydDcload;
    }

    public function setLtDcload($ltDcload) {
        $this->ltDcload = $ltDcload;
    }

    public function setDxDcload($dxDcload) {
        $this->dxDcload = $dxDcload;
    }

    public function setRemark($remark) {
        $this->remark = $remark;
    }

}
