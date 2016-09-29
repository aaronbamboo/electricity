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
define('QY_YUECHENGQU', '越城');
define('QY_SHAOXINGXIAN', '柯桥');
define('QY_SHANGYUSHI', '上虞');
define('QY_XHUJISHI', '诸暨');
define('QY_SHENGZHOUSHI', '嵊州');
define('QY_XINCHANGXIAN', '新昌');

//工程状态：未落实，落实，开工，完工，交付
define('STATUS_NOT_CONFIRMED', '未落实');
define('STATUS_CONFIRMED', '已落实');
define('STATUS_STARTED', '已开工');
define('STATUS_FINISHED', '已完工');
define('STATUS_DELIVERED', '已交付');

//页面文字
define('PAGE_COPYRIGHT','中国铁塔股份有限公司绍兴市分公司建设维护部');
define('PAGE_SYSTEM_NAME','建设维护部电费管理系统');
define('PAGE_NAVBAR_CURRENT_USER','当前用户：');
define('PAGE_NAVBAR_MANAGEMENT','管理');
define('PAGE_NAVBAR_MOD_PASSWORD', '修改密码');
define('PAGE_NAVBAR_OTHER', '其他');

//侧边栏
define('PAGE_SITEBAR_HEADER_PROGRESS_MANAGEMENT', '电费管理');
define('PAGE_SITEBAR_SITE_UPDATE', '站点更新');
define('PAGE_SITEBAR_SITE_ELEC_CHARGE', '单站电费');
define('PAGE_SITEBAR_PROVINCE_BRANCH_REPORT', '省公司报表');

//基站配置表格
define('TBL_HEADER_SITE_AREA', '区域');
define('TBL_HEADER_SITE_CODE', '基站编号');
define('TBL_HEADER_SITE_NAME', '基站名称');
define('TBL_HEADER_SHARE_INFO', '共享方');
define('TBL_HEADER_METER_USER', '电表使用方');
define('TBL_HEADER_YD_DCLOAD', '移动直流负载');
define('TBL_HEADER_LT_DCLOAD', '联通直流负载');
define('TBL_HEADER_DX_DCLOAD', '电信直流负载');

//按钮
define('BT_SITE_ADD', '添加基站');
define('BT_SITE_UPDATE', '更新基站');
define('BT_SITE_DELETE', '删除基站');
define('BT_UNIVERSE_SEARCH', '查询');
define('BT_UNIVERSE_CLOSE', '关闭');
define('BT_UNIVERSE_SUBMIT', '提交');
define('BT_SITE_OUTPUT', '导出');

//选择框
define('SLT_AREA_YC', '越城');
define('SLT_AREA_KQ', '柯桥');
define('SLT_AREA_SY', '上虞');
define('SLT_AREA_ZJ', '诸暨');
define('SLT_AREA_SZ', '嵊州');
define('SLT_AREA_XC', '新昌');

//标签
define('LBL_SITE_NAME', '基站名称');
define('LBL_SITE_AREA', '区域');
define('LBL_SITE_CODE', '基站编号');
define('LBL_SITE_NAME', '基站名称');
define('LBL_SHARE_INFO', '共享方');
define('LBL_METER_USER', '电表使用方');
define('LBL_YD_DCLOAD', '移动直流负载');
define('LBL_LT_DCLOAD', '联通直流负载');
define('LBL_DX_DCLOAD', '电信直流负载');
define('LBL_SITE_REMARK', '备注');
define('LBL_DAV_CURRENT_USER', '当前用户：');

//电表使用方
define('SLT_SHARE_YD', '移动');
define('SLT_SHARE_LT', '联通');
define('SLT_SHARE_DX', '电信');
define('SLT_SHARE_YD_LT', '移动+联通');
define('SLT_SHARE_YD_DX', '移动+电信');
define('SLT_SHARE_LT_DX', '联通+电信');
define('SLT_SHARE_YD_LT_DX', '移动+联通+电信');

//电表使用方
define('SLT_METERUSER_YD', '移动');
define('SLT_METERUSER_LT', '联通');
define('SLT_METERUSER_DX', '电信');
define('SLT_METERUSER_YD_LT', '移动+联通');
define('SLT_METERUSER_YD_DX', '移动+电信');
define('SLT_METERUSER_LT_DX', '联通+电信');
define('SLT_METERUSER_YD_LT_DX', '移动+联通+电信');

//提示
define('TIPS_SITE_INPUT', '请输入基站名称');
define('TIPS_PLEASE_SELECT_SITE', '请选择基站');

//操作结果
define('OPER_SITE_UPDATE_SUCCESS', '基站信息更新成功');
define('OPER_SITE_ADD_SUCCESS', '基站添加成功');
define('OPER_SITE_DELETE_SUCCESS', '基站删除成功');

//弹出框样式
define('ALERT_STYLE_SUCCESS', 1);
define('ALERT_STYLE_INFO', 2);
define('ALERT_STYLE_WARNING', 3);
define('ALERT_STYLE_DANGER', 4);

//错误信息
define('WARN_DATA_IS_NULL', '数据为空');
