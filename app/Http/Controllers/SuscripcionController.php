<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovimientoStore;
use App\Models\Suscripcion;
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

        $movimientos = SuscripcionMovimiento::where('suscripcion_id', $suscripcion)->get();

        $movimientos =  $movimientos->map(function (SuscripcionMovimiento $movimiento) {
            $movimiento->data = json_decode($movimiento->data);

            return array_merge($movimiento->toArray(), [
                'delete_url' =>  route('movimiento.destroy', [
                    'id' =>  $movimiento->id,
                ]),
                'date' => date("Y-m-d", strtotime($movimiento->created_at)),
                'monto' => $movimiento->data->pago->valor,
                'estado' => ucfirst($movimiento->data->pago->estado),

            ]);
        });
        return datatables()->of($movimientos->toArray())->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($suscripcion)
    {
        return response(
            view('suscripcion.create', ['suscripcion' => $suscripcion]),
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovimientoStore $request, $suscripcion)
    {
        //dd($request->request);
        $movimiento = SuscripcionMovimiento::where('suscripcion_id', $suscripcion)->get()->groupBy('tipo')->toArray();
        $impago = isset($movimiento['impago'])  ? count($movimiento['impago']) * floatval(trans('fields.suscripcion.costo')) : 0;
        $pago =  0;
        if (isset($movimiento['pago'])) {

            foreach ($movimiento['pago'] as $item) {
                $data = json_decode($item['data']);
                if ($data->pago->estado == 'exitoso')
                    $pago = $pago + $data->pago->valor;
            }
        }

        $suscripcion = Suscripcion::find($suscripcion);
        $movimiento = new SuscripcionMovimiento();
        $movimiento->suscripcion_id =  $suscripcion->id;
        $movimiento->tipo = trans('fields.suscripcion.tipo.0');
        if ($pago < $impago) {

            $movimiento->data = json_encode([
                'cliente' => $suscripcion->mascota->client->toArray(),
                'mascota' => $suscripcion->mascota->toArray(),
                'pago' => ['estado' => 'exitoso', 'valor' => floatval($request->monto)]
            ]);
            $movimiento->save();
            session()->flash('success', trans('messages.suscripcion.action.create'));
            return response()->redirectToRoute('movimientos.list', ['suscripcion' => $suscripcion]);
        } else {
            $movimiento->data = json_encode([
                'cliente' => $suscripcion->mascota->client->toArray(),
                'mascota' => $suscripcion->mascota->toArray(),
                'pago' => ['estado' => 'fallo', 'valor' => floatval($request->monto)]
            ]);
            $movimiento->save();
            session()->flash('error', trans('messages.suscripcion.action.error'));
            return response()->redirectToRoute('movimientos.list', ['suscripcion' => $suscripcion]);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        SuscripcionMovimiento::find($id)->delete();
        session()->flash('success', trans('messages.suscripcion.action.delete'));
        return redirect()->back();
    }
}