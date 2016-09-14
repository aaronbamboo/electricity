<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// 数据库配置参数
define('DB_DSN', 'mysql:host=10.10.32.51;dbname=Kcdryfz2Y9xuCDnL');
define('DB_USER', 'u6rZLMYuyIeaoOns');
define('DB_PWD', 'p1ovrzIXk6MWbeEJ4');
define('DB_NAME', 'Kcdryfz2Y9xuCDnL');
define('DB_HOST', '10.10.32.51');

//县市区域
define('QY_YUECHENGQU', '越城区');
define('QY_SHAOXINGXIAN', '绍兴县');
define('QY_SHANGYUSHI', '上虞市');
define('QY_XHUJISHI', '诸暨市');
define('QY_SHENGZHOUSHI', '嵊州市');
define('QY_XINCHANGXIAN', '新昌县');

//工程状态：未落实，落实，开工，完工，交付
define('STATUS_NOT_CONFIRMED', '未落实');
define('STATUS_CONFIRMED', '已落实');
define('STATUS_STARTED', '已开工');
define('STATUS_FINISHED', '已完工');
define('STATUS_DELIVERED', '已交付');

//页面文字
define('PAGE_COPYRIGHT','中国铁塔股份有限公司绍兴市分公司建设维护部');
define('PAGE_SYSTEM_NAME','建设维护部综合管理系统');
define('PAGE_NAVBAR_CURRENT_USER','当前用户：');
define('PAGE_NAVBAR_MANAGEMENT','管理');
define('PAGE_NAVBAR_MOD_PASSWORD', '修改密码');
define('PAGE_NAVBAR_OTHER', '其他');

//侧边栏
define('PAGE_SITEBAR_HEADER_PROGRESS_MANAGEMENT', '进度管理');
define('PAGE_SITEBAR_SITE_UPDATE', '站点更新');
define('PAGE_SITEBAR_DELIVER_PLAN', '交付计划');
define('PAGE_SITEBAR_HEADER_ORDER_MANAGEMENT', '订单管理');
define('PAGE_SITEBAR_JL_ORDER', '监理订单');
define('PAGE_SITEBAR_SJ_ORDER', '设计订单');
define('PAGE_SITEBAR_DK_ORDER', '地勘订单');
define('PAGE_SITEBAR_SBAZ_ORDER', '设备安装订单');
define('PAGE_SITEBAR_SDYR_CONTACT', '市电合同');
define('PAGE_SITEBAR_TJ_CONTACT', '土建合同');

//表格
define('TBL_HEADER_PROJECT_NAME', '项目名称');
define('TBL_HEADER_PROJECT_AREA', '区域');
define('TBL_HEADER_CONSTR_TYPE', '建设类型');
define('TBL_HEADER_CONSTR_DETAIL', '建设方式');
define('TBL_HEADER_YD_PC', '移动批次');
define('TBL_HEADER_LT_PC', '联通批次');
define('TBL_HEADER_DX_PC', '电信批次');
define('TBL_HEADER_PROJECT_STATUS', '工程状态');

//按钮
define('BT_PROJECT_ADD', '添加项目');
define('BT_PROJECT_UPDATE', '更新项目');
define('BT_PROJECT_DELETE', '删除项目');
define('BT_UNIVERSE_SEARCH', '查询');
define('BT_UNIVERSE_CLOSE', '关闭');
define('BT_UNIVERSE_SUBMIT', '提交');

//选择框
define('SLT_AREA_YC', '越城区');
define('SLT_AREA_KQ', '绍兴县');
define('SLT_AREA_SY', '上虞市');
define('SLT_AREA_ZJ', '诸暨市');
define('SLT_AREA_SZ', '嵊州市');
define('SLT_AREA_XC', '新昌县');

//标签
define('LBL_PROJECT_NAME', '项目名称');
define('LBL_PROJECT_AREA', '区域');
define('LBL_PROJECT_CODE', '项目编号');
define('LBL_SITE_CODE', '站点编号');
define('LBL_CONSTR_TYPE', '建设类型');
define('LBL_CONSTR_DETAIL', '建设方式');
define('LBL_YD_PC', '移动批次');
define('LBL_LT_PC', '联通批次');
define('LBL_DX_PC', '电信批次');
define('LBL_DAV_CURRENT_USER', '当前用户：');


//提示
define('TIPS_PROJECT_INPUT', '请输入项目名称');
define('TIPS_PLEASE_SELECT_PROJECT', '请选择项目');

//操作结果
define('OPER_PROJECT_UPDATE_SUCCESS', '项目更新成功');
define('OPER_PROJECT_ADD_SUCCESS', '项目添加成功');
define('OPER_PROJECT_DELETE_SUCCESS', '项目删除成功');
