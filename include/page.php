<?php
function getHeader($title="",$style=""){
    if(isset($title)){
     $title= "- " . $title;
    }
?>
<head>
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/style.css">
    <?php
    if(isset($style)){
        ?>
        <link rel="stylesheet" href="css/<?php echo $style;?>">
    <?php
    }
    ?>
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
                <li><a href="makelamp.php">Crea lampada</a></li>
                <li><a href="login.php">Area Riservata</a></li>
            </ul>
        </div>
    </div>

    <div id="logo">

    </div>
</div>
<?php
}
?>
