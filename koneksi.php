<?php
$conn = mysqli_connect('localhost','root','','posyandu');
if(mysqli_error($conn)){
  echo 'db not connected';
}
?>