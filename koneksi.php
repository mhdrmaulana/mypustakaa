<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Header: Content-Type');
header('Access-Control-Allow-Method: GET, POST, OPTION');

function getConnection() {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'mypustaka';


    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>