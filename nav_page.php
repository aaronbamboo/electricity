<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="#" style=" color: #149bdf"><?= PAGE_SYSTEM_NAME ?></a>
            <div class="nav-collapse collapse">
                <p class="navbar-text pull-right">
                    <?= LBL_DAV_CURRENT_USER ?> <a href="#" >Username</a>
                </p>
                <ul class="nav">
                    <li class="active"><a href="#"><?= PAGE_NAVBAR_MANAGEMENT ?></a></li>
                    <li><a href="#about"><?= PAGE_NAVBAR_MOD_PASSWORD ?></a></li>
                    <li><a href="#contact"><?= PAGE_NAVBAR_OTHER ?></a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
