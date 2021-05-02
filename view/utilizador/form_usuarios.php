	<?php
    //session_start();
    /* Connect To Database*/

    require_once '../../dbconf/getConection.php';
    $db = new mySQLConnection();
    $con = $db->openConection();

		if (isset($con) || !isset($_SESSION['username']))
		{
	?>
            <div class="modal fade" id="modal-usuario" tabindex="-1" role="dialog" data-backdrop="static"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">

                    <div class="modal-content">
                        <div class="modal-header alert alert-info">

                            <h5 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-user'></i>Cadastro de Utilizador</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <br>
                        </div>

                       <form class="form-horizontal" style=";padding: 10px 30px; method="post" id="guardar_usuario" name="guardar_usuario">

                    <div class="row" style="">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname" class="control-label">Nome Completo:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nome ..." required>
                            </div>
                        </div>
                        <div class="col-md-6">

                           <div class="form-group">
                                <label for="user_name" class="control-label">Username:</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Nome de Acesso" autocomplete="off"
                                       pattern="[a-zA-Z0-9]{2,64}" title="Nome do utilizador (somente letras e números, 2-64 caracteres)"required>
                            </div>
                          
                        
                        </div>

                        <div class="col-md-6">

                           <div class="form-group">
                                <label for="user_password_new" class="control-label">Password:</label>
                                <input type="password" class="form-control" id="user_password_new" name="user_password_new"
                                       placeholder="Senha" pattern=".{6,}" title="Senha (Min. 6 Caracteres)" required>
                            </div>

                        </div>

                         <div class="col-md-6">

                            <div class="form-group">
                                <label for="sexo" class="control-label">Sexo:</label>
                                <select class="form-control" id="sexo" name="sexo">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>

                            </div>
                        </div>
                    </div> <!---------- fim first row ----------->

                    <div class="row">
                       
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="user_email" class="control-label">Email: <span class="vemail" style="color:red"></span></label>
                                <input type="email" class="form-control" id="user_email" 
                                name="user_email" placeholder="dados@dominio"
                                       onchange="validateDomainEmail(this.value)" required="O Formato Valido do Email">
                            </div>
                        </div>

                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="celular" class="control-label">Contacto 1:</label>
                                <input type="number" class="form-control" id="celular1" name="celular1"
                                       placeholder="Contacto 1" required>
                            </div>
                        </div>

                         <div class="col-md-6">
                           
                            <div class="form-group">
                                <label for="celular2" class="control-label">Contacto 2: </label>
                                 <input type="number" name="celular2" 
                                 class="form-control" id="celular2" placeholder="Contacto 2" >
                            </div>

                        </div>


                        <div class="col-md-6">

                           <div class="form-group">

                                <label  for="nrmec" class="control-label">Previlegio:</label>
                                <select class="form-control" id="previlegio" name="previlegio"  required>
                                    <option value="#">--Select Previlegio --</option>
                                    <?php
                                      $sql2= mysqli_query($con, 'select * from previlegio ');
                                    while ($row = mysqli_fetch_assoc($sql2)){?>

                                        <option value="<?php echo $row['idprevilegio'] ?>">
                                            <?php echo utf8_encode($row['descricao']) ?></option>
                                    <?php }  ?>
                                </select>
                            </div>
                           
                        </div>

                    </div> <!----- second row ------->
                <div class="pull-right">

                    <input type="hidden" value="" name="datanasc">
                    <input type="hidden" value="1" name="nivelescolar">
                    <input type="hidden" value="" name="bi_recibo">
                    <input type="hidden" value="1" name="distrito">
                    <input type="hidden" value="1" name="estadocivil">
                    <input type="hidden" value="" name="endereco1">
                    

                   
   <br>    <br>

                    <button type="reset" class="btn btn-warning">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="guardar_datos">
                    Guardar</button>
                                   </div>


            </form>

              <div class="modal-footer">

                  <div id="resultados_ajax"></div>
                  
                  </div>

            </div>

                </div>
 
                </div>
        

            <!---  Fim modal Utilizador -->
	<?php
		}
	?>