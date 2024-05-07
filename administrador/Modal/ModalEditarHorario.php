<link rel="stylesheet" href="../apoderado/stylecss/stylemaass.css">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">




<!--ventana para Update--->
<div class="modal fade" id="editarhorario<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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


            <form method="POST" action="../administrador/editarhorario.php?usuario=<?php $usuario = $_SESSION['usuario'];
                                                                                        echo "$usuario"; ?>">




                <div class="modal-body" id="cont_modal">



                    <div class="form-group-modal">


                        <input type="hidden" class="input-text" required name="id" value="<?php echo $data['id']; ?>">


                        <input type="hidden" class="input-text" required name="usuario_admin" value="<?php $usuario = $_SESSION['usuario'];
                                                                                                        echo $usuario; ?>">



                        <div class="row" style="text-align: center">

                            <label style="padding: 30px;"></label>
                            <div class="inline-block right-margin">

                                <label>Hora: </label><br>

                                <input type="time" class="input-text" required name="hora_i" value="<?php echo $data['hora_i'] ?>">
                                <label style="padding: 10px;"></label>
                                <input type="time" class="input-text" required name="hora_f" value="<?php echo $data['hora_f'] ?>">



                            </div>
                        </div>


                        <br>




                        <div class="row">

                            <label style="padding: 10px;"></label>
                            <div class="inline-block right-margin">

                                <label>Dia de la Semana: </label><br>
                                <select required name="dia">





                                    <?php

                                    // Verificar si este es el elemento seleccionado
                                    $selectedLUNES = ($data['dia'] == 'Lunes') ? 'selected' : '';
                                    $selectedMARTES = ($data['dia'] == 'Martes') ? 'selected' : '';
                                    $selectedMIERCOLES = ($data['dia'] == 'Miércoles') ? 'selected' : '';
                                    $selectedJUEVES = ($data['dia'] == 'Jueves') ? 'selected' : '';
                                    $selectedVIERNES = ($data['dia'] == 'Viernes') ? 'selected' : '';




                                    ?>

                                    <option value="">SELECCIONAR...</option>
                                    <option value="Lunes" <?php echo $selectedLUNES ?>>Lunes</option>
                                    <option value="Martes" <?php echo $selectedMARTES ?>>Martes</option>
                                    <option value="Miércoles" <?php echo $selectedMIERCOLES ?>>Miércoles</option>
                                    <option value="Jueves" <?php echo $selectedJUEVES ?>>Jueves</option>
                                    <option value="Viernes" <?php echo $selectedVIERNES ?>>Viernes</option>


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


                                    $selectedId = $data['materia'];


                                    if ($result->num_rows > 0) {
                                        echo "<option value=''>SELECCIONAR...</option>";
                                        echo "<option value='DESCANSO'>DESCANSO</option>";
                                        while ($row = $result->fetch_assoc()) {

                                            $selected = ($row["nombre"] == $selectedId) ? 'selected' : ''; // Compara con el id deseado


                                            $curso_dd = $row["nombre"];
                                            echo "<option value='{$curso_dd}' {$selected}>{$row["nombre"]}</option>";
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
                                <select id="niveles" required name="niveles">
                                    <?php
                                    $selectedPRIMARIA = ($data['nivel'] == 'Primaria') ? 'selected' : '';

                                    ?>
                                    <option value="">SELECCIONAR...</option>

                                    <option value="Primaria" <?php echo $selectedPRIMARIA ?>>Primaria</option>




                                </select>

                            </div>




                            <label style="padding: 10px;"></label>
                            <div class="inline-block right-margin">



                                <label>Grado: </label><br>
                                <select id="grados" required name="grados">

                                    <?php
                                    // Verificar si este es el elemento seleccionado
                                    $selectedPrimero = ($data['grado'] == 'Primero') ? 'selected' : '';
                                    $selectedSegundo = ($data['grado'] == 'Segundo') ? 'selected' : '';
                                    $selectedTercero = ($data['grado'] == 'Tercero') ? 'selected' : '';

                                    $selectedCuarto = ($data['grado'] == 'Cuarto') ? 'selected' : '';
                                    $selectedQuinto = ($data['grado'] == 'Quinto') ? 'selected' : '';
                                    $selectedSexto = ($data['grado'] == 'Sexto') ? 'selected' : '';
                                    ?>
                                    <option value="">SELECCIONAR...</option>
                                    <option value="Primero" <?php echo $selectedPrimero ?>>Primero</option>
                                    <option value="Segundo" <?php echo $selectedSegundo ?>>Segundo</option>
                                    <option value="Tercero" <?php echo $selectedTercero ?>>Tercero</option>

                                    <option value="Cuarto" <?php echo $selectedCuarto ?>>Cuarto</option>
                                    <option value="Quinto" <?php echo $selectedQuinto ?>>Quinto</option>
                                    <option value="Sexto" <?php echo $selectedSexto ?>>Sexto</option>


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

                                    $selectedId = $data['usuario_docente'];


                                    if ($result->num_rows > 0) {
                                        echo "<option value=''>SELECCIONAR...</option>";
                                        while ($row = $result->fetch_assoc()) {

                                            $selected = ($row["usuario"] == $selectedId) ? 'selected' : ''; // Compara con el id deseado


                                            $docente_dd = $row["usuario"];
                                            echo "<option value='{$docente_dd}' {$selected}>{$row["apellido_paterno"]} {$row["apellido_materno"]} {$row["nombres"]}</option>";
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