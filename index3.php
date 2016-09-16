<?php
require_once 'resources/CTCCodes.php';
require_once 'includes/CTCDbService.php';
require_once 'includes/AlertTool.php';

//$jsonSites = null;
if (!empty($_POST)) {
    $Site = new Site();
    $sitetName = null;
    $siteService = new SiteService();
    if (htmlspecialchars($_POST['actionType']) == 'search_site') {
        $siteName = htmlspecialchars($_POST['site_name']);
        $sites = $siteService->getSiteByName($siteName);
        $jsonSites = json_encode($sites);
    } elseif (htmlspecialchars($_POST['actionType']) == 'update_site') {
        //echo "<script> alert('". htmlspecialchars($_POST['input_dc_id']) ."') </script>";
        $site->setDcId(intval($_POST['input_dc_id']));
        $site->setSiteName(htmlspecialchars($_POST['input_site_name']));
        $site->setSiteAera($siteArea = htmlspecialchars($_POST['select_site_area']));
        $site->setSiteCode($siteCode = htmlspecialchars($_POST['input_site_code']));
        $site->setRemark($remark = htmlspecialchars($_POST['input_site_remark']));
        $site->setShareInfo($shareInfo = htmlspecialchars($_POST['select_share_info']));
        $site->setMeterUser($meterUser = htmlspecialchars($_POST['select_meter_user']));
        $site->setYdDcload($ydDcload = htmlspecialchars($_POST['input_yd_dcload']));
        $site->setDxDcload($dxDcload = htmlspecialchars($_POST['input_dx_dcload']));
        $site->setLtDcload($ltDcload = htmlspecialchars($_POST['input_lt_dcload']));

        try {
            $siteService->updateSite($site);
//            $siteName = $site->getSiteName();
        } catch (Exception $ex) {
            $alertMessage = new AlertMessager($ex->getMessage(), 1);
            $alertMessage->alertMessage();
            return;
        }
//        echo "<script> alert('". $site->getSiteName() . "：" .OPER_SITE_UPDATE_SUCCESS  ."') </script>";
    } elseif (htmlspecialchars($_POST['actionType']) == 'add_site') {
        $site = new Site();
//        $site->setDcId(htmlspecialchars($_POST['input_dc_id']));
        $site->setSiteName(htmlspecialchars($_POST['input_site_name_add']));
        $site->setSiteAera($siteArea = htmlspecialchars($_POST['select_site_area_add']));
        $site->setSiteCode($siteCode = htmlspecialchars($_POST['input_site_code_add']));
        $site->setRemark($remark = htmlspecialchars($_POST['input_site_remark_add']));
        $site->setShareInfo($shareInfo = htmlspecialchars($_POST['select_share_info_add']));
        $site->setMeterUser($meterUser = htmlspecialchars($_POST['select_meter_user_add']));
        $site->setYdDcload($ydDcload = htmlspecialchars($_POST['input_yd_dcload_add']));
        $site->setDxDcload($dxDcload = htmlspecialchars($_POST['input_dx_dcload_add']));
        $site->setLtDcload($ltDcload = htmlspecialchars($_POST['input_lt_dcload_add']));
        try {
            $siteService->createSite($site);
//            $siteName = $site->getSiteName();
        } catch (Exception $ex) {
            $alertMessage = new AlertMessager($ex->getMessage(), 1);
            $alertMessage->alertMessage();
            return;
        }
        echo "<script> alert('" . $site->getSiteName() . "：" . OPER_SITE_ADD_SUCCESS . "') </script>";
    } elseif (htmlspecialchars($_POST['actionType']) == 'delete_site') {
        $dcId = htmlspecialchars($_POST['deleteSiteId']);
        try {
            $siteService->deleteSite($dcId);
        } catch (Exception $ex) {
            $alertMessage = new AlertMessager($ex->getMessage(), 1);
            $alertMessage->alertMessage();
            return;
        }
        echo "<script> alert('" . htmlspecialchars($_POST['site_name']) . "：" . OPER_SITE_DELETE_SUCCESS . "') </script>";
    } else {
        $siteName = null;
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
                var $table = $('#site-table');
                $table.bootstrapTable('load', <?= $jsonSites ?>);
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
                            <li><a href="#"><?= PAGE_SITEBAR_SITE_ELEC_CHARGE ?></a></li>
                            <li><a href="#"><?= PAGE_SITEBAR_PROVINCE_BRANCH_REPORT ?></a></li>
                        </ul>
                    </div><!--/.well -->
                </div><!--/span-->
                <div class="span9 ">
                    <div class="row-fluid">
                        <form class="form-inline" id="searchForm" method="post" action="index3.php">
                            <div class="input-group">
                                <input type="text" name = "site_name" class="form-control"  placeholder="<?= TIPS_SITE_INPUT ?>">
                                <span class="">
                                    <button class="btn btn-default" type="submit">
<?= BT_UNIVERSE_SEARCH ?>
                                    </button>
                                </span>
                                <button id="bt_update_site" class="btn btn-default" type="button"><?= BT_SITE_UPDATE ?></button>
                                <button id="bt_delete_site" class="btn btn-default" type="button"><?= BT_SITE_DELETE ?></button>
                                <button id="bt_add_site" class="btn btn-primary right" type="button"><?= BT_SITE_ADD ?></button>
                            </div><!-- /input-group -->
                            <div hidden="true">
                                <input type="text" id="actionType" name="actionType" value="search_site">
                                <input type="text" id="deleteSiteId" name="deleteSiteId">
                            </div>
                        </form>

                    </div>
                    <div class="row-fluid">
                        <table class="table table-bordered" id="site-table" data-toggle="table" data-url="data.json"
                               data-click-to-select="true" data-pagination="true" >
                            <thead>
                                <tr>
                                    <th data-radio="true"></th>
                                    <th data-field="site_area"><?= TBL_HEADER_SITE_AREA ?></th>
                                    <th data-field="site_code"><?= TBL_HEADER_SITE_CODE ?></th>
                                    <th data-field="site_name"><?= TBL_HEADER_SITE_NAME ?></th>
                                    <th data-field="share_info"><?= TBL_HEADER_SHARE_INFO ?></th>
                                    <th data-field="meter_user"><?= TBL_HEADER_METER_USER ?></th>
                                    <th data-field="yd_dcload"><?= TBL_HEADER_YD_DCLOAD ?></th>
                                    <th data-field="lt_dcload"><?= TBL_HEADER_LT_DCLOAD ?></th>
                                    <th data-field="dx_dcload"><?= TBL_HEADER_DX_DCLOAD ?></th>                 
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
<?= BT_SITE_UPDATE ?>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post" action="index3.php" id="updateForm">
                            <div class="control-group">
                                <label class="control-label" for="select_site_area"><?= LBL_SITE_AREA ?></label>
                                <div class="controls">
                                    <select  id="select_site_area" name="select_site_area">
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
                                <label class="control-label" for="input_site_code"><?=LBL_SITE_CODE?></label>
                                <div class="controls">
                                    <input id="input_site_code" name="input_site_code" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_site_name"><?=LBL_SITE_NAME?></label>
                                <div class="controls">
                                    <input id="input_site_name" name="input_site_name" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="select_share_info"><?=LBL_SHARE_INFO?></label>
                                <div class="controls">
                                    <select  id="select_share_info" name="select_share_info">
                                        <option value="<?=SLT_SHARE_YD?>"><?=SLT_SHARE_YD?></option>
                                        <option value="<?=SLT_SHARE_LT?>"><?=SLT_SHARE_LT?></option>
                                        <option value="<?=SLT_SHARE_DX?>"><?=SLT_SHARE_DX?></option>
                                        <option value="<?=SLT_SHARE_YD_LT?>"><?=SLT_SHARE_YD_LT?></option>
                                        <option value="<?=SLT_SHARE_YD_DX?>"><?=SLT_SHARE_YD_DX?></option>
                                        <option value="<?=SLT_SHARE_LT_DX?>"><?=SLT_SHARE_LT_DX?></option>
                                        <option value="<?=SLT_SHARE_YD_LT_DX?>"><?=SLT_SHARE_YD_LT_DX?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="select_meter_user"><?=LBL_METER_USER?></label>
                                <div class="controls">
                                     <select  id="select_meter_user" name="select_meter_user">
                                        <option value="<?=SLT_METERUSER_YD?>"><?=SLT_METERUSER_YD?></option>
                                        <option value="<?=SLT_METERUSER_LT?>"><?=SLT_METERUSER_LT?></option>
                                        <option value="<?=SLT_METERUSER_DX?>"><?=SLT_METERUSER_DX?></option>
                                        <option value="<?=SLT_METERUSER_YD_LT?>"><?=SLT_METERUSER_YD_LT?></option>
                                        <option value="<?=SLT_METERUSER_YD_DX?>"><?=SLT_METERUSER_YD_DX?></option>
                                        <option value="<?=SLT_METERUSER_LT_DX?>"><?=SLT_METERUSER_LT_DX?></option>
                                        <option value="<?=SLT_METERUSER_YD_LT_DX?>"><?=SLT_METERUSER_YD_LT_DX?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_yd_dcload"><?=LBL_YD_DCLOAD?></label>
                                <div class="controls">
                                    <input type="text" id="input_yd_dcload" name="input_yd_dcload">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_lt_dcload" ><?=LBL_LT_DCLOAD?></label>
                                <div class="controls">
                                    <input type="text" id="input_lt_dcload" name="input_lt_dcload">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_dx_dcload"><?=LBL_DX_DCLOAD?></label>
                                <div class="controls">
                                    <input type="text" id="input_dx_dcload" name="input_dx_dcload">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_site_remark"><?=LBL_SITE_REMARK?></label>
                                <div class="controls">
                                    <input type="text" id="input_site_remark" name="input_site_remark">
                                </div>
                            </div>
                            <div  hidden="true">
                                <input type="text" id="input_dc_id" name="input_dc_id" hidden="true">
                                <input type="text" id="actionType" name="actionType" value="update_site">
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
<?= BT_SITE_ADD ?>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post" action="index3.php" id="addForm">
                            
                            <div class="control-group">
                                <label class="control-label" for="select_site_area_add"><?= LBL_SITE_AREA ?></label>
                                <div class="controls">
                                    <select  id="select_site_area_add" name="select_site_area_add">
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
                                <label class="control-label" for="input_site_code_add"><?=LBL_SITE_CODE?></label>
                                <div class="controls">
                                    <input id="input_site_code_add" name="input_site_code_add" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_site_name_add"><?= LBL_SITE_NAME ?></label>
                                <div class="controls">
                                    <input id="input_site_name" type="text" name="input_site_name_add">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="select_share_info_add"><?=LBL_SHARE_INFO?></label>
                                <div class="controls">
                                    <select  id="select_share_info_add" name="select_share_info_add">
                                        <option value="<?=SLT_SHARE_YD?>"><?=SLT_SHARE_YD?></option>
                                        <option value="<?=SLT_SHARE_LT?>"><?=SLT_SHARE_LT?></option>
                                        <option value="<?=SLT_SHARE_DX?>"><?=SLT_SHARE_DX?></option>
                                        <option value="<?=SLT_SHARE_YD_LT?>"><?=SLT_SHARE_YD_LT?></option>
                                        <option value="<?=SLT_SHARE_YD_DX?>"><?=SLT_SHARE_YD_DX?></option>
                                        <option value="<?=SLT_SHARE_LT_DX?>"><?=SLT_SHARE_LT_DX?></option>
                                        <option value="<?=SLT_SHARE_YD_LT_DX?>"><?=SLT_SHARE_YD_LT_DX?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="select_meter_user_add"><?=LBL_METER_USER?></label>
                                <div class="controls">
                                     <select  id="select_meter_user_add" name="select_meter_user_add">
                                        <option value="<?=SLT_METERUSER_YD?>"><?=SLT_METERUSER_YD?></option>
                                        <option value="<?=SLT_METERUSER_LT?>"><?=SLT_METERUSER_LT?></option>
                                        <option value="<?=SLT_METERUSER_DX?>"><?=SLT_METERUSER_DX?></option>
                                        <option value="<?=SLT_METERUSER_YD_LT?>"><?=SLT_METERUSER_YD_LT?></option>
                                        <option value="<?=SLT_METERUSER_YD_DX?>"><?=SLT_METERUSER_YD_DX?></option>
                                        <option value="<?=SLT_METERUSER_LT_DX?>"><?=SLT_METERUSER_LT_DX?></option>
                                        <option value="<?=SLT_METERUSER_YD_LT_DX?>"><?=SLT_METERUSER_YD_LT_DX?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_yd_dcload_add"><?=LBL_YD_DCLOAD?></label>
                                <div class="controls">
                                    <input type="text" id="input_yd_dcload_add" name="input_yd_dcload_add">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_lt_dcload_add" ><?=LBL_LT_DCLOAD?></label>
                                <div class="controls">
                                    <input type="text" id="input_lt_dcload_add" name="input_lt_dcload_add">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_dx_dcload_add"><?=LBL_DX_DCLOAD?></label>
                                <div class="controls">
                                    <input type="text" id="input_dx_dcload_add" name="input_dx_dcload_add">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_site_remark_add"><?=LBL_SITE_REMARK?></label>
                                <div class="controls">
                                    <input type="text" id="input_site_remark_add" name="input_site_remark_add">
                                </div>
                            </div>
                            <div  hidden="true">
                                <input type="text" id="input_dc_id_add" name="input_dc_id_add" hidden="true">
                                <input type="text" id="actionType" name="actionType" value="add_site">
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
        var $table = $('#site-table'),
                $updateButton = $('#bt_update_site');
        var $addButton = $('#bt_add_site');
        var $deleleButton = $('#bt_delete_site');
        var $updateSubButton = $('#bt_update_submit');
        var $addSubButton = $('#bt_add_submit');
        $(function () {
            $updateButton.click(function () {
                var selectRow = $table.bootstrapTable('getSelections');
                if (selectRow.length < 1) {
                    alert("<?= TIPS_PLEASE_SELECT_SITE ?>");
                    return;
                }

                // 模态框赋值
                $('#input_site_name').val(selectRow[0]['site_name']);
                $('#select_site_area').val(selectRow[0]['site_aera']);
                $('#input_site_code').val(selectRow[0]['site_code']);
                $('#select_share_info').val(selectRow[0]['share_info']);
                $('#select_meter_user').val(selectRow[0]['meter_user']);
                $('#input_site_remark').val(selectRow[0]['remark']);
                $('#input_yd_dcload').val(selectRow[0]['yd_dcload']);
                $('#input_dx_dcload').val(selectRow[0]['dx_dcload']);
                $('#input_lt_dcload').val(selectRow[0]['lt_dcload']);
                $('#input_dc_id').val(selectRow[0]['dc_id']);

                $('#myModal_update').modal('show');
            });

            $addButton.click(function () {
                $('#myModal_add').modal('show');
            });

            $deleleButton.click(function () {
                var selectRow = $table.bootstrapTable('getSelections');
                if (selectRow.length < 1) {
                    alert("<?= TIPS_PLEASE_SELECT_SITE ?>");
                    return;
                }
                $('#deleteSiteId').val(selectRow[0]['dc_id']);
                $('#site_name').val(selectRow[0]['site_name']);
                $('#actionType').val('delete_site');
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