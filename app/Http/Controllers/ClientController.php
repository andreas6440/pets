<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStore;
use App\Models\Client;
use App\Models\Mascota;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return response(
            view('client.index'),
            200
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        $client = Client::orderBy('id');
        $client = $client->get()->map(function (Client $client) {
            return array_merge($client->toArray(), [
                'edit_url' => route('client.edit', [
                    'id' => $client->id,
                ]),
                'delete_url' =>  route('client.destroy', [
                    'id' => $client->id,
                ]),
                'mascota_url' =>  route('mascota.list', [
                    'client' => $client->id,
                ]),

            ]);
        });
        return datatables()->of($client->toArray())->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return response(
            view('client.create', ['client' => new Client()]),
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStore $request)
    {

        $client = new Client();
        $client->nombre = $request->nombre;
        $client->apellido = $request->apellido;
        $client->email = $request->email;
        $client->save();

        session()->flash('success', trans('messages.client.action.create'));
        return response()->redirectToRoute('client.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        return response()->json(['client' => $client])->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return response(
            view('client.edit', ['client' => $client]),
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
    public function update(ClientStore $request, $id)
    {

        $client = Client::findOrFail($id);
        $client->nombre = $request->nombre;
        $client->apellido = $request->apellido;
        $client->email = $request->email;
        $client->save();

        session()->flash('success', trans('messages.client.action.edit'));
        return response()->redirectToRoute('client.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->mascota()->delete();
        $client->delete();


        session()->flash('success', trans('messages.client.action.delete'));
        return response()->redirectToRoute('client.list');
    }
}