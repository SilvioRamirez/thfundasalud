<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contactanos</title>

</head>

<body>
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="{{ asset('storage/img/fundasalud.png') }}" alt="Logo Fundasalud" style="max-width: 200px;">
        </div>

        <h1 style="color: #333; text-align: center;">Mensaje de Contacto</h1>

        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-top: 20px;">
            <p style="margin-bottom: 15px;"><strong>Nombre:</strong> Silvio {{-- {{ $nombre }} --}}</p>
            <p style="margin-bottom: 15px;"><strong>Correo:</strong> Ramirez {{-- {{ $correo }} --}}</p>
            <p style="margin-bottom: 15px;"><strong>Mensaje:</strong></p>
            <p style="background-color: white; padding: 15px; border-radius: 5px;"> Mensaje de contacto {{-- {{ $mensaje }} --}}</p>
        </div>

        <div style="text-align: center; margin-top: 30px; color: #6c757d; font-size: 14px;">
            <p>Este es un mensaje automático, por favor no responder a este correo.</p>
            <p>&copy; {{ date('Y') }} Fundasalud. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
