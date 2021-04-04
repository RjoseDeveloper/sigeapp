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

						SIGEIRES <span class="desc">Sistema de Gestão Academica</span></a></h1>
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

	<!--//banner -->
	<!-- /newsletter-->
 

	<div class="newsletter_w3ls_agileits">

    <div class="col-sm-3 newsright">&nbsp</div>
		
		<div class=" col-sm-6 form_login" style="text-align:justify; background: #ccc; margin-top: 5em" align="center">
		
                  <div class="modal-body" style="padding: 30px 50px">
                      <div class="result_login alert alert-info">
                          <span class="badge badge-pill badge-info">SIGEIRES</span>

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
<!--                          <button type="reset" class="btn btn-warning" data-dismiss="modal">Cancelar</button>-->
                          <button type="button" id="btnlogin" onClick="login_online();" 
                           class="btn btn-primary">ENTRAR</button>
                      </div>
                  </div>
		
		</div>
        <div class="clearfix"></div>
         <div class="col-sm-3 newsright">&nbsp</div>
	</div>
	<!-- //newsletter-->


     <div class="modal-body form_register" style=";padding: 30px 50px">

                      <div class="result_register alert alert-info">
                          <span class="badge badge-pill badge-info">SIGEIRES</span>

                      </div>


     <form class="form-horizontal" style=";padding: 10px 30px; background: #ccc" method="post" id="guardar_usuario" name="guardar_usuario">

                
                    <div id="resultados_ajax" style=""></div>
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

                                <label for="sexo" class="control-label">Classe:</label>
                                <select name="curso" id="curso" class="form-control">
                                    <option value="none">--Selecionar o Curso --</option>

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

                                <label  for="nrmec" class="control-label">Endereco:</label>
                                <input style=" color: #0000CC" type="text" class="form-control" id="nrmec" name="nrmec"
                                       placeholder="Morada, bairro">
                          
                                <input name="previlegio" id="previlegio" value="1" type="hidden"/>
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
                                <label for="celular" class="control-label">Contacto</label>
                                <input type="number" class="form-control" id="celular" name="celular"
                                       placeholder="Contacto de Telefone" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_email" class="control-label">Email: <span class="vemail" style="color:red"></span></label>
                                <input type="email" class="form-control" id="user_email" pattern=".+@"
                                       name="user_email" placeholder="dados@gmail.com"
                                       onchange="validateDomainEmail(this.value)" required="O formato valido da unilurio">
                            </div>
                        </div>
                   
                    <div class="col-md-1">&nbsp;</div>

                    <div class="col-md-5">
                            <div class="form-group">
                                <label for="user_email" class="control-label">Email: <span class="vemail" style="color:red"></span></label>
                                <input type="email" class="form-control" id="user_email" pattern=".+@"
                                       name="user_email" placeholder="dados@gmail.com"
                                       onchange="validateDomainEmail(this.value)" required="O formato valido da unilurio">
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
				}, 1200);
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

    $( "#guardar_usuario" ).submit(function( event ) {
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
                $(".link_login").html('<br><a href="#" class="btn btn-success" style="" onclick="callback_login()">Iniciar Sistema ? </a>');
                $('#name').val($('#user_name').val());
                $('#pass').val($('#user_password_new').val());
            }
        });
        event.preventDefault();
    })

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
        $('.vemail').html("Ex. nome@example.com");


    }

</script>
