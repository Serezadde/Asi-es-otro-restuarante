<?php

if (isset($_SESSION['productos']) && count($_SESSION['productos']) > 0) {
    foreach ($_SESSION['productos'] as $producto) {
        echo "<tr>
                <td>" . htmlspecialchars($producto['nombre']) . "</td>
                <td>" . htmlspecialchars($producto['precio']) . "€</td>
                <td>" . htmlspecialchars($producto['unidades']) . "</td>
                <td>" . htmlspecialchars($producto['subtotal']) . "€</td>
              </tr>";
    }
}
?>