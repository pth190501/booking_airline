<?php
    //error_reporting(0);
    session_start();
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    set_time_limit(0);
    if (!isset($_SESSION)) {
        ini_set('session.gc_maxlifetime', 30*24*60*60); 
        ini_set('session.cookie_lifetime', 30*24*60*60); 
    }
    
    //ket noi db
    $dbhost = '127.0.0.1';
    $dbname = 'book';
    $dbusername = 'book';
    $dbpassword = '123456';
    //-- Kết Nối PDO --//

    // Kiểm tra kết nối
    try {
        $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
        $db->exec("set names utf8"); //Set bảng mã
    } catch (PDOException $e) {
        //echo $e->getMessage();
        echo 'Loi ket noi';
        exit;
    }
?>

