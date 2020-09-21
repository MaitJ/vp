<?php
 
  $username = "Mait Jurask";
  $fullTimeNow = date("H:i:s");
  $hourNow = date("H");
  $partofday = "lihtsalt aeg";

  $database = "if20_mait_ju_1";
 
  require("../../../config.php");
  //Loen andmebaasist filme
 

  $filmhtml = "";
  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);	
  //$stmt = $conn->prepare("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");

  $stmt = $conn->prepare("SELECT * FROM film");
  $stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
  $stmt->execute();
  $filmhtml = "<ol> \n";
  while ($stmt->fetch()) {
	$filmhtml .= "\t\t<li>" . $titlefromdb . "\n";
	$filmhtml .= "\t\t\t<ul> \n";
	$filmhtml .= "\t\t\t\t<li>" . $yearfromdb . "</li> \n";
	$filmhtml .= "\t\t\t\t<li>" . $genrefromdb. "</li> \n";
	$filmhtml .= "\t\t\t\t<li>" . $studiofromdb. "</li> \n";
	$filmhtml .= "\t\t\t\t<li>" . $directorfromdb. "</li> \n";
	$filmhtml .= "\t\t\t</ul> \n";
	$filmhtml .= "\t\t</li> \n";
  }
  $filmhtml .= "\t </ol> \n";
  $stmt->close();
  $conn->close();


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
    <nav id="navBar">
      <a href="home.php">Avaleht</a>
      <a href="m6tetesisend.php">M6tete sisend</a>
      <a href="m6tted.php">M6tted</a>
      <a href="listfilms.php">Filmide nimekiri</a>
    </nav>
    <div id="content">
	<?php echo $filmhtml;?>
    </div>
    <footer>
      <h4>See veebileht on tehtud Mait Jurask'i poolt.</h4>
      <h4><?php echo "Parajasti on " .$partofday ."." ?></h4>
    </footer>
 </div>
</body>
</html>
