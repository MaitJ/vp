<?php

$database = "if20_mait_ju_1";

function readpersonoptionshtml($selected) {
    $result = "<p>Kahjuks ei eksisteeri inimesi andmebaasis.</p>";
    $personoptionhtml = "";
    $result = "";

    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);	
    $stmt = $conn->prepare("SELECT person_id, first_name, last_name FROM person");
    echo $conn->error;
    $stmt->bind_result($personidfromdb, $firstnamefromdb, $lastnamefromdb);
    $stmt->execute();

    while ($stmt->fetch()) {
        $personoptionhtml .= '<option value"' .$personidfromdb .'"';
        if ($personidfromdb == $selected) {
            $personoptionhtml .= " selected";
        }
        $personoptionhtml .= ">" .$firstnamefromdb . " " .$lastnamefromdb . "</option> \n";
    }

    if (!empty($personoptionhtml)) {
        $result = '<option value="" disabled selected>Vali inimene</option>' . "\n";
        $result .= $personoptionhtml;
    }
    $stmt->close();
    $conn->close();
    return $result;
}

function readfilmoptionshtml($selected) {
    $result = "<p>Kahjuks ei eksisteeri filme andmebaasis.</p>";
    $filmoptionhtml = "";
    $result = "";

    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);	
    $stmt = $conn->prepare("SELECT movie_id, title FROM movie");
    echo $conn->error;
    $stmt->bind_result($movieidfromdb, $movietitlefromdb);
    $stmt->execute();

    while ($stmt->fetch()) {
        $filmoptionhtml .= '<option value="' .$movieidfromdb .'"';
        if ($movieidfromdb == $selected) {
            $filmoptionhtml .= " selected";
        }
        $filmoptionhtml .= ">" .$movietitlefromdb . "</option> \n";
    }
    
    if (!empty($filmoptionhtml)) {
        $result = '<option value="" disabled selected>Vali film</option>' . "\n";
        $result .= $filmoptionhtml;
    }

    $stmt->close();
    $conn->close();
    return $result;
}

function readpositionoptionshtml($selected) {
    $result = "<p>Kahjuks ei eksisteeri positsioone andmebaasis.</p>";
    $positionhtml = "";
    $result = "";

    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);	
    $stmt = $conn->prepare("SELECT position_id, position_name FROM position");
    echo $conn->error;
    $stmt->bind_result($positionidfromdb, $positionnamefromdb);
    $stmt->execute();

    while ($stmt->fetch()) {
        $positionhtml .= '<option value="' .$positionidfromdb .'"';
        if ($positionidfromdb == $selected) {
            $positionhtml .= " selected";
        }
        $positionhtml .= ">" .$positionnamefromdb . "</option>\n";
    }

    if (!empty($positionhtml)) {
        $result = '<option value="" disabled selected>Vali positsioon</option>' . "\n";
        $result .= $positionhtml;
    }
    $stmt->close();
    $conn->close();
    return $result;

}

function storenewrelation($personid, $movieid, $positionid, $role) {
    $result = "";
    
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);	
    $stmt = $conn->prepare("SELECT person_in_movie_id FROM person_in_movie WHERE person_id = ?, movie_id = ?, position_id = ?, role = ?");
    echo $stmt->error;
    $stmt->bind_param("iiis", $personid, $movieid, $positionid, $role);
    $stmt->bind_result($idfromdb);
    $stmt->execute();

    if ($stmt->fetch()) {
        $result = "Kirje on olemas";
    }
    else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO person_in_movie (person_id, movie_id, position_id, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $personid, $movieid, $positionid, $role);
        if ($stmt->execute()) {
            $result = "Kirje edukalt loodud";
        }
        else {
            $result = "Kirjet ei suudetud luua, Error: " . $stmt->error;
        }
    }
    
    $stmt->close();
    $conn->close();
    return $result;
}