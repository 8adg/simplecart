// public_html/js/app.js

document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        let productId = this.getAttribute('data-product-id');
        let quantity = 1; // Puedes modificar para permitir que el usuario elija la cantidad
        let stock = parseInt(this.getAttribute('data-stock'));

        if (quantity <= stock) {
            // Lógica para agregar el producto al carrito
            fetch('/add-to-cart/' + productId + '/' + quantity)
                .then(response => response.json())
                .then(data => {
                    // Mostrar mensaje de éxito o actualizar carrito
                    alert('Producto agregado al carrito');
                })
                .catch(error => {
                    alert('Error al agregar el producto al carrito');
                });
        } else {
            alert('No hay suficiente stock disponible.');
        }
    });
});
