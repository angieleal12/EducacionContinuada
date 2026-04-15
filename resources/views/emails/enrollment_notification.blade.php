<!DOCTYPE html>
<html>

<head>
    <style>
    body {
        font-family: sans-serif;
        line-height: 1.6;
        color: #333;
    }

    .header {
        background: #b91c1c;
        color: white;
        padding: 20px;
        text-align: center;
    }

    .content {
        padding: 20px;
        border: 1px solid #eee;
    }

    .section-title {
        font-weight: bold;
        color: #b91c1c;
        border-bottom: 1px solid #eee;
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="header">
        <h1>Nueva Inscripción Recibida</h1>
        <p>Curso: {{ $formData['course_name'] }}</p>
    </div>

    <div class="content">
        <div class="section-title">1. DATOS PERSONALES</div>
        <p><strong>Nombre:</strong> {{ $formData['student_name'] }}</p>
        <p><strong>Correo:</strong> {{ $formData['student_email'] }}</p>
        <p><strong>Celular:</strong> {{ $formData['phone'] }}</p>
        <p><strong>Documento:</strong> {{ $formData['doc_type'] }} - {{ $formData['doc_number'] }}</p>
        <p><strong>Dirección:</strong> {{ $formData['address'] }}</p>

        <div class="section-title">2. PERFIL ACADÉMICO Y LABORAL</div>
        <p><strong>¿Estudia actualmente?:</strong> {{ $formData['studying_now'] }}
            @if(!empty($formData['current_university'])) (En: {{ $formData['current_university'] }}) @endif
        </p>
        <p><strong>¿Posee título?:</strong> {{ $formData['has_degree'] }}
            @if(!empty($formData['degree_title'])) (Título: {{ $formData['degree_title'] }}) @endif
        </p>
        <p><strong>¿Es egresado UT?:</strong> {{ $formData['is_ut_graduate'] }}</p>
        @if(!empty($formData['other_university']))
        <p><strong>Otra Universidad:</strong> {{ $formData['other_university'] }}</p>
        @endif
        @if(!empty($formData['work_field']))
        <p><strong>Campo Laboral:</strong> {{ $formData['work_field'] }}</p>
        @endif
    </div>
</body>

</html>