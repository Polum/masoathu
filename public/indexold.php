<?php 

$conn = new mysqli("localhost", "masoathu_db", "maso100%", "masoathu_db");
$text = $_POST['text'];
$sender = $_POST['sender'];
$insert_incoming_sms_query = "INSERT INTO sms (text,number) VALUES('$text', '$sender')";
$output = print_r($_POST, TRUE);
if($query_result = $conn->query($insert_incoming_sms_query)){
 $output .= "Sucessful insertion";
 echo "True";
}else{
 $output .= "Error Inserting sms - ".$conn->error;
 echo $output."-False";
}

?>