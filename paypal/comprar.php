<?php session_start();
//Concepto de compra
$concepto = "Carrito de compras";

//URL's de retorno
/*$regreso   = "http://localhost:801/grupoemp/GE-procesar-pedido.php";
$cancelado = "http://localhost:801/grupoemp/GE-shop_cart.php";*/
$regreso   = "http://grupodeemprendedores.com/index/GE-procesar-pedido.php";
$cancelado = "http://grupodeemprendedores.com/index/GE-shop_cart.php";

//El total
$tax=0;
$envio=0;
$dolar=$_POST['dolar'];
//$total=$_SESSION['total']/$dolar;
//NO MODIFICAR
require 'bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

$payer = new Payer();
$payer->setPaymentMethod("paypal");

$datos=$_SESSION['carrito'];
$items=array();
$subtotal=0;
foreach ($datos as $d) {
    $item = new Item();
    $price=$d['total']/$dolar;
    $item->setName($d['nombre'])
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setSku($d['id'])// Similar to `item_number` in Classic API
        ->setPrice($price);
    $items[]=$item;
    $subtotal=$price+$subtotal;
}

$itemList = new ItemList();
$itemList->setItems($items);

/*$item1 = new Item();
$item1->setName($concepto)
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setSku("5") // Similar to `item_number` in Classic API
    ->setPrice($precio);*/

$details = new Details();
$details->setShipping(0)
    ->setTax(0)
    ->setSubtotal($subtotal);

$total=$subtotal+$envio+$tax;
$amount = new Amount();
$amount->setCurrency("USD")
    ->setTotal($total)
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Compra en linea www.grupodeemprendedores.com")
    ->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl($regreso)
    ->setCancelUrl($cancelado);

$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

$request = clone $payment;

try {
    $payment->create($apiContext);
} catch (Exception $ex) {
    ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
    exit(1);
}

$approvalUrl = $payment->getApprovalLink();
echo $_POST['metodoPago'];
if($_POST['metodoPago']=='paypal'){
    $_SESSION['metodo']='paypal';
    header("Location: " . $approvalUrl);
}else{
    $_SESSION['metodo']=$_POST['metodoPago'];
    header("Location: ../GE-procesar-pedido.php");
}


ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

return $payment;