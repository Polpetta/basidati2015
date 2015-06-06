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
<div id="button_menu">
    <div id="menu">
        <ul>
            <li>link1</li>
            <li>link2</li>
            <li>link3</li>
        </ul>
        <p>Prova</p>
    </div>
</div>
<?php
}
?>
