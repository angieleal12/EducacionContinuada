<!DOCTYPE html>
<html>

<head>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f4f4f4;
        padding: 20px;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .header {
        background: #8B0000;
        color: white;
        padding: 20px;
        text-align: center;
    }

    .content {
        padding: 30px;
        text-align: center;
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #8B0000;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
        font-weight: bold;
    }

    .footer {
        padding: 15px;
        text-align: center;
        font-size: 12px;
        color: #777;
        background-color: #eee;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>NUEVA INSCRIPCIÓN</h2>
        </div>

        <div class="content">
            <p>Hola, Administración.</p>
            <p>El sistema acaba de registrar una nueva solicitud de inscripción.</p>

            <div
                style="background-color: #f9fafb; border-left: 4px solid #8B0000; padding: 15px; margin: 20px 0; text-align: left;">
                <p style="margin: 0;"><strong>Persona Inscrita:</strong>
                    {{ $formData['full_name'] ?? 'Nombre no disponible' }}</p>
                <p style="margin: 5px 0 0 0;"><strong>Curso / Diplomado:</strong> Solicitud Pendiente</p>
            </div>

            <p>Por favor, ingresa al módulo administrativo (Servicio al Usuario) para revisar los documentos adjuntos y
                aprobar o rechazar la solicitud.</p>

            <a href="{{ url('/login') }}" class="button">Ir al Panel Administrativo</a>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Educación Continuada - Universidad del Tolima. Este es un mensaje automático.
        </div>
    </div>
</body>

</html>