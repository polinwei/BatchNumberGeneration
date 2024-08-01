<?php
  //PHP 版本確認
  if (phpversion() < 7.4) {
    $ErrorTitle		 = 'SYSTEM ENVIRONMENT ERROR' ;
    $ErrorMessage	 = '本系統需運行於 PHP 8.1 以上的環境（目前 PHP 版本為 ' . phpversion() . '）<BR />若您非系統管理人員，請記錄下您看到的畫面並告知管理員' ;
    die ($ErrorMessage. $ErrorTitle) ;
  }

/**
 * 管理後台的基本設定區域
 */

  //列印錯誤的層級 , E_ALL, E_ERROR, E_WARNING
  error_reporting(E_ALL);
  // 執行中改變 php.ini 時
  ini_set('display_errors','1') ;

  //設定時區
	date_default_timezone_set('Asia/Taipei') ;

  //語系設定
	header('Content-Type: text/html; charset=UTF-8');

  // 目錄的絕對路徑, ABS_PATH=W:\xampp\htdocs\case\myphp\
  define('ABS_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
  
  // Apache 的根目錄, 如: W:\xampp\htdocs\
  define('ROOT_PATH', realpath($_SERVER['DOCUMENT_ROOT'])  . DIRECTORY_SEPARATOR ) ;   

  // 網站相對目錄, 如: case\myblog\
  define('CONTEXT_PATH', substr( ABS_PATH, strlen(ROOT_PATH) ));
 
  // 網站相對網址, 如: case/myblog/
  define('CONTEXT_URL', (strlen(CONTEXT_PATH)>0) ? str_replace(DIRECTORY_SEPARATOR,'/',CONTEXT_PATH) : '');

	//網域根網址, 如 http://localhost/
	define( 'ROOT_URL',  ((isset($_SERVER['HTTPS']) && strtoupper($_SERVER['HTTPS']) == 'ON') ? 'https://' : 'http://') . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . '/');

  // 網站網址, 如 http://localhost/kp-sft  
  define('ABS_URL', ROOT_URL .substr(CONTEXT_URL, 0, strlen(CONTEXT_URL)) );  

/**
 * QRCode Config
 */
  require 'assets/phpqrcode/phpqrcode.php';

  //set it to writable location, a place for temp generated PNG files
  define('PNG_TEMP_DIR', ABS_PATH.'temp'.DIRECTORY_SEPARATOR);
  //ofcourse we need rights to create temp dir
  if (!file_exists(PNG_TEMP_DIR))
    mkdir(PNG_TEMP_DIR);

  //html PNG location prefix
  define('PNG_WEB_DIR', ABS_URL.'temp/');

  //QRCode 產生的模式 1:一天只有一個批號, 2:每次取得新的批號
  define('GENERATE_MODE',1); 
  
/**
 * 資料庫設定
 * 
 */
require ABS_PATH . 'src/mysql/db.php';
use PolinWei\Mysql\DB;

// ** Database settings - You can get this info from your web host ** //
/** The name of the database */
define( 'DB_NAME', 'kpsft' );

/** Database username */
define( 'DB_USER', 'kpsft' );

/** Database password */
define( 'DB_PASSWORD', 'kpsft' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

global $db;
$db = new DB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_CHARSET);



// 將函數加入
include_once('functions.php');