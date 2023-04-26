 <!-- INSERIRE LE FUNZIONI DI LOGIN E VERIFICA DELL'UTENTE  -->

<?php
echo print_r($_POST);
$_POST['sium'] = 'cazzetto';
header('location: home_page.php');
exit();
?>