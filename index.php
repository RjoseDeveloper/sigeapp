<?php
require_once 'dbconf/getConection.php';
$db = new mySQLConnection();
$con = $db->openConection();
?>

<!DOCTYPE html>
<html>

<head>
	<title>SIGaIRIS</title>

	<!--/tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--//tags -->
	<link href="bibliotecas/layout_home/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="bibliotecas/layout_home/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="bibliotecas/layout_home/css/prettyPhoto.css" rel="stylesheet" type="text/css" />
	<link href="bibliotecas/layout_home/css/font-awesome.css" rel="stylesheet">
	<!-- //for bootstrap working -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,300,300i,400,400i,500,500i,600,600i,700,800" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700" rel="stylesheet">
	<script src="bibliotecas/jQuery/js/jquery-1.7.1.min.js"></script>
	 
</head>

<body>

	<div class="top_header" id="home">
		<!-- Fixed navbar -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="nav_top_fx_w3ls_agileinfo">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed"
                            data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					    aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
					<div class="logo-w3layouts-agileits">
						<h1> <a class="navbar-brand" href="#">

                                <i class="fa fa-folder-open" aria-hidden="true"></i>

						SIGAIRIS <span class="desc">Sistema de Gestão Academica</span></a></h1>
					</div>
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<div class="nav_right_top">

						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a  href="#" onclick="callback_login()">ENTRAR</a></li>
						</ul>

						<ul class="nav navbar-nav">
							<li><a class="request" href="#">HOME</a></li>
