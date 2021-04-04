<?php
include('ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

require_once '../Query/EstudantesSQL.php';
require_once '../dbconf/getConection.php';

$estudante_sql = new EstudantesSQL();
$db = new mySQLConnection();
$semestre = date('m') < 7 ? '1º':' 2º';
$ano = date('Y');

$semis = date('m') < 7 ? '1':' 2';

if (!isset($_SESSION['username'])){ ?>

    <script xmlns="http://www.w3.org/1999/html">
        window.location= "../index.php";
    </script>

<?php } ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SIGePautas</title>
        <meta name="keywords" content="" />
		<meta name="description" content="" />
<!--
-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap core CSS -->

        <?php require '../view/layouts/_header.html' ?>

        <script src="fragments/js/js_function.js" type="text/javascript"></script>
        <script src="fragments/js/js_estudante.js" type="text/javascript"></script>
        <script src="fragments/js/js_plano_avaliacao.js" type="text/javascript"></script>
        <script src="fragments/js/js_registo_academico.js" type="text/javascript"></script>
        <script type="text/javascript" src="fragments/js/shared.js"></script>

        <style>

            #templatemo-nav-bar{
                margin-bottom: 1em;
                margin-top: -1em;
            }

             ul li{cursor: pointer;color:white}
             ul li:hover{ background:#ccc; color:white}

             .main-content{
                margin: auto;
                position: relative;
                overflow: hidden;
            }

            .iframe-container {
                overflow: hidden;
               //Calculated from the aspect ration of the content (in case of 16:9 it is 9/16= 0.5625);
                padding-top: 56.25%;
                position: relative;
            }
            .iframe-container iframe {
                border: 0;
                height: 100%;
                left: 0;
                position: absolute;
                top: 0;
                width: 100%;
            }

        </style>

    </head>
    <body>

    <?php include("utilizador/cambiar_password.php"); ?>

        <div class="templatemo-top-bar" id="templatemo-top" style="margin-top: -1.5em;">
            <div class="container">
                <div class="subheader" >

            <div class="navbar navbar-default" role="navigation" style="background: none;">
                <div class="container">

                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>

                        </button>
                    </div>

                    <div class="menu-logo" style="">
                        <div class="navbar-brand">
                <span class="navbar-logo">
                    etchicola
                </span>
                        </div>
                    </div>

                    <?php if ($_SESSION['tipo'] == 'estudante'){?>

                    <div class="navbar-collapse collapse" id="templatemo-nav-bar">
                    <ul class="nav navbar-nav navbar-right" style="margin-bottom: 2px">
                        <li class="active"><a href="aluno/buscar_alunos.php?action=ajax&q=x" target="frm_content">HOME</a></li>
                        <li ><a href="aluno/aluno_pauta.php" target="frm_content">Pautas Finais</a></li>
<!--                        <li><a  href="aluno/Aluno.php" target="frm_content" >Meus Dados</a></li>-->

                        <li class="dropdown" id="">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false" >
                                <i class=""></i> <?php echo 'Minha Conta';?> <span class="caret"></span></a>

                            <ul class="dropdown-menu">

                                <li><a href="#" onclick="modify_user_pass('<?php echo $_SESSION['id'] ?>', 'utilizador/editar_password.php');" data-toggle="modal" data-target="#myModal3">
                                        <i class="glyphicon glyphicon-cog"></i> Alterar Password</a></li>
                                <li><a href="classes/logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair do Sistema</a></li>

                            </ul>
                        </li>

                    </ul>
                    </div><!--/.nav-collapse Estudante-->

                    <?php } elseif ($_SESSION['tipo'] == 'visitante'){?>

                        <div class="navbar-collapse collapse" id="templatemo-nav-bar">
                            <ul class="nav navbar-nav navbar-right" style="margin-bottom: 2px">
                                <li class="active"><a href="../index.php">HOME</a></li>

                                <li class="dropdown" id="">

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                       aria-expanded="false" >
                                        <i class=""></i> <?php echo 'Minha Conta';?> <span class="caret"></span></a>

                                    <ul class="dropdown-menu">

                                        <li><a href="#" onclick="modify_user_pass('<?php echo $_SESSION['id'] ?>', 'utilizador/editar_password.php');" data-toggle="modal" data-target="#myModal3">
                                                <i class="glyphicon glyphicon-cog"></i> Alterar Password</a></li>
                                        <li><a href="classes/logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair do Sistema</a></li>

                                    </ul>
                                </li>

                            </ul>
                        </div><!--/.nav-collapse Estudante-->

				   <?php }  elseif ($_SESSION['tipo'] == 'racademico'){ ?>
                    </div> <!--/.container-fluid coordenador-->


                    <div class="navbar-collapse collapse" id="templatemo-nav-bar">
                        <ul class="nav navbar-nav navbar-right" style="margin-top: 5px">
                            <li class="active"><a href="../view/registo_academico/Gestao_Academica.php" target="frm_content">HOME</a></li>
                            
                            <li class="dropdown" id="">
                                <a  href="#" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class=""></i><?php echo 'Contabilidade'; ?><span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="actividade/activity_session.php" target="frm_content">Sessão de Pagamento</a></li>
                                    <li><a href="contabilidade/facturas.php" target="frm_content">Gerir Pagamentos Alunos</a></li>
                                    <li><a href="contabilidade/despesas.php" target="frm_content">Gerir Despesas e Orçamentos</a></li>
                                    <li><a href="contabilidade/factura.php" target="frm_content">Relatórios Financeiros</a></li>

                                    <span class=""></span>
                                </ul>

                            </li>

                            <li class="dropdown" id="">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                   aria-expanded="false" >
                                    <i class=""></i> <?php echo 'Area Academica';?> <span class="caret"></span></a>

                                <ul class="dropdown-menu">
                                    
                                     <li id="manageStudentNav"><a href="aluno/aluno.php" target="frm_content">Todos Alunos</a></li>
                                    
                                   <li id="manageStudentNav"><a href="curso/cursos.php" target="frm_content">Cursos e Turmas <i class="pull-right glyphicon glyphicon-eye"></i></a></li>
                                    <li id="manageStudentNav"><a href="disciplina/disciplinas.php" target="frm_content">Todas Disciplinas</a></li>
                                    <li ><a href="registo_academico/Registo_Academico.php" target="frm_content">Notas Finais</a></li>

                                </ul>
                            </li>

                             <li value=""><a href="utilizador/usuarios.php" target="frm_content">Gestao de Contas</a></li>

                            <li class="dropdown" id="">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                   aria-expanded="false" >
                                    <i class=""></i> <?php echo 'Minha Conta';?> <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="#" onclick="modify_user_pass('<?php echo $_SESSION['id'] ?>', 'utilizador/editar_password.php');" data-toggle="modal" data-target="#myModal3">
                                            <i class="glyphicon glyphicon-cog"></i> Alterar Password</a></li>
                                    <li><a href="classes/logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair do Sistema</a></li>

                                </ul>
                            </li>

                            

                        </ul>
                        <?php } ?>
                    </div> <!--/.container-fluid coordenador-->
                </div> <!--/.navbar contaniner -->
                </div>  <!--/.navbar bar default -->
                </div>  <!--/.sub header -->
                </div>  <!--/. contaniner 1 main -->
            </div>  <!--/. tamplate top bar -->

        <div class="container" style="color: #008000;font-weight: bold">
            <span class="glyphicon glyphicon-user"></span><?php echo " ". utf8_decode($_SESSION['username']) ?> / <span><?php echo strtoupper( $_SESSION['tipo']);?></span></div>
        <div class="templatemo-service">
            <div class="main-content" style="">
                <?php

                if ($_SESSION['tipo'] == 'estudante'){
                    $page_init = 'aluno/buscar_alunos.php?action=ajax&q=x';

                }elseif ($_SESSION['tipo'] == 'dir_adjunto_pedag' || $_SESSION['tipo'] == 'director'){
                    $page_init = 'pedagogico/Direcao.php';
                }
                elseif ($_SESSION['tipo'] == 'racademico'){
                    $page_init = 'registo_academico/Gestao_Academica.php';
                }

                elseif ($_SESSION['tipo'] == 'visitante'){
                    $page_init = 'home/visitante.php';
				
                }else{
                    $page_init = 'home/visitante.php';
                }
                ?>
                <iframe  src="<?php echo $page_init ?>"
                        width="100%" height="2000" overflow="hidden" name="frm_content" frameborder="0" id="iframe" onload=""></iframe>
            </div>
        </div>

        <!--- Pesquisar Planos de outros Docentes das Disciplinas -->
        <!-- container -->

        <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="md_relatorios" role="dialog">

                <div class="modal-dialog modal-sm">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header alert alert-warning" style="padding:25px 40px; text-align: left">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4><span class="glyphicon glyphicon-search"></span>&nbsp;Pesquisar planos de avaliação</h4>
                        </div>

                        <div class="modal-body" style="padding:20px 30px;">
                           <?php if ($_SESSION['tipo'] == 'estudante') {?>
                               <div class="alert alert-success"> Disciplinas associadas ao Estudante - <?php echo utf8_encode($_SESSION['nomeC']) ?> </div>
                               <label>Seleccionar:</label>
                               <ul class="list-group ul_li_item" id="rs_docente_disciplinas">

                                   <?php
                                   $idAluno= $estudante_sql->getIdEstudante($_SESSION['username'], 1);
                                   //echo $idAluno;
                                   $vetor =  $estudante_sql->estudanteDisciplina($idAluno, "", 0,$semestre,$ano);
                                   foreach($vetor as $row){
                                       if ($row!=null){?>

                                           <li style="color: #0000CC" class="list-group-item" value="<?php echo $row['idDisciplina']?>"
                                               onclick="mostrar_plano_avaliacao(this.value,<?php echo $semis?>,<?php echo $ano?>,0)">
                                               <?php echo $row['descricao']?>  <span class="glyphicon glyphicon-chevron-right pull-right"></span></li>
                                       <?php } }?>
                               </ul>
                               <?php }else {?>

                            <div class="pesquisar_planos" >

                                <div class="row">

                                    <div class="col-md-6">

                                        <input type="text" class="form-control" name="search_doc" onkeyup="pl_avaliacao_doc_nome(this.value)"
                                               placeholder="Buscar docente ... nome" id="search_doc" value=""/>
                                        <ul class="list-group ul_li_item" id="rs_docente" style="color: #0000CC"></ul>

                                    </div>

                                    <div class="col-md-6">

                                            <select class="form-control" id="ano_academico" style="width: 200px">
                                                <option selected>-- ANO --</option>

                                                <?php for ($i  = date('Y'); $i> 2010; $i--){ ?>
                                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php } ?>
                                                <option>...</option>
                                            </select>
                                    </div>
                                </div>
                                <br>

                                <div class="">
                                    <button class="btn btn-default" id="btn_buscar_disciplias">Listar Disciplinas</button>

                                </div>

                            </div>

                               <span class="mostrar_doc"></span>

                            <ul class="list-group ul_li_item" id="rs_docente_disciplinas"></ul>

                            <?php } ?>


                            <div class="visualizar_pl">
                                <label>Detalhes do Plano</label>
                                <table  id="table-custom-2" data-mode="color"
                                        class="table table-responsive">
                                     
                                    <thead>
                                          <tr class="ui-bar-b"  id="div-bar"
                                              style="background: #D8D8D8;border: none; color: #151515; font-size: 12px">
                                        <th>ID</th> 
                                        <th >Disciplina</th>
                                                <th >Tipo de Avaliação</th>
                                                <th >Peso</th>
                                        <th>Operações</th>
                                              </tr>
                                    </thead>
                                        <tbody id="tbl_dados" style="font-size: 11px;"> </tbody>
                                      </table>

                        </div> <!---- Table show plano-->


                           

                            </div>

                </div>
            </div>
            </div> <!-- container--->
         </div>

            <!---------------------------------------------------------------------------------------------->
    </body>
  </html>

  <script type="text/javascript">

    $('#rs_docente_disciplinas li').click(function(){
        $('li.current ').removeClass('current').css({'background':'white', 'color':'black'});
        $(this).closest('li').addClass('current');
        $(this).closest('li ').css({'background':'#E6E8FA', 'color':'blue'});
    });

    $('.iframe').css('height', $(window).height()+'px');

    function getDocHeight(doc) {
        doc = doc || document;
        // stackoverflow.com/questions/1145850/
        var body = doc.body, html = doc.documentElement;
        var height = Math.max( body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight );
        return height;
    }

    function setIframeHeight(id) {
        var ifrm = document.getElementById(id);
        var doc = ifrm.contentDocument? ifrm.contentDocument:
            ifrm.contentWindow.document;
        ifrm.style.visibility = 'hidden';
        ifrm.style.height = "10px"; // reset to minimal height ...
        // IE opt. for bing/msn needs a bit added or scrollbar appears
        ifrm.style.height = getDocHeight( doc ) + 4 + "px";
        ifrm.style.visibility = 'visible';
    }
  </script>

