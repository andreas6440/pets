<?php

namespace App\Http\Controllers;

use App\Models\SuscripcionMovimiento;
use Illuminate\Http\Request;

class SuscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($suscripcion)
    {
        return response(
            view('suscripcion.index', ['suscripcion' => $suscripcion]),
            200
        );
    }

    public function datatable($suscripcion)
    {

        $movimientos = SuscripcionMovimiento::where('suscripcion_id', $suscripcion)->orderBy('created_at')->get();

        $movimientos =  $movimientos->map(function (SuscripcionMovimiento $movimiento) {
            $movimiento->data = json_decode($movimiento->data);

            return array_merge($movimiento->toArray(), [
                'delete_url' =>  route('movimiento.destroy', [
                    'id' =>  $movimiento->id,
                ]),
                'date' => date("Y-m-d", strtotime($movimiento->created_at)),
                'monto' => $movimiento->data->pago->valor,

            ]);
        });
        return datatables()->of($movimientos->toArray())->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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