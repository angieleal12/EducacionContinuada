<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeContent;


class HomeContentController extends Controller

{
    public function index()
    {
      
        return view('admin.home_content.index');
    }
    // Muestra el formulario con los textos actuales
    public function edit()
    {
        // Busca el primer registro. Si la tabla está vacía, lo crea con id 1 automáticamente.
        $content = HomeContent::firstOrCreate(['id' => 1]);
        
        return view('admin.home_content.edit', compact('content'));
    }

    // Guarda los textos en la base de datos
    public function update(Request $request)
    {
        $content = HomeContent::first();

        // Validamos que sea texto (nullable permite que la administradora deje secciones en blanco si quiere)
        $validated = $request->validate([
            'about_us' => 'nullable|string',
            'formation_types' => 'nullable|string',
            'discounts' => 'nullable|string',
        ]);

        // Actualizamos la base de datos
        $content->update($validated);

        // Devolvemos a la administradora a la misma pantalla con un mensaje verde de éxito
        return redirect()->back()->with('success', '¡Información de la página principal actualizada correctamente!');
    }
}