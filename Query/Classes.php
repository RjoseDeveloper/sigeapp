<?php
/**
 * Created by PhpStorm.
 * User: Raimundo Jose
 * Date: 1/16/2018
 * Time: 2:54 AM
 */

//require '../dbconf/getConection.php';

class Classes {

    function find_distritos($idprovincia){

        return "SELECT  distrito.iddistrito, distrito.descricao
FROM distrito INNER JOIN provincia ON provincia.idprovincia = distrito.idprovincia
WHERE provincia.idprovincia = '$idprovincia'";
    }

    function find_periodos($idcurso){
        $db =  new mySQLConnection();

        $query = 'SELECT  periodo.descricao
FROM curso INNER JOIN periodo ON curso.idcurso = periodo.idcurso
WHERE curso.idcurso='.$idcurso;

        $rs = mysqli_query($db->openConection(), $query);
        while ($linhas = mysqli_fetch_assoc($rs)){
            echo $linhas['descricao'].'<br>';
        }
    }

    function find_frm_periodos_or_mes($curso, $disciplina, $aluno, $ctr)
    {
        $sql="";
        $aux = "OR";

        if ($aluno !=''){
            $aux = "AND";
        }

        if ($ctr==0) {
            $sql.="SELECT COUNT(utilizador.id) as numrows ";
        } else {
            $sql.= "SELECT utilizador.id,  utilizador.nomeCompleto, aluno.nr_mec,
                  turma.descricao as turma, disciplina.anolectivo as nivel, disciplina.descricao as disciplina,
                   inscricao.data_registo,curso.descricao, disciplina.creditos ";
        }

            $sql.="FROM utilizador INNER JOIN inscricao ON inscricao.idutilizador = utilizador.id 
  INNER JOIN disciplina on disciplina.idDisciplina = inscricao.iddisciplina
  INNER JOIN turma ON turma.idturma = inscricao.idturma
  INNER JOIN curso ON curso.idcurso = turma.idcurso 
  INNER JOIN aluno ON aluno.idutilizador = utilizador.id
		WHERE  (curso.idcurso = '$curso' AND inscricao.iddisciplina = '$disciplina') $aux inscricao.idutilizador ='$aluno'";

        return $sql;
    }

    function find_frm_curso($aluno){
        $db =  new mySQLConnection();
      $data = "SELECT curso.idcurso FROM inscricao INNER JOIN
turma ON turma.idturma = inscricao.idturma INNER JOIN
curso ON curso.idcurso = turma.idcurso
WHERE inscricao.idutilizador = '$aluno'";

        $rs = mysqli_query($db->openConection(), $data);
        while ($linhas = mysqli_fetch_assoc($rs)){
            return $linhas['idcurso'];
        }
$db->closeDatabase();
    }

    function find_formando_by($string){
        return "SELECT formando.idformando, formando.bi_recibo, formando.fullname as fullname
FROM formando WHERE formando.fullname LIKE '$string'";
    }

    function find_formaando_list(){
        return 'SELECT idformando,bi_recibo,fullname FROM formando LIMIT 4';
    }

    function find_users($q, $ctr){
        if ($ctr ==0){
            return "SELECT id, nomeCompleto as fullname, email FROM utilizador WHERE idprevilegio >= 1 AND nomeCompleto LIKE '%$q%' LIMIT 3";
        }else if($ctr == 5){
            return "SELECT id, nomeCompleto as fullname, email FROM utilizador WHERE idprevilegio < 2 AND nomeCompleto LIKE '%$q%' LIMIT 3";
        }else{
            return "SELECT aluno.idaluno as id, CONCAT(aluno.nome,' ', aluno.apelido) as fullname, email FROM aluno WHERE CONCAT(aluno.nome,' ', aluno.apelido) LIKE '%$q%' LIMIT 3";
        }
    }

    public function return_mes()
    {
        if (date('m')== 1){return 'Janeiro';}
        if (date('m')== 2){return 'Fevereiro';}
        if (date('m')== 3){return 'Março';}
        if (date('m')== 4){return 'Abril';}
        if (date('m')== 5){return 'Maio';}
        if (date('m')== 6){return 'Junho';}
        if (date('m')== 7){return 'Julho';}
        if (date('m')== 8){return 'Agosto';}
        if (date('m')== 9){return 'Setembro';}
        if (date('m')== 10){return 'Outubro';}
        if (date('m')== 11){return 'Novembro';}
        if (date('m')== 12){return 'Dezembro';}
    }
    function find_periodos_curso($idcurso){
        return 'SELECT turma.idturma, turma.descricao
                FROM turma WHERE turma.idcurso='.$idcurso;
    }

    function find_disciplina($idcurso){
        return "SELECT disciplina.idDisciplina, disciplina.descricao
                FROM disciplina WHERE disciplina.idcurso='$idcurso'";
    }

    function find_estudante($idcurso){

        return 'SELECT DISTINCT inscricao.idutilizador as id, utilizador.nomeCompleto as fullname
                FROM inscricao INNER JOIN utilizador on utilizador.id=inscricao.idutilizador
                INNER JOIN turma on turma.idturma = inscricao.idturma
                  WHERE turma.idcurso ='.$idcurso;
    }

    function sql_update_user(){
        return "UPDATE utilizador SET username = ?, password = ?,
  fullname = ?, previlegio =?, descricao = ?
WHERE iduser = ? ";
    }

    function sql_update_pagamento(){
        return "UPDATE inscricao SET prestacao = prestacao + ?
WHERE idformando = ?";
    }

    function insert_encarregado(){
        return "INSERT INTO `encarregado_educacao`(`idlocaltrabalho`, `idpessoa`, `nrdocumento`,
                                                  `nivel_escolar`, `contacto`, `idade`, `parentesco`, `nomeCompleto`)
                                                  VALUES (?,?,?,?,?,?,?,?)";
    }
}