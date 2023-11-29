<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Requests\warehouse\StoreWarehouseRequest;
use App\Http\Requests\warehouse\UpdateWarehouseRequest;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $warehouses = Warehouse::filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('warehouses.index', [
            'warehouses' => $warehouses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarehouseRequest $request)
    {
        // dd($request);
        $warehouses = Warehouse::create($request->all());

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

            $file->storeAs('warehouses/', $filename, 'public');
            $warehouses->update([
                'photo' => $filename
            ]);
        }

        return redirect()
            ->route('warehouses.index')
            ->with('success', 'New warehouse has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        //
        return view('warehouses.edit', [
            'warehouse' => $warehouse
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        //
        $warehouse->update($request->except('photo'));

        /**
         * Handle upload image with Storage.
         */
        if($request->hasFile('photo')){

            // Delete Old Photo
            if($warehouse->photo){
                unlink(public_path('storage/warehouses/') . $warehouse->photo);
            }

            // Prepare New Photo
            $file = $request->file('photo');
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

            // Store an image to Storage
            $file->storeAs('warehouses/', $fileName, 'public');

            // Save DB
            $warehouse->update([
                'photo' => $fileName
            ]);
        }

        return redirect()
            ->route('warehouses.index')
            ->with('success', 'Warehouse has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        //
        if($warehouse->photo){
            unlink(public_path('storage/warehouses/') . $warehouse->photo);
        }

        $warehouse->delete();

        return redirect()
            ->back()
            ->with('success', 'Warehouse has been deleted!');
    }
}
