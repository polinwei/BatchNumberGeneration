
## php.ini 設定
<p>啟用 GD</p>
<p>extension=gd</p>

## DB 設定
<p>1. 建立資料庫: kpsft 或執行 src/kpsft_db.sql</p>
<p>2. 建立帳號/密碼: kpsft/kpsft 並且賦予資料庫: kpsft 權限</p>

## 批號產生設定
<p>config.php 中的 define('GENERATE_MODE',2); 為 QRCode 產生的模式  1:一天只有一個批號, 2:每次取得新的批號</p>
  