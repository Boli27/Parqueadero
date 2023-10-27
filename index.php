<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
    <div class="row">
        <div class="col-md-4">
            <!-- Alertas -->

            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php session_unset();
            } ?>

            <!-- Formulario Agregar Vehiculo -->
            <div class="card card-body">
                <form action="AgregarVehiculo.php" method="POST">
                    <div class="form-group">
                        <label for="tipo_vehiculo" style="font-size:1rem;">Tipo de vehiculo</label>
                        <select name="tipo_vehiculo" class="form-control"  autofocus>
                            <option value="carro">Carro</option>
                            <option value="moto">Moto</option>
                            <option value="camion">Camion</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="marca" class="form-control" placeholder="Marca" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="placa" class="form-control" placeholder="Placa" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="color" class="form-control" placeholder="Color" autofocus>
                    </div>
                    <input type="submit" name="AgregarVehiculo" class="btn btn-success btn-block"
                        value="Agregar Vehiculo">
                </form>
            </div>
        </div>

        <!-- tabla de vehiculos agregados -->

        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Vehiculo</th>
                        <th>Marca</th>
                        <th>Placa</th>
                        <th>Color</th>
                        <th>Fecha Ingreso</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $query = "SELECT * FROM vehiculos";
                    $vehiculos = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($vehiculos)) { ?>
                        <tr>
                            <td>
                                <?php echo $row['tipo_vehiculo']; ?>
                            </td>
                            <td>
                                <?php echo $row['marca']; ?>
                            </td>
                            <td>
                                <?php echo $row['placa']; ?>
                            </td>
                            <td>
                                <?php echo $row['color']; ?>
                            </td>
                            <td>
                                <?php echo $row['fecha_ingreso']; ?>
                            </td>
                            <!-- botones donde llamamos a nuestras funcionalidades -->
                            <td>
                                <a href="GenerarComprobante.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                    <i class="fas fa-receipt"> Generar Comprobante</i>
                                </a>
                                <a href="VerComprobante.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                    <i class="fa-solid fa-eye"> Ver Comprobante</i>
                                </a>

                                <a href="EditarVehiculo.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                    <i class="fa-solid fa-pen-to-square">Editar</i>
                                </a>
                                <a href="EliminarVehiculo.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                                    <i class="fa-solid fa-trash-can"> Eliminar</i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>