<?php
// https://www.cnblogs.com/CraryPrimitiveMan/p/4385034.html

$host = 'localhost';
$database = 'jiapu';
$username = 'root';
$password = '123456';

set_time_limit(0); //  程序执行时间不限制

$conn = mysqli_connect($host, $username, $password);//连接到数据库
mysqli_query($conn,"set names 'utf8'");//编码转化
if (!$conn) {
    die("could not connect to the database.\n" . mysqli_error($conn));//诊断连接错误
}
$selectedDb = mysqli_select_db($conn,$database);//选择数据库
if (!$selectedDb) {
    die("could not to the database\n" . mysqli_error($conn));
}

mydata($conn);

function mydata($conn){
    // 查询 --s
    $query = "SELECT MAX(level) AS max_level FROM `jp_member` LIMIT 1"; //构建查询语句
    $result = mysqli_query($conn,$query);//执行查询
    if (!$result) {
        die("could not to the database\n" . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_row($result)) {
        // 取出结果并显示
        $max_level = $row[0];
    }
    // 查询 --e
    // $max_level = 8;  调试时先写一个较的数字
    for($al=1;$al<$max_level;$al+=4){
        // 查询 -- s
        $map = "level=".$al." and childs<>''";
        $query = "SELECT `id`,`pid`,`name` FROM `jp_member` WHERE ( ".$map." )";
        $result = mysqli_query($conn,$query);//执行查询
        if (!$result) {
            die("could not to the database\n" . mysqli_error($conn));
        }
        $i=0;
        while ($row = mysqli_fetch_row($result)) {
            // 取出结果并显示
            //取出结果并显示
            $id    = $row[0];
            $pid   = $row[1];
            $name  = $row[2];
            $list[$i]['id']     = $id;
            $list[$i]['pid']    = $pid;
            $list[$i]['name']   = $name;
            $i++;
        }
        // 查询 -----e
        foreach($list as $k=>$v){
            $tree[$v['id']] = data($conn,$al,$v['id']);
        }
    }


    if(!is_array($tree)){
        $tree = json_decode($tree,true);
    };

    // 对第一层重新书写
    $i=0;
    foreach($tree as $k=>$v){
        // 查询--s
        $query = "SELECT `name` FROM `jp_member` WHERE `id` = ".$k." LIMIT 1"; //构建查询语句
        $result = mysqli_query($conn,$query);//执行查询
        if (!$result) {
            die("could not to the database\n" . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_row($result)) {
            // 取出结果并显示
            $name  = $row[0];
        }
        // 查询 ----e
        $data[$i]['name']     = $name;
        $data[$i]['children'] = $v;
        $i++;
    }
    echo json_encode($data);
}

function data($conn,$level,$pidd){
    // 找到所有level=5,childs有值的。
    // 查询 --s
    $map = 'level<'.($level+6).' and level >'.$level ;
    $query = "SELECT `id`,`pid`,`name` FROM `jp_member` WHERE ( ".$map." )";
    $result = mysqli_query($conn,$query);//执行查询
    if (!$result) {
        die("could not to the database\n" . mysqli_error($conn));
    }
    $j=0;
    while ($row = mysqli_fetch_row($result)) {
        // 取出结果并显示
        //取出结果并显示
        $id    = $row[0];
        $pid   = $row[1];
        $name  = $row[2];
        $data[$j]['id']     = $id;
        $data[$j]['pid']    = $pid;
        $data[$j]['name']   = $name;
        $j++;
    }
    // 查询 -----e
    $res = getTree($conn,$data,$pidd);
    return $res;
}

function getTree($conn,$data,$pId)
{
    $tree = [];
    foreach($data as $k => $v)
    {
        if($v['pid'] == $pId)
        {
           /* echo '<pre>';
            var_dump($v['id']);
            echo '<pre>';*/

            // 父亲找到儿子
            $v['children'] = getTree($conn,$data,$v['id']);

          /*  echo '<pre>';
            echo 'children';
            var_dump($v['children']);
            echo '<pre>';*/

            // 查询---s
            $query ="SELECT `level` FROM `jp_member` WHERE `id` = ".$v['id']." LIMIT 1";
            $result = mysqli_query($conn,$query);//执行查询
            if (!$result) {
                die("could not to the database\n" . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_row($result)) {
                // 取出结果并显示
                $level  = $row[0];
            }
            // 查询 --e
            $v['level'] = $level;
            $tree[] = $v;
        }
    }
   /* echo '<pre>';
    echo 'tree';
    var_dump($tree);
    echo '<pre>';*/
    return $tree;
}