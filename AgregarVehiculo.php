<?php

include('db.php');


if (isset($_POST['AgregarVehiculo'])) {
    $tipo_vehiculo = $_POST['tipo_vehiculo'];
    $marca = $_POST['marca'];
    $placa = $_POST['placa'];
    $color = $_POST['color'];
    $query = "INSERT INTO vehiculos(tipo_vehiculo, marca, placa, color) VALUES ('$tipo_vehiculo', '$marca','$placa','$color')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Solicitud Fallida");
    }

    $_SESSION['message'] = 'Vehiculo Agregado';
    $_SESSION['message_type'] = 'success';
    header('Location: index.php');

}

?>