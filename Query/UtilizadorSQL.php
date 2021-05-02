<?php
/**
 * Created by PhpStorm.
 * User: Raimundo Jose
 * Date: 6/6/2018
 * Time: 9:07 PM
 */

class UtilizadorSQL {

    public function insert(){
        return 'INSERT INTO `utilizador` (`idsexo`, `username`, `password`, `data_ingresso`, `idprevilegio`, `fullname`)
               VALUES (?,?,?,now(),?,?)';
    }

    public function list_utilizador(){
    return 'DISTINCT(utilizador.id), utilizador.username, utilizador.password, utilizador.fullname,previlegio.idprevilegio,utilizador.celular1,
                utilizador.email, utilizador.sexo, previlegio.descricao,utilizador.data_added, utilizador.estadocivil
                FROM utilizador inner join  previlegio on utilizador.idprevilegio = previlegio.idprevilegio';
}

}