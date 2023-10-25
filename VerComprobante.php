<?php
include('db.php');


$tipo_vehiculo = '';
$marca = '';
$placa = '';
$color = '';
$fecha_ingreso = '';
$fecha_salida = '';
$valor_pagar = '';
$id_vehiculo = '';



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT Vehiculos.*, Comprobante.* FROM Vehiculos 
        LEFT JOIN Comprobante  ON Vehiculos.id = Comprobante.id_vehiculo
        WHERE Vehiculos.id = $id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $tipo_vehiculo = $row['tipo_vehiculo'];
        $marca = $row['marca'];
        $placa = $row['placa'];
        $color = $row['color'];
        $fecha_ingreso = $row['fecha_ingreso'];
        $fecha_salida = $row['fecha_salida'];
        $valor_pagar = $row['valor_pagar'];

    }
    if (!$fecha_salida) {

        $_SESSION['message'] = 'No existe comprobante del vehiculo';
        $_SESSION['message_type'] = 'danger';
        header('Location: index.php');

    }

}
?>

<?php include('includes/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="VerComprobante.php?id=<?php echo $_GET['id']; ?>" method="GET">
                    <div class="form-group">
                        <label for="">Marca: <span>
                                <?php echo $marca; ?>
                            </span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="">Placa: <span>
                                <?php echo $placa; ?>
                            </span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="">Color: <span>
                                <?php echo $color; ?>
                            </span></label>
                    </div>
                    <div class="form-group">
                        <label for="">Tipo Vehiculo: <span>
                                <?php echo $tipo_vehiculo; ?>
                            </span></label>
                    </div>
                    <div class="form-group">
                        <label for="">Fecha Ingreso: <span>
                                <?php echo $fecha_ingreso; ?>
                            </span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="">Fecha Salida: <span>
                                <?php echo $fecha_salida; ?>
                            </span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="">Valor A Pagar: <span>
                                <?php echo $valor_pagar; ?>
                            </span>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>