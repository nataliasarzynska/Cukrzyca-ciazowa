<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nowy pomiar</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $weight_measurement = $_POST['weight_measurement'];
    $weight_date = $_POST['weight_date'];

}

$servername = "";
$username = "";
$dbpassword = "";
$dbname = "";

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);

$current_user = $_SESSION["current_user"];
$current_m_table = $_SESSION["current_m_table"];


$q_dodajpomiar = "INSERT INTO $current_m_table (pomiar_masa, data_masa) VALUES ('$weight_measurement','$weight_date')";
mysqli_query($dbconn,$q_dodajpomiar);

echo "Twój pomiar został zapisany";

?>

<br>
<a href = "./masadzienniczek.php"> Zobacz swoje pomiary</a> <br>

<br><br>
<a href = "./login.php"> Powrót do profilu</a> <br>

</body>
</html>