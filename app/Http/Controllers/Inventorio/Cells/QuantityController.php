<?php

namespace App\Http\Controllers\Inventorio\Cells;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuantityController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer'],
            'row_id' => ['required', 'integer', 'exists:table_rows,id'],
        ]);

        $request->user()->rows()->where('id', $validated['row_id'])->update([
            'quantity' => $validated['quantity']
        ]);
    }
}
