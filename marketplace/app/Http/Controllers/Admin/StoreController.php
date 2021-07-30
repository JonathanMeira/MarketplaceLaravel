<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    public function index()
    {
        $stores = \App\Store::paginate(10);
        return view('admin.stores.index', compact('stores'));
    }

    public function create(){
        $users = \App\User::all(['id','name']);
        return view('admin.stores.create', compact('users'));
    }


    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $user = auth()-> user();
        $store = $user->store()->create($data);

        flash('Store creation was an success')->success();        
        return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
        $store = \App\Store::findOrFail($store);
        return view('admin.stores.edit',compact('store'));
    }

    public function update(StoreRequest $request, $store)
    {
        $data = $request->all();
        $store = \App\Store::find($store);
        $store->update($data);

        flash('Store update was an success')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = \App\Store::find($store);
        $store->delete();

        flash('Store deletion was an success')->success();
        return redirect()->route('admin.stores.index');
    }


}
