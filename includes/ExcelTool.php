<?php

/**
 * Created by PhpStorm.
 * User: chenzhuohua
 * Date: 16/9/28
 * Time: 下午3:15
 * Function: Excel操作类
 */
require_once 'PHPExcel/Classes/PHPExcel.php';

class ExcelTool
{

    public function outputSiteExcel($data)
    {
        if(!$data) {
            throw new Exception(WARN_DATA_IS_NULL);
            //$message = new AlertMessager(WARN_DATA_IS_NULL, ALERT_STYLE_WARNING);
            return;
        }

        //echo "<script> alert('". print_r($data)   ."') </script>";

        //创建对象
        $excel = new PHPExcel();
        //表头列序号
        $letter = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I');

        //表头数组
        $tableheader = array('区域', '基站编号', '基站名称', '共享方', '电表使用方', '移动直流负载', '联通直流负载',
            '电信直流负载', '备注');
        //填充表头信息
        for ($i = 0; $i < count($tableheader); $i++) {
            $excel->getActiveSheet()->setCellValue("$letter[$i]1", "$tableheader[$i]");
        }

//        $data = array(
//            array('越城', 'SXYC0001', '绍兴越城黄酒博物馆', '移动', '移动','20','0','0',''),
//            array('越城', 'SXYC0002', '绍兴越城中医院', '移动', '移动','20','0','0',''),
//            array('越城', 'SXYC0003', '绍兴越城妇保院', '移动', '移动','20','0','0',''),
//            array('越城', 'SXYC0004', '绍兴越城人民医院', '移动', '移动','20','0','0','')
//        );
        //填充表格信息
        for ($i = 2; $i <= count($data) + 1; $i++) {
            $j = 0;
            foreach ($data[$i - 2] as $key => $value) {

                $excel->getActiveSheet()->setCellValue($letter[$j].$i, $value);
                $j++;
            }
        }

        //创建Excel输入对象
        $write = new PHPExcel_Writer_Excel5($excel);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        header('Content-Disposition:attachment;filename="testdata.xls"');
        header("Content-Transfer-Encoding:binary");
        $write->save('php://output');
    }

}