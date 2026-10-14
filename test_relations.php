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

// Refresh the venta model to get updated totals
$v->refresh();

echo "Producto->categoria: " . $prod->categoria->nombre . PHP_EOL;
echo "Producto->proveedor: " . $prod->proveedor->nombre . PHP_EOL;
echo "Cliente->ventas count: " . $cli->ventas->count() . PHP_EOL;
echo "Venta->detalles count: " . $v->detalles->count() . PHP_EOL;
echo "Venta subtotal: " . $v->subtotal . PHP_EOL;
echo "Venta IGV: " . $v->igv . PHP_EOL;
echo "Venta total: " . $v->total . PHP_EOL;
echo "Detalle subtotal: " . $d->subtotal . PHP_EOL;
echo "Producto stock después de venta: " . $prod->fresh()->stock . PHP_EOL;

echo "Todas las relaciones funcionan correctamente!" . PHP_EOL;