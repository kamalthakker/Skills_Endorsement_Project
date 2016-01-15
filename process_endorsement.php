<?php

if (isset($_POST['recommendation'])) {

    echo 'submitted!<br/><br/>';

    //echo $_POST['recommendation'];

} else {

    echo 'NO data submitted!<br/><br/>';

    echo $_POST['recommendation'];

}


?>