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

use App\Models\Cart;
$cart1 = $app->make(Cart::class);

//$cart1->adicionarItem('Bike', 200);
//$cart1->adicionarItem('Tapete', 100);
//$cart1->adicionarItem('Forno', 300);

echo 'Valor total: '. $cart1->exibirValorTotal();
echo '<br />';
echo 'Status: '. $cart1->exibirStatus();

if ($cart1->confirmarPedido()) {
    echo '<br />';
    echo 'Carrinho confirmado';
} else {
    echo '<br />';
    echo 'Carrinho vazio';
}
echo '<br />';
echo 'Status: '. $cart1->exibirStatus();
