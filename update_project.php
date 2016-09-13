<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'includes/CTCDbService.php';
require_once 'includes/AlertTool.php';
require_once 'entities/projects.php';

//$jsonProjects = null;
if (!empty($_POST)) {
    $project = new project;
    
    $project->setProjectId(htmlspecialchars($_POST['input_project_id']));
    $project->setProjectName(htmlspecialchars($_POST['input_project_name']));
    $project->setProjectAera($projectArea = htmlspecialchars($_POST['select_project_area']));
    $project->setProjectCode($projectCode= htmlspecialchars($_POST['input_project_code']));
    $project->setSiteCode($siteCode= htmlspecialchars($_POST['input_site_code']));
    $project->setConstrType($constrType= htmlspecialchars($_POST['input_constr_type']));
    $project->setConstrDetail($constrDetail= htmlspecialchars($_POST['input_constr_detail']));
    $project->setYdPc($ydPc= htmlspecialchars($_POST['input_yd_pc']));
    $project->setDxPc($dxPc= htmlspecialchars($_POST['input_dx_pc']));
    $project->setLtPc($ltPc= htmlspecialchars($_POST['input_lt_pc']));
    
    $projectService = new ProjectPlanService();
    try {
        $projects = $projectService->updateProject($project);
    } catch (Exception $ex) {
        $alertMessage = new AlertMessager($ex->getMessage(), 1);
        $alertMessage->alertMessage();
    }
    header("Location: index3.php");        
} else {
    return ;
}
