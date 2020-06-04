<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM entregas WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $fecha_cliente = $row['Fecha_Cliente'];
                $codigo_cliente = $row['Cod_Cliente'] ;
                $nombre_cliente = $row['Nombre_Cliente'];
                $direccion = $row['Direccion_Llegada'] ;
                $distrito = $row['Distrito'];
                $latitud = $row['Latitud'] ;
                $longitud = $row['Longitud']; 
                $guia_trans = $row['Gui_Trans']; 
                $guia_remi = $row['Guia_Remi'];
                $param_guia_cliente = $row['Guia_Cliente']; 
                $estado = $row['Estado'];
                $observacion = $row['Observaciones'];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Entrega</h1>
                    </div>
                    <div class="form-group">
                        <label>Fecha</label>
                        <p class="form-control-static"><?php echo $row['Fecha_Cliente']; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Codigo</label>
                        <p class="form-control-static"><?php echo $row['Cod_Cliente']; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Nombre</label>
                        <p class="form-control-static"><?php echo $row['Nombre_Cliente']; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Direccion</label>
                        <p class="form-control-static"><?php echo $row['Direccion_Llegada']; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Distrito</label>
                        <p class="form-control-static"><?php echo $row['Distrito']; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Latitud</label>
                        <p class="form-control-static"><?php echo $row['Latitud'] ; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Longitud</label>
                        <p class="form-control-static"><?php echo $row['Longitud'] ; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Guia transportista</label>
                        <p class="form-control-static"><?php echo $row['Gui_Trans']; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Guia Remision</label>
                        <p class="form-control-static"><?php echo $row['Guia_Remi'];?></p>
                    </div>

                    <div class="form-group">
                        <label>Guia cliente</label>
                        <p class="form-control-static"><?php echo $row['Guia_Cliente'];  ?></p>
                    </div>

                    <div class="form-group">
                        <label>Estado</label>
                        <p class="form-control-static"><?php echo $row['Estado']; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Observaciones</label>
                        <p class="form-control-static"><?php echo $row['Observaciones']; ?></p>
                    </div>

                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>