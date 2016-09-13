<?php
require_once 'resources/CTCCodes.php';
require_once 'includes/CTCDbService.php';
require_once 'includes/AlertTool.php';

//$jsonProjects = null;
if (!empty($_POST)) {
    $project = new project;
    $projectName = null;
    $projectService = new ProjectPlanService();
    if (htmlspecialchars($_POST['actionType']) == 'search_project') {
        $projectName = htmlspecialchars($_POST['project_name']);
        $projects = $projectService->getProjectByName($projectName);
        $jsonProject = json_encode($projects);
    } elseif (htmlspecialchars($_POST['actionType']) == 'update_project') {

        $project->setProjectId(htmlspecialchars($_POST['input_project_id']));
        $project->setProjectName(htmlspecialchars($_POST['input_project_name']));
        $project->setProjectAera($projectArea = htmlspecialchars($_POST['select_project_area']));
        $project->setProjectCode($projectCode = htmlspecialchars($_POST['input_project_code']));
        $project->setSiteCode($siteCode = htmlspecialchars($_POST['input_site_code']));
        $project->setConstrType($constrType = htmlspecialchars($_POST['input_constr_type']));
        $project->setConstrDetail($constrDetail = htmlspecialchars($_POST['input_constr_detail']));
        $project->setYdPc($ydPc = htmlspecialchars($_POST['input_yd_pc']));
        $project->setDxPc($dxPc = htmlspecialchars($_POST['input_dx_pc']));
        $project->setLtPc($ltPc = htmlspecialchars($_POST['input_lt_pc']));

        try {
            $projectService->updateProject($project);
//            $projectName = $project->getProjectName();
        } catch (Exception $ex) {
            $alertMessage = new AlertMessager($ex->getMessage(), 1);
            $alertMessage->alertMessage();
            return;
        }
//        echo "<script> alert('". $project->getProjectName() . "：" .OPER_PROJECT_UPDATE_SUCCESS  ."') </script>";
    } elseif (htmlspecialchars($_POST['actionType']) == 'add_project') {
        $project = new project();
//        $project->setProjectId(htmlspecialchars($_POST['input_project_id']));
        $project->setProjectName(htmlspecialchars($_POST['input_project_name_add']));
        $project->setProjectAera($projectArea = htmlspecialchars($_POST['select_project_area_add']));
        $project->setProjectCode($projectCode = htmlspecialchars($_POST['input_project_code_add']));
        $project->setSiteCode($siteCode = htmlspecialchars($_POST['input_site_code_add']));
        $project->setConstrType($constrType = htmlspecialchars($_POST['input_constr_type_add']));
        $project->setConstrDetail($constrDetail = htmlspecialchars($_POST['input_constr_detail_add']));
        $project->setYdPc($ydPc = htmlspecialchars($_POST['input_yd_pc_add']));
        $project->setDxPc($dxPc = htmlspecialchars($_POST['input_dx_pc_add']));
        $project->setLtPc($ltPc = htmlspecialchars($_POST['input_lt_pc_add']));
        try {
            $projectService->createProject($project);
//            $projectName = $project->getProjectName();
        } catch (Exception $ex) {
            $alertMessage = new AlertMessager($ex->getMessage(), 1);
            $alertMessage->alertMessage();
            return;
        }
        echo "<script> alert('" . $project->getProjectName() . "：" . OPER_PROJECT_ADD_SUCCESS . "') </script>";
    } elseif (htmlspecialchars($_POST['actionType']) == 'delete_project') {
        $projectId = htmlspecialchars($_POST['deleteProjectId']);
        try {
            $projectService->deleteProject($projectId);
        } catch (Exception $ex) {
            $alertMessage = new AlertMessager($ex->getMessage(), 1);
            $alertMessage->alertMessage();
            return;
        }
        echo "<script> alert('" . htmlspecialchars($_POST['project_name']) . "：" . OPER_PROJECT_DELETE_SUCCESS . "') </script>";
    } else {
        $projectName = null;
    }
}
?>

