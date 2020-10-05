<?php
/*
// 함수를 호출해서 사용할거야.
// 값을 전달해주면, 문자열 전달할거야 .파일주소

$filename = "../"; // 상위폴더 (학번)
$filename .= "resource/layout.html"; // 복합연산자
// . 문자열을 더하는 연산자
// = 대입

//file_get_contents 함수는
// 파일을 읽어서 내용을 결과값으로 반환

$body = file_get_contents($filename);
$header = file_get_contents("../resource/header.html");

//body 에 str_replace 함수의 결과값을 대입
$body = str_replace("{{header}}", $header, $body);
$footer = file_get_contents("../resource/footer.html");
$body = str_replace("{footer}", $footer, $body);
echo $body;
*/
// 위에 함수는 파일을 읽어서 내용을 결과값으로 반환
if(!function_exists("html_get_resource")){
//함수가 있어요

function html_get_resource($layout,$path="layout.html")
{
     $filename = "../resource/".$layout."/".$path;
    $body = file_get_contents($path);
    return $body;
}
}