<?php @session_start();
$suma=0;
$cantidad=0;

if(isset($_SESSION['carrito'])){

    if(isset($_POST['cant']) ){
            $arreglo=$_SESSION['carrito'];
            $id=$_POST['id_prod'];
            $cant=$_POST['cant'];
            $id_cla=$_POST['id_cla'];
            for($i=0;$i<count($arreglo);$i++){
                if($arreglo[$i]['id']==$id AND $arreglo[$i]['idclasif']==$id_cla ) {
                    if ($_POST['cant'] == 0) {
                        unset($arreglo[$i]);
                        $arreglo = array_values($arreglo);
                        $_SESSION['carrito'] = $arreglo;
                    } else{
                        $arreglo[$i]['cant'] = $cant;
                        $arreglo[$i]['total']=$cant*$arreglo[$i]['price'];
                        $_SESSION['carrito'] = $arreglo;
                    }
                }
            }
    }


    if(isset($_POST['id-delete'])){
        $arreglo=$_SESSION['carrito'];
        $idDelete=$_POST['id-delete'];
        $id_cla=$_POST['id_cla'];
        for($i=0;$i<count($arreglo);$i++){
            if($arreglo[$i]['id']==$idDelete AND $arreglo[$i]['idclasif']==$id_cla ){
                unset($arreglo[$i]);
                $arreglo=array_values($arreglo);
                $_SESSION['carrito']=$arreglo;
            }
        }
        if(count($arreglo)==0){
                $_SESSION['carrito']=$arreglo;
                unset($_SESSION['carrito']);
                unset($_SESSION['total']);
                echo "<tr>
                    <th><span class=\"f-primary-b\">Producto</span></th>
                    <th width=\"130\"><span class=\"f-primary-b\">Precio</span></th>
                    <th width=\"100\"><span class=\"f-primary-b\">Cantidad</span></th>
                    <th width=\"170\"><span class=\"f-primary-b\">Total</span></th>
                    <th width=\"70\"><span class=\"f-center\"></span></th>
                </tr>
                <tr><td colspan=\"5\" align='center'>No hay productos en el carro de compras</td></tr>";

        }
    }

}else{
	echo "<tr>
            <th><span class=\"f-primary-b\">Producto</span></th>
            <th width=\"130\"><span class=\"f-primary-b\">Precio</span></th>
            <th width=\"100\"><span class=\"f-primary-b\">Cantidad</span></th>
            <th width=\"170\"><span class=\"f-primary-b\">Total</span></th>
            <th width=\"70\"><span class=\"f-center\"></span></th>
</tr>
 <tr><td colspan=\"5\" align='center'>No hay productos en el carro de compras</td></tr>";
}
if(isset($_SESSION['carrito'])){
    $datos=$_SESSION['carrito'];
    echo '<tr>
        <th><span class="f-primary-b">Producto</span></th>
        <th width="130"><span class="f-primary-b">Precio</span></th>
        <th width="100"><span class="f-primary-b">Cantidad</span></th>
        <th width="170"><span class="f-primary-b">Total</span></th>
        <th width="70"><span class="f-center"><a class="btn-close-o" href=""><i class="fa fa-times"></i></a></span></th>
    </tr>';

    foreach ($datos as $d){


        $cantidad=$d['cant']+$cantidad;
        $total=$d['price']*$d['cant'];
        $suma= $total+$suma;

        $price=number_format($d['price'], 2, ',', '.');
        $total=number_format($total, 2, ',', '.');

    echo '<tr>
        <td>
            <div class="b-href-with-img">
                <a class="c-primary" href="shop_detail.html">
                    <img data-retina="" style="width:8%" src="Administer/public/img/'.$d['img'].'" alt="">
                    <p>
                        <span class="f-title-small ">'.$d['nombre'].'  '.$total.'</span>
                    </p>
                </a>
            </div>
        </td>
        <td><span class="f-primary-b c-default f-title-medium">$<span class="j-product-price">'.$price.'</span></span></td>
        <td class="f-center">
            <div class="b-product-card__info_count "  >
                <input type="number"   min="1" class="form-control form-control--secondary j-product-count cantid"  value="'.$d['cant'].'"  data-id="'.$d['id'].'" data-idcla="'.$d['idclasif'].'"/>
            </div>
        </td>
        <td><span class="f-primary-b c-default f-title-medium">$<span class=" ">'.$total.'</span></span></td>
        <td><span class="f-center"><a class="btn-close-o quitar" data-id="'.$d['id'].'" data-idcla="'.$d['idclasif'].'"><i class="fa fa-times"></i></a></span></td>
    </tr>';
    }

}else{

}
$_SESSION['cantidad']=$cantidad;
$_SESSION['total']=$suma;
?>