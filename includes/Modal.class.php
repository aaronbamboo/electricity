<?php  
require_once 'resources/CTCCodes.php';
// 连接数据库  
class Db {  
    static public function getDB() {  
        try {  
            $pdo = new PDO(DB_DSN, DB_USER, DB_PWD);  
            $pdo->setAttribute(PDO::ATTR_PERSISTENT, true);  // 设置数据库连接为持久连接  
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // 设置抛出错误  
            $pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, true);  // 设置当字符串为空转换为 SQL 的 NULL  
            $pdo->query('SET NAMES utf8');  // 设置数据库编码  
        } catch (PDOException $e) {  
            exit('数据库连接错误，错误信息：'. $e->getMessage());  
        }  
        return $pdo;  
    }  
}  


/** 
* 数据库操作类库 
* author Lee.  
* Last modify $Date: 2012-1-19 13:59；04 $ 
*/  
class M {  
    private $_db;  //数据库句柄  
    public  $_sql; //SQL语句  
  
  
    /** 
     * 构造方法 
     */  
    public function __construct() {  
        $this->_db = Db::getDB();  
    }  
      
    /**  
     * 数据库添加操作 
     * @param string $tName 表名 
     * @param array $field 字段数组 
     * @param array $val 值数组 
     * @param bool $is_lastInsertId 是否返回添加ID 
     * @return int 默认返回成功与否，$is_lastInsertId 为true，返回添加ID 
     */  
    public function insert($tName, $fields, $vals, $is_lastInsertId=FALSE) {  
        try {  
            if (!is_array($fields) || !is_array($vals))   
                exit($this->getError(__FUNCTION__, __LINE__));  
            $fields = $this->formatArr($fields);  
            $vals = $this->formatArr($vals, false);  
            $tName = $this->formatTabName($tName);  
            $this->_sql = "INSERT INTO {$tName} ({$fields}) VALUES ({$vals})";  
            if (!$is_lastInsertId) {  
                $row = $this->_db->exec($this->_sql);  
                return $row;  
            } else {  
                $this->_db->exec($this->_sql);  
                $lastId = (int)$this->_db->lastInsertId();  
                return $lastId;  
            }  
        } catch (PDOException $e) {  
            exit($e->getMessage());  
        }  
    }  
  
  
    /**  
     * 数据库修改操作 
     * @param string $tName 表名 
     * @param array $field 字段数组 
     * @param array $val 值数组 
     * @param string $condition 条件 
     * @return int 受影响的行数 
     */  
    public function update($tName, $fieldVal, $condition) {  
        try {  
            if (!is_array($fieldVal) || !is_string($tName) || !is_string($condition))  
                exit($this->getError(__FUNCTION__, __LINE__));  
            $tName = $this->formatTabName($tName);  
            $upStr = '';  
            foreach ($fieldVal as $k=>$v) {  
                $upStr .= '`'.$k . '`=' . '\'' . $v . '\'' . ',';  
            }  
            $upStr = rtrim($upStr, ',');  
            $this->_sql = "UPDATE {$tName} SET {$upStr} WHERE {$condition}";  
            $row = $this->_db->exec($this->_sql);  
            return $row;  
        } catch (PDOException $e) {  
            exit($e->getMessage());  
        }  
    }  
  
  
    /** 
     * 数据库删除操作（注：必须添加 where 条件） 
     * @param string $tName 表名 
     * @param string $condition 条件 
     * @return int 受影响的行数 
     */  
    public function del($tName, $condition) {  
        try {  
            if (!is_string($tName) || !is_string($condition))   
                exit($this->getError(__FUNCTION__, __LINE__));  
            $tName= $this->formatTabName($tName);  
            $this->_sql = "DELETE FROM {$tName} WHERE {$condition}";  
            $row = $this->_db->exec($this->_sql);  
            return $row;  
        } catch (PDOException $e) {  
            exit($e->getMessage());  
        }  
    }  
    