<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <title><?= PAGE_SYSTEM_NAME ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="./bootstrap-table/css/bootstrap-table.css" rel="stylesheet">

        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }

            @media (max-width: 980px) {
                /* Enable use of floated navbar text */
                .navbar-text.pull-right {
                    float: none;
                    padding-left: 5px;
                    padding-right: 5px;
                }
            }
            #myModal .modal-body {
                max-height: 800px;
            }
        </style>
        <link href="./bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="../assets/ico/favicon.png">
        <script type="text/javascript">
            function loadData() {
                var $table = $('#project-table');
                $table.bootstrapTable('load', <?= $jsonProject ?>);
            }
            ;
        </script>
    </head>

    <body onload="loadData()">

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
                            <?=LBL_DAV_CURRENT_USER?> <a href="#" >Username</a>
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

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3">
                    <div class="well sidebar-nav">
                        <ul class="nav nav-list">
                            <li class="nav-header"><?= PAGE_SITEBAR_HEADER_PROGRESS_MANAGEMENT ?></li>
                            <li class="active"><a href="#"><?= PAGE_SITEBAR_SITE_UPDATE ?></a></li>
                            <li><a href="#"><?= PAGE_SITEBAR_DELIVER_PLAN ?></a></li>
                            <li class="nav-header"><?= PAGE_SITEBAR_HEADER_ORDER_MANAGEMENT ?></li>
                            <li><a href="#"><?= PAGE_SITEBAR_JL_ORDER ?></a></li>
                            <li><a href="#"><?= PAGE_SITEBAR_SJ_ORDER ?></a></li>
                            <li><a href='#'><?= PAGE_SITEBAR_DK_ORDER ?></a></li>
                            <li><a href='#'><?= PAGE_SITEBAR_SBAZ_ORDER ?></a></li>
                            <li><a href='#'><?= PAGE_SITEBAR_SDYR_CONTACT ?></a></li>
                            <li><a href='#'><?= PAGE_SITEBAR_TJ_CONTACT ?></a></li>
                        </ul>
                    </div><!--/.well -->
                </div><!--/span-->
                <div class="span9 ">
                    <div class="row-fluid">
                        <form class="form-inline" id="searchForm" method="post" action="index3.php">
                            <div class="input-group">
                                <input type="text" name = "project_name" class="form-control"  placeholder="<?= TIPS_PROJECT_INPUT ?>">
                                <span class="">
                                    <button class="btn btn-default" type="submit">
<?= BT_UNIVERSE_SEARCH ?>
                                    </button>
                                </span>
                                <button id="bt_update_project" class="btn btn-default" type="button"><?= BT_PROJECT_UPDATE ?></button>
                                <button id="bt_delete_project" class="btn btn-default" type="button"><?= BT_PROJECT_DELETE ?></button>
                                <button id="bt_add_project" class="btn btn-primary right" type="button"><?= BT_PROJECT_ADD ?></button>
                            </div><!-- /input-group -->
                            <div hidden="true">
                                <input type="text" id="actionType" name="actionType" value="search_project">
                                <input type="text" id="deleteProjectId" name="deleteProjectId">
                            </div>
                        </form>

                    </div>
                    <div class="row-fluid">
                        <table class="table table-bordered" id="project-table" data-toggle="table" data-url="data.json"
                               data-click-to-select="true" data-pagination="true" >
                            <thead>
                                <tr>
                                    <th data-radio="true"></th>
                                    <th data-field="project_aera"><?= TBL_HEADER_PROJECT_AREA ?></th>
                                    <th data-field="project_name"><?= TBL_HEADER_PROJECT_NAME ?></th>
                                    <th data-field="constr_type"><?= TBL_HEADER_CONSTR_TYPE ?></th>
                                    <th data-field="constr_detail"><?= TBL_HEADER_CONSTR_DETAIL ?></th>
                                    <th data-field="yd_pc"><?= TBL_HEADER_YD_PC ?></th>
                                    <th data-field="dx_pc"><?= TBL_HEADER_DX_PC ?></th>
                                    <th data-field="lt_pc"><?= TBL_HEADER_LT_PC ?></th>
                                    <th data-field="pro_status"><?= TBL_HEADER_PROJECT_STATUS ?></th>
                                </tr>
                            </thead>
