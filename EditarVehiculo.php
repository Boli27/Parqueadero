<?php
include("db.php");
$marca = '';
$placa = '';
$color = '';



// sacamos la informacion del vehiculo para poder usarla en el formulario donde se actualizara el vehiculo
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM vehiculos WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $marca = $row['marca'];
        $placa = $row['placa'];
        $color = $row['color'];
    }
}

//funcionalidad para el boton actualizar
if (isset($_POST['actualizar'])) {
    $id = $_GET['id'];
    $marca = $_POST['marca'];
    $placa = $_POST['placa'];
    $color = $_POST['color'];

    $query = "UPDATE vehiculos set marca = '$marca', placa = '$placa', color = '$color' WHERE id=$id";
    mysqli_query($conn, $query);
    $_SESSION['message'] = 'Actualizado con exito';
    $_SESSION['message_type'] = 'warning';
    header('Location: index.php');
}

?>

<?php include('includes/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="EditarVehiculo.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <label  style="font-size:1rem;">Marca</label>
                        <input type="text" name="marca" class="form-control" placeholder="Marca" value="<?php echo $marca; ?>" autofocus>
                    </div>
                    <div class="form-group">
                        <label  style="font-size:1rem;">Placa</label>
                        <input type="text" name="placa" class="form-control" placeholder="Placa" value="<?php echo $placa; ?>"  autofocus>
                    </div>
                    <div class="form-group">
                        <label  style="font-size:1rem;">Color</label>
                        <input type="text" name="color" class="form-control" placeholder="Color" value="<?php echo $color; ?>" autofocus>
                    </div>
                    <input type="submit" name="actualizar" class="btn btn-success btn-block" value="Editar Vehiculo">
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
