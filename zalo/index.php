<?php
header('Access-Control-Allow-Origin: *');
$input = $_GET['input']      ?? 'Xin Chào';
$voice = $_GET['voice'] ?? '6';
$speed = $_GET['speed']      ?? '1';


$filename = md5($input . $voice . $speed) . '.mp3';

if (!file_exists($filename)) {
    if (in_array($voice, ['1', '2', '3', '4', '5', '6'])) {
        $postFields = http_build_query([
            'input'      => $input,
            'speaker_id' => $voice,
            'speed'      => $speed,
            'dict_id'    => 0,
            'quality'    => 0,
        ]);
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
    } else {
        $data = [
            'speed'             => floatval($speed),
            'voice'             => $voice,
            'text'              => $input,
            'tts_return_option' => 3,
            'without_filter'    => false,
        ];
        $fp = fopen($filename, 'wb');

        $ch = curl_init('https://viettelai.vn/tts/speech_synthesis');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Connection: keep-alive',
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if (curl_exec($ch) === false) {
            die(curl_error($ch));
        }

        curl_close($ch);
        fclose($fp);
    }
}

header('Content-Type: audio/mpeg');
readfile($filename);
