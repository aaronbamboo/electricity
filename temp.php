
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<title>Twitter Bootstrap Tutorial - A responsive layout tutorial</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css" rel="stylesheet">
<style type='text/css'>
    body {
      background-color: #CCC;
    }
    #content {
      background-color: #FFF;
      border-radius: 5px;
    }
    #content .main {
      padding: 20px;
    }
    #content .sidebar {
      padding: 10px;
    }
    #content p {
      line-height: 30px;
    }
</style>
</head>
<body>
  <div class='container'>
    <h1>建设维护部综合管理系统</h1>
    <div class='navbar navbar-inverse'>
      <div class='navbar-inner nav-collapse' style="height: auto;">
        <ul class="nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">修改密码</a></li>
          <li><a href="#">other</a></li>
        </ul>
       <p class="navbar-text pull-right">登陆用户： <a href="#">username</a></p>
      </div>
    </div>
    <div id='content' class='row-fluid'>
        <div class='span3 sidebar'>
        <h2>进度管理</h2>
        <ul class="nav nav-tabs nav-stacked">
          <li style=" background-color: #CCC"><a href='#'>站点更新</a></li>
          <li><a href='#'>交付计划</a></li>
          <li><a href='#'>other</a></li>
        </ul>
        <h2>订单管理</h2>
        <ul class="nav nav-tabs nav-stacked">
            <li><a href='#'>监理订单</a></li>
          <li><a href='#'>设计订单</a></li>
          <li><a href='#'>地勘订单</a></li>
          <li><a href='#'>设备安装订单</a></li>
          <li><a href='#'>市电合同</a></li>
          <li><a href='#'>土建合同</a></li>
        </ul>
      </div>
      <div class='span9 main'>
        <h2></h2>

      </div>
      
    </div>
  </div>
</body>
</html>
