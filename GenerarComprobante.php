<?php

include('db.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        // solo insertamos el id del vehiculo, puesto que la hora de salida se genera automaticamente 
        // y el valor a pagar tambien a travez de un disparador en la base de datos
        $query = "INSERT INTO comprobante(id_vehiculo) VALUES ('$id')";
        try {
            $result = mysqli_query($conn, $query);
            if (!$result) {
                throw new Exception("Error al generar el comprobante.");
            }
    
            $_SESSION['message'] = 'Comprobante Generado';
            $_SESSION['message_type'] = 'success';
            header('Location: index.php');
        } catch (Exception $e) {
            // Captura la excepción
            $_SESSION['message'] = 'Este vehículo ya tiene un comprobante.';
            $_SESSION['message_type'] = 'danger';
            header('Location: index.php');
        }
    }