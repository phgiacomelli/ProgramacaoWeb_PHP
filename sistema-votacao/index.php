<?php
require_once __DIR__ . "/vendor/autoload.php";

$votos = Voto::findall();
$times = Time::findall();

$resultados = [];

foreach ($times as $time) {
    $resultados[] = array("time"=>$time,"votos"=>Voto::findallByTime($time->getIdTime()));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de usuário</title>
</head>

<body>
    <div class="count-results">
        <?php

        foreach ($resultados as $result) {
            // var_dump($results['votos']);
            $content = "<div class='team-stats'><p>";
            $content.="{$result['time']->getNome()} : ".number_format((count($result['votos']) / count($votos))*100,2)."%";

            $content.="</p></div>";

            echo $content;
        }
        ?>
        
    </div>
    <a href='login.php'>Login</a>
</body>

</html>