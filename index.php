<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 1350px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 25px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Entregas</a>
            </nav>
        </div>
    

    <div class="container-sm" align="center">
        <div class="wraper">
            <h2>Busqueda</h2>

            <?php

            require_once "config.php";

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $where="";
            $nombre=$_POST['xnombre'];
            $codigo=$_POST['xcodigo'];

            if(isset($_POST['buscar']))
            {
                if(empty($_POST['xcodigo']))
                {
                    $where="where Nombre_Cliente like '".$nombre."%'";
                }
                else if (empty($_POST['xnombre'])){
                    $where="where Cod_Cliente like '".$codigo."%'";
                }
                else{
                    $where="where Nombre_Cliente like '".$nombre."' and Cod_Cliente='".$codigo."'";
                }
            }

            

                $sql = "SELECT * FROM entregas $where";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_array($result);
            }

            
            ?>

            <form method="post">
                
				<input type="text" placeholder="Nombre" name="xnombre"/>
                <input type="text" placeholder="Codigo" name="xcodigo"/>
				

				<button name="buscar" type="submit">Buscar</button>
			</form>
        </div>
    </div>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Lista de entregas</h2>
                        <a href="create.php" class="btn btn-success pull-right">Agregar entrega</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM entregas $where";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Fecha Cliente</th>";
                                        echo "<th>Codigo Cliente</th>";
                                        echo "<th>Nombre Cliente</th>";
                                        echo "<th>Direccion llegada</th>";
                                        echo "<th>Distrito</th>";
                                        echo "<th>Latitud</th>";
                                        echo "<th>Longitud</th>";
                                        echo "<th>Guia transportista</th>";
                                        echo "<th>Guia Remisión</th>";
                                        echo "<th>Guia Cliente</th>";
                                        echo "<th>Estado</th>";
                                        echo "<th>Observacion</th>";
                                        echo "<th>Accion</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['Id'] . "</td>";
                                        echo "<td>" . $row['Fecha_Cliente'] . "</td>";
                                        echo "<td>" . $row['Cod_Cliente'] . "</td>";
                                        echo "<td>" . $row['Nombre_Cliente'] . "</td>";
                                        echo "<td>" . $row['Direccion_Llegada'] . "</td>";
                                        echo "<td>" . $row['Distrito'] . "</td>";
                                        echo "<td>" . $row['Latitud'] . "</td>";
                                        echo "<td>" . $row['Longitud'] . "</td>";
                                        echo "<td>" . $row['Gui_Trans'] . "</td>";
                                        echo "<td>" . $row['Guia_Remi'] . "</td>";
                                        echo "<td>" . $row['Guia_Cliente'] . "</td>";
                                        echo "<td>" . $row['Estado'] . "</td>";
                                        echo "<td>" . $row['Observaciones'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['Id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['Id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['Id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No hay registros en la busqueda.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>