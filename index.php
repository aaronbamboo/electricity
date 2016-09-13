<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        <form name="wishlist" action="wishlist.php">
            <div class="form-group">
                <label for="user">显示愿望列表：</label>>
                <input type="text" name="projectName" class="form-control" placeholder="项目名称" />
            </div>
            <input type="submit" value="确定" class="btn btn-default" />
        </form>
    </body>
</html>
