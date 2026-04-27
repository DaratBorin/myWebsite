<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'phone'      => 'required|string|max:20',
            'date'       => 'required|date|after:today',
            'time'       => 'required',
            'guests'     => 'required|integer|min:1|max:20',
            'occasion'   => 'nullable|string',
            'notes'      => 'nullable|string|max:1000',
        ]);

        $reservation = Reservation::create($validated);

        return redirect()->route('reservations.confirmation', $reservation->id);
    }

    public function confirmation($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.confirmation', compact('reservation'));
    }
}
