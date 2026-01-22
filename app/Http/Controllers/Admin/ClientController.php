<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {

        $query = Client::query();
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%" . $request->search . "%")
                    ->orWhere('phone', 'like', '%' .$request->search . '%'  )
                    ->orWhere('code', $request->search)
                    ->orWhere('email', $request->search)
//                    ->orWhere('active', $request->search)
                    ->orWhere('person_res', 'like', '%' .$request->search . '%')->orWhere('address', 'like', '%' .$request->search . '%')->orWhere('ctype', $request->search);
            });
        }
        $clients = $query->latest()->paginate(config('app.pagination_num'))->appends($request->query());
        return view('admin/clients/index', compact('clients'));
    }

    public function create(Request $request)
    {
        return view('admin/clients/create');
    }

//    public function store(ClientRequest $clientRequest)
    public function store(ClientRequest $clientRequest)

    {
        client::create(array_merge($clientRequest->only([
            'name',
            'phone',
            'email',
            'address',
            'active',
            'person_res',
            'ctype',
        ]),
           ['code' => rand(100000 , 999999) , 'active' => (!$clientRequest->active ? 0 : 1)]

        ));
//     dd($m);
        return redirect(route('admin.clients.index'))->with(['success' => __('lang.you inserted  client successfully')]);
    }

    public function edit(Client $client)
    {
        return view('admin/clients/edit', compact('client'));
    }

    public function update(ClientRequest $clientRequest, Client $client)
    {
        $client->update(array_merge($clientRequest->only([
            'name',
            'phone',
            'email',
            'address',
            'active',
            'person_res',
            'ctype',
        ]),
            ['active' => (!$clientRequest->active ? 0 : 1)]

        ));
        return redirect()->back()->with(['success' => __('lang.client has been updated successfully')]);
    }


    public function destroy(Client $client)
    {
        dd($client->id);
        $client->delete();
        return redirect(route('admin.clients.index'))->with(['success' => 'lang.you have deleted  client successfully']);
    }




    //  used in ajax for print data
    public function getAllData(Request $request)
    {
        $query = Client::query();
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%" . $request->search . "%")
                    ->orWhere('phone', 'like', '%' .$request->search . '%'  )
                    ->orWhere('code', $request->search)
                    ->orWhere('email', $request->search)
//                    ->orWhere('active', $request->search)
                    ->orWhere('person_res', 'like', '%' .$request->search . '%')->orWhere('address', 'like', '%' .$request->search . '%')->orWhere('ctype', $request->search);
            });
        }
        $clients = $query->latest()->get();
        return view('admin.clients.print', compact('clients'));

    }


}
