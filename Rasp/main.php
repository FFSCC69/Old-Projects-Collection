<?php

include "vk_api.php"; 
require_once 'connection.php'; // подключаем скрипт


const VK_KEY = "0ff6d61ca834492a7167b76eed9e6ad1b41e5a1f466d3440944a32e445251ac7405e0e7f39f5bb0721acd";  
const ACCESS_KEY = "bffd926d";
const VERSION = "5.81"; // Версия API VK

//основные переменные 
$vk = new vk_api(VK_KEY, VERSION); 
$data = json_decode(file_get_contents('php://input')); 

if ($data->type == 'confirmation') { 
    exit(ACCESS_KEY); 
}
$vk->sendOK(); 

$id = $data->object->from_id; 
$peer_id = $data->object->peer_id;
$message = $data->object->text;

//побочные переменные
$date = date("d-M-Y, l");
$time = date('H:i:s');

//одиночные ответы
if ($data->type == 'message_new') {

    switch ($message) {
        
        case '/get user id':
            $vk->sendMessage($peer_id,$id);
            break;
            
        case '/get peer id':
            $vk->sendMessage($peer_id,$peer_id);
            break;    
            
        case '/info':
            $vk->sendMessage($peer_id,'создано мной');
            break;
            
        case '/date':
            $vk->sendMessage($peer_id, $date);
        break;
        
        case '/time':
            $vk->sendMessage($peer_id, $time);
        break;
        
        case '/кто витя?':
            $vk->sendMessage($peer_id,'пидорас');
        break;
        
        case '/empty':
            $vk->sendMessage($peer_id,'&#12288;');
        break;
        
        case '/кто мопс?':
            $vk->sendMessage($peer_id,'вот [id208704026|он] кряхтит');
        break;
        
        case '/кто сейчас жрет?':
            $vk->sendMessage($peer_id,'потише [id426548819|чавкай] блин');
        break;
        
        case '/тест':
       
        break;
        
    }	

}