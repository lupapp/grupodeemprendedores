<?php @session_start();
$suma=0;
$cantidad=0;

if(isset($_SESSION['carrito'])){

    if(isset($_POST['id-menos']) ){
            $arreglo=$_SESSION['carrito'];
            $encontrado=false;
            $numero=0;
            $numero2=0;
            $idMenos=$_POST['id-menos'];
            $det=$_POST['det'];


            for($i=0;$i<count($arreglo);$i++){
                if($arreglo[$i]['id']==$idMenos && $det==$arreglo[$i]['deta']){
                    if($arreglo[$i]['cant']==1){
                        unset($arreglo[$i]);
                        $arreglo=array_values($arreglo);
                        $_SESSION['carrito']=$arreglo;									
                    }
                }
            }			
            for($i=0;$i<count($arreglo);$i++){
                if($arreglo[$i]['id']==$idMenos && $det==$arreglo[$i]['deta']){
                    if($arreglo[$i]['cant'] > 1){
                        $arreglo[$i]['cant']--;
                        $_SESSION['carrito']=$arreglo;
                    }
                }
            }
            if(count($arreglo)==0){
                $_SESSION['carrito']=$arreglo;
                unset($_SESSION['total']);
                echo"<center>No hay productos</center>";
            }
    }
    if(isset($_POST['id-mas']) && isset($_POST['det'])){
        $arreglo=$_SESSION['carrito'];
        $idMas=$_POST['id-mas'];
        $det=$_POST['det'];
        for($i=0;$i<count($arreglo);$i++){			
            if($arreglo[$i]['id']==$idMas && $det==$arreglo[$i]['deta']){
                $arreglo[$i]['cant']++;
                $_SESSION['carrito']=$arreglo;
            }
        }
    }

    if(isset($_POST['id-delete'])){
        $arreglo=$_SESSION['carrito'];
        $idDelete=$_POST['id-delete'];
        $idCla=$_POST['id_cla'];
        for($i=0;$i<count($arreglo);$i++){
            if($arreglo[$i]['id']==$idDelete AND $arreglo[$i]['idclasif']==$idCla ){
                unset($arreglo[$i]);
                $arreglo=array_values($arreglo);
                $_SESSION['carrito']=$arreglo;
            }
        }
        if(count($arreglo)==0){
                $_SESSION['carrito']=$arreglo;
                unset($_SESSION['total']);
                echo"<center>No hay productos</center>";

        }
    }
    if(isset($_POST['nombre'])&& $_POST['nombre']!=''){
        $arreglo=$_SESSION['carrito'];
        $encontrado=false;
        $numero=0;
        $contador=0;

        for($i=0;$i<count($arreglo);$i++){		
                if($arreglo[$i]['id']==$_POST['id'] AND $arreglo[$i]['idclasif']==$_POST['idclasif'] ){
                    $encontrado=true;
                    $numero=$i;
                }
        }

        if($encontrado==true){
                $arreglo[$numero]['cant']=$arreglo[$numero]['cant']+$_POST['cantidad'];
                $_SESSION['carrito']=$arreglo;
        }else{
        $arreglo=$_SESSION['carrito'];
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $cant=$_POST['cantidad'];
        $price=$_POST['valor'];
        $img=$_POST['img'];
        $clasf=$_POST['idclasif'];
        $modi=$_POST['modi'];
        $arregloNuevo=array(
            'id'=>$id,
            'nombre'=>$nombre,
            'cant'=>$cant,
            'price'=>$price,
            'img'=>$img,
            'idclasif'=>$clasf,
            'modi'=>$modi,
            'total'=>$cant*$price
        );
        array_push($arreglo, $arregloNuevo);
        $_SESSION['carrito']=$arreglo;
        }

    }
}else{
	if(isset($_POST['nombre']) and $_POST['nombre']!=''){
        $id=$_POST['id'];
		$nombre=$_POST['nombre'];
		$cant=$_POST['cantidad'];
		$price=$_POST['valor'];
		$img=$_POST['img'];
        $clasf=$_POST['idclasif'];
        $modi=$_POST['modi'];
		$arreglo[]=array(
				'id'=>$id,
				'nombre'=>$nombre,
				'cant'=>$cant,
				'price'=>$price,
				'img'=>$img,
                'idclasif'=>$clasf,
                'modi'=>$modi,
                'total'=>$cant*$price
				);
		
		$_SESSION['carrito']=$arreglo;
		
	}else{
	}
}
if(isset($_SESSION['carrito'])){
    $datos=$_SESSION['carrito'];            
    for($i=0;$i<count($datos);$i++){
        $suma= $datos[$i]['price']*$datos[$i]['cant']+$suma;
        $cantidad=$datos[$i]['cant']+$cantidad;
        echo"
        
        <li>
          <div class='b-option-cart__items__img'>
              <div class='view view-sixth'>
                  <img data-retina='' src='Administer/public/img/".$datos[$i]['img']."' alt=''>
                  <div class='b-item-hover-action f-center mask'>
                      <div class='b-item-hover-action__inner'>
                          <div class='b-item-hover-action__inner-btn_group'>
                              <a href='#' class='b-btn f-btn b-btn-light f-btn-light info'><i class='fa fa-link'></i></a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class='b-option-cart__items__descr'>
              <strong class='b-option-cart__descr__title f-option-cart__descr__title'><a href='#'>".$datos[$i]['nombre']."</a></strong>
              <span class='b-option-cart__descr__cost f-option-cart__descr__cost'>".$datos[$i]['cant']." x $".number_format($datos[$i]['price'], 0, ',', '.')."</span>
          </div>
          <i class='fa fa-times b-icon--fa quitar' data-id='".$datos[$i]['id']."' data-idcla='".$datos[$i]['idclasif']."'></i>
        </li>
        ";


    }

}else{
    echo"<center>No hay productos</center>";
}
$_SESSION['cantidad']=$cantidad;
$_SESSION['total']=$suma;
?>