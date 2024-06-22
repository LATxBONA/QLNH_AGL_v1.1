<?php
// Tạo header cho việc kiểm soát đầy đủ
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Thông tin server
$server = "localhost";
$username = "root";
$password = "";
$database = "qlnh_perfact";

// Kết nối
$conn = new mysqli($server, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

$Username = isset($_GET['Username']) ? $_GET['Username'] : '';
$Password = isset($_GET['Password']) ? $_GET['Password'] : '';

switch($action){
    case "checkAccount":
        checkAccount($conn, $Username, $Password);
        break;
    default:
        echo "Không xác định";
}

function checkAccount($conn, $Username, $Password) {
    $sql = "SELECT * FROM tbaccount where Username like '$Username' and Password like '$Password'";
   
    $result = $conn->query($sql);
    
    //Tạo mảng trống
    $rows = array();
    
    while ($row = $result->fetch_assoc()){
        $rows[] = $row;
    }

    $json = json_encode(array("taikhoan" => $rows), JSON_PRETTY_PRINT);

    file_put_contents('data.json', $json);
    
}

$conn->close();
?>