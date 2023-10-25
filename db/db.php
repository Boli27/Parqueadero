<?php
session_start();


// coneccion a la db
$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'parqueadero'
) or die(mysqli_erro($mysqli));

?>