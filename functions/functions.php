<?php

function readData($db){
    $stmt = $db->prepare("SELECT * FROM hiking");
    if ($stmt->execute()){
        foreach ($stmt->fetchAll() as $customer){
            echo "<div>"
                ."<p>". "Nom de la randonnée : " . $customer['name'] ."</p>"
                ."<p>". "Difficulté : ". $customer['difficulty'] ."</p>"
                ."<p>". "Distance en km : " . $customer['distance'] ."</p>"
                ."<p>". "Durée du parcours en H: " . $customer['duration'] ."</p>"
                ."<p>". "Altitude en mètres : " . $customer['height_difference'] ."</p>"
                ."<p>". "<a href='/update.php'>Modifie</a>"."</p>"
                ."</div><br><hr><br>";
        }
    }
}

function createHiking($name, $difficulty, $distance, $duration, $height_difference, $db){
    $sql = "INSERT INTO hiking (name, difficulty, distance, duration, height_difference)
            VALUES ('$name', '$difficulty', $distance, '$duration', $height_difference)";

    $db->exec($sql);
    echo 'You have create a new rando with success !';
}

function cleanData ($data) : string{
    $data = trim(stripslashes($data));
    return htmlspecialchars($data);
}