<!--						<li><a href="#"> Sobre o Sistema </a> </li> -->
							<li><a href="#" class="request" onclick="callback_register()" >REGISTAR-SE</a></li>

                        </ul>

					</div>
				</div>

				<!--/.nav-collapse -->
			</div>
		</nav>
	</div>
	<!-- banner -->

	<div class="newsletter_w3ls_agileits">

    <div class="col-sm-3 newsright">&nbsp</div>
		
		<div class=" col-sm-6 form_login" style="text-align:justify; background: #F8F9F9; margin-top: 5em" align="center">
		
                  <div class="modal-body" style="padding: 30px 50px">
                      <div class="result_login alert alert-info">
                          <span class="badge badge-pill badge-info" style="background: red">SIGaIRIS - Autenticação</span>

                      </div>
                      <hr>

                      <div class="userlogin">
                          <div style="">
                              <label for="name" class="control-label mb-1">Username</label>
                              <input class="form-control" autocomplete="off" name="name" id="name"
                                     value="" data-clear-btn="true" placeholder="user" type="text"><br>
                              <label for="pass" class="control-label mb-1"> Password</label>
                              <input class="form-control" autocomplete="off" name="pass" id="pass" value="" data-clear-btn="true"  placeholder="senha" type="password">
                          </div>
                          <p style="color:indianred">Não possui conta? <span><a href="#"
                           onclick="callback_register()">Registar -se</a></span></p>

                      </div>

                      <div class="modal-footer" style="">
                      
                          <button type="button" id="btnlogin" onClick="login_online();" 
                           class="btn btn-primary">ENTRAR</button>
                      </div>
                  </div>
		
		</div>
        <div class="clearfix"></div>
         <div class="col-sm-3 newsright">&nbsp</div>
	</div>

	<!-- //newsletter-->


     <div class="modal-body form_register" style="padding: 30px 50px">
      <div class="badge badge-pill" style="background: red">SIGaIRIS - AUTOCADASTRO DO ALUNO</div>
        
      <div id="resultados_ajax"></div>
      <div class="link_login"></div>
      <hr>

 
     <form class="form-horizontal" style=";padding: 10px 30px; background:#F8F9F9" method="post" id="guardar_usuario" name="guardar_usuario">

                    <div class="row" style="">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="firstname" class="control-label">Nome Completo:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nome ..." required>
                            </div>
                        </div>
                        <div class="col-md-4">

                           <div class="form-group">
                                <label for="user_name" class="control-label">Username:</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Nome de Acesso" autocomplete="off"
                                       pattern="[a-zA-Z0-9]{2,64}" title="Nome do utilizador (somente letras e números, 2-64 caracteres)"required>
                            </div>
                          
                        
                        </div>

                        <div class="col-md-4">

                           <div class="form-group">
                                <label for="user_password_new" class="control-label">Password:</label>
                                <input type="password" class="form-control" id="user_password_new" name="user_password_new"
                                       placeholder="Senha" pattern=".{6,}" title="Senha (Min. 6 Caracteres)" required>
                            </div>

                        </div>
                    </div> <!---------- fim first row ----------->

                    <div class="row">
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="sexo" class="control-label">Sexo:</label>
                                <select class="form-control" id="sexo" name="sexo">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>

                            </div>
                        </div>
                       

                        <div class="col-md-4">

                              <div class="form-group">

                                <label for="firstname" class="control-label">Data de Nascimento:</label>
                                <input type="date" class="form-control" id="datanasc" name="datanasc" placeholder="Data de Nascimento..." required>

                            </div>

                        </div>

                        <div class="col-md-4">
                          
                             <div class="form-group">
                                <label for="user_email" class="control-label">Email: <span class="vemail" style="color:red"></span></label>
                                <input type="email" class="form-control" id="user_email" 
                                name="user_email" placeholder="dados@dominio"
                                       onchange="validateDomainEmail(this.value)" required="O Formato Valido do Email">
                            </div>

                        </div>
                    </div> <!----- second row ------->


                    <div class="row">
                        <div class="col-md-4">
                           
                               <div class="form-group">
                                <label for="firstname" class="control-label">BI/Recibo:</label>
                                <input type="text" class="form-control" id="bi_recibo" name="bi_recibo" placeholder="Numero do documento ..." required>
                            </div>


                        </div>

                        <div class="col-md-4">
                          
                          <div class="form-group">
                                <label for="firstname" class="control-label">Estado Civil:</label>
                                 <select class="form-control" id="estadocivil" name="estadocivil"  required>
                                    <option value="1">solerio</option>
                                    <option value="2">casado</option>
                                    <option value="3">viuva</option>
                                    <option value="4">divorciado</option>
                                </select> 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="celular" class="control-label">Contacto 1:</label>
                                <input type="number" class="form-control" id="celular1" name="celular1"
                                       placeholder="Contacto 1" required>
                            </div>
                        </div>
                    </div> <!----- fim fourth row------>

                    <div class="row">


                        <div class="col-md-4">
                           
                            <div class="form-group">
                                <label for="celular2" class="control-label">Contacto 2: </label>
                                 <input type="number" name="celular2" 
                                 class="form-control" id="celular2" placeholder="Contacto 2" >
                            </div>

                        </div>
                   
                    <div class="col-md-4">
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

                        <div class="col-md-4">

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

                  </div> <!------- fim fiveth row-------->


                  <div class="row">


                        <div class="col-md-4">
                           
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
                   
                    <div class="col-md-4">
                      <div class="form-group">
                                <label for="firstname" class="control-label">Encarregado de educação:</label>
                                <input type="text" class="form-control" id="encarregado name="encarregado" placeholder="encarregado ..." required>
                            </div>

                    </div>

                        <div class="col-md-4">

                           <div class="form-group">

                                <label  for="nrmec" class="control-label">Endereco:</label>
                                <input style=" color: #0000CC" type="text" class="form-control" id="endereco1" name="endereco1" placeholder="Morada, bairro">
                                <input name="previlegio" id="previlegio" value="1" type="hidden"/>
                               <input type="hidden" class="form-control" id="classe" name="classe " value="">

                           </div>
                           
                        </div>

                  </div> <!------- fim fiveth row-------->
             
                <input name="estado" id="estado" value="1" type="hidden" readonly/>
                <input name="previlegio" id="previlegio" value="1" type="hidden" readonly/>

              
                <div class="pull-right">

                   

                    <button type="reset" class="btn btn-warning">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="guardar_datos">
                    Guardar</button>
                    <br>
                  </div>

                </div>

            </form>
          </div>
      
	 <script type="text/javascript" src="bibliotecas/layout_home/js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="bibliotecas/layout_home/js/bootstrap.js"></script>
	<script type="text/javascript" src="view/fragments/js/js_function.js"> </script>
  <script type="text/javascript" src="view/fragments/js/js_index.js"></script>

	<script>

		$('ul.dropdown-menu li').hover(function () {
			$(this).find('.dropdown-menu').stop(true, true).delay(400).fadeIn(700);
		}, function () {
			$(this).find('.dropdown-menu').stop(true, true).delay(400).fadeOut(700);
		});

       $('.form_register').hide();

	</script>

	<!-- js -->
	<!-- Smooth-Scrolling-JavaScript -->
	<script type="text/javascript" src="bibliotecas/layout_home/js/easing.js"></script>

	<script type="text/javascript">

		jQuery(document).ready(function ($) {

			$(".scroll, .navbar li a, .footer li a").click(function (event) {
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				},1200);
			});

		});

	</script>

	<!-- //Smooth-Scrolling-JavaScript -->
	<script type="text/javascript">

		function callback_login(){

        $('.form_login').show('slow');
        $('.form_register').hide();
    }

    function callback_register(){

        $('.form_login').hide('slow');
        $('.form_register').show('slow');
    }

	</script>


	<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- jQuery-Photo-filter-lightbox-Gallery-plugin -->
	<script type="text/javascript" src="bibliotecas/layout_home/js/jquery-1.7.2.js"></script>
	<script src="bibliotecas/layout_home/js/jquery.quicksand.js" type="text/javascript"></script>
	<script src="bibliotecas/layout_home/js/script.js" type="text/javascript"></script>
	<script src="bibliotecas/layout_home/js/jquery.prettyPhoto.js" type="text/javascript"></script>
	<!-- //jQuery-Photo-filter-lightbox-Gallery-plugin -->

</body>

</html>


<!---  Fim modal Utilizador -->

<script type="text/javascript">

    $(document).ready(function(){
        $('.ano_doc').hide();
    });

    $("#guardar_usuario" ).submit(function(event) {
        $('#guardar_datos').attr("disabled", true);

        var parametros = $(this).serialize();
        //alert(parametros);
        $.ajax({
            type: "POST",
            url: "view/utilizador/nuevo_usuario.php",
            data: parametros,
            beforeSend: function(objeto){
                $("#resultados_ajax").html("Mensagem: Carregando...");
            },
            success: function(datos){
                //alert(datos);
                $("#resultados_ajax").html(datos);
                $('#guardar_datos').attr("disabled", false);
                $(".link_login").html('<a href="#" class="btn btn-success" onclick="callback_login()">Consultar Codigo? </a>');
                $('#name').val($('#user_name').val());
                $('#pass').val($('#user_password_new').val());
            }
        });
        event.preventDefault();
    });

    function enable_codigo_aluno(item){

        if(item == 1){

            $('.nr_mec').show('slow');
            $('.ano_doc').hide('slow');
        }else{

            $('.nr_mec').hide('slow');
            $('.ano_doc').show('slow');
        }

    }

    var domains = ["dominio", "", ""];

    function validateDomainEmail(me) {
        $('.vemail').html("Ex. nome@dominio");
    }

</script>
