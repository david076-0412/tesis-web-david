<link rel="stylesheet" href="../apoderado/stylecss/stylemaass.css">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">




<!--ventana para Update--->
<div class="modal fade" id="editarsolicitud<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0B2545 !important;">
                <h6 class="modal-title" style="color: #fff; text-align: center;">
                    Registrar de Solicitud
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <form method="POST" action="../administrador/editarsolicitud.php?usuario=<?php $usuario = $_SESSION['usuario'];
                                                                                        echo "$usuario"; ?>">




                <div class="modal-body" id="cont_modal">



                    <div class="form-group-modal">



                    <input type="hidden" class="input-text" required name="id" value="<?php echo $data['id']; ?>">




                        <input type="hidden" class="input-text" required name="usuario_apoderado" value="<?php $usuario_apoderado = $_REQUEST['usuario_apoderado'];
                                                                                                            echo $usuario_apoderado; ?>">


                        <input type="hidden" class="input-text" required name="usuario" value="<?php $usuario = $_SESSION['usuario'];
                                                                                                echo $usuario; ?>">




                        <label>Periodo: </label><br>

                        <input type="number" class="input-text" required name="periodo" value="<?php echo $data['periodo'] ?>">

                        <br>




                        <label>Categoria Solicitud: </label><br>



                        <input type="text" class="input-text" id="categoria_solicitud" required name="categoria_solicitud" value="<?php echo $data['categoria_solicitud'] ?>">


                        <br>




                        <label>Servicio: </label><br>


                        <select required name="curso">



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

                            $selectedId = $data['curso'];

                            if ($result->num_rows > 0) {
                                echo "<option value=''>SELECCIONAR...</option>";
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
                        <br>



                        <label>Importe: </label>



                        <input type="number" class="input-text" required name="importe" step="0.01" min="0" max="99999999.99" pattern="\d+(\.\d{2})?" value="<?php echo $data['importe'] ?>">






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