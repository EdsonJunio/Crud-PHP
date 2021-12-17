<?php

namespace App\Db;


use \PDO;
use PDOException;

class Database
{


    /**===
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = ''; //xxxxxx



    /**
     * Nome do banco de dados
     * @var string
     */

    const NAME = 'crudphp';



    /**
     * Usuário do banco
     * @var string
     */
    const USER = 'root';



    /**
     * Senha de acesso ao banco de dados
     * @var string
     */
    const PASS = ''; //xxxxx


    /**
     * Nome da tabela a ser manipulada
     * @var string
     */
    private $table;


    /**
     * Intancia de conexão com o banco de dados
     * @var PDO
     */

    private $connection;


    /**
     * Define a tabela e instancia a conexão
     * @param string
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }


    /**
     * método responsável por criar um conexão com o banco de dados
     * @var PDO
     */
    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERRO: ' . $e->getMessage()); // nunca faça isso em produção
        }
    }


    /**
     * Método responsável por insertit dados no banco
     *@param string
     *@param array
     *@return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            $statemat = $this->connection->prepare($query);
            $statemat->execute($params);
            return $statemat;
        } catch (PDOException $e) {
            die('ERRO: ' . $e->getMessage()); // nunca faça isso em produção
        }
    }


    /**
     * Método responsável por insertit dados no banco
     *@param  [array] $value  [field => value]
     *@return integer
     */
    public function insert($values)
    { // DADOS DA QUERY

        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        // MONTA A QUERY
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        $this->execute($query, array_values($values));
        return $this->connection->lastInsertId();
    }
    /**
     *Método responsável por executar uma consulta no banco
     *
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        //Dados da query
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY' . $order : '';
        $limit = strlen($limit) ? 'WHERE' . $limit : '';


        //Monta a query
        $query = 'SELECT  ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        //Exercutar a query
        return $this->execute($query);
    }

    /**
     * Método responsável por  executar atualizações no banco de dados
     *
     * @param string $where
     * @param  array $values [field => value]
     * @return boolean
     */
    public function update($where, $values)
    {
        //Dados da query
        $fields = array_keys($values);


        //Monta query
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;


        //Executar a query
        $this->execute($query, array_values($values));
        return true;
    }
}
