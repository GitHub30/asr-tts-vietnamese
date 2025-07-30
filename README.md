# asr-tts-vietnamese

wget '[https://xs679698.xsrv.jp/zalo?input=Xin chào các bạn](<https://xs679698.xsrv.jp/zalo?input=Xin chào các bạn>)' -O audio.mp3

wget '[https://xs679698.xsrv.jp/zalo?input=Xin chào các bạn&voice=1&speed=0.8](<https://xs679698.xsrv.jp/zalo?input=Xin chào các bạn&voice=1&speed=0.8>)' -O audio.mp3

## params

### voice

| Voice          | Name         | Gender | Location | Service |
| -------------- | ------------ | ------ | -------- | ------- |
|              4 |              | Male   | Northern | Zalo    |
|              2 |              | Female | Northern | Zalo    |
|              5 |              | Female | Northern | Zalo    |
|              3 |              | Male   | Southern | Zalo    |
|              1 |              | Female | Southern | Zalo    |
|              6 |              | Female | Southern | Zalo    |
|    hn-quynhanh | Quỳnh Anh    | Female | Northern | Viettel |
|     hn-thaochi | Thảo Chi     | Female | Northern | Viettel |
|   hn-thanhtung | Thanh Tùng   | Male   | Northern | Viettel |
|    hn-namkhanh | Nam Khánh    | Male   | Northern | Viettel |
| hn-phuongtrang | Phương Trang | Female | Northern | Viettel |
|     hn-thanhha | Thanh Hà     | Female | Northern | Viettel |
| hn-thanhphuong | Thanh Phương | Female | Northern | Viettel |
|    hn-tienquan | Tiến Quân    | Male   | Northern | Viettel |
|    hue-maingoc | Mai Ngọc     | Female | Central  | Viettel |
|    hue-baoquoc | Bảo Quốc     | Male   | Central  | Viettel |
|     hcm-diemmy | Diễm My      | Female | Southern | Viettel |
|   hcm-thuydung | Thùy Dung    | Female | Southern | Viettel |
|       hn-leyen | Lê Yến       | Female | Southern | Viettel |
|   hcm-phuongly | Phương Ly    | Female | Southern | Viettel |
|   hcm-minhquan | Minh Quân    | Male   | Southern | Viettel |
|  hcm-thuyduyen | Thùy Duyên   | Female | Southern | Viettel |


### speed

```yaml
0.8
0.9
1.0
1.1
1.2
```

## curl

```bash
mkdir zalo && cd zalo
wget https://github.com/ffbinaries/ffbinaries-prebuilt/releases/download/v6.1/ffmpeg-6.1-linux-64.zip && unzip ffmpeg-6.1-linux-64.zip


./ffmpeg -i "$(curl https://ai.zalo.cloud/api/demo/v1/tts/synthesize -b zai_did=8k9uAj3FNiTevcSSryzXoYYo64d0o6V3AB4PHJ8q -H origin:https://ai.zalo.cloud -H referer:https://ai.zalo.cloud/products/text-to-audio-converter --data 'input=Xin+chào+bạn&speaker_id=6&speed=0.9&dict_id=0&quality=0' | jq -r .data.url)" output.mp3
```

https://ai.zalo.cloud/products/text-to-audio-converter

```bash
curl https://viettelai.vn/tts/speech_synthesis -H Connection:keep-alive -H Content-Type:application/json --data '{"speed":1,"voice":"hcm-diemmy","text":"Xin chào bạn","tts_return_option":3,"without_filter":false}' -o output.mp3
```

https://viettelai.vn/en/chuyen-giong-noi
