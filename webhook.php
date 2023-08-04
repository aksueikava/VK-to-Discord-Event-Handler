<?php 
if (!isset($_REQUEST)) { 
    return; 
} 
$confirmation_token = '0f5c65fc'; // token
$data = json_decode(file_get_contents('php://input')); 
$lelu = json_decode(file_get_contents('php://input'), true); 
switch ($data->type) { 
    case 'confirmation': 
    echo $confirmation_token; 
    break; 
    case 'wall_post_new':
    $messageSS = $data->object->text;
    $currenttime = $data->object->date;
    $url = "https://discordapp.com/api/webhooks/"; // webhook
    $hookObject = json_encode([
        "content" => "",
        "username" => "",
        "avatar_url" => "",
        "tts" => false,
        "embeds" => [
            [
                "title" => "",
                "type" => "rich",
                "description" => "$messageSS",
                "url" => "",
                "timestamp" => "",
                "color" => "blue",
                "footer" => [
                    "text" => "Akvityxs • Date: $currenttime",
                    "icon_url" => "https://pngicon.ru/file/uploads/vk.png"
                ],
                "thumbnail" => [
                    "url" => "https://cdn.discordapp.com/banners/775595984335667200/a_29eba09c9160f01d1a8e9c568e24fb64.gif"
                ],
                "author" => [
                    "name" => "Новая новость ВК!"
                ]
            ]
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
    $ch = curl_init();
    curl_setopt_array( $ch, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $hookObject,
        CURLOPT_HTTPHEADER => [
            "Length" => strlen( $hookObject ),
            "Content-Type" => "application/json"
        ]
    ]);
    $response = curl_exec( $ch );
    curl_close( $ch );
    break;
}
?> 
