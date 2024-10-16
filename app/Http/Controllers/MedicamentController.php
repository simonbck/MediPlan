<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteMedicamentRequest;
use App\Http\Requests\StoreMedicamentRequest;
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
    public function store(StoreMedicamentRequest $request)
    {

        Medicament::create($request->validated() + ['user_id' => Auth::user()->id]);

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
        $newPieces = $medicament->pieces + $request->validated('pieces');
        $medicament->update(['pieces' => $newPieces]);

        return response()->json([
            'title' => __('overview.added_medicaments_title'),
            'message' =>  __('overview.added_medicaments_message'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteMedicamentRequest $request)
    {
        $medicament = Medicament::find($request->validated('id'));
        $medicament->delete();
        return response()->json([
            'title' => __('medicationplan.success_delete_title'),
            'message' =>  __('medicationplan.success_delete_message'),
        ]);
    }
}
