<?php

namespace App\Http\Controllers;

use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopupController extends Controller
{
    public function index()
    {
        $popups = Popup::latest()->get();
       return view('admin.home_content.popups', compact('popups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
           'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|url',
        ]);

        // Guardamos la imagen en la carpeta pública
        $imagePath = $request->file('image')->store('popups', 'public');

        Popup::create([
            'title' => $request->title,
            'image_path' => $imagePath,
            'link' => $request->link,
            'is_active' => false, // Por defecto se sube apagada
        ]);

        return back()->with('success', 'Oferta publicitaria creada. Recuerda activarla en la lista de abajo.');
    }

    public function toggle(Popup $popup)
    {
        // Simplemente cambiamos el estado al contrario del que tiene actualmente
        $popup->is_active = !$popup->is_active;
        $popup->save();

        $mensaje = $popup->is_active ? '✅ Oferta ACTIVADA.' : '❌ Oferta DESACTIVADA.';

        return back()->with('success', $mensaje);
    }

    public function destroy(Popup $popup)
    {
        // Borramos el archivo físico para no llenar el servidor
        if (Storage::disk('public')->exists($popup->image_path)) {
            Storage::disk('public')->delete($popup->image_path);
        }
        $popup->delete();

        return back()->with('success', 'Oferta eliminada permanentemente.');
    }
}