<?php
function getHeader($title="",$style="style.css"){
    if(isset($title)){
     $title= "- " . $title;
    }
?>
<head>
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
            <ul>
                <li>link1</li>
                <li>link2</li>
                <li>link3</li>
            </ul>
            <p>Prova</p>
        </div>
    </div>

    <div id="logo">
    </div>
</div>
<?php
}
?>
