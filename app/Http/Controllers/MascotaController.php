<?php

namespace App\Http\Controllers;

use App\Http\Requests\MascotaStore;
use App\Models\Client;
use App\Models\Mascota;
use App\Models\Suscripcion;
use App\Models\SuscripcionMovimiento;
use Carbon\Carbon;
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
                'suscripcion' => date("Y-m-d", strtotime($mascota->suscripcion->fecha_alta_suscripcion)),


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

        $suscripcion = new Suscripcion();
        $suscripcion->mascota_id = $mascota->id;
        $suscripcion->fecha_alta_suscripcion = Carbon::now();
        $suscripcion->costo_suscripcion = floatval(trans('fields.suscripcion.costo'));
        $suscripcion->save();

        $movimiento = new SuscripcionMovimiento();
        $movimiento->suscripcion_id =  $suscripcion->id;
        $movimiento->tipo = trans('fields.suscripcion.tipo.1');
        $movimiento->data = json_encode([
            'cliente' => $mascota->client->toArray(),
            'mascota' => $mascota->toArray(),
            'pago' => ['estado' => 'exitoso', 'valor' => floatval(trans('fields.suscripcion.costo'))]
        ]);
        $movimiento->save();
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
        $mascota = Mascota::findOrFail($id);
        $mascota->suscripcion->movimientos()->delete();
        $mascota->suscripcion()->delete();
        $mascota->delete();
        session()->flash('success', trans('messages.mascota.action.delete'));
        return redirect()->back();
    }
}