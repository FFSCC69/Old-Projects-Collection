<?php

include "vk_api.php"; 
require_once 'connection.php'; // подключаем скрипт


const VK_KEY = "0ff6d61ca834492a7167b76eed9e6ad1b41e5a1f466d3440944a32e445251ac7405e0e7f39f5bb0721acd";  // Токен сообщества
const ACCESS_KEY = "bffd926d";  // Тот самый ключ из сообщества 
const VERSION = "5.81"; // Версия API VK

$vk = new vk_api(VK_KEY, VERSION); 
$data = json_decode(file_get_contents('php://input')); 

if ($data->type == 'confirmation') { 
    exit(ACCESS_KEY); 
}
$id = 274442840;
$vk->sendOK(); 
$peer_id = 2000000003;
$dof = idate(w);
 
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
$query ="SELECT * FROM lessons1 WHERE day_of_week = $dof AND NOT flag_lesson = 0";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 


while($row = mysqli_fetch_assoc($result)){
    $lesson_time_string = $row['lesson_time'];
    $lesson_number = $row['lesson_number'];
    $zoom_id = $row['zoom_id'];
    $zoom_pass = $row['zoom_pass'];
    $teacher = $row['teacher'];
    $lesson_name = $row['lesson_name'];
    $time_elements = explode('-',$lesson_time_string);
    $start_elements = explode(':',$time_elements[0]);
    $lessonMinsMinus5 = $start_elements[1] - 5;
    $timeNow = mktime(idate(H),idate(i),0,10,10,2010);
    $timeLessonMinus5 = mktime($start_elements[0],$lessonMinsMinus5,0,10,10,2010);
    if ($timeNow == $timeLessonMinus5) {

            $vk->sendMessage($peer_id,'Через 5 минут начинается<br>'.$lesson_name.' | '.$lesson_time_string.'<br>ZoomID | '.$zoom_id.'<br>Пароль | '.$zoom_pass);
			
        }
}

