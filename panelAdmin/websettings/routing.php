<?php
    $pageArray = [];
    $pageDir = scandir('./pages/');
    foreach($pageDir as $page){
        if($page!='.' && $page!='..'){
            array_push($pageArray,basename($page,'.php'));
        }
    }
    $reqURL = $_SERVER['REQUEST_URI'];
    if($reqURL == "/paneladmin/" || $reqURL == "/paneladmin"){
        $page = "home";
    }else{
        $page = basename($reqURL);
    }
    foreach($pageArray as $pageName){
        if($pageName == $page){
            $pageCompo = "./pages/$page.php";
            break;
        }
    }
    if(!isset($pageCompo)){
        $pageCompo = './pages/404.php';
    }
?>