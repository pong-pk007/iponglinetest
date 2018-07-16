<?php
//include ('./line-bot-api/php/line-bot.php');
//$channelSecret = '19ad20fb23ec68ea532f42be2b2324ac';
//$access_token = 'Or3FAdhd8meFbWg41YcM75+c+HTE9FceVh0/HUka68uPwc6UuAJNlOt2MguhlZDDry/kk0b8G8KXQUevco0cDwO/wpJEVrGseHrvR/10/fI9oCygwaOIPuO//WF2RN+j89uvpjnnM3hYflB+78UBDAdB04t89/1O/w1cDnyilFU=';
//$bot = new BOT_API($channelSecret, $access_token);
//
//if (!empty($bot->isEvents)) {
//
//    $bot->replyMessageNew($bot->replyToken, json_encode($bot->message));
//    if ($bot->isSuccess()) {
//        echo 'Succeeded!';
//        exit();
//    }
//    // Failed
//    echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody();
//    exit();
//}



$accessToken = "Or3FAdhd8meFbWg41YcM75+c+HTE9FceVh0/HUka68uPwc6UuAJNlOt2MguhlZDDry/kk0b8G8KXQUevco0cDwO/wpJEVrGseHrvR/10/fI9oCygwaOIPuO//WF2RN+j89uvpjnnM3hYflB+78UBDAdB04t89/1O/w1cDnyilFU="; //copy Channel access token ตอนที่ตั้งค่ามาใส่

$content = file_get_contents('php://input');
$arrayJson = json_decode($content, true);

$arrayHeader = array();
$arrayHeader[] = "Content-Type: application/json";
$arrayHeader[] = "Authorization: Bearer {$accessToken}";

//รับข้อความจากผู้ใช้
$message = $arrayJson['events'][0]['message']['text'];

//รับ id ของผู้ใช้
if(isset($arrayJson['events'][0]['source']['userId'])){
    $id = $arrayJson['events'][0]['source']['userId'];
}else{
    $id = $arrayJson['events'][0]['source']['groupId'];
}


#ตัวอย่าง Message Type "Text"
if ($message == "สวัสดี") {
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "text";
    $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
    replyMsg($arrayHeader, $arrayPostData);
}
#ตัวอย่าง Message Type "Sticker"
else if ($message == "ฝันดี") {
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "sticker";
    $arrayPostData['messages'][0]['packageId'] = "2";
    $arrayPostData['messages'][0]['stickerId'] = "46";
    replyMsg($arrayHeader, $arrayPostData);
}
#ตัวอย่าง Message Type "Image"
else if ($message == "รูปน้องแมว") {
    $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "image";
    $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
    $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
    replyMsg($arrayHeader, $arrayPostData);
}
#ตัวอย่าง Message Type "Location"
else if ($message == "พิกัดสยามพารากอน") {
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "location";
    $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
    $arrayPostData['messages'][0]['address'] = "13.7465354,100.532752";
    $arrayPostData['messages'][0]['latitude'] = "13.7465354";
    $arrayPostData['messages'][0]['longitude'] = "100.532752";
    replyMsg($arrayHeader, $arrayPostData);
}
#ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
else if ($message == "ลาก่อน") {
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "text";
    $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
    $arrayPostData['messages'][1]['type'] = "sticker";
    $arrayPostData['messages'][1]['packageId'] = "1";
    $arrayPostData['messages'][1]['stickerId'] = "131";
    replyMsg($arrayHeader, $arrayPostData);
} else if ($message == "นับ 1-10") {
    for ($i = 1; $i <= 10; $i++) {
        $arrayPostData['to'] = $id;
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = $i;
        pushMsg($arrayHeader, $arrayPostData);
    }
}

function pushMsg($arrayHeader, $arrayPostData) {
    $strUrl = "https://api.line.me/v2/bot/message/push";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $strUrl);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
}

function replyMsg($arrayHeader, $arrayPostData) {
    $strUrl = "https://api.line.me/v2/bot/message/reply";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $strUrl);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
}

exit;
?>

<!--https://iponglinetest.herokuapp.com/zna_bot.php-->