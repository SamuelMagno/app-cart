<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

use App\Models\Carrinho;
use App\Models\Item;
use App\Models\Pedido;
use App\Services\EmailService;

$pedido = new Pedido();

$item1 = new Item();
$item2 = new Item();

$item1->setDescricao('Porta copos');
$item1->setValor(9.90);

$item2->setDescricao('Conjunto 6 Copos');
$item2->setValor(99.90);

$pedido->getCarrinho()->addItem($item1);
$pedido->getCarrinho()->addItem($item2);

echo '<h4> Pedido</h4>';
echo '<pre>';
print_r($pedido);
echo '</pre>';

echo '<h4> Itens</h4>';
echo '<pre>';
print_r($pedido->getCarrinho()->getItens());
echo '</pre>';

echo '<h4> Valor do pedido</h4>';
echo '<pre>';
$total = 0;
foreach($pedido->getCarrinho()->getItens() as $item) {
    $total += $item->getValor();
}
echo $total;
echo '</pre>';

echo '<h4> Carrinho está válido</h4>';
echo '<pre>';
print_r($pedido->getCarrinho()->validarCarrinho() ? 'Válido' : 'Inválido');
echo '</pre>';

echo '<h4> Status do pedido</h4>';
echo '<pre>';
print_r($pedido->getStatus());
echo '</pre>';

echo '<h4> Confirmar pedido</h4>';
echo '<pre>';
print_r($pedido->confirmar() ? 'Confirmado' : 'Carrinho inválido');
echo '</pre>';

echo '<h4> Status do pedido</h4>';
echo '<pre>';
print_r($pedido->getStatus());
echo '</pre>';

echo '<h4> Envia email</h4>';
echo '<pre>';
if ($pedido->getStatus() == 'confirmado') {
   $emailService = new EmailService();
   echo $emailService->dispararEmail();
}
echo '</pre>';