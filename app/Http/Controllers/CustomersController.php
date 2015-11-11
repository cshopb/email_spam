<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCustomersRequest;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $customer = Auth::user()->customers()->findOrFail($id);

        return view('customers.edit', compact('customer'));
    }

    public function update(UpdateCustomersRequest $request, $id)
    {
        $customer = Auth::user()->customers()->findOrFail($id);

        $customer->update($request->all());

        return redirect()->action('EmailsController@index');
    }

    public function destroy($id)
    {
        $customer = Auth::user()->customers()->findOrFail($id);

        $customer->delete();

        return redirect()->action('EmailsController@index');
    }
}
