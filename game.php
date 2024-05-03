<?php

include_once "Human.php";
include_once "Orc.php";
include_once 'Data_Manager.php';
include "Ring.php";
include "MyClass.php";

 
$info = "";
$end  = false;

if(isset($_POST['btnStart'])) {

     print_r("Ring Name: ".$_POST['p1_ring']);
     print_r("Ring Name 2: ".$_POST['p2_ring']);

    $p1_ring = new Ring($_POST['p1_ring']);
    $p2_ring = new Ring($_POST['p2_ring']);

    var_dump($p1_ring);
    var_dump($p2_ring);

    switch($_POST['p1_race']) {
        case 'human' : $p1 = new Human($_POST['p1_name'], $p1_ring); break;
        case 'orc' : $p1 = new Orc($_POST['p1_name'], $p1_ring); break;
    }

    switch($_POST['p2_race']) {
        case 'human' : $p2 = new Human($_POST['p2_name'], $p2_ring); break;
        case 'orc' : $p2 = new Orc($_POST['p2_name'], $p2_ring); break;
    }


   $round = rand(1, 2);

} else {

    $p1 = Data_Manager::loadPlayer(1);
    $p2 = Data_Manager::loadPlayer(2);

    if(isset($_POST['p1_attack'])) {

        $info .= "$p1->name greift $p2->name an <br />";

        $attack_value = $p1->getAttackValue();
        $info .= $p2->attack($attack_value);
        $round = 2;

    }

    if(isset($_POST['p2_attack'])) {

        $info .= "$p2->name greift $p1->name an <br />";
        
        $attack_value = $p2->getAttackValue();
        $info .= $p1->attack($attack_value);
        $round = 1;
    }

}

if($p1->getHealth() < 0) {
    $info = "$p2->name hat gewonnen";
    $end = true;
}

if($p2->getHealth() < 0) {
    $info = "$p1->name hat gewonnen";
    $end = true;
}



Data_Manager::savePlayer(1, $p1);
Data_Manager::savePlayer(2, $p2);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1><?php echo $p1->name; ?></h1>
Rasse: <?php echo get_class($p1); ?><br />
Gesundheit: <?php echo $p1->getHealth(); ?><br />
Stärke: <?php echo $p1->getStrength(); ?><br />
Ring: <?php echo $p1_ring->toString() ?><br />

<form action="game.php" method="post">
    <input type="submit" name="p1_attack" value="Angriff" <?php if($end || ($round == 2)) echo "disabled" ?>  >
</form>

<h1><?php echo $p2->name ?></h1>

Rasse: <?php echo get_class($p2); ?><br />
Gesundheit: <?php echo $p2->getHealth(); ?><br />
Stärke: <?php echo $p2->getStrength(); ?><br />
Ring: <?php echo $p2_ring->toString() ?><br />
    
<form action="game.php" method="post">
    <input type="submit" name="p2_attack" value="Angriff" <?php if($end || ($round == 1)) echo "disabled" ?> >
</form>

<p>
    <?php echo $info;
    
    if($end) {
        echo '
        
            <form action="index.html" method="get">
                <input type="submit" value="Neues Spiel">
            </form>
        
        ';
    }
    
    ?>




</p>

</body>
</html>