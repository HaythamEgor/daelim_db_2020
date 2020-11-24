<?php
// echo "대림대학교";

include "theme.conf.php";
$dbinfo = include "../dbinfo.php";  // 암호 보안 기법 
include "desc.php";

// 객체 생성
$db0 = new mysqli(
    $dbinfo['master']['dbhost'],  // mysql 서버 주소
    $dbinfo['master']['dbuser'],  // 사용자 아이디
    $dbinfo['master']['dbpass'],  // 사용자 비밀번호
    $dbinfo['master']['dbschema']  // 스키마
);

if($db0) {
    // echo "DB 접속 성공"."<br>"; 
    $query = "SELECT * FROM phpdaelim4.".$tablename.";";  // SQL QUERY문
    $result = mysqli_query($db0, $query);  // DB서버로 전송
    if($result){
        // echo "<pre>";
        // print_r($rows);
        $rows = getRowData($result);
        
    }
    // echo "<a href='new.php'>New</a>";

    // 파일을 읽어서, 변수에 넣어주세요.
    $layout = file_get_contents($theme['layout']);

    $contents = file_get_contents($theme['list']);
    $contents = str_replace("{{datatable}}", viewTable($rows), $contents);

    $layout = str_replace("{{contents}}", $contents, $layout);
    echo $layout;

} else {
    echo "DB 접속 실패"."<br>";
}

function getRowData($result) {
    $cnt = mysqli_num_rows($result);
    // echo "데이터의 갯수는 = ".$cnt."<br>";

    $rows = [];  // 배열을 초기화
        for($i = 0; $i < $cnt; $i++) {
            // 여러 개의 데이터가 들어가 있는 2차원 배열
            $rows [] = mysqli_fetch_object($result);
        }
        // 2차원 배열 반환
        return $rows;
}

function viewTable($rows) {
    global $db0,$tablename;

    // 이스케이프를 이용하면 " 안에 "문자를 삽입할 수 있음
    $str = "<table class=\"table table-striped\">";  // 변수 초기화
    
    // $tablename = "instagram";
    $fields = desc($db0, $tablename);
    $str .= "<tr>";
    foreach($fields as $name) {
        $str .= "<td>".$name."</td>";
    }
    $str .= "</tr>";

    // 반복문
    for($i = 0; $i < count($rows); $i++) {
        $str .= "<tr>";

        foreach($rows[$i] as $field => $value) {
            if($field == "title") {
                $str .= "<td>"."<a href='edit.php?id=".$rows[$i]->id."'>".$value."</a>"."</td>";
            } else {
                $str .= "<td>".$value."</td>";
            } 
        }
        
        // echo "<td>".$row->username."</td>";
        // echo "<td>".$row->usernum."</td>";

        $str .= "</tr>";
    }
    $str .= "</table>";
    return $str;
}
