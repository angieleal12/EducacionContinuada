<?php

namespace App\Exports;

use App\Models\Enrollment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;
use Illuminate\Support\Str;

class EnrollmentsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $category;
    protected $status; 

    public function __construct($category, $status = 'Todos')
    {
        $this->category = $category;
        $this->status = $status;
    }

    public function collection()
    {
        // Iniciamos la consulta filtrando por la categoría
        $query = Enrollment::whereHas('course', function($query) {
            $query->where('category', $this->category);
        })->with('course');

        // Si el administrador eligió un estado específico (diferente a "Todos"), aplicamos el filtro
        if ($this->status !== 'Todos') {
            $query->where('status', $this->status);
        }

        // Ejecutamos la consulta y devolvemos los datos
        return $query->get();
    }
    public function headings(): array
    {
        return [
            'Fecha de Inscripción',
            'Programa Matriculado',
            'Estado',
            'Nombre Completo',
            'Tipo de Documento',
            'Número de Documento',
            'Lugar de Expedición',
            'Fecha de Expedición',
            'Lugar de Nacimiento',
            'Fecha de Nacimiento',
            'Edad',
            'Género',
            'Tipo de Sangre',
            'Correo Personal',
            'Correo Institucional (UT)',
            'Teléfono / Celular',
            'Ciudad de Residencia',
            'Dirección',
            'Horario Seleccionado',
            // --- COLUMNAS INSTITUCIONALES ---
            '¿Es Estudiante UT?',
            'Código Estudiantil',
            'Programa Académico',
            'Semestre',
            '¿Es Egresado(a) UT?',
            // --- COLUMNAS DE EDUCACIÓN SUPERIOR ---
            '¿Tiene Título Superior?',
            'Pregrado',
            'Especialización',
            'Maestría',
            'Doctorado'
        ];
    }

    public function map($enrollment): array
    {
        $extra = $enrollment->extra_details ?? [];
        
        $esEstudiante = isset($extra['is_ut_student']) ? (strtolower($extra['is_ut_student']) === 'yes' ? 'Sí' : 'No') : '';
        $esEgresado = isset($extra['is_ut_graduate']) ? (strtolower($extra['is_ut_graduate']) === 'yes' ? 'Sí' : 'No') : '';
        $tieneTitulo = isset($extra['has_degree']) ? (strtolower($extra['has_degree']) === 'yes' ? 'Sí' : 'No') : '';

        $pregrado = '';
        $especializacion = '';
        $maestria = '';
        $doctorado = '';

        // Clasificador inteligente de títulos (Lee el formato de lista de tu JavaScript)
        if (isset($extra['degrees'])) {
            $titulosArray = is_array($extra['degrees']) ? \Illuminate\Support\Arr::flatten($extra['degrees']) : [$extra['degrees']];
            
            // Recorremos la lista buscando el nivel y capturando el nombre que está justo en la siguiente posición
            for ($i = 0; $i < count($titulosArray); $i++) {
                $itemLower = strtolower(trim($titulosArray[$i]));
                
                // Si encontramos un nivel, el nombre de la carrera es el elemento $i + 1
                $nombreCarrera = isset($titulosArray[$i + 1]) ? trim($titulosArray[$i + 1]) : '';
                
                if ($itemLower === 'pregrado') {
                    $pregrado = $nombreCarrera;
                } elseif (in_array($itemLower, ['especialización', 'especializacion'])) {
                    $especializacion = $nombreCarrera;
                } elseif (in_array($itemLower, ['maestría', 'maestria'])) {
                    $maestria = $nombreCarrera;
                } elseif ($itemLower === 'doctorado') {
                    $doctorado = $nombreCarrera;
                }
            }
        } elseif ($tieneTitulo === 'No') {
            $pregrado = 'Ninguno';
            $especializacion = 'Ninguno';
            $maestria = 'Ninguno';
            $doctorado = 'Ninguno';
        }

        return [
            Carbon::parse($enrollment->created_at)->format('d/m/Y H:i'),
            $enrollment->course->title ?? 'Programa Eliminado',
            $enrollment->status,
            $enrollment->full_name,
            $enrollment->doc_type,
            $enrollment->doc_number,
            $enrollment->expedition_place,
            $enrollment->expedition_date,
            $enrollment->birth_place,
            $enrollment->birth_date,
            $enrollment->age,
            $enrollment->gender,
            $enrollment->blood_type,
            $enrollment->personal_email,
            $enrollment->institutional_email ?? '',
            $enrollment->phone_number,
            $enrollment->city,
            $enrollment->address,
            $enrollment->schedule ?? '',
            // --- BLOQUE INSTITUCIONAL ---
            $esEstudiante,
            $extra['student_code'] ?? '',
            $extra['academic_program'] ?? '',
            $extra['semester'] ?? '',
            $esEgresado,
            // --- BLOQUE DE EDUCACIÓN SUPERIOR ---
            $tieneTitulo,
            $pregrado,
            $especializacion,
            $maestria,
            $doctorado
        ];
    }
}