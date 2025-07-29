# asr-tts-vietnamese

```bash
mkdir zalo && cd zalo
wget https://github.com/ffbinaries/ffbinaries-prebuilt/releases/download/v6.1/ffmpeg-6.1-linux-64.zip && unzip ffmpeg-6.1-linux-64.zip


./ffmpeg -i "$(curl 'https://ai.zalo.cloud/api/demo/v1/tts/synthesize' -b 'zai_did=8k9uAj3FNiTevcSSryzXoYYo6Kt7oMVAAR8RJpOp' -H 'origin: https://ai.zalo.cloud' -H 'referer: https://ai.zalo.cloud/products/text-to-audio-converter' --data 'input=Xin+chào+bạn&speaker_id=6&speed=0.9&dict_id=0&quality=0' | jq -r .data.url)" output.mp3
```