<!--                            <tbody>
                                <tr>
                                    <td data-field="state" data-radio="true"></td>
                                    <td data-field="C1">Row 1 Data 1</td>
                                    <td data-field="C2">Row 1 Data 2</td>
                                    <td data-field="C3">Row 1 Data 3</td>
                                    <td data-field="C4">Row 1 Data 4</td>
                                </tr>
                                <tr>
                                    <td data-field="state" data-radio="true"></td>
                                    <td data-field="C1">Row 2 Data 1</td>
                                    <td data-field="C2">Row 2 Data 2</td>
                                    <td data-field="C3">Row 2 Data 3</td>
                                    <td data-field="C4">Row 2 Data 4</td>
                                </tr>
                            </tbody>-->
                        </table>
                    </div><!--/row-->

                </div><!--/span-->
            </div><!--/row-->



        </div><!--/.fluid-container-->
        <div id="footer" class="container">
            <nav class="navbar navbar-default navbar-fixed-bottom">
                <div class="navbar-inner navbar-content-center">
                    <p class="text-muted credit" style="padding: 10px;">
                        &copy; <?php echo PAGE_COPYRIGHT; ?>
                    </p>                     
                </div>

            </nav>
        </div>

        <!-- 模态框（Modal） -->
        <div class="modal hide fade" id="myModal_update" tabindex="-1" role="dialog" 
             aria-labelledby="myModalLabel_update" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" 
                                data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel_update">
<?= BT_PROJECT_UPDATE ?>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post" action="index3.php" id="updateForm">
                            <div class="control-group">
                                <label class="control-label" for="input_project_name"><?= LBL_PROJECT_NAME ?></label>
                                <div class="controls">
                                    <input id="input_project_name" type="text" readonly="true" name="input_project_name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="select_project_area"><?= LBL_PROJECT_AREA ?></label>
                                <div class="controls">
                                    <select  id="select_project_area" name="select_project_area">
                                         <option value="<?=SLT_AREA_YC?>"><?=SLT_AREA_YC?></option>
                                        <option value="<?=SLT_AREA_KQ?>"><?=SLT_AREA_KQ?></option>
                                        <option value="<?=SLT_AREA_SY?>"><?=SLT_AREA_SY?></option>
                                        <option value="<?=SLT_AREA_ZJ?>"><?=SLT_AREA_ZJ?></option>
                                        <option value="<?=SLT_AREA_SZ?>"><?=SLT_AREA_SZ?></option>
                                        <option value="<?=SLT_AREA_XC?>"><?=SLT_AREA_XC?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_project_code"><?=LBL_PROJECT_CODE?></label>
                                <div class="controls">
                                    <input id="input_project_code" name="input_project_code" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_site_code"><?=LBL_SITE_CODE?></label>
                                <div class="controls">
                                    <input id="input_site_code" name="input_site_code" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_constr_type"><?=LBL_CONSTR_TYPE?></label>
                                <div class="controls">
                                    <input id="input_constr_type" name="input_constr_type" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_constr_detail"><?=LBL_CONSTR_DETAIL?></label>
                                <div class="controls">
                                    <input id="input_constr_detail" name="input_constr_detail" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_yd_pc"><?=LBL_YD_PC?></label>
                                <div class="controls">
                                    <input type="text" id="input_yd_pc" name="input_yd_pc">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_dx_pc" ><?=LBL_DX_PC?></label>
                                <div class="controls">
                                    <input type="text" id="input_dx_pc" name="input_dx_pc">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_lt_pc"><?=LBL_LT_PC?></label>
                                <div class="controls">
                                    <input type="text" id="input_lt_pc" name="input_lt_pc">
                                </div>
                            </div>
                            <div  hidden="true">
                                <input type="text" id="input_project_id" name="input_project_id" hidden="true">
                                <input type="text" id="actionType" name="actionType" value="update_project">
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" 
                                data-dismiss="modal"><?=BT_UNIVERSE_CLOSE?>
                        </button>
                        <button type="button" class="btn btn-primary" id="bt_update_submit">
                            <?=BT_UNIVERSE_SUBMIT?>
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>

        <!-- 添加项目模态框（Modal） -->
        <div class="modal hide fade" id="myModal_add" tabindex="-1" role="dialog" 
             aria-labelledby="myModalLabel_add" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" 
                                data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel_add">
