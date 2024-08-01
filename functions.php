<?php

/**
 * 網站首頁網址 
 */
function home_url($context_url='') {
  if (empty($context_url)) {
    return ABS_URL;
  } else {
    return ABS_URL . $context_url;
  }    
}
/**
 * 取得今天的年月日, 格式為:yyyymmdd
 */
function get_today() {
  return date("Ymd");
}

/**
 * 取得今天目前的 QRCode 資料
 */
function get_today_current_qrcode() {
  global $db;

  // 取得今天的 QRCode 
  $today = get_today();  
  $sql = "SELECT * FROM kmi_qrcode WHERE qrcode_date=$today ";  
  $qrcode_data = $db->query($sql)->fetchArray();
  return $qrcode_data;
}

/**
 * 產生今天一筆 today+001 的 QRCode 資料
 * 
 */
function get_today_one_qrcode() {
  global $db;
  // 取得今天的 QRCode 
  $today = get_today();  
  $sql = "SELECT * FROM kmi_qrcode WHERE qrcode_date=$today ";  
  $qrcode_data = $db->query($sql)->fetchArray();

  // 沒有資料時, 新增一筆
  if (empty($qrcode_data)) {
    $filename = 'kmi_'.$today.'001'.'.png' ;
    $sql = "INSERT INTO kmi_qrcode (qrcode_date, qrcode_no, qrcode_filename, createDate, updateDate) VALUES " ;
    $sql .= " ('$today', '001', '$filename', NOW(), NOW() )";
    $db->query($sql);
    $insert_id = $db->lastInsertID();
    $sql = "SELECT * FROM kmi_qrcode WHERE id=$insert_id ";  
    $qrcode_data = $db->query($sql)->fetchArray();
  }
  //產生 QRcode 圖檔
  $today_one_qrcode = $qrcode_data['qrcode_date'].$qrcode_data['qrcode_no'];
  $errorCorrectionLevel = 'H'; // 'L','M','Q','H'
  $matrixPointSize = 15;
  $filename = 'kmi_'.$today_one_qrcode.'.png' ;
  QRcode::png($today_one_qrcode, PNG_TEMP_DIR . $filename, $errorCorrectionLevel, $matrixPointSize, 2);

  $current_id = $qrcode_data['id'];
  // 重讀資料
  $sql = "SELECT * FROM kmi_qrcode WHERE id=$current_id ";
  $today_one_qrcode = $db->query($sql)->fetchArray();
  return $today_one_qrcode;
}

/**
 * 產生今天最大的 QRCode 資料
 */
function get_today_max_qrcode() {  
  global $db;

  // 取得今天的 QRCode 
  $today = get_today();  
  $sql = "SELECT * FROM kmi_qrcode WHERE qrcode_date=$today ";  
  $qrcode_data = $db->query($sql)->fetchArray();

  // 沒有資料時, 新增一筆
  if (empty($qrcode_data)) {
    $sql = "INSERT INTO kmi_qrcode (qrcode_date, qrcode_no, createDate) VALUES " ;
    $sql .= " ('$today', '000', NOW() )";
    $db->query($sql);
    $insert_id = $db->lastInsertID();
    $sql = "SELECT * FROM kmi_qrcode WHERE id=$insert_id ";  
    $qrcode_data = $db->query($sql)->fetchArray();
  }

  $current_id = $qrcode_data['id'];
  // 將序號: qrcode_no 加一
  $current_no =  $qrcode_data['qrcode_no'];
  //將數字由左邊補零至三位數
  $next_no = str_pad( $current_no + 1 , 3, '0', STR_PAD_LEFT);
  
  //刪除目前 QRcode 圖檔
  $filename = PNG_TEMP_DIR.$qrcode_data['qrcode_filename'] ;
  if ( !empty($qrcode_data['qrcode_filename']) &&  file_exists( $filename )) {
    $status  = unlink($filename) ? 'The file '.$filename.' has been deleted' : 'Error deleting '.$filename;
    // echo $status;
  }

  //產生 QRcode 圖檔
  $today_max_qrcode = $qrcode_data['qrcode_date'].$next_no;
  $errorCorrectionLevel = 'H'; // 'L','M','Q','H'
  $matrixPointSize = 15;
  $filename = 'kmi_'.$today_max_qrcode.'.png' ;
  QRcode::png($today_max_qrcode, PNG_TEMP_DIR . $filename, $errorCorrectionLevel, $matrixPointSize, 2);

  // 序號回寫
  $sql = "UPDATE kmi_qrcode ";
  $sql .= " SET  qrcode_no='$next_no', qrcode_filename='$filename', updateDate=NOW() WHERE id=$current_id ";
  $db->query($sql);

  // 重讀資料
  $sql = "SELECT * FROM kmi_qrcode WHERE id=$current_id ";
  $today_max_qrcode = $db->query($sql)->fetchArray();
  return $today_max_qrcode;
}


