<?php
// src/SimpleCartController.php

namespace SimpleCart\Controller;

use Bolt\Controller\AbstractBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SimpleCartController extends AbstractBase
{
    public function addToCartAction(Request $request, $productId, $quantity)
    {
        // Obtener el producto desde la base de datos
        $product = $this->app['storage']->getContent('simplecart', $productId);

        if ($product) {
            $availableStock = $product->stock;

            // Verificar si hay suficiente stock
            if ($availableStock >= $quantity) {
                // Lógica para agregar al carrito
                // Guardar el producto en la sesión o base de datos según sea necesario
                // $this->addProductToSession($product, $quantity);
                return new Response('Producto agregado al carrito');
            } else {
                // Si no hay suficiente stock
                $this->app['session']->getFlashBag()->add('error', 'No hay suficiente stock.');
                return new Response('No hay suficiente stock disponible', 400);
            }
        }

        return new Response('Producto no encontrado', 404);
    }
}
