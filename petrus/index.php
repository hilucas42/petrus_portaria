<?php
    echo $_SERVER['QUERY_STRING'];

    parse_str($_SERVER['QUERY_STRING']);

    echo "<br>";
    echo $p;
    echo "<br>";
    echo $ele;
    echo "<br>";
    echo $ela;
