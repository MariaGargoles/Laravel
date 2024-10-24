<?php

namespace App\Http\Controllers;

use App\Models\Booking;
<<<<<<< HEAD
=======
use App\Models\Room;
>>>>>>> 1e6604a (first commit)
use Illuminate\Http\Request;

class BookingController extends Controller
{
<<<<<<< HEAD
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las reservas
        $bookings = Booking::all();
        
        // Retornar la vista 'bookings.index' con los datos de las reservas
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retornar la vista 'bookings.create' para crear una nueva reserva
        return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
        ]);

        // Crear una nueva reserva con los datos validados
        Booking::create($validated);

        // Redirigir a la lista de reservas
        return redirect()->route('bookings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        // Mostrar la reserva específica en la vista 'bookings.show'
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        // Retornar la vista 'bookings.edit' con los detalles de la reserva para editar
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        // Validar los datos enviados en el formulario de edición
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
        ]);

        // Actualizar la reserva con los datos validados
        $booking->update($validated);

        // Redirigir a la lista de reservas
        return redirect()->route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        // Eliminar la reserva
        $booking->delete();

        // Redirigir a la lista de reservas
        return redirect()->route('bookings.index');
    }
}

=======
    public function store(Request $request, $id)
{
    $request->validate([
        'checkIn' => 'required|date',
        'checkOut' => 'required|date|after:checkIn',
        'fullName' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'specialRequest' => 'nullable|string',
    ]);

    $checkIn = $request->input('checkIn');
    $checkOut = $request->input('checkOut');
    $room_id = $id;
    $room = Room::find($room_id);

    if (!$room) {
        return redirect()->back()->with('error', 'La habitación no existe.');
    }
    if ($room->available($checkIn, $checkOut)->exists()) {
        Booking::create([
            'fullName' => $request->input('fullName'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'room_id' => $room_id,
            'status' => 'In progress',
            'bookDate' => now(),
            'specialRequest' => $request->input('specialRequest'),
        ]);

        return redirect()->back()->with('success', 'Reservation made successfully.');
    } else {
        return redirect()->back()->with('error', 'The room is not available on those dates.');
    }
}
}
>>>>>>> 1e6604a (first commit)
