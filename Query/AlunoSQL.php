<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/5/2018
 * Time: 7:23 AM
 */

class AlunoSQL {


    function get_all_pessoa($ctr, $iduser){

        $sql ='SELECT DISTINCT * from utilizador INNER JOIN distrito ON distrito.iddistrito = utilizador.iddistrito WHERE utilizador.idprevilegio = 1' ;

        if ($ctr != 0){$sql.=" AND utilizador.id ='$iduser' OR utilizador.username='$iduser'"; }
        return $sql;
    }

    public function list_emcarregado($id){

        return "SELECT * FROM encarregado_educacao INNER JOIN localtrabalho
ON localtrabalho.idlocaltrabalho = encarregado_educacao.idlocaltrabalho INNER JOIN nivelescolar
ON nivelescolar.idnivel = encarregado_educacao.nivel_escolar
WHERE encarregado_educacao.idpessoa = '$id'";

    }


    function get_disciplina_aluno($iduser){

        $sql ="SELECT DISTINCT disciplina.codigo,inscricao.data_registo, inscricao.status, disciplina.creditos, disciplina.natureza, disciplina.idDisciplina, disciplina.descricao
                 from disciplina INNER JOIN inscricao ON inscricao.iddisciplina = disciplina.idDisciplina
                  INNER JOIN utilizador ON utilizador.id = inscricao.idutilizador
                WHERE utilizador.username='$iduser'";
        return $sql;
    }

}