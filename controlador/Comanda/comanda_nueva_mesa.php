<?php
require "../modelo/conexion.php";
require "../modelo/comanda.php";
require "../modelo/pedido.php";

if (!isset($_GET['id_mesa'])) {
    header("Location: seleccionar_mesa.php");
    exit();
}

$pedido = new Pedido($conexion);
$comanda = new Comanda($conexion);

$id_mesa = $_GET['id_mesa'];

$pedido_mesa = $pedido->obtenerPedidoPorMesa($id_mesa);

if (!$pedido_mesa) {
    header("Location: seleccionar_mesa.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['guardar_comanda'])) {
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];

        $comanda->crearComanda($pedido_mesa['id']);
        $ultima_comanda = $comanda->obtenerUltimaComandaPorPedido($pedido_mesa['id']);
        $comanda->anadirProductoAComanda($ultima_comanda['id'], $id_producto, $cantidad);

        header("Location: agregar_comanda.php?id_mesa=$id_mesa");
        exit();
    }
}

$sql_categorias = "SELECT * FROM sp_restaurante_categoria_seleccionar()";
$result_categorias = $conexion->query($sql_categorias);
$categorias = [];
if ($result_categorias) {
    while ($categoria = $result_categorias->fetch(PDO::FETCH_ASSOC)) {
        $categoria_id = $categoria['id'];
        $sql_productos = "SELECT * FROM ObtenerProductosPorCategoria(:categoria_id)";
        $stmt_productos = $conexion->prepare($sql_productos);
        $stmt_productos->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $stmt_productos->execute();
        $productos = [];
        while ($producto = $stmt_productos->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $producto;
        }
        $categorias[] = [
            'categoria' => $categoria,
            'productos' => $productos
        ];
    }
}

$comandas_pedido = $comanda->obtenerComandasPorPedido($pedido_mesa['id']);
if (!$comandas_pedido) {
    $comandas_pedido = [];
}
?>
