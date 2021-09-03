<?php

namespace  App\Entity;

use App\Db\Database;

class Vaga
{

    /**
     * Identificador único da vaga
     *@var integer
     */

    public $id;

    /**
     * Título da vaga
     *@var string
     */

    public $titulo;

    /**
     * Descrição da vaga (pode conter html)
     *@var string
     */

    public $descricao;

    /**
     * Define se a vaga está ativa
     *@var string(s/n)
     */

    public $ativo;


    /**
     * Data de publicação da vaga
     *@var string
     */

    public $data;


    /**
     * método responsavel por cadastrar uma nova vaga no banco
     *
     * @return boolean
     */
    public function cadastrar()
    {
        // DEFINIR A DATA

        $this->data = date('y-m-d H:i:s');

        // INSERIR A VAGA NO BANCO

        $obDatabase = new Database('vagas');
        $this->id = $obDatabase->insert([
            'titulo'    => $this->titulo,
            'descricao' => $this->descricao,
            'ativo'     => $this->ativo,
            'data'      => $this->data
        ]);

        echo "<pre>";
        print_r($this);
        echo "</pre>";

        // RETORNAR SUCESSO

        return true;
    }
     /**
      * Método responsável por obter as vagas do banco de dados
      *
      * @param string $where
      * @param string $order
      * @param string $limit
      * @return array
      */
    public static function getVagas($where = null, $order = null, $limit = null)
    {
      return (new Database('vagas'))->select($where,$order,$limit);
    }
}
