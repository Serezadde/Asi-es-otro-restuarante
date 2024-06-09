<!DOCTYPE html>
<html>
<head>
    <title>Finalizar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/aec7d72014.js" crossorigin="anonymous"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 800px; margin: auto; }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center p-3">Finalizar Pedido</h1>

    <?php
    include "../../controlador/Pedido/pedido_finalizado.php";
    ?>

    <h2>Detalle del Pedido</h2>
    <p><strong>Mesa:</strong> <?= htmlspecialchars($pedido['nombre_mesa']) ?></p>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Unidades</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalle_comandas as $comanda) { ?>
                <tr>
                    <td><?= htmlspecialchars($comanda['nombre']) ?></td>
                    <td><?= htmlspecialchars($comanda['cantidad']) ?></td>
                    <td><?= htmlspecialchars($comanda['precio']) ?>€</td>
                    <td><?= htmlspecialchars($comanda['precio'] * $comanda['cantidad']) ?>€</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <h3>Total a Pagar: <?= htmlspecialchars($total) ?>€</h3>

    <form method="post" id="pagoForm">
        <div class="mb-3">
            <label for="dinero_pagado" class="form-label">Dinero Pagado:</label>
            <input type="number" class="form-control" name="dinero_pagado" id="dinero_pagado" step="0.01" value="1">
        </div>
        <button type="submit" class="btn btn-primary" name="pagar_dinero">Pagar con Dinero</button>
        <button type="submit" class="btn btn-primary" name="pagar_tarjeta">Pagar con Tarjeta</button>
        <input type="hidden" name="id_pedido" value="<?= htmlspecialchars($id_pedido) ?>">
    </form>

    <?php if (isset($forma_pago)) { ?>
        <h3>Forma de Pago: <?= htmlspecialchars($forma_pago == 'dinero' ? 'Dinero' : 'Tarjeta') ?></h3>
        <h3>Total Pagado: <?= htmlspecialchars($pagado) ?>€</h3>
        <h3>Devolución: <span id="devolucion"><?= htmlspecialchars($devolucion) ?></span>€</h3>
    <?php } ?>
    <br>
    <form method="post" action="../../controlador/Pedido/pedido_finalizado.php">
        <input type="hidden" name="id_pedido" value="<?= htmlspecialchars($id_pedido) ?>">
        <input type="hidden" name="finalizar" value="1">
        <button type="submit" class="btn btn-success" id="finalizarBtn" disabled>Finalizar Pedido <i class="fa-solid fa-cart-shopping"></i></button>
    </form>
    <br>
    <br>
    <br>
    <a href="../../vista/Pedidos/menu.php"><button class="btn btn-primary">Atrás</button></a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const devolucion = parseFloat(document.getElementById('devolucion').innerText);
            const finalizarBtn = document.getElementById('finalizarBtn');

            if (devolucion >= 0) {
                finalizarBtn.disabled = false;
            } else {
                finalizarBtn.disabled = true;
            }

            document.getElementById('pagoForm').addEventListener('submit', function () {
                const dineroPagado = parseFloat(document.getElementById('dinero_pagado').value);
                const total = parseFloat(<?= $total ?>);
                const devolucion = dineroPagado + parseFloat(<?= $pagado ?>) - total;

                if (devolucion >= 0) {
                    finalizarBtn.disabled = false;
                } else {
                    finalizarBtn.disabled = true;
                }
            });
        });
    </script>
</div>
</body>
</html>
