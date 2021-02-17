<?php
if(isset($_SESSION['admin'])){
    echo $_SESSION['admin'];
}else{
    echo false;
}
