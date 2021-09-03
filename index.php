<?php

use App\Entity\Vaga;

require __DIR__ . "/vendor/autoload.php";

$vaga = Vaga::getVagas();
echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;



require __DIR__ . "/includes/header.php";
require __DIR__ . "/includes/listagem.php";
require __DIR__ . "/includes/footer.php";
