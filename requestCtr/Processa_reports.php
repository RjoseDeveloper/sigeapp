<?php 

require_once ("../Query/EstudantesSQL.php");
 require_once("../dbconf/getConection.php");

$sql_estudante = new EstudantesSQL();
 $db = new mySQLConnection();

$acao = $_POST['acao'];

//echo '<script src="../fragments/js/js_editar_pauta.js" type="text/javascript"></script>';

switch($acao){
    case 1:?>

          <div class="col-md-8"> <table class="table table-responsive" style="">
            <thead>

            <th>#</th>
            <th>Descrição</th>
            <th>Data de Publicação</th>
            <th>Acção</th>

            </thead>
            <tbody>

            <?php

            $vector = $sql_estudante->obterQtdAvaliacao($_POST['disp'], $_POST['curso'],2);
            foreach($vector as $linha){ if ($linha!=null){?>

                <tr>
                    <td><?php echo $linha['idptn']?></td>
                    <td style="text-align:left"><?php echo $linha['descricao']?></td>
                    <td style="text-align:left"><?php echo $linha['datapub']?></td>

                    <td>
                        <input type="hidden" name="campo_ptn" id="campo_ptn" value="<?php echo $linha['idptn']?>"/>

                        <select id="select_reports" name="selects_reports" class="form-control" onchange="print_lista_pauta(<?php echo $linha['idptn']?>, this.value)">

                            <option value="">Seleccionar</option>
                            <option value="ptn" class="btn_pauta_normal_pdf">Imprimir (PDF)</option>
                            <option value="html" class="btn_pauta_normal_html">Visualizar</option>
                            <option value="json" class="btn_pauta_normal_json">Exportar(JSON)</option>
                            <option value="">...</option>

                        </select>

                    </td>

                </tr>

            <?php }}?>

            </tbody>
        </table>
        </div>

        <?php break; 

        case 2:

           $disciplina = $_POST['disp'];
            $curso = $_POST['curso'];
          
            $result = mysqli_query($db->openConection(),
                $sql_estudante->obterEstudantesDisciplina($disciplina, $curso));

            $t =0;

            while ($row= mysqli_fetch_assoc($result)){

                if ($t%2 != 0){
                    echo '<tr class="remove_tr" style="background: #E8E8E8" >';
                }else{

                    echo '<tr class="remove_tr" style="background: #FFFAFA" >';
                }
                    echo'<td>&nbsp;</td><td class="nrmec">'.$row['numero'].'</td> <td>&nbsp;</td>';
                    echo '<td style="text-align:left">'.$row['nomeCompleto'].'</td>';
                    echo '<td><div style="text-align: right; float: right" class="">';
                    echo '<input type="number" id="nota" class="form-control" onchange="validar_nota(this.value)" placeholder="Atribuir classificação"/></div>';
                    echo '<input id="id_aluno" value="'.$row['idEstudante'].'" name="id_aluno" type="hidden" /></td>';
                    echo '<td class="nrmec"><input type="hidden" id="btn_nrmec" value="'.$row['numero'].'"/> </td></tr>';
                $t++;
            }

            break;


        break;


         } ?>