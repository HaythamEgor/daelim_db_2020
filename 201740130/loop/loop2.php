<?php
$msg = "abcdefghijk";
# echo $msg;
for ($i=0; $i<strlen($msg); $i++){
    //echo $msg[$i]; //숫자로 선택하는 배열 => 순차배열
    $str = $msg[$i];
    echo ++$str;
    print "<br>";
}