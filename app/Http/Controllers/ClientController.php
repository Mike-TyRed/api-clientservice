<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
 
    public function index()
    {
        //Retornar todos los clientes
        $client = Client::all();

        //Agregar los servicios a los clientes
        $client->load('services');

        return response()->json($client);
    }
 
    public function store(Request $request)
    {
        //
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();

        $data = [
            'message' => 'Client created successfully',
            'client' => $client
        ];

        return response()->json($data);
    }
 
    public function show(Client $client)
    {
        //
        return response()->json($client->withPivot());
    }
 
    public function update(Request $request, Client $client)
    {
        //
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();

        $data = [
            'message' => 'Client updated successfully',
            'client' => $client
        ];

        return response()->json($data);
    }
 
    public function destroy(Client $client)
    {
        //
        $client->delete();

        $data = [
            'message' => 'Client deleted successfully',
            'client' => $client
        ];

        return response()->json($data);
    }

    public function attach(Request $request){

        $client = Client::find($request->client_id);

        //Crea un servicio para la tabla clientes
        $client->services()->attach($request->service_id);
        $data = [
            'message' => 'Service attached successfully',
            'client' => $client
        ];
        return response()->json($data);
    }

    public function detach(Request $request){

        $client = Client::find($request->client_id);

        //Elimina un servicio para la tabla clientes
        $client->services()->detach($request->service_id);
        $data = [
            'message' => 'Service detached successfully',
            'client' => $client
        ];
        return response()->json($data);
    }
}
