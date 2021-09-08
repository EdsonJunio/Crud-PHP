<?php

require __DIR__ . "/vendor/autoload.php";

define('TITLE', 'Editar vaga');

use \App\Entity\Vaga;



// Validação do id
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;

}


// Consulta vaga
$obVaga = Vaga::getVaga($_GET['id']);

//Validação da vaga
if (!$obVaga instanceof Vaga) {
    header('location: index.php?status=error');
    exit;
}





// VALIDAÇÃO DO POST
if (isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])) {

    $obVaga = new Vaga;
    $obVaga->titulo = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo = $_POST['ativo'];
    $obVaga->atualizar();

    //echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;

    header('location: index.php?status=success');
    exit;
}

require __DIR__ . "/includes/header.php";//
require __DIR__ . "/includes/formulario.php";
require __DIR__ . "/includes/footer.php";
