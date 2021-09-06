<?php

use App\Entity\Vaga;

require __DIR__ . "/vendor/autoload.php";

$vagas = Vaga::getVagas();




require __DIR__ . "/includes/header.php";
require __DIR__ . "/includes/listagem.php";
require __DIR__ . "/includes/footer.php";
