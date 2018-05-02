<?php
session_start();
spl_autoload_register(function ($clase) {
    include '../class/'.$clase.'/'.$clase.'.php';
});
$cone=new Conexion();
$membresia=new Membresia($cone);
$mem=$membresia->getAll();
$usuario= new User($cone);
$option= new Options($cone);
$mail=$option->getByName('mail_noti');
$con=0;
$mails=[];
foreach ($mem as $m){
    $ver=$membresia->verificarVencimiento($m->vencimiento);
    if($ver<=0) {
        $con++;
        $user = $usuario->getById($m->id_user);
        $membresia->setEstado(1);
        $membresia->setVencimiento($m->vencimiento);
        if ($m->estado == 0){
            array_push($mails, $user->mail);
        }
        $membresia->update($m->id);
    }

}
$maildd=$mails;
print_r($maildd);
echo $con;

if(count($mails)!=0) {
    $mailv = implode(',', $mails);
    echo $mailv;
    include '../view/mensajes/mensajeNotiMem.php';
    $to = $mail->valor;
    $from = 'MIME-Version: 1.0' . "\r\n";
    $from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $from .= 'To:' . $to . '' . "\r\n";
    $from .= 'From: Do_Not_reply@grupodeemprendedores.com' . "\r\n";
    date_default_timezone_set('America/Bogota');
    $tema = "Registro de usuario";
    @mail($to, $tema, utf8_decode($mensaje), $from);
}
?>