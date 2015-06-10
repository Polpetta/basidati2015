<?php
function getHeader($title="",$style="style.css"){
    if(isset($title)){
     $title= "- " . $title;
    }
?>
<head>
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/<?php echo $style;?>">
    <title>Linea Casa Bari <?php echo $title; ?></title>
</head>
<?php
}

function getMenu(){
?>
<div id="head">
    <div id="button_menu">
        <div id="drawer">
            <h3>Men&ugrave;</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Prodotti</a></li>
                <li>link3</li>
            </ul>
            <p>Prova</p>
        </div>
    </div>

    <div id="logo">
        <div id="login">
            <a href="login.php">Accedi</a>
        </div>
    </div>
</div>
<?php
}
?>