<?= BT_PROJECT_ADD ?>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post" action="index3.php" id="addForm">
                            <div class="control-group">
                                <label class="control-label" for="input_project_name_add"><?= LBL_PROJECT_NAME ?></label>
                                <div class="controls">
                                    <input id="input_project_name" type="text" name="input_project_name_add">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="select_project_area_add"><?= LBL_PROJECT_AREA ?></label>
                                <div class="controls">
                                    <select  id="select_project_area_add" name="select_project_area_add">
                                        <option value="<?=SLT_AREA_YC?>"><?=SLT_AREA_YC?></option>
                                        <option value="<?=SLT_AREA_KQ?>"><?=SLT_AREA_KQ?></option>
                                        <option value="<?=SLT_AREA_SY?>"><?=SLT_AREA_SY?></option>
                                        <option value="<?=SLT_AREA_ZJ?>"><?=SLT_AREA_ZJ?></option>
                                        <option value="<?=SLT_AREA_SZ?>"><?=SLT_AREA_SZ?></option>
                                        <option value="<?=SLT_AREA_XC?>"><?=SLT_AREA_XC?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_project_code_add"><?=LBL_PROJECT_CODE?></label>
                                <div class="controls">
                                    <input id="input_project_code_add" name="input_project_code_add" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_site_code_add"><?=LBL_SITE_CODE?></label>
                                <div class="controls">
                                    <input id="input_site_code_add" name="input_site_code_add" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_constr_type_add"><?=LBL_CONSTR_TYPE?></label>
                                <div class="controls">
                                    <input id="input_constr_type_add" name="input_constr_type_add" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_constr_detail_add"><?=LBL_CONSTR_DETAIL?></label>
                                <div class="controls">
                                    <input id="input_constr_detail_add" name="input_constr_detail_add" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_yd_pc_add"><?=LBL_YD_PC?></label>
                                <div class="controls">
                                    <input type="text" id="input_yd_pc_add" name="input_yd_pc_add">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_dx_pc_add" ><?=LBL_DX_PC?></label>
                                <div class="controls">
                                    <input type="text" id="input_dx_pc_add" name="input_dx_pc_add">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_lt_pc_add"><?=LBL_LT_PC?></label>
                                <div class="controls">
                                    <input type="text" id="input_lt_pc_add" name="input_lt_pc_add">
                                </div>
                            </div>
                            <div  hidden="true">
                                <input type="text" id="input_project_id_add" name="input_project_id_add" hidden="true">
                                <input type="text" id="actionType" name="actionType" value="add_project">
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" 
                                data-dismiss="modal"><?=BT_UNIVERSE_CLOSE?>
                        </button>
                        <button type="button" class="btn btn-primary" id="bt_add_submit">
                            <?=BT_UNIVERSE_SUBMIT?>
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>

        <!-- Le javascript    
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <script src="./bootstrap/twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>
        <script src="./bootstrap/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="./bootstrap-table/bootstrap-table.js"></script>

        <script>
        var $table = $('#project-table'),
                $updateButton = $('#bt_update_project');
        var $addButton = $('#bt_add_project');
        var $deleleButton = $('#bt_delete_project');
        var $updateSubButton = $('#bt_update_submit');
        var $addSubButton = $('#bt_add_submit');
        $(function () {
            $updateButton.click(function () {
                var selectRow = $table.bootstrapTable('getSelections');
                if (selectRow.length < 1) {
                    alert("<?= TIPS_PLEASE_SELECT_PROJECT ?>");
                    return;
                }

                // 模态框赋值
                $('#input_project_name').val(selectRow[0]['project_name']);
                $('#select_project_area').val(selectRow[0]['project_aera']);
                $('#input_project_code').val(selectRow[0]['project_code']);
                $('#input_site_code').val(selectRow[0]['site_code']);
                $('#input_constr_type').val(selectRow[0]['constr_type']);
                $('#input_constr_detail').val(selectRow[0]['constr_detail']);
                $('#input_yd_pc').val(selectRow[0]['yd_pc']);
                $('#input_dx_pc').val(selectRow[0]['dx_pc']);
                $('#input_lt_pc').val(selectRow[0]['lt_pc']);
                $('#input_project_id').val(selectRow[0]['project_id']);

                $('#myModal_update').modal('show');
            });

            $addButton.click(function () {
                $('#myModal_add').modal('show');
            });

            $deleleButton.click(function () {
                var selectRow = $table.bootstrapTable('getSelections');
                if (selectRow.length < 1) {
                    alert("<?= TIPS_PLEASE_SELECT_PROJECT ?>");
                    return;
                }
                $('#deleteProjectId').val(selectRow[0]['project_id']);
                $('#project_name').val(selectRow[0]['project_name']);
                $('#actionType').val('delete_project');
                $('#searchForm').submit();
            });

            $updateSubButton.click(function () {
                $('#updateForm').submit();
            });


            $addSubButton.click(function () {
                $('#addForm').submit();
            });
        });
        </script> 
    </body>
</html>