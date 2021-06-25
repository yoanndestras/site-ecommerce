<?
session_start();

if(!isset($_SESSION['client_Id_Client']))
{
    if(!isset($_SESSION['client_admin']))
    {
        header('Location: index.php');
    }
}
else if(!isset($_SESSION['client_admin']))
{
    if(!isset($_SESSION['client_Id_Client']))
    {
        header('Location: index.php');
    }
}

session_start();
$_SESSION = array();
session_destroy();
header('Location: index.php');

?>