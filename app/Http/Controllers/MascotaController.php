<?php

namespace App\Http\Controllers;

use App\Http\Requests\MascotaStore;
use App\Models\Client;
use App\Models\Mascota;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($client)
    {
        $client = Client::findOrFail($client);

        return response(
            view('mascota.index', ['client' => $client]),
            200
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable($client)
    {
        $client = Client::find($client);
        $mascota = $client->mascota;
        $mascota =  $mascota->map(function (Mascota  $mascota) {
            return array_merge($mascota->toArray(), [
                'edit_url' => route('mascota.edit', [
                    'id' => $mascota->id,
                ]),
                'delete_url' =>  route('mascota.destroy', [
                    'id' =>  $mascota->id,
                ]),


            ]);
        });
        return datatables()->of($mascota->toArray())->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($client)
    {
        $client = Client::find($client);
        return response(
            view(
                'mascota.create',
                [
                    'client' => $client,
                    'mascota' => new Mascota()
                ]
            ),
            200
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MascotaStore $request, $client)
    {
        $mascota = new Mascota();
        $mascota->client_id = $client;
        $mascota->nombre = $request->nombre;
        $mascota->raza = $request->raza;
        $mascota->fecha_nacimiento = $request->fecha_nacimiento;
        $mascota->save();
        session()->flash('success', trans('messages.mascota.action.create'));
        return response()->redirectToRoute('mascota.list', ['client' => $client]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mascota = Mascota::findOrFail($id);

        return response(
            view(
                'mascota.edit',
                ['mascota' => $mascota]
            ),
            200
        );
        dd('sad');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MascotaStore $request, $id)
    {
        $mascota = Mascota::findOrFail($id);
        $mascota->nombre = $request->nombre;
        $mascota->raza = $request->raza;
        $mascota->fecha_nacimiento = $request->fecha_nacimiento;
        $mascota->save();

        session()->flash('success', trans('messages.mascota.action.edit'));
        return response()->redirectToRoute('mascota.list', ['client' => $mascota->client_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}