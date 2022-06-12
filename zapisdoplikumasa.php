<?php
session_start();
?>

<?php
$servername = "";
$username = "";
$dbpassword = "";
$dbname = "";

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);

$current_user = $_SESSION["current_user"];
$current_m_table = $_SESSION["current_m_table"];


$sql = "SELECT `pomiar_masa`, `data_masa` FROM $current_m_table";
$result = mysqli_query($dbconn, $sql);


$query = $dbconn->query("SELECT * FROM $current_m_table"); 

if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "dane-masa.csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('Waga', 'Data pomiaru'); 
    fputcsv($f, $fields, $delimiter); 
    
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['pomiar_masa'], $row['data_masa']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
    ?>