    /**
     * 
     * @param type $sql
     * @return type
     */
    public function execSQL($sql) {  
        try {  
            if (!is_string($sql))   
                exit($this->getError(__FUNCTION__, __LINE__));   
            $this->_db->exec($sql);  
            return ;  
        } catch (PDOException $e) {  
            exit($e->getMessage());  
        }  
    }  
  
  
    /**  
     * 返回表总个数 
     * @param string $tName 表名 
     * @param string $condition 条件 
     * @return int 
     */  
    public function total($tName, $condition='') {  
        try {  
            if (!is_string($tName))   
                exit($this->getError(__FUNCTION__, __LINE__));  
            $tName = $this->formatTabName($tName);  
            $this->_sql = "SELECT COUNT(*) AS total FROM {$tName}" .   
            ($condition=='' ? '' : ' WHERE ' . $condition);  
            $re = $this->_db->query($this->_sql);  
            foreach ($re as $v) {  
                $total = $v['total'];  
            }  
            return (int)$total;  
        } catch (PDOException $e) {  
            exit($e->getMessage());  
        }  
    }  
  
  
    /** 
     * 数据库删除多条数据 
     * @param string $tName 表名 
     * @param string $field 依赖字段 
     * @param array $ids 删除数组 
     * @return int 受影响的行数 
     */  
    public function delMulti($tName, $field, $ids) {  
        try {  
            if (!is_string($tName) || !is_array($ids))   
                exit($this->getError(__FUNCTION__, __LINE__));  
            $delStr = '';  
            $tName  = $this->formatTabName($tName);  
            $field  = $this->formatTabName($field);  
            foreach ($ids as $v) {  
                $delStr .= $v . ',';  
            }  
            $delStr = rtrim($delStr, ',');  
            $this->_sql = "DELETE FROM {$tName} WHERE {$field} IN ({$delStr})";  
            $row = $this->_db->exec($this->_sql);  
            return $row;  
        } catch (PDOException $e) {  
            exit($e->getMessage());  
        }  
    }  
  
  
    /** 
     * 获取表格的最后主键（注：针对 INT 类型） 
     * @param string $tName 表名 
     * @return int 
     */  
    public function insertId($tName) {  
        try {  
            if (!is_string($tName))   
                exit($this->getError(__FUNCTION__, __LINE__));  
            $this->_sql = "SHOW TABLE STATUS LIKE '{$tName}'";  
            $result = $this->_db->query($this->_sql);  
            $insert_id = 0;  
            foreach ($result as $v) {  
                $insert_id = $v['Auto_increment'];  
            }  
            return (int)$insert_id;  
        } catch (PDOException $e) {  
            exit($e->getMessage());  
        }  
    }  
  
  
    /** 
     * 检查数据是否已经存在（依赖条件） 
     * @param string $tName 表名  
     * @param string $field 依赖的字段 
     * @return bool 
     */  
    public function exists($tName, $condition) {  
        try {  
            if (!is_string($tName) || !is_string($condition))  
                exit($this->getError(__FUNCTION__, __LINE__));  
            $tName = $this->formatTabName($tName);  
            $this->_sql = "SELECT COUNT(*) AS total FROM {$tName} WHERE {$condition}";  
            $result = $this->_db->query($this->_sql);  
            foreach ($result as $v) {  
                 $b = $v['total'];  
            }  
            if ($b) {  
                return true;  
            } else {  
                return false;  
            }  
        } catch (PDOException $e) {  
            exit($e->getMessage());  
        }  
    }  
  
  
    /** 
     * 检查数据是否已经存在（依赖 INT 主键） 
     * @param string $tName 表名  
     * @param string $primary 主键 
     * @param int $id 主键值 
     * @return bool 
     */  
    public function existsByPK($tName, $primary, $id) {  
        try {  
            if (!is_string($tName) || !is_string($primary)  
            || !is_int($id))  
                exit($this->getError(__FUNCTION__, __LINE__));  
            $tName = $this->formatTabName($tName);  
            $this->_sql = "SELECT COUNT(*) AS total FROM {$tName} WHERE {$primary} = ". $id;  
            $result = $this->_db->query($this->_sql);  
            foreach ($result as $v) {  
                 $b = $v['total'];  
            }  
            if ($b) {  
                return true;  
            } else {  
                return false;  
            }  
        } catch (PDOException $e) {  
            exit($e->getMessage());  
        }  
    }  
  
  
    /** 
     * 预处理删除（注：针对主键为 INT 类型，推荐使用） 
     * @param string $tName 表名 
     * @param string $primary 主键字段 
     * @param int or array or string $ids 如果是删除一条为 INT，多条为 array，删除一个范围为 string 
     * @return int 返回受影响的行数 
     */  
    public function delByPK($tName, $primary, $ids, $mult=FALSE) {  
        try {  
            if (!is_string($tName) || !is_string($primary)   
            || (!is_int($ids) && !is_array($ids) && !is_string($ids))  
            || !is_bool($mult)) exit($this->getError(__FUNCTION__, __LINE__));  
            $tName = $this->formatTabName($tName);  
            $stmt = $this->_db->prepare("DELETE FROM {$tName} WHERE {$primary}=?");  
            if (!$mult) {  
                $stmt->bindParam(1, $ids);  
                $row = $stmt->execute();  
            } else {  
                if (is_array($ids)) {  
                    $row = 0;  
                    foreach ($ids as $v) {  
                        $stmt->bindParam(1, $v);  
                        if ($stmt->execute()) {  
                            $row++;  
                        }  
                    }  
                } elseif (is_string($ids)) {  
                    if (!strpos($ids, '-'))   
                        exit($this->getError(__FUNCTION__, __LINE__));  
                    $split = explode('-', $ids);  
                    if (count($split)!=2 || $split[0]>$split[1])   
                        exit($this->getError(__FUNCTION__, __LINE__));  
                    $i = null;  
                    $count = $split[1]-$split[0]+1;  
                    for ($i=0; $i<$count; $i++) {  
                        $idArr[$i] = $split[0]++;  
                    }  
                    $idStr = '';  
                    foreach ($idArr as $id) {  
                        $idStr .= $id . ',';  
                    }  
                    $idStr = rtrim($idStr, ',');  
                    $this->_sql ="DELETE FROM {$tName} WHERE {$primary} in ({$idStr})";  
                    $row = $this->_db->exec($this->_sql);  
                }  
            }  
            return $row;  
        } catch (PDOException $e) {  
            exit($e->getMessage());  
        }  
    }  
  
  
    /** 
     * 返回单个字段数据或单条记录 
     * @param string $tName 表名 
     * @param string $condition 条件 
     * @param string or array $fields 返回的字段，默认是* 
     * @return string || array 
     */  
    public function getRow($tName, $condition='', $fields="*") {  
        try {  
            if (!is_string($tName) || !is_string($condition)   
            || !is_string($fields) || empty($fields))  
                 exit($this->getError(__FUNCTION__, __LINE__));  
            $tName = $this->formatTabName($tName);  
            $this->_sql = "SELECT {$fields} FROM {$tName} ";  
            $this->_sql .= ($condition=='' ? '' : "WHERE {$condition}") . " LIMIT 1";  
            $sth = $this->_db->prepare($this->_sql);  
            $sth->execute();  
            $result = $sth->fetch(PDO::FETCH_ASSOC);  
            if ($fields === '*') {  
                return $result;  
            } else {  
                return $result[$fields];  
            }  
        } catch (PDOException $e) {  
            exit($e->getMessage());  
        }  
    }  
  
  
    /** 
     * 返回多条数据 
     * @param string $tName 表名 
     * @param string $fields 返回字段，默认为* 
     * @param string $condition 条件 
     * @param string $order 排序 
     * @param string $limit 显示个数 
     * @return PDOStatement 
     */  
    public function getAll($tName, $fields='*', $condition='', $order='', $limit='') {  
        try {  
            if (!is_string($tName) || !is_string($fields)   
            || !is_string($condition) || !is_string($order)   
            || !is_string($limit))  
                exit($this->getError(__FUNCTION__, __LINE__));  
            $tName = $this->formatTabName($tName);  
            $fields = ($fields=='*' || $fields=='') ? '*' : $fields;  
            $condition = $condition=='' ? '' : " WHERE ". $condition ;  
            $order = $order=='' ? '' : " ORDER BY ". $order;  
            $limit = $limit=='' ? '' : " LIMIT ". $limit;  
            $this->_sql = "SELECT {$fields} FROM {$tName} {$condition} {$order} {$limit}";  
            $sth = $this->_db->prepare($this->_sql);  
            $sth->execute();  
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);  
            return $result;  
        } catch (PDOException $e) {  
            exit($e->getMessage());  
        }  
    }  
  
  
    /** 
     * 格式化数组（表结构和值） 
     * @param array $field 
     * @param bool $isField 
     * @return string 
     */  
    private function formatArr($field, $isField=TRUE) {  
        if (!is_array($field)) exit($this->getError(__FUNCTION__, __LINE__));  
        $fields = '';  
        if ($isField) {  
            foreach ($field as $v) {  
                $fields .= '`'.$v.'`,';  
            }  
        } else {  
            foreach ($field as $v) {  
                $fields .= '\''.$v.'\''.',';  
            }  
        }  
        $fields = rtrim($fields, ',');  
        return $fields;  
    }  
  
  
    /** 
     * 格式化问号 
     * @param int $count 数量 
     * @return string 返回格式化后的字符串 
     */  
    private function formatMark($count) {  
        $str = '';  
        if (!is_int($count)) exit($this->getError(__FUNCTION__, __LINE__));  
        if ($count==1) return '?';  
        for ($i=0; $i<$count; $i++) {  
            $str .= '?,';  
        }  
        return rtrim($str, ',');  
    }  
  
  
    /** 
     * 错误提示 
     * @param string $fun 
     * @return string 
     */  
    private function getError($fun, $line) {  
        return __CLASS__  . '->' . $fun . '() line<font color="red">'. $line .'</font> ERROR!';  
    }  
      
    /** 
     * 处理表名 
     * @param string $tName 
     * @return string 
     */  
    private function formatTabName($tName) {  
        return '`' . trim($tName, '`') . '`';  
    }  
      
    /** 
     * 析构方法 
     */  
    public function __destruct() {  
        $this->_db = null;  
    }  
}  