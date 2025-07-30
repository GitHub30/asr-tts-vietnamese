<?php
header('Access-Control-Allow-Origin: *');

$postFields = http_build_query([
    'input'      => $_GET['input']      ?? 'Xin Chào',
    'speaker_id' => $_GET['speaker_id'] ?? '6',
    'speed'      => $_GET['speed']      ?? '1',
    'dict_id'    => 0,
    'quality'    => 0,
]);

$filename = md5($postFields) . '.mp3';

if (!file_exists($filename)) {
    $ch = curl_init('https://ai.zalo.cloud/api/demo/v1/tts/synthesize');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $postFields,
        CURLOPT_HTTPHEADER     => [
            'origin: https://ai.zalo.cloud',
            'referer: https://ai.zalo.cloud/products/text-to-audio-converter',
        ],
        CURLOPT_COOKIE         => 'zai_did=8k9uAj3FNiTevcSSryzXoYYo64d0o6V3AB4PHJ8q',
    ]);
    $response = curl_exec($ch);
    if ($response === false) {
        die(curl_error($ch));
    }
    curl_close($ch);

    $obj = json_decode($response);
    if ($obj->error_code) {
        header('Content-Type: application/json');
        die($response);
    }

    $url = escapeshellarg($obj->data->url);
    exec("./ffmpeg -loglevel error -y -i $url $filename");
}

header('Content-Type: audio/mpeg');
readfile($filename);
