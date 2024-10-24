<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeskStoreRequest;
use App\Http\Resources\DeskResource;
use App\Models\Desk;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DeskResource::collection(Desk::with('lists')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeskStoreRequest $request)
    {
        $created_desk = Desk::create($request->validated());
        //возращение только что созданной доски
        return new DeskResource($created_desk);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //with('lists') - это связи
        return new DeskResource(Desk::with('lists')->findorFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeskStoreRequest $request, Desk $desk)
    {
        $desk -> update($request->validated());

        return new DeskResource($desk);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desk $desk)
    {
        // Удаляем переданный объект Desk
        $desk->delete();

        // Возвращаем ответ с кодом 204 (HTTP_NO_CONTENT) без содержимого
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
