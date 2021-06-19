
	<!-- Modal -->
	<div class="modal fade" id="form_aluno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  
      <div class="modal-dialog" role="document">
		<div class="modal-content" style=";padding: 10px 30px; background:#F8F9F9">


		  <div class="modal-header">

			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> NOVO ALUNO</h4>

          </div>

            
            <div class="modal-body">

            <form class="form-horizontal"  method="post" id="guardar_usuario" name="guardar_usuario">

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

                                <label for="firstname" class="control-label">Data de Nascimento:</label>
                                <input type="date" class="form-control" id="datanasc" name="datanasc" placeholder="Data de Nascimento..." required>

                            </div>

                        </div>

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
                                <label for="firstname" class="control-label">BI/Recibo:</label>
                                <input type="text" class="form-control" id="bi_recibo" name="bi_recibo" placeholder="Numero do documento ..." required>
                            </div>
                        </div>

                         <div class="col-md-6">
                          
                          <div class="form-group">
                                <label for="firstname" class="control-label">Estado Civil:</label>
                                 <select class="form-control" id="estadocivil" name="estadocivil"  required>
                                    <option value="1">Solterio</option>
                                    <option value="2">Casado</option>
                                    <option value="3">Viuva</option>
                                    <option value="4">Divorciado</option>
                                </select> 
                            </div>
                        </div>
                    </div> <!----- second row ------->


                    <div class="row">
                        
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
                                <label for="firstname" class="control-label">Provincia:</label>
                                <select class="form-control" id="provincia" name="provincia"  required>
                                     <option value="#">--Select Provincia --</option>
                                    <?php
                                   $sql1 = mysqli_query($con, 'select * from provincia ');
                                    while ($row = mysqli_fetch_assoc($sql1)){?>

                                        <option value="<?php echo $row['idprovincia'] ?>">
                                            <?php echo utf8_encode($row['descricao']) ?></option>
                                    <?php }  ?>
                                </select>  
                            </div>

                    </div>


                        <div class="col-md-6">

                           <div class="form-group">

                                <label  for="nrmec" class="control-label">Distrito:</label>
                                <select class="form-control" id="distrito" name="distrito"  required>
                                    <option value="#">--Select Curso --</option>
                                    <?php
                                      $sql2= mysqli_query($con, 'select * from distrito ');
                                    while ($row = mysqli_fetch_assoc($sql2)){?>

                                        <option value="<?php echo $row['iddistrito'] ?>">
                                            <?php echo utf8_encode($row['descricao']) ?></option>
                                    <?php }  ?>
                                </select>
                            </div>
                           
                        </div>
                   

                    </div> <!----- fim fourth row------>


                  <div class="row">


                        <div class="col-md-6">
                           
                            <div class="form-group">
                                <label for="celular2" class="control-label">Nivel Escolar: </label> 
                                

                                <select class="form-control" id="nivelescolar" name="nivelescolar"  required>
                                    <option value="1">1ª</option>
                                    <option value="2">2ª</option>
                                    <option value="3">3ª</option>
                                    <option value="4">4ª</option>
                                    <option value="4">5ª</option>
                                    <option value="4">6ª</option>
                                    <option value="4">7ª</option>
                                    <option value="4">8ª</option>
                                    <option value="4">9ª</option>
                                    <option value="4">10ª</option>
                                    <option value="4">11ª</option>
                                    <option value="4">12ª</option>
                                </select>
                            </div>

                        </div>
                   
                    <div class="col-md-6">
                      <div class="form-group">
                                <label for="firstname" class="control-label">Encarregado de educação:</label>
                                <input type="text" class="form-control" id="encarregado 
                                name="encarregado" placeholder="encarregado ..." required>
                            </div>

                    </div>

                        <div class="col-md-6">

                           <div class="form-group">

                                <label  for="nrmec" class="control-label">Endereco1:</label>
                                <input style=" color: #0000CC" type="text" class="form-control" id="endereco1" name="endereco1" placeholder="Morada, bairro">
                                <input name="previlegio" id="previlegio" value="1" type="hidden"/>
                            </div>
                           
                        </div>

                        <div class="col-md-6">

                           <div class="form-group">

                                <label  for="nrmec" class="control-label">Classe:</label>
                               <input style=" color: #0000CC" type="hidden" class="form-control" id="endereco2" name="endereco2" placeholder="Morada, bairro">

                               <select class="form-control" id="classe" name="classe"  required>
                                   <option value="#">--Select Classe--</option>
                                   <?php
                                   $sql2= mysqli_query($con, 'select * from curso ');
                                   while ($row = mysqli_fetch_assoc($sql2)){?>
                                       <option value="<?php echo $row['idcurso'] ?>">
                                           <?php echo utf8_encode($row['descricao']) ?></option>
                                   <?php }  ?>
                               </select>

                            </div>
                           
                        </div>

                  </div> <!------- fim fiveth row-------->
             
                <input name="estado" id="estado" value="1" type="hidden" readonly/>
                <input name="previlegio" id="previlegio" value="1" type="hidden" readonly/>
                
                <div class="pull-right">

                <button type="reset" class="btn btn-warning">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="guardar_datos">
                    Guardar</button>
                </div>
                <br> <br>

                   </form>
              </div> <!-- Modal Body-->

                  <div class="modal-footer">

                  <div id="resultados_ajax"></div>
                  
                  </div>

	  </div>
 
	</div>
    </div>
