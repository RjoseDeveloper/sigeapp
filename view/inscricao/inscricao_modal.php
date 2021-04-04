	<?php

    if (!isset($_SESSION['tipo'])){
         session_start();
    }

    require_once '../../dbconf/getConection.php';
    require_once '../../Query/AllQuerySQL.php';
    require_once '../../Query/DocenteSQL.php';
    $db = new mySQLConnection();
    $query = new QuerySql();
    $con = $db->openConection();
    $idDoc = $query->getDoc_id($_SESSION['username']);
    $cdocente = new DocenteSQL();

    ?>

			<!-- Modal -->
            <!-- Modal para controlo de erro  -->
            <div class="container">

            <div class="modal fade" id="form-inscricao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header alert-warning">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Adicionar Estudante à disciplina </h4>


                        </div>

                        <form class="form-horizontal" method="post" id="save_inscricao" name="save_inscricao">
                        <div class="modal-body" style="padding: 10px 30px">
                            <span class="results_inserted"></span>

                            <?php
                            if ($_SESSION['tipo'] != 'estudante'){ ?>

                                <label for="auto_encarregado" style="color: #f95e0f">Buscar Utilizador Registado *</label>


                                <input type="search" onkeyup="pesquisar(this.value,0)" value=""
                                       id="auto_encarregado" class="form-control" autocomplete="off">
                                <ul class="list-group list_view_studant"></ul>
                                <input type="hidden" name="aluno" id="aluno" value=""/>
                            <?php }else{?>
                                <input name="aluno" id="aluno" value="<?php echo $_SESSION['id'] ?>" type="hidden"/>
                            <?php }?>

                            <div class="row">

                                <div class="col-md-4">

                            <label for="turno">Turno:</label>
                            <select class="form-control"  data-style="btn-primary"
                                    data-width="auto" id="turno" name="turno" required="">
                                <?php
                                $resut = mysqli_query($con,'SELECT * FROM turno');
                                while ($row = mysqli_fetch_assoc($resut)){ ?>
                                    <option value="<?php echo $row['idturno'] ?>">
                                        <?php echo utf8_encode($row['descricao']) ?></option>
                                <?php }  ?>
                            </select>
                                </div>

                                <input name="disciplina" id="disciplina" value="" type="hidden"/>
                                <input name="curso" id="curso" value="" type="hidden"/>

                                <div class="col-md-4">

                            <label for="regime">Regime:</label>
                            <select class="form-control"  data-style="btn-primary"
                                    data-width="auto" id="regime" name="regime" required="">
                                <?php
                                $resut = mysqli_query($con,'SELECT * FROM regime');
                                while ($row = mysqli_fetch_assoc($resut)){ ?>
                                    <option value="<?php echo $row['idregime'] ?>">
                                        <?php echo utf8_encode($row['descricao']) ?></option>
                                <?php }  ?>
                            </select>

                                </div>

                                <div class="col-md-4">
                                    <span class="list_turma"> </span>
                                </div>
                            <br>
                            </div>
                            
                        </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="btn_inscricao"> Guardar Dados</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
            </div>


    <script type="text/javascript" src="../fragments/js/aluno.js"></script>
