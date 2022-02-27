<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Randonnées, ajout</title>
</head>
<body>
    <form action="">
        <input type="text" name="name" placeholder="Nom de la randonnée">
        <select name="difficulty" id="difficulty">
            <option value="très facile">Très facile</option>
            <option value="facile">Facile</option>
            <option value="moyen">Moyen</option>
            <option value="difficile">Difficile</option>
            <option value="très difficile">Très difficile</option>
        </select>
        <input type="number" name="distance">
        <!-- Ajoutez un / des champs pour gérer la donnée de type time à insérer via PHP -->
        <input type="time" name="duration" id="time-id" onfocus="this.value">
        <input type="number" name="height_difference" onfocus="this.value">
        <input type="submit" value="send" name="submit">
        <input type="number" name="height_difference">
    </form>
</body>
</html>

<?php

require __DIR__ . '/class/Database.php';
require __DIR__ . '/functions/functions.php';


$pdo = new Database();
$start = $pdo->getInstance();

if (!empty($_POST['submit'])){
    if(isset($_POST['name'], $_POST['difficulty'], $_POST['distance'], $_POST['duration'] , $_POST['height_difference'])){
        $name = cleanData($_POST['name']);
        $difficulty = cleanData( $_POST['difficulty']);
        $distance = cleanData($_POST['distance']);
        $duration = cleanData($_POST['duration']);
        $height_difference = cleanData($_POST['height_difference']);

        $stmt = $start->prepare("INSERT INTO hiking (name, difficulty, distance, duration, height_difference)
                                           VALUES (:name, :difficulty, :distance, :duration, :height_difference)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':difficulty', $difficulty);
        $stmt->bindParam(':distance', $distance);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':height_difference', $height_difference);

        if($stmt->execute()){
            echo "<div>Votre randonnée => <strong>$name</strong> , ajouté avec succès !"
                ."<p>". "Difficulté : $difficulty" ."</p>"
                ."<p>". "Distance en km: $distance" ."</p>"
                ."<p>". "Temps en heures: $duration" ."</p>"
                ."<p>". "Alltitude en mètres: $height_difference" ."</p>"
                ."</div>";
        }
    }
}