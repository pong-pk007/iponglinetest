<?php

include ('./line-bot-api/php/line-bot.php');
$channelSecret = '19ad20fb23ec68ea532f42be2b2324ac';
$access_token = 'Or3FAdhd8meFbWg41YcM75+c+HTE9FceVh0/HUka68uPwc6UuAJNlOt2MguhlZDDry/kk0b8G8KXQUevco0cDwO/wpJEVrGseHrvR/10/fI9oCygwaOIPuO//WF2RN+j89uvpjnnM3hYflB+78UBDAdB04t89/1O/w1cDnyilFU=';
$bot = new BOT_API($channelSecret, $access_token);

if (!empty($bot->isEvents)) {

    $bot->replyMessageNew($bot->replyToken, json_encode($bot->message));
    if ($bot->isSuccess()) {
        echo 'Succeeded!';
        exit();
    }
    // Failed
    echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody();
    exit();
}
?>