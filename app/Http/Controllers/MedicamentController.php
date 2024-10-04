<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteMedicamentRequest;
use App\Http\Requests\UpdateMedicamentRequest;
use App\Models\Medicament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class MedicamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DataTables::make(Auth::user()->medicaments)
            ->removeColumn('updated_at')
            ->removeColumn('created_at')
            ->removeColumn('user_id')
            ->editColumn('dose', '{{$dose}} {{$unit}}')
            ->removeColumn('unit')
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'dose' => 'required|integer',
            'unit' =>  Rule::in(['mg', 'ug', 'ml']),
            'pieces_morning' => 'required|integer',
            'pieces_midday' => 'required|integer',
            'pieces_evening' => 'required|integer',
            'pieces_night' => 'required|integer'
        ]);

        Medicament::create($request->all() + ['user_id' => Auth::user()->id]);

        return response()->json([
            'title' => __('medicationplan.success_title'),
            'message' =>  __('medicationplan.success_message'),
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicamentRequest $request, string $id)
    {
        $medicament = Medicament::find($id);
        $newPieces = $medicament->pieces + $request->pieces;
        $medicament->update(['pieces' => $newPieces]);

        return response()->json([
            'title' => __('overview.added_medicaments_title'),
            'message' =>  __('overview.added_medicaments_message'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteMedicamentRequest $request, string $id)
    {
        $medicament = Medicament::find($id);
        $medicament->delete();
        return response()->json([
            'title' => __('medicationplan.success_delete_title'),
            'message' =>  __('medicationplan.success_delete_message'),
        ]);
    }
}
