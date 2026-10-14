<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Venta;
use App\Models\DetalleVenta;

$c = Categoria::create(['nombre' => 'Electrónica', 'descripcion' => 'Productos electrónicos', 'estado' => 'activo']);
$p = Proveedor::create(['nombre' => 'TechCorp', 'ruc' => '20123456789', 'email' => 'contacto@techcorp.com', 'estado' => 'activo']);
$prod = Producto::create(['codigo' => 'LAP001', 'nombre' => 'Laptop HP', 'categoria_id' => $c->id, 'proveedor_id' => $p->id, 'precio_compra' => 2000, 'precio_venta' => 3000, 'stock' => 10, 'estado' => 'activo']);
$cli = Cliente::create(['nombre' => 'Juan Pérez', 'ruc_dni' => '12345678', 'email' => 'juan@email.com', 'estado' => 'activo']);
$u = User::create(['name' => 'Vendedor Test', 'email' => 'vendedor@test.com', 'password' => bcrypt('password')]);
$v = Venta::create(['numero_comprobante' => 'F001-001', 'cliente_id' => $cli->id, 'user_id' => $u->id, 'fecha_venta' => now(), 'estado' => 'completada']);
$d = DetalleVenta::create(['venta_id' => $v->id, 'producto_id' => $prod->id, 'cantidad' => 2, 'precio_unitario' => 3000, 'descuento' => 100]);

// Debug
echo "Detalle created: " . $d->id . PHP_EOL;
echo "Detalle venta_id: " . $d->venta_id . PHP_EOL;
echo "Venta loaded via relationship: " . ($d->venta ? "YES" : "NO") . PHP_EOL;

if ($d->venta) {
    echo "Venta ID: " . $d->venta->id . PHP_EOL;
    echo "Venta detalles count via relationship: " . $d->venta->detalles->count() . PHP_EOL;
    echo "Venta detalles sum via query: " . $d->venta->detalles()->sum('subtotal') . PHP_EOL;
}

echo "Direct query sum: " . DetalleVenta::where('venta_id', $v->id)->sum('subtotal') . PHP_EOL;

// Now manually call calcularTotales
$v->calcularTotales();
$v->refresh();

echo "After manual calcularTotales:" . PHP_EOL;
echo "Venta subtotal: " . $v->subtotal . PHP_EOL;
echo "Venta IGV: " . $v->igv . PHP_EOL;
echo "Venta total: " . $v->total . PHP_EOL;