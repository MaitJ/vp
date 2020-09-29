<?php
 
  $username = "Mait Jurask";
  $fullTimeNow = date("H:i:s");
  $hourNow = date("H");
  $partofday = "lihtsalt aeg";

  $database = "if20_mait_ju_1";
 
  require("../../../config.php");

  //Errori valued
  $firstnameerror = "";
  $lastnameerror = "";
  $emailerror = "";
  $passworderror ="";
  $gendererror = "";
  $passwordsecondaryerror = "";

  //Salvestatud valued
  $firstnamevalue = "";
  $lastnamevalue = "";
  $emailvalue= "";
  $gender = "";
  $kontroll = "";

  if (isset($_POST["registersubmit"]) and !empty($_POST["registersubmit"])){
    $kontroll = "J6udsin siia";

    if (!empty($_POST["firstnameinput"])) {
      $firstnamevalue = $_POST["firstnameinput"];
    }
    else {
      $firstnameerror = "Sisesta eesnimi!";
    }

    if (!empty($_POST["lastnameinput"])) {
      $lastnamevalue = $_POST["lastnameinput"];
    }
    else {
      $lastnameerror = "Sisesta perekonnanimi!";
    }

    if (isset($_POST["genderinput"])) {
      $gender = $_POST["genderinput"];
    }
    else {
      $gendererror = "Sisesta sugu!";
    }

    if (!empty($_POST["emailinput"])) {
      $emailvalue = $_POST["emailinput"];
    }
    else {
      $emailerror = "Sisesta email!";
    }

    if (strlen($_POST["passwordinput"]) < 8) {
      $passworderror = "Parool on liiga lyhike (v2hemalt 8 t2hem2rki";
    }
    else if (empty($_POST["passwordinput"])) {
      $passworderror = "Sisesta parool!";
    }

    if ($_POST["passwordinput"] != $_POST["passwordsecondaryinput"]) {
      $passwordsecondaryerror = "Sisesta sama parool!";
    }
    else if (empty($_POST["passwordsecondaryinput"])) {
      $passwordsecondaryerror = "Sisesta parool!";
    }
  }





  $weekdayNamesET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];

  $weekdaynow = date("N");
  $monthnow = date("n");


  //vaatame semestri kulgemist
  $semesterStart = new DateTime("2020-08-31");
  $semesterEnd = new DateTime("2020-12-13");
  $today = new DateTime("now");

  $semesterStartToToday = $semesterStart->diff($today);
  $toSemesterEnd = $today->diff($semesterEnd);
  $semesterDuration = $semesterStart->diff($semesterEnd);

  // Alati formati vahe 2ra, muidu ei teki numbri tyypi, millega v6rrelda
  $semesterStartDays = $semesterStartToToday->format("%r%a");
  $semesterDurationDays = $semesterDuration->format("%r%a");
  $daysToSemesterEnd = $toSemesterEnd->format("%r%a");


  if ($hourNow < 7) {
    $partofday = "uneaeg";
  }

  if ($hourNow >= 8 && $hourNow < 18) {
    $partofday = "akadeemilise aktiivsuse aeg";
  }

  $semestriMessage = 0;

  if ($semesterStartDays < 0) {
      $semestriMessage =  "Semester pole veel alanud";
  } else if ($semesterStartDays <= $semesterDurationDays) {
      $percentToEnd = ($semesterStartDays * 100) / $semesterDurationDays;
      $semestriMessage = "Semestri l6puni on: " . $daysToSemesterEnd . " p2eva " . " 6ppet88st on tehtud: " . round($percentToEnd, 1) . "%";
  } else {
      $semestriMessage =  "Semester on l6ppenud";
  }
  

  // selgitage välja nende vahe ehk erinevus
  // $semesterDuration = $semesterStart->diff($semesterEnd);

  // leiame selle p2evade arvu
  // $semesterDurationDays = $semesterDuration->format("%r%a");

  
  // if ($fromsemesterstartdays < 0) { semester ple alanud }
  // if ($semesterstartdays >= $semesterDurationDays)
  // mitu % õppetööst on tehtud



 require("header.php");
 ?>

  <div id="contentLocker">
    <header>
      <h1 id="mainHeader">Gheto Kalawiki</h1>
      <h3 id="mainHeader">See leht on veebiprogemise kursuse alusel tehtud, midagi t2htsat siin ei ole</h3>
      <h3 id="mainHeader">Lehe avamisel oli hetkel kell: <?php echo $weekdayNamesET[$weekdaynow - 1]. " " . date("j") . ". " . $monthNamesET[$monthnow - 1] . " " . $fullTimeNow?></h3>
      <h4 id="mainHeader"><?php echo $semestriMessage?></h3>
      <img src="img/vp_banner.png" alt="Veebiprogrammeerimise logo">
    </header>
    <?php require('navbar.php'); ?>
    <div id="content">
      <p><?php echo $kontroll; ?></p>
      <form method="POST" id="registerform">
        <label for="fistnameinput">Eesnimi</label>
        <input type="text" name="firstnameinput" id="firstnameinput" placeholder="Eesnimi" value="<?php echo $firstnamevalue;?>"><span><?php echo $firstnameerror; ?></span>
        <label for="lastnameinput">Perekonnanimi</label>
        <input type="text" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi" value="<?php echo $lastnamevalue;?>"><span><?php echo $lastnameerror; ?></span>
        <label for="genderinput">Sugu</label>
        <input type="radio" name="genderinput" id="gendermale" value="1" <?php if($gender == "1") {echo " checked";}?>><label for="gendermale">Mees</label>
        <input type="radio" name="genderinput" id="genderfemale" value="2" <?php if($gender == "2") {echo " checked";}?> ><label for="genderfemale">Naine</label>
        <span><?php echo $gendererror;?></span>
        <label for="emailinput">Email</label>
        <input type="email" name="emailinput" id="emailinput" placeholder="Email" value="<?php echo $emailvalue;?>"><span><?php echo $emailerror;?></span>
        <label for="passwordinput">Password</label>
        <input type="password" name="passwordinput" id="passwordinput"><span><?php echo $passworderror;?></span>
        <label for="passwordsecondaryinput">Enter your password again</label>
        <input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput"><span><?php echo $passwordsecondaryerror;?></span>
        <br>
        <input type="submit" name="registersubmit" value="Registreeri">
      </form>
    </div>
    <footer>
      <h4>See veebileht on tehtud Mait Jurask'i poolt.</h4>
      <h4><?php echo "Parajasti on " .$partofday ."." ?></h4>
    </footer>
 </div>
</body>
</html>
