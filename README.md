# asr-tts-vietnamese

wget '[https://xs679698.xsrv.jp/zalo?input=Xin chào các bạn](<https://xs679698.xsrv.jp/zalo?input=Xin chào các bạn>)' -O audio.mp3

wget '[https://xs679698.xsrv.jp/zalo?input=Xin chào các bạn&speaker_id=1&speed=0.8](<https://xs679698.xsrv.jp/zalo?input=Xin chào các bạn&speaker_id=1&speed=0.8>)' -O audio.mp3

## params

### speaker_id

4: Northern man

3: Southern man

2: Northern woman

1: Southern woman

5: Northern women 2

6: South women 2

### speed

0.8 0.9 1 1.1 1.2

## curl

```bash
mkdir zalo && cd zalo
wget https://github.com/ffbinaries/ffbinaries-prebuilt/releases/download/v6.1/ffmpeg-6.1-linux-64.zip && unzip ffmpeg-6.1-linux-64.zip


./ffmpeg -i "$(curl https://ai.zalo.cloud/api/demo/v1/tts/synthesize -b zai_did=8k9uAj3FNiTevcSSryzXoYYo64d0o6V3AB4PHJ8q -H origin:https://ai.zalo.cloud -H referer:https://ai.zalo.cloud/products/text-to-audio-converter --data 'input=Xin+chào+bạn&speaker_id=6&speed=0.9&dict_id=0&quality=0' | jq -r .data.url)" output.mp3
```

```bash
curl https://viettelai.vn/tts/speech_synthesis -H Connection:keep-alive -H Content-Type:application/json --data '{"speed":1,"voice":"hcm-diemmy","text":"Xin chào bạn","tts_return_option":3,"without_filter":false}' -o output.mp3
```
