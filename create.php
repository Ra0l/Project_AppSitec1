<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$fecha_cliente=$codigo_cliente=$nombre_cliente=$direccion=$distrito=$latitud=$longitud=$guia_trans=$guia_remi=$guia_cliente=$estado=$observacion="";
$fecha_cliente_err=$codigo_cliente_err=$nombre_cliente_err=$direccion_err=$distrito_err=$latitud_err=$longitud_err=$guia_trans_err=$guia_remi_err=$guia_cliente_err=$estado_err=$observacion_err="";


 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Validate fecha cliente
    $input_fecha_cliente= trim($_POST["fechacliente"]);
    if(empty($input_fecha_cliente)){
        $fecha_cliente_err = "Please enter date";
    }else{
        $fecha_cliente = $input_fecha_cliente;
    }

    //Validate codigo cliente
    $input_codigo_cliente= trim($_POST["codigocliente"]);
    if(empty($input_codigo_cliente)){
        $codigo_cliente_err = "Please enter code";
    }else{
        $codigo_cliente = $input_codigo_cliente;
    }

    //validate nombre cliente
    $input_nombre_cliente = trim($_POST["nombrecliente"]);
    if(empty($input_nombre_cliente)){
        $nombre_cliente_err = "Please enter a nombre.";
    } elseif(!filter_var($input_nombre_cliente, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_cliente_err = "Please enter a valid name.";
    } else{
        $nombre_cliente = $input_nombre_cliente;
    }

    //validate direccion
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_nombre_cliente)){
        $direccion_err = "Please enter a name.";
    } elseif(!filter_var($input_direccion, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $direccion_err = "Please enter a valid name.";
    } else{
        $direccion = $input_direccion;
    }

    //validate distrito
    $input_distrito = trim($_POST["distrito"]);
    if(empty($input_distrito)){
        $distrito_err = "Please enter a distrito.";
    } elseif(!filter_var($input_distrito, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $distrito_err = "Please enter a valid distrito.";
    } else{
        $distrito = $input_distrito;
    }

    //validate latitud
    $input_latitud = trim($_POST["latitud"]);
    if(empty($input_latitud)){
        $latitud_err = "Please enter the latitud";     
    } elseif(!ctype_digit($input_latitud)){
        $latitud_err = "Please enter a positive double or negative double latitude";
    } else{
        $latitud = $input_latitud;
    }

    //validate longitud
    $input_longitud = trim($_POST["longitud"]);
    if(empty($input_longitud)){
        $longitud_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_longitud)){
        $longitud_err = "Please enter a positive integer value.";
    } else{
        $longitud = $input_longitud;
    }

    //validate guia transportista
    $input_guia_trans = trim($_POST["guiatransportista"]);
    if(empty($input_guia_trans)){
        $guia_trans_err = "Please enter the guia transportista";     
    } elseif(!ctype_digit($input_guia_trans)){
        $guia_trans_err = "Please enter a positive integer value.";
    } else{
        $guia_trans = $input_guia_trans;
    }

    //validate guia remision
    $input_guia_remi = trim($_POST["guiaremision"]);
    if(empty($input_guia_remi)){
        $guia_remi_err = "Please enter the guia remision";     
    } elseif(!ctype_digit($input_guia_trans)){
        $guia_remi_err = "Please enter a positive integer value.";
    } else{
        $guia_remi = $input_guia_remi;
    }
    //validate guia cliente
    $input_guia_cliente = trim($_POST["guiacliente"]);
    if(empty($input_guia_trans)){
        $guia_cliente_err = "Please enter the guia cliente";     
    } elseif(!ctype_digit($input_guia_trans)){
        $guia_cliente_err = "Please enter a positive integer value.";
    } else{
        $guia_cliente = $input_guia_cliente;
    }

    //validate estado
    $input_estado = trim($_POST["estado"]);
    if(empty($input_estado)){
        $estado_err = "Please enter an estado.";     
    } else{
        $estado = $input_estado;
    }
    //valoidate observacion
    $input_observacion = trim($_POST["observacion"]);
    if(empty($input_observacion)){
        $observacion_err = "Please enter an observacion.";
    } elseif(!filter_var($input_observacion, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $observacion_err = "Please enter a valid name.";
    } else{
        $observacion = $input_observacion;
    }

    
    

    // Check input errors before inserting in database
    if(empty($fecha_cliente_err) && empty($codigo_cliente_err) && empty($nombre_cliente_err) && empty($direccion_err) && empty($distrito_err) && empty($latitud_err) && empty($longitud_err) && empty($guia_trans_err) && empty($guia_remi_err) && empty($guia_cliente_err) && empty($estado_err) && empty($observacion_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO entregas (Fecha_Cliente,Cod_Cliente,Nombre_Cliente,Direccion_Llegada,Distrito,Latitud,Longitud,Gui_Trans,Guia_Remi,Guia_Cliente,Estado,Observaciones) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        // Bind variables to the prepared statement as parameters
        if($stmt = mysqli_prepare($link,$sql)){
            
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_fecha_cliente,$param_codigo_cliente,$param_nombre_cliente,$param_direccion,$param_distrito,$param_latitud,$param_longitud,$param_guia_trans,$param_guia_remi,$param_guia_cliente,$param_estado,$param_observacion);
           
            
            
            // Set parameters
            $param_fecha_cliente = $fecha_cliente;
            $param_codigo_cliente = $codigo_cliente;
            $param_nombre_cliente = $nombre_cliente;
            $param_direccion = $direccion;
            $param_distrito = $distrito;
            $param_latitud = $latitud;
            $param_longitud = $longitud;
            $param_guia_trans = $guia_trans;
            $param_guia_remi = $guia_remi;
            $param_guia_cliente = $guia_cliente;
            $param_estado = $estado;
            $param_observacion = $observacion;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            }else{
                echo "Something went wrong. Please try again later.";
            }
        }

         // Close statement
         mysqli_stmt_close($stmt);
    }    
}
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
        var minValue = $(this).val();
        minValue=$.datepicker.parseDate('yy-mm-dd', minValue);
        minValue.setDate(minValue.getDate()+1);
        $("datepicker").datepicker("option","minDate",minValue);
  } );
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Crear entrega</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group <?php echo (!empty($fecha_cliente_err)) ? 'has-error' : ''; ?>">
                            <label>Fecha</label>
                            <input type="text" id="datepicker" name="fechacliente" class="form-control" value="<?php echo $fecha_cliente; ?>">
                            <span class="help-block"><?php echo $fecha_cliente_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($codigo_cliente_err)) ? 'has-error' : ''; ?>">
                            <label>Codigo</label>
                            <input type="text" name="codigocliente" class="form-control" value="<?php echo $codigo_cliente; ?>">
                            <span class="help-block"><?php echo $codigo_cliente_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nombre_cliente_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="nombrecliente" class="form-control" value="<?php echo $nombre_cliente; ?>">
                            <span class="help-block"><?php echo $nombre_cliente_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Direccion</label>
                            <input type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($distrito_err)) ? 'has-error' : ''; ?>">
                            <label>Distrito</label>
                            <input type="text" name="distrito" class="form-control" value="<?php echo $distrito; ?>">
                            <span class="help-block"><?php echo $distrito_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($latitud_err)) ? 'has-error' : ''; ?>">
                            <label>Latitud</label>
                            <input type="text" name="latitud" class="form-control" value="<?php echo $latitud; ?>">
                            <span class="help-block"><?php echo $latitud_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($longitud_err)) ? 'has-error' : ''; ?>">
                            <label>Longitud</label>
                            <input type="text" name="longitud" class="form-control" value="<?php echo $longitud; ?>">
                            <span class="help-block"><?php echo $longitud_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($guia_trans_err)) ? 'has-error' : ''; ?>">
                            <label>Guia transportista</label>
                            <input type="text" name="guiatransportista" class="form-control" value="<?php echo $guia_trans; ?>">
                            <span class="help-block"><?php echo $guia_trans_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($guia_remi_err)) ? 'has-error' : ''; ?>">
                            <label>Guia remision</label>
                            <input type="text" name="guiaremision" class="form-control" value="<?php echo $guia_remi; ?>">
                            <span class="help-block"><?php echo $guia_remi_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($guia_cliente_err)) ? 'has-error' : ''; ?>">
                            <label>Guia Cliente</label>
                            <input type="text" name="guiacliente" class="form-control" value="<?php echo $guia_cliente; ?>">
                            <span class="help-block"><?php echo $guia_cliente_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($estado_err)) ? 'has-error' : ''; ?>">
                            <label>Estado</label>
                            <input type="text" name="estado" class="form-control" value="<?php echo $estado; ?>">
                            <span class="help-block"><?php echo $estado_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($observacion_err)) ? 'has-error' : ''; ?>">
                            <label>Observacion</label>
                            <textarea name="observacion" class="form-control"><?php echo $observacion; ?></textarea>
                            <span class="help-block"><?php echo $observacion_err;?></span>
                        </div>

                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>