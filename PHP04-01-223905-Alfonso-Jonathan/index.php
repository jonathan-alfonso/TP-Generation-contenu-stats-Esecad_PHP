<?php
    require('stat.php');

    $pupil_data = array(
        'name' => '',
        'school' => 1
    );
    $pupil = new Pupil($pupil_data);
    $db = new PDO('mysql:host=localhost; dbname=php04-01-223905', 'root', '');
    $manager = new pupilManager($db);
    $pupil_id = $manager->addPupil($pupil);

    $rand = rand(0, 3);
    for ($i = 0; $i < $rand; $i++) {
        $sport_data = array('pupil_id' => (int) $pupil_id);
        $sport = new Sport($sport_data);
        $manager = new sportManager($db);
        $manager->addSport($sport);
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>PHP Expert 1</title>
    </head>
    <body>
        <h1>Statistiques</h1>

        <h2>Liste des écoles</h2>
        <?php $manager = new pupilManager($db); ?>
        <?php $manager->getPupilBySchool(); ?>

        <h2>Élèves pratiquant au moins un sport</h2>
        <?php $sportManager = new sportManager($db); ?>
        <?php $sportManager->atLeastOneSport(); ?>

        <h2>Nombre d'activités sportives pratiquées</h2>
        <?php $sportManager->numbersSports(); ?>
        
        <h2>Liste des activités sportives pratiquées classées par ordre croissant en fonction du nombre d'élèves</h2>
        <?php $sportManager->eachSportList(); ?>
    </body>
</html>