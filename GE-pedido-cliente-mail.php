<?php
$mensaje='<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; font-family: dHelvetica Neue, Arial, Helvetica, sans-serif"">
<tr>

    <td align="center" bgcolor="#05735a" style="padding: 5px 0 10px 0;">


    </td>

</tr>
    <tr>

        <td align="center" bgcolor="#ffffff" style="padding: 40px 0 30px 0;">

            <img src="img/logo-header-default.png">
        </td>

    </tr>
    <tr >
        <td align="center" style="background: #eda000; color:#ffffff; padding: 10px 20px 10px 20px"><h3 style="margin:0">Informacion de su pedido</h3></td>
    </tr>
    <tr >
        <td style="padding: 5px 10px 30px 10px;" >

            <table cellpadding="0" cellspacing="0" width="100%" >
                <tr style="color:#05735a;">
                   <th align="center"colspan="2" style="padding:10px 0 10px 0; ">Producto</th>
                    <th>Valor</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($datos as $d) { ?>
                <tr style="color:#666666; font-size: 12px;">
                    <td style="padding: 3px 0 3px 0">
                        <img width="50" src="Administer/public/img/'.$d['img'].'/>
                    </td>
                    <td align="left">
                        '.$d['nombre'].'
                    </td>
                    <td align="center">'. $d['price'].'</td>
                    <td align="center">'. $d['cant'].'</td>
                    <td align="right">$ '.$d['price']*$d['cant'].'</td>
                </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
    <tr>
        <td align="right">
            <table cellpadding="0" cellspacing="0" width="100%" >
                <tr>
                    <td style="padding:10px 0 10px 0" width="260"></td>
                    <td><strong>Total pagado</strong></td>
                    <td align="right" style="padding:0 15px 0 0"><strong>$ '.$_SESSION['total'].'</strong></td>
                </tr>
                <tr>
                    <td style="padding:10px 0 10px 0" width="260"></td>
                    <td><strong>Método pago</strong></td>
                    <td align="right" style="padding:0 15px 0 0"><strong>'.$metodo.'</strong></td>
                </tr>
                <tr >
                    <td colspan="3" style="padding:20px 15px 20px 15px">
                        <p>Debe consignar en la cuenta que bancaria que le llegará al correo electrónico junto con el pedido despues de hacer el deposito envia al correo info@gmail.com la copia del recibo.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#05735a" style="padding: 30px 30px 30px 30px;">
            <table>
                <tr>
                    <td>
                        <a href="http://www.grupodeemprededores.com">www.grupodeemprendedores.com</a>
                    </td>
                    <td align="right">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <a href="http://www.twitter.com/">
                                        <img src="images/tw.gif" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
                                    </a>
                                </td>
                                <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                <td>
                                    <a href="http://www.twitter.com/">
                                        <img src="images/fb.gif" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>';
?>

