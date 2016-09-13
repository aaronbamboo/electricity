<!DOCTYPE html>
<?php
require_once 'includes/CTCDbService.php';
require_once 'entities/projects.php';
require_once 'includes/AlertTool.php';
//use ProjectPlanService;
//$con=  mysqli_connect("localhost", "phpuser", "phpuserpw");
//if (!$con) {
//    exit('Connect Error (' . mysqli_connect_errno() . ') '
//           . mysqli_connect_error());
//}
//mysqli_set_charset($con, 'utf-8');
//
//// 检索许愿者ID
//mysqli_select_db($con, "ctcdb");
//$user = mysqli_real_escape_string($con, htmlentities($_GET["user"]));
//$wisher = mysqli_query($con, "SELECT id FROM wishers WHERE name='" . $user . "'");
//if (mysqli_num_rows($wisher) < 1) {
//    exit("The person " . htmlentities($_GET["user"]) . " is not found. Please check the spelling and try again");
//}
//$row = mysqli_fetch_row($wisher);
//$wisherID = $row[0];
//mysqli_free_result($wisher);
//
//$wisherID = CTCDbService::getInstance()->get_wisher_id_by_name($_GET["user"]);
//if (!$wisherID) {
//    exit("The person " . $_GET["user"] . " is not found. Please check the spelling and try again");
//}
//?>


<html>
    <head>
        <meta charset="UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- 新 Bootstrap 核心 CSS 文件 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- 可选的Bootstrap主题文件（一般不用引入） -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

        <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
        <!-- <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>-->

        <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <title></title>
    </head>
    <body>
        <h3><?php echo htmlentities($_GET["projectName"]); ?>的信息：</h3></br>
        <table class="table table-hover">
            <tr>
                <th>项目名称</th>
                <th>项目编号</th>
                <th>工程状态</th>
            </tr>
            <?php
            // 检索许愿者的愿望
//            $result = mysqli_query($con, "SELECT description, due_date FROM wishes WHERE wisher_id=" . $wisherID);
            $projectPlanServ = new ProjectPlanService;
            $results = $projectPlanServ->getProjectByName($_GET["projectName"]);
            while ($row = mysqli_fetch_array($results)) {
                echo "<tr><td>" . htmlentities($row["project_name"]) . "</td>";
                echo "<td>" . htmlentities($row["project_code"]) . "</td>";
                echo "<td>" . htmlentities(project::displayProStatusByParam($row["pro_status"])) . "</td>";
            }
           
//            mysqli_close($con);
            
            ?>
        </table>
        <?php
        $project = new project;
        $project->setProjectAera("越城区");
        $project->setProjectName("绍兴孙端许家埭东");
        $project->setLtPc("联通3");
        $project->setProStatus("aaaa");
        try {
            $projectPlanServ->createProject($project);
        } catch (Exception $ex) {
            $alertMessage = new AlertMessager($ex->getMessage(), 1);
            $alertMessage->alertMessage();
        }
        ?>
    </body>
</html>