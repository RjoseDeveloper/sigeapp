<!DOCTYPE html>
<html>
<head lang="en">

    <meta charset="UTF-8">
    <title>Registar Disciplina</title>

    <style type="text/css">

        li{list-style: none;  padding: -2em;}
        .doc_ul_a{ cursor: pointer;}
        .form-control{margin-top: 5px;}

    </style>

</head>
<body>

<div class="container">
    <div class="jumbotron col-sm-12">
        <!--------   Mmostra lista de disciplina de um docente ----------------->

                <div class=" disciplina">

                    <form class="form-horizontal" method="post" id="guardar_disciplina" name="guardar_disciplina">
                   
<div id="resultados_ajax"></div><!-- Carga los datos ajax -->
                    <input type="text" required="" name="descricao" class="form-control" value="" id="descricao" placeholder="Descrição da Disciplina"/>
                    <input type="text" required="" name="credito" class="form-control" value="" id="credito" placeholder="Pontuação ou Creditos"/>
                    
                        <div class="row">

                            <div class="col-md-6">
                                <select name="natureza" id="natureza" class="form-control" required="">

                                    <option value="" data-theme="a" desable="desable"> -- Natureza -- </option> 
                                    <option value="Teorico/Pratico"> Teorico/Pratico </option>
                                    <option value="Modular"> Modular </option>
                                    <option value="Laboratorio"> Laboratorio </option>
                                    <option value="Pesquisa de Campo">Outro</option>
                                     
                                </select>
                            </div>


                            <div class="col-md-6">

                                <select name="curso" id="curso" class="form-control" required="">
                                    <option value="" data-theme="a" desable="desable"> -- Classe -- </option>

                                    <?php

                                    $rs = mysqli_query($con, 'SELECT * FROM curso');
                                    while ($row = mysqli_fetch_assoc($rs)){?>
                                        <option value="<?php echo $row['idcurso'] ?>"> <?php echo utf8_encode($row['descricao'])?> </option>
                                    <?php  }?>
                                     
                                </select>

                            </div>

                        </div>


                    <div class="pull-right"><br>

                      
                    <button type="submit" class="btn btn-primary" data-theme="b" data-mini="true" data-inline="true"
                            style="font-size:12px;
                 margin-right: -.1em;background:#4682B4; border:none; padding: 10px 50px"  class="guardar_datos" id="guardar_datos">Registar Operação</button>
                        </div>
                        <br>

                    </form>
                </div> <!-- fim div class sm-7 tamanho de textos-->

</div>

</body>


</html>