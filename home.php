<?php 
  $username = "Mait Jurask";

  $webNameArray = array(
    0 => "Gheto",
    1 => "Trash",
    2 => "Mediocre"
  );

  $fullTimeNow = date("H:i:s");
  $hourNow = date("H");
  $partofday = "lihtsalt aeg";

  $haugiPildiArray = array(
    0 => "pics/haug.jpeg",
    1 => "pics/haug2.jpg"
  );

  if ($hourNow < 7) {
    $partofday = "uneaeg";
  }

  if ($hourNow >= 8 && $hourNow < 18) {
    $partofday = "akadeemilise aktiivsuse aeg";
  }

  $haugiPilt = 0

  //vaatame semestri kulgemist
  $semesterStart = new DateTime("2020-9-31");
  $semesterEnd = new DateTime("2020-12-13");

  //selgitage välja nende vahe ehk erinevus
  $semesterDuration = $semesterStart->diff($semesterEnd);

  //leiame selle p2evade arvu
  $semesterDurationDays = $semesterDuration->format("%r%a");

  //T2nane p2ev
  $today = new DateTime("now");
  // if ($fromsemesterstartdays < 0) { semester ple alanud }
  // if ($semesterstartdays >= $semesterDurationDays)
  // mitu % õppetööst on tehtud

?>


<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title><?php echo $username;?> veebileht</title>

</head>
<body>
  <div id="contentLocker">
    <header>
      <h1 id="mainHeader"><?php echo $webNameArray[rand(0, 2)] ?> Kalawiki</h1>
      <h3 id="mainHeader">See leht on veebiprogemise kursuse alusel tehtud, midagi t2htsat siin ei ole</h3>
      <h3 id="mainHeader">Lehe avamisel oli hetkel kell: <?php echo $fullTimeNow?></h3>
    </header>
    <nav id="navBar">
      <a href="home.php">Haug</a>
      <a href="forell.html">Forell</a>
    </nav>
    <div id="content">
      <h2>Haugi poiss</h2>
      <img src="<?php echo $haugiPildiArray[$haugiPilt]?>">
      <p>Haug ehk harilik haug ehk havi (Esox lucius) on hauglaste sugukonda haugi perekonda kuuluv röövkala.

        Haug elab Euraasia ja Põhja-Ameerika põhjaosa sisevetes. Ta on üks kõige laiemalt levinud mageveekala. Venemaal puudub ta vaid Amuuri jõgikonnas, kus elab amuuri haug. Ukrainas puudub haug ainult Krimmis.[1]
        
        Haugil on nooljas keha, mis on natuke külgedel lamenenud. Seljauim on keha tagaosas, suurendades saba tõukepinda. See võimaldab välkkiireid kohaltsööste saagi haaramiseks. Suhteliselt suurel peal on pardi nokka meenutav suu, millel on tahapoole kaldu olevad hambad. Haugi värvus sõltub keskkonnast, keha on selja pealt tavaliselt rohekas-sinakas, mis muutub allapoole minnes üha heledamaks, kõhualune on valge.
        
        Haugi hambad on suunatud sissepoole, et vältida saagi pagemist suust. Alalõua hambad on eri suurusega ja vahetuvad. Alalõua seesmine külg on kaetud pehme koega, mille all on asendushammaste kõverad read. Igal kihval on 2–4 asendushammast ja kui kihv välja langeb, siis tuleb tema asemele mõni asendushammas. Algul uus hammas logiseb, edaspidi aga kasvab tihedalt alalõua külge kinni. Hambad ei vahetu korraga, vaid kogu aasta vältel pidevalt on haugi suus nii noori kui vanu hambaid.[1]
        
        Haugi tavaline suurus on 50–100 cm, aga ta võib olla üle 150 cm pikk ja üle 35 kg raske. Vangistuses võib haug elada kuni 30 aasta vanuseks.
        
        Haug on suhteliselt paikne kala, kes eelistab aeglase vooluga jõgesid, järvi ja riimveelist rannikumerd, hoidudes enamasti kalda lähedale taimestikku või teistesse varju pakkuvatesse paikadesse. On ka hauge, kes elavad avavees ja jälitavad pisemaid parvekalu. Ta talub hästi happelist keskkonda ja võib elada veekogudes, mille pH on 4,75[1].
        
        Haug on röövkala, kes toitub teistest kaladest, ka oma liigikaaslastest. Suured haugid võivad süüa konni, pardipoegi ja pisiimetajaid. Haugide hulgas on kannibalism väga levinud ja eksisteerib järvi, kus peale haugide teisi kalaliike üldse ei ela. Neis järvedes söövad pisikesed havid vesikirpe, vähikesi ja muud zooplanktonit, aga suuremad liigikaaslasi[1].
        
        Eestis on haug tavaline ja teda püütakse ka töönduslikult. Ta esineb enamikus järvedes ja jõgedes, samuti rannikumeres.
        
        Harrastuspüügil kasutatakse enamasti spinningut ja elussöödaõnge, vähemal määral lendõnge ja põhjaõnge. Enamikus veekogudes on edukaim püügiviis elussöödaõng, mõnes spinning.</p>
    </div>
    <footer>
      <h4>See veebileht on tehtud Mait Jurask'i poolt.</h4>
      <h4><?php echo "Parajasti on " .$partofday ."." ?></h4>
    </footer>
  </div>

</body>
</html>
