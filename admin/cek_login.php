<?php
include "config.php";

$username   = $security->anti_injection($_POST['username']);
$password   = $security->anti_injection($_POST['password']);

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($password)){

echo "
    <br /> <br />
    <br /> <br />
    <br /> <br />
    <br /> <br />
    <div align='center'>
        <div id='content'>
            <div align='center'>
            <br />

            <table width='303' border='0' cellpadding='0' cellspacing='0' class='form3'>
                <tr>
                    <td>
                        <div align='center'>
                            <a href='index.php'>
                                <b>
                                    <img src='assets/img/icons/icn_alert_warning.png' width='24' height='24' border='0'/>
                                </b>
                            </a>
                            <br />

                            <a href='index.php'><b>Ulangi Sekali Lagi</b></a>
                        </div>
                    </td>
                </tr>
            </table>

            <br /> <br />
        </div>
    </div>";
}
else{
$pass   = $security->enkrip($password);
$result = $database->count_rows($table="users", $where_clause="WHERE username='$username' AND password='$pass' AND blokir='N' AND level = 'admin'");

$users = $database->select($fields="*", $table="users", $where_clause="WHERE username='$username' AND password='$pass' AND blokir='N' AND level='admin'", $fetch="");

// Apabila username dan password ditemukan
if ($result > 0){
    session_start();
    $_SESSION['id_users']       = $users['id_users'];
    $_SESSION['username']       = $users['username'];
    $_SESSION['nama_lengkap']   = $users['nama_lengkap'];
    $_SESSION['password']       = $users['password'];
    $_SESSION['level']          = $users['level'];

	$sid_lama = session_id();

	session_regenerate_id();

	$sid_baru = session_id();

    $form_data = array(
        'id_session' => $sid_baru,
    );

    $database->update($table="users", $array=$form_data, $fields_key="id_users", $id="$_SESSION[id_users]");
    header('location:media.php?module=home');
}
else{

echo "
    <br /> <br />
    <br /> <br />
    <br /> <br />
    <br /> <br />
    <div align='center'>
        <div id='content'>
            <div align='center'>
            <br />

            <table width='303' border='0' cellpadding='0' cellspacing='0' class='form3'>
                <tr>
                    <td>
                        <div align='center'>
                            <a href='index.php'>
                                <b>
                                    <img src='assets/img/icons/icn_alert_warning.png' width='24' height='24' border='0'/>
                                </b>
                            </a>
                            <br />

                            <a href='index.php'><b>Ulangi Sekali Lagi</b></a>
                        </div>
                    </td>
                </tr>
            </table>

            <br /> <br />
        </div>
    </div>";
}}
?>
