<?php
/**
 * Mở kết nối đến CSDL sử dụng PDO
 */
function pdo_get_connection(){
    $dburl = "mysql:host=localhost;port=3306;dbname=laptopdb;charset=utf8";
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO($dburl, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Kết nối không thành công: " . $e->getMessage();
        return null;
    }
}
?>
