<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Requests\seller\StoreSellerRequest;
use App\Http\Requests\seller\UpdateSellerRequest;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $sellers = Seller::filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('sellers.index', [
            'sellers' => $sellers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSellerRequest $request)
    {
        //
        // dd($request);
        $seller = Seller::create($request->all());

        return redirect()
            ->route('sellers.index')
            ->with('success', 'New seller has been created!');
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
    public function edit(Seller $seller)
    {
        //
        return view('sellers.edit', [
            'seller' => $seller
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSellerRequest $request, Seller $seller)
    {
        //
        $seller->update($request->all());

        return redirect()
            ->route('sellers.index')
            ->with('success', 'seller has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller)
    {
        //
        $seller->delete();

        return redirect()
            ->back()
            ->with('success', 'seller has been deleted!');
    }
}
