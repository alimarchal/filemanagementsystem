<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFmsRequest;
use App\Http\Requests\UpdateFmsRequest;
use App\Models\Fms;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fms = QueryBuilder::for(Fms::class)
            ->allowedFilters([
                'exchange_name',
                AllowedFilter::exact('telephone'),
                AllowedFilter::exact('type')
            ])
            ->orderByDesc('created_at') // Order the results by 'created_at' in descending order
            ->paginate(5)
            ->withQueryString();


        return view('fms.index', compact('fms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFmsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Fms $fms)
    {
        return view('fms.show', compact('fms'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fms $fms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFmsRequest $request, Fms $fms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fms $fms)
    {
        //
    }
}
