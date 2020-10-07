<?php
    require("usersession.php");
    header("Content-type: text/css; charset: UTF-8");
?>
#contentLocker {
    margin: auto 20%;
    height: 100%;
    /*background-color: #68B0AB;*/
    background-color: <?php if (isset($_SESSION["userbgcolor"])) {
        echo $_SESSION["userbgcolor"];
    }
    else {
        echo "#68B0AB";
    }
    ?>;
    padding: 4px;
}

body {
    margin: 0 0;
}

html {
    background-color: #122932;
}

#mainHeader {
    text-align: center;
}

#navBar a {
    font-size: 140%;
}

#navBar {
    padding: 4px 2px;
    border-style: solid;
    border-width: 1px;
}

#content img {
    width: 300px;
    height: 200px;
}

footer {
    border-top: solid 1px;
}

header img {
    width: auto;
}

#filmiform {
    display: inline-grid;
}

#registerform {
    display: flex;
    flex-direction: column;

}
