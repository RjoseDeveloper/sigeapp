<?php
/**
 * Created by PhpStorm.
 * User: Raimundo Jose
 * Date: 12/23/2018
 * Time: 3:22 PM
 */

class ContabilidadeSQL
{

    function buscar_pagamentos($fullname, $nmerc)
    {
        $sql = "";

        if (!isset($fullname) or !isset($nmerc)) {

            $sql = "";

        } else {
            //$sql.="WHERE utilizador.nomeCompleto like="'$fullna'" OR estudante.nr_mec =";
        }
        return $sql;
    }

    function somar_pagamento(){
        return ('SELECT SUM(prestacao.valor) as valor, prestacao.`status`, prestacao.user_session_id,  
                utilizador.id, utilizador.codigo, utilizador.fullname, utilizador.celular1 as celular, 
                utilizador.email
		
                FROM prestacao, utilizador, actividade
                WHERE utilizador.id = prestacao.iduser
        
                GROUP BY utilizador.fullname, prestacao.`status`,  prestacao.user_session_id, utilizador.id');
    }

    public function all_paymantes($ctr, $idaluno)
    {
       $sql ='SELECT DISTINCT utilizador.id, prestacao.valor, prestacao.datapay, 
                prestacao.modepay, juro.juro, actividade.descricao, actividade.taxa,
                      utilizador.fullname, 
                utilizador.celular1 as celular,prestacao.status,
                   utilizador.email, utilizador.id, utilizador.codigo
                FROM prestacao INNER JOIN juro ON juro.idjuro = prestacao.idjuro
                                INNER JOIN actividade on actividade.idactividade = prestacao.idactividade
                                INNER JOIN utilizador ON utilizador.id = prestacao.iduser';

        if ($ctr != 'all'){
            $sql.= ' where utilizador.id='.$idaluno;
        }

        return $sql;
    }

    public function consult_actividade ($curso){

        return "SELECT DATEDIFF(actividade.data_inicio,actividade.data_fim) as periodo from actividade
INNER JOIN curso ON curso.idcurso = actividade.idcurso WHERE curso.idcurso = '$curso'
ORDER BY actividade.idactividade DESC LIMIT 1";

    }
}




