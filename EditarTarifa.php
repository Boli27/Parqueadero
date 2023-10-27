
<?php
include("db.php");
$tipo_vehiculo='';
$tarifa = '';


//funcionalidad para el boton actualizar tarifa
if (isset($_POST['actualizar'])) {
    $tipo_vehiculo = $_POST['tipo_vehiculo'];
    $tarifa = $_POST['tarifa'];

    $query = "UPDATE tarifas set precio_tarifa = '$tarifa' WHERE tipo_vehiculo='$tipo_vehiculo'";
    mysqli_query($conn, $query);
    $_SESSION['message'] = 'Tarifa actualizada con exito';
    $_SESSION['message_type'] = 'warning';
    header('Location: index.php');
}

?>



<?php include('includes/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="EditarTarifa.php" method="POST">
                    <div class="form-group">
                    <label  style="font-size:1rem;">Tipo de vehiculo</label>
                        <select name="tipo_vehiculo" class="form-control"  autofocus>
                            <option value="carro">Carro</option>
                            <option value="moto">Moto</option>
                            <option value="camion">Camion</option>
                        </select>                    </div>
                    <div class="form-group">
                        <input type="text" name="tarifa" class="form-control" placeholder="Tarifa Por Hora" autofocus>
                    </div>
                    <input type="submit" name="actualizar" class="btn btn-success btn-block" value="Editar Tarifa">
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
