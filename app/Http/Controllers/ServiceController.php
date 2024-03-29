<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
 
    public function index()
    {
        //
        $service = Service::all();
        return response()->json($service);
    }
 
    public function store(Request $request)
    {
        //
        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();

        $data = [
            'message' => 'Service created successfully',
            'service' => $service
        ];

        return response()->json($data);
    }
 
    public function show(Service $service)
    {
        //
        return response()->json($service);
    }
 
    public function update(Request $request, Service $service)
    {
        //
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();

        $data = [
            'message' => 'Service updated successfully',
            'service' => $service
        ];

        return response()->json($data);
    }
 
    public function destroy(Service $service)
    {
        //
        $service->delete();

        $data = [
            'message' => 'Service deleted successfully',
            'service' => $service
        ];

        return response()->json($data);
    }

    public function clients(Request $request){

        // $service = Service::find($request->service_id);
        // $service->clients()->attach($request->client_id);
        // $service->load('clients');
        // return response()->json($service);

        $service = Service::find($request->service_id);
        $clients = $service->clients()->get();
        $data = [
            'message' => 'Clients attached successfully',
            'clients' => $clients
        ];
        return response()->json($data);
    }
}
