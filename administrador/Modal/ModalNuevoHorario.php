<link rel="stylesheet" href="../apoderado/stylecss/stylemaass.css">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">




<!--ventana para Update--->
<div class="modal fade" id="nuevohorario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0B2545 !important;">
                <h6 class="modal-title" style="color: #fff; text-align: center;">
                    Registrar Horario
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <form method="POST" action="../administrador/registrarhorario.php?usuario=<?php $usuario = $_SESSION['usuario'];
                                                                                        echo "$usuario"; ?>">




                <div class="modal-body" id="cont_modal">



                    <div class="form-group-modal">



                        <input type="hidden" class="input-text" required name="usuario_admin" value="<?php $usuario = $_SESSION['usuario'];
                                                                                                echo $usuario; ?>">



                        <div class="row" style="text-align: center">

                            <label style="padding: 30px;"></label>
                            <div class="inline-block right-margin">

                                <label>Hora: </label><br>

                                <input type="time" class="input-text" required name="hora_i">
                                <label style="padding: 10px;"></label>
                                <input type="time" class="input-text" required name="hora_f">



                            </div>

                            
                        </div>


                        <br>




                        <div class="row">

                            <label style="padding: 10px;"></label>
                            <div class="inline-block right-margin">

                                <label>Dia de la Semana: </label><br>
                                <select required name="dia">




                                    <option value="">SELECCIONAR...</option>
                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miércoles">Miércoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>

                                </select>



                            </div>
                            <label style="padding: 10px;"></label>
                            <div class="inline-block right-margin">
                                <label>Materia: </label><br>


                                <select required name="materia">



                                    <?php
                                    // Aquí deberías realizar la conexión a la base de datos y la consulta SQL
                                    $servidor = "localhost";
                                    $usuario = "root";
                                    $password = "9$8753JK5";
                                    $db = "bd_tesis";

                                    $conn = new mysqli($servidor, $usuario, $password, $db);

                                    if ($conn->connect_error) {
                                        die("Conexión fallida: " . $conn->connect_error);
                                    }



                                    $sql = "SELECT DISTINCT c.nombre FROM curso c";
                                    $result = $conn->query($sql);



                                    if ($result->num_rows > 0) {
                                        echo "<option value=''>SELECCIONAR...</option>";
                                        echo "<option value='DESCANSO'>DESCANSO</option>";
                                        while ($row = $result->fetch_assoc()) {
                                            $curso_dd = $row["nombre"];
                                            echo "<option value='{$curso_dd}'>{$row["nombre"]}</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay cursos</option>";
                                    }

                                    $conn->close();
                                    ?>






                                </select>

                            </div>



                        </div>




                        <div class="row">

                            <label style="padding: 10px;"></label>
                            <div class="inline-block right-margin">




                                <label>Nivel: </label><br>
                                <select id="niveles" required name="niveles" onchange="cambiarGrados()">
                                    <option value="">SELECCIONAR...</option>
                                    <?php

                                    $usuario = $_SESSION['usuario'];

                                    if ($usuario == "adminprimaria") {
                                    ?>
                                        <option value="Primaria">Primaria</option>

                                    <?php

                                    } else if ($usuario == "adminsecundaria") {
                                    ?>
                                        <option value="Secundaria">Secundaria</option>


                                    <?php
                                    }


                                    ?>





                                </select>

                            </div>




                            <label style="padding: 10px;"></label>
                            <div class="inline-block right-margin">



                                <label>Grado: </label><br>
                                <select class="select-bx" id="grados" required name="grados">

                                    <option value="">SELECCIONAR...</option>


                                </select>


                            </div>
                        </div>



                        <div class="row">

                            <label style="padding: 10px;"></label>
                            <div class="inline-block right-margin">
                                <label>Docente: </label><br>
                                <select required name="docente">



                                    <?php
                                    // Aquí deberías realizar la conexión a la base de datos y la consulta SQL
                                    $servidor = "localhost";
                                    $usuario = "root";
                                    $password = "9$8753JK5";
                                    $db = "bd_tesis";

                                    $conn = new mysqli($servidor, $usuario, $password, $db);

                                    if ($conn->connect_error) {
                                        die("Conexión fallida: " . $conn->connect_error);
                                    }



                                    $sql = "SELECT DISTINCT d.apellido_paterno, d.apellido_materno, d.nombres,d.usuario FROM docente d";
                                    $result = $conn->query($sql);



                                    if ($result->num_rows > 0) {
                                        echo "<option value=''>SELECCIONAR...</option>";
                                        while ($row = $result->fetch_assoc()) {
                                            $docente_dd = $row["usuario"];
                                            echo "<option value='{$docente_dd}'>{$row["apellido_paterno"]} {$row["apellido_materno"]} {$row["nombres"]}</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay Docentes</option>";
                                    }

                                    $conn->close();
                                    ?>






                                </select>


                            </div>
                        </div>






                    </div>




                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <!--<button type="submit" class="btn btn-primary">Guardar Cambios</button>-->
                </div>


            </form>

        </div>
    </div>
</div>
<!---fin ventana Update --->



<script>
    function cambiarGrados() {
        // Obtener el valor seleccionado en la categoría
        var nivelesSeleccionada = $("#niveles").val();

        $("#grados").empty();


        if (nivelesSeleccionada == null) {
            $("#grados").append('<option value="">SELECCIONAR...</option>');
        } else {
            addGradeOptions(nivelesSeleccionada);
        }

    }


    cambiarGrados();


    function addGradeOptions(level) {

        $("#grados").empty();


        $("#grados").append('<option value="">SELECCIONAR...</option>');




        if (level === "Primaria") {


            $("#grados").append('<option value="Primero">Primero</option>');
            $("#grados").append('<option value="Segundo">Segundo</option>');
            $("#grados").append('<option value="Tercero">Tercero</option>');
            $("#grados").append('<option value="Cuarto">Cuarto</option>');
            $("#grados").append('<option value="Quinto">Quinto</option>');
            $("#grados").append('<option value="Sexto">Sexto</option>');



        }


    }
</script>
