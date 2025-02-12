<!DOCTYPE html>
<html>
<head>
    <title>{{ __('Alerta de Stock') }}</title>
</head>
<body>
    <p>{{ 'Los siguientes productos se agotaron.: ' }}</p>
    @foreach ($listProducts as $product)
        <p>{{ __('Producto: ' . $product->name ) }}<p>
        <p>{{ __('Existencias actuales: ' . $product->quantity ) }}<p>
        <p>{{ __('Alerta si está debajo de: ' . $product->quantity_alert ) }}<p>
        <hr>
    @endforeach

</body>
</html>