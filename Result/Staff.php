<?php

header("Content-Type:text/html;charset=utf-8");
class Staff
{
    //链接staff数据库
    function linkStaffsql(){
        //链接staffsql数据库 (数据库，用户名，密码，使用库)
        $sql = mysqli_connect('localhost','root','root','staffsql');
        if (!$sql)die('链接数据库出错！');
        //链接staff表
        mysqli_select_db($sql,"staff");
        return $sql;
    }

    //全部员工信息
    function Staffsql(){
        $sql = self::linkStaffsql();
        $result_sql = mysqli_query($sql,"select * from staff");
        if(!$result_sql)die('查询全部员工信息出错！');
        $result_sql_list=[];
        while ($row = mysqli_fetch_array($result_sql)) {
            array_push($result_sql_list,$row);
        }
        return $result_sql_list;
    }

    //插入员工信息到数据库 参数员工信息数组(name,number,sex,job) 返回是否成功
    function addStaffsql($result_arr){
        $sql = self::linkStaffsql();
        $result_sql = mysqli_query($sql,"insert into staff values ('','{$result_arr['name']}','{$result_arr['number']}','{$result_arr['sex']}','{$result_arr['job']}')");
        if (!$result_sql)die('插入员工信息失败！');
        return $result_sql;
    }

    //更改员工信息 参数员工信息数组(number,status,msg) 返回是否成功
    function changeStaffsql($result_arr){
        $sql = self::linkStaffsql();
        $result_sql = mysqli_query($sql,"update staff set {$result_arr['status']} = '{$result_arr['msg']}' where number={$result_arr['number']}");
        if (!$result_sql)die('更新员工信息失败！');
        return $result_sql;
    }

    //删除员工信息 参数员工编号(number) 返回是否成功
    function delteStaffsql($number){
        $sql = self::linkStaffsql();
        $result_sql = mysqli_query($sql,"delete from staff where number = {$number}");
        if (!$result_sql)die('删除员工信息失败！');
        return $result_sql;
    }


    //查询员工信息 参数员工编号 成功返回员工信息 失败返回没有找到员工！
    public function query($number){
        foreach (self::Staffsql() as $value){
            if ($value['number'] == $number){
                $result =array('success'=>'true','msg'=>'姓名:'.$value["name"].'|编号:'.$value["number"].'|性别:'.$value["sex"].'|职位:'.$value["job"]);
                return $result;
            }
        }
        $result = array('success'=>'true','msg'=>'没有找到员工！');
        return $result;
    }

    //插入员工信息 参数员工信息数组(name,number,sex,job) 返回是否成功
    public function addList($newStaff){
        return self::addStaffsql($newStaff);
    }

    //更改员工信息 参数员工信息数组(number,status,msg) 成功返回true 失败返回没有找到员工！
    public function update($msgList){
        //先查询员工是否存在
        $data = self::query($msgList['number']);
        if ($data['msg'] == '没有找到员工！'){
            print_r($data['msg']);die();
        }else{
            return self::changeStaffsql($msgList);
        }
    }

    //删除员工信息 参数员工编号(number) 返回是否成功
    public function delete($number){
        //先查询员工是否存在
        $data = self::query($number);
        if ($data['msg'] == '没有找到员工！'){
            print_r($data['msg']);die();
        }else{
            return self::delteStaffsql($number);
        }
    }
}
