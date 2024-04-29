<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
error_reporting(0);

$config["demo"] = false;

use duzun\hQuery;
hQuery::$cache_path = $_SERVER["DOCUMENT_ROOT"]."/cache";
hQuery::$cache_expires = 360000;

header("content-type: image");

if(isset($_GET["img"]))
{
    $code = $_GET["img"];
    $d = hQuery::fromURL("https://prnt.sc/".$code, ["User-agent" => "Mozilla/5.0"]);
    $src = $d->find("img#screenshot-image")->attr("src");
    if(strpos($src, "imgur") === false) 
    {
        header("content-type: text/plain");
        echo 'error';
    }
    elseif(isset($_GET["view"]))
    {
        header("content-type: image");
        $src = str_replace(".jpg", ".jpeg", $src);
        $d = hQuery::fromURL($src, ["Accept" => "image/*"]);
        $image = $d->html();
        echo $image;
    }
    elseif($config["demo"])
    {
        echo '0';
    }
    else
    {
        require("db.php");
        header("content-type: text/plain");

        $q = $db->runQuery("SELECT * FROM scores WHERE code=?", $code);
        if($q->rowCount()==0)
        {
            echo 0;
        }
        else
        {
            $f = $q->fetch();
            echo $f["likes"];
        }
    }

}
if(isset($_POST["like"]) && !$config["demo"])
{
    require("db.php");
    $code = $_POST["like"];
    $q = $db->runQuery("SELECT * FROM scores WHERE code=?", $code);
    if($q->rowCount() == 0)
    {
        $db->runQuery("INSERT INTO scores (code, likes) VALUES (?, ?)", $code, 1);
    }
    else
    {
        $db->runQuery("UPDATE scores SET likes = likes + 1 WHERE code=?", $code);
    }
}

?>
