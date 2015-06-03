<?php
function test(){
    $variable="prova";

 echo <<<END
This uses the "here document" syntax to output
multiple lines with $variable interpolation. Note
that the here document terminator must appear on a
line with just a semicolon. no extra whitespace!
END;
}

function getHeader($title=""){
    if(isset($title)){
     $title= "-" . $title;
    }

    echo "test";

    echo <<<END

    <head>
    <link rel="stylesheet" href="css/style.css">
    <title>Linea Casa Bari $title</title>
    </head>

 END;
}

function getMenu(){
 echo <<<END
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
 END;
}
?>
