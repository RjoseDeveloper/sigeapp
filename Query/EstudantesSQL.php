
<?php
/**
 * Created by PhpStorm.
 * User: Raimundo Jose
 * Date: 2/26/2018
 * Time: 10:43 PM
 */

class EstudantesSQL
{

    public function obter_id_estudante($fullname)
    {
        return 'SELECT idEstudante  FROM estudante INNER JOIN utilizador
ON utilizador.id=estudante.idUtilizador
WHERE utilizador.username =' . $fullname;
    }

    public function obterEstudantesDisciplina($disp, $curso)
    {

        return (

        "SELECT DISTINCT aluno.nr_mec as numero,aluno.idaluno as idEstudante, utilizador.nomeCompleto
FROM aluno
  INNER JOIN utilizador ON utilizador.id = aluno.idutilizador
  INNER JOIN inscricao ON utilizador.id = inscricao.idutilizador
  INNER JOIN turma ON turma.idturma = inscricao.idturma
WHERE turma.idcurso = '$curso' AND inscricao.iddisciplina= '$disp'
ORDER BY utilizador.nomeCompleto ASC ");
    }


    /*-----------Retorna o identificador do estudante apartir do nome e apelido recebido -------------*/

    public function getIdEstByNameApelido($fullname, $ctr)
    {
        $db = new mySQLConnection();

        $result = mysqli_query($db->openConection(),
            "SELECT aluno.idaluno as idEstudante FROM aluno INNER JOIN utilizador
            ON utilizador.id = aluno.idutilizador
              WHERE utilizador.nomeCompleto ='$fullname'");
        if ($row = mysqli_fetch_assoc($result)) {
            return $row['idEstudante'];
        }
    }

    /**-----------Retorna a lista de tipos de avaliacao e suas respectivas quantidades--------------*/

    public function obterQtdAvaliacao($disciplina, $curso, $estado)
    {
        $db = new mySQLConnection();

        $query = "SELECT  pautanormal.dataPub, pautanormal.idPautaNormal, data_avaliacao.id_data as tipo, data_avaliacao.descricaoteste as descricao
FROM pautanormal INNER JOIN data_avaliacao ON data_avaliacao.id_data = pautanormal.idTipoAvaliacao
    INNER JOIN  disciplina ON disciplina.idDisciplina = pautanormal.idDisciplina
WHERE disciplina.idDisciplina = '$disciplina' AND pautanormal.idcurso = '$curso' AND pautanormal.estado='$estado'
GROUP BY tipo, pautanormal.idPautaNormal;";

        $vetor [] = null;
        $result = mysqli_query($db->openConection(), $query);
        // echo $query;
        while ($row = mysqli_fetch_assoc($result)) {
            $vetor[] = array('tipo' => $row['tipo'],
                'descricao' => $row['descricao'],
                'idptn' => $row['idPautaNormal'],
                'datapub' => $row['dataPub']);
        }
        return ($vetor);
        $db->closeDatabase();
    }

    /*----------- permite obter a nota de um estudante apartir do idNota -------------------*/
    public function getEstNota($idNota)
    {
        $db = new mySQLConnection();

        $query = "SELECT estudante_nota.nota FROM estudante_nota
					WHERE estudante_nota.idNota = '$idNota';";
        $result = mysqli_query($db->openConection(), $query);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row['nota'];
        } else {
            return 0;
        }
    }

    function obter_ano_ingresso($username)
    {
        $db = new mySQLConnection();
        $query = mysqli_query($db->openConection(),
            "SELECT YEAR(utilizador.data_ingresso) as data_r FROM utilizador WHERE
utilizador.username = '$username'");
        if ($row = mysqli_fetch_assoc($query)) {
            return $row['data_r'];
        }
    }

    ///---------------------------------------------------------------------------------

    public function estudanteDisciplina($estudante, $discplina, $ctr, $semestre, $ano)
    {

        $db = new mySQLConnection();

        $query = "SELECT DISTINCT disciplina.descricao, disciplina.idDisciplina,
curso.descricao as curso, curso.idcurso
FROM disciplina INNER JOIN inscricao  ON disciplina.idDisciplina = inscricao.iddisciplina
  INNER JOIN turma ON turma.idturma = inscricao.idturma
  INNER JOIN curso ON curso.idcurso = turma.idcurso
WHERE inscricao.idutilizador = '$estudante' AND year(inscricao.data_registo) = '$ano'";

        if ($ctr == 0) {
            $query = $query . "ORDER BY disciplina.descricao ASC";

        } else {
            $query = $query . "AND disciplina.descricao LIKE '$discplina' ORDER BY disciplina.descricao ASC";
            return ($query);
        }

        $result = mysqli_query($db->openConection(), $query);
        while ($row[] = mysqli_fetch_assoc($result)) {
            ;
        }
        return ($row);

    }


    public function return_mes()
    {
        if (date('m') == 1) {
            return 'Janeiro';
        }
        if (date('m') == 2) {
            return 'Fevereiro';
        }
        if (date('m') == 3) {
            return 'Março';
        }
        if (date('m') == 4) {
            return 'Abril';
        }
        if (date('m') == 5) {
            return 'Maio';
        }
        if (date('m') == 6) {
            return 'Junho';
        }
        if (date('m') == 7) {
            return 'Julho';
        }
        if (date('m') == 8) {
            return 'Agosto';
        }
        if (date('m') == 9) {
            return 'Setembro';
        }
        if (date('m') == 10) {
            return 'Outubro';
        }
        if (date('m') == 11) {
            return 'Novembro';
        }
        if (date('m') == 12) {
            return 'Dezembro';
        }
    }


    public function returnMediaEstudante($idEst, $disp, $curso)
    {
        $q = "SELECT  DISTINCT AVG(estudante_nota.nota) as media, estudante_nota.idaluno from estudante_nota

                        INNER JOIN pautanormal on pautanormal.idPautaNormal = estudante_nota.idPautaNormal
                        INNER JOIN disciplina ON disciplina.idDisciplina = pautanormal.idDisciplina
                        INNER JOIN inscricao ON disciplina.idDisciplina = inscricao.iddisciplina
                        INNER JOIN turma ON turma.idturma = inscricao.idturma
                        INNER JOIN data_avaliacao ON data_avaliacao.id_data = pautanormal.idTipoAvaliacao

                        WHERE disciplina.idDisciplina = '$disp' AND
estudante_nota.idaluno = '$idEst' AND pautanormal.idcurso= '$curso' AND data_avaliacao.id_data < 4
GROUP BY estudante_nota.idaluno";

        $db = new mySQLConnection();

        $result = mysqli_query($db->openConection(), $q);
        if ($row = mysqli_fetch_assoc($result)) {
            return ($row['media']);
        }

    }

}