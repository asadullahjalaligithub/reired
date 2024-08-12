<?php



$user = getenv('CLOUDSQL_USER');
$password = getenv('CLOUDSQL_PASSWORD');
$inst = getenv('CLOUDSQL_DSN');
$db = getenv('CLOUDSQL_DB');
$record_per_page = 10;
//$apiKey="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2F1dGg6ODA4MC9hcGkvdjEvdXNlcnMvYXBpL2tleS9nZW5lcmF0ZSIsImlhdCI6MTY0NDQ3ODgzNSwibmJmIjoxNjQ0NDc4ODM1LCJqdGkiOiJ1emcxOUpTTzhLZFZISnpNIiwic3ViIjoyNjkxNTQsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.1aZ8GokfzKTmbcumu8bryoT1QRlzwScu7etENYgPgkg";
// $connection = mysqli_connect($server, $user, $password, $database);
$connection = mysqli_connect(null, $user, $pass, $db, null, $ins);
if (!$connection) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
} else {
    echo "connected";
}