	<?php
    //session_start();
    /* Connect To Database*/

    require_once '../../dbconf/getConection.php';
    $db = new mySQLConnection();
    $con = $db->openConection();

		if (isset($con) || !isset($_SESSION['username']))
		{
	?>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">

                    <div class="modal-content">
                        <div class="modal-header alert alert-info">

                            <h5 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-user'></i>CONTAS DE ACESSO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <br>
                        </div>

                        <form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
                            <div class="modal-body" style="padding: 30px 50px;">
                                <div id="resultados_ajax"></div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname" class="control-label">Nome</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Nome ..." required>
                                        </div>
                                    </div>
                                    <div class="col-md-1">&nbsp;</div>

                                    <div class="col-md-5">
                                        <div class="form-group">

                                            <label for="firstname" class="control-label">Apelido</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apelido ..." required>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="sexo" class="control-label">Sexo</label>
                                            <select class="form-control" id="sexo" name="sexo">
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-1">&nbsp;</div>

                                    <div class="col-md-5">
                                        <div class="form-group">

                                            <label for="sexo" class="control-label">Curso:</label>
                                            <select name="curso" id="curso" class="form-control">

                                                <?php
                                                $rs = mysqli_query($con, 'SELECT * FROM curso');
                                                while ($row = mysqli_fetch_assoc($rs)){ ?>
                                                    <option value="<?php echo $row['idcurso']?>"><?php echo $row['descricao'] ?></option>
                                                <?php } ?>

                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="user_name" class="control-label">Username</label>
                                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Nome de Acesso" autocomplete="off"
                                                   pattern="[a-zA-Z0-9]{2,64}" title="Nome do utilizador (somente letras e números, 2-64 caracteres)"required>
                                        </div>

                                    </div>

                                    <div class="col-md-1">&nbsp;</div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="sexo" class="control-label">Tipo de Acesso</label>
                                            <select name="previlegio" onchange="enable_codigo_aluno(this.value)" id="previlegio" class="form-control">
                                                <option value="#">--Seleccionar--</option>
                                                <?php
                                                $rs = mysqli_query($con, 'SELECT * FROM previlegio');
                                                while ($row = mysqli_fetch_assoc($rs)){ ?>
                                                    <option value="<?php echo $row['idprevilegio']?>"><?php echo $row['descricao'] ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="nr_mec">

                                            <label style="color: #0000CC" for="nrmec" class="control-label">Número Mecanografico:</label>
                                            <input style="background:#ced4da; color: #0000CC" type="text" class="form-control" id="nrmec" name="nrmec"
                                                   placeholder="Número Mecanografico">
                                        </div>

                                        <div class="ano_doc">

                                            <label style="color: #0000CC" for="nrmec" class="control-label">Ano de inicio de funções:</label>
                                            <input style="background:#ced4da; color: #0000CC" type="text" class="form-control" id="nrmec" name="nrmec"
                                                   placeholder="Ano de Inicio de Funções">
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_password_new" class="control-label">Password</label>
                                            <input type="password" class="form-control" id="user_password_new" name="user_password_new"
                                                   placeholder="Senha" pattern=".{6,}" title="Senha (Min. 6 caracteres)" required>
                                        </div>
                                    </div>

                                    <div class="col-md-1">&nbsp;</div>
                                    <div class="col-md-5">
                                        <div class="form-group">

                                            <label for="user_password_repeat" class="control-label">Repetir Password</label>
                                            <input type="password" class="form-control" id="user_password_repeat" name="user_password_repeat"
                                                   placeholder="Repetir a Senha" pattern=".{6,}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="celular" class="control-label">Contacto</label>
                                            <input type="number" class="form-control" id="celular" name="celular"
                                                   placeholder="Contacto de Telefone" required>
                                        </div>
                                    </div>

                                    <div class="col-md-1">&nbsp;</div>

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="user_email" class="control-label">Email: <span class="vemail" style="color:red"></span></label>
                                            <input type="email" class="form-control" id="user_email" pattern=".+@unilurio.ac.mz"
                                                   name="user_email" placeholder="dados@unilurio.ac.mz"
                                                   onchange="validateDomainEmail(this.value)" required="O formato valido da unilurio">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <input name="estado" id="estado" value="1" type="hidden" readonly/>

                            <div class="modal-footer" style="">
                                <div class="link_login pull-left"></div>
                                <button type="submit" class="btn btn-primary" id="guardar_datos">Guardar Dados</button><br>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

            <!---  Fim modal Utilizador -->
	<?php
		}
	?>