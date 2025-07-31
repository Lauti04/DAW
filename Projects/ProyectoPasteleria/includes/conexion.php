<?php
$host = "localhost"; 
$dbname = "u214508706_pasteleria"; 
$user = "u214508706_lauti";
$pass = "kF0]Yi0qr#"; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
<!-- <?php
// $host = "127.0.0.1"; 
// $dbname = "pasteleria"; 
// $user = "root";
// $pass = ""; 

// try {
//     $conn = new PDO("mysql:host=$host;port=3309;dbname=$dbname;charset=utf8", $user, $pass);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Error de conexión: " . $e->getMessage());
// }
?> -->