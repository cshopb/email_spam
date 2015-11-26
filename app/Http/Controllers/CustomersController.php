<?php

namespace App\Http\Controllers;

use App\Email_spam\Facades\Flash;
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

        Flash::message('Update successful.');

        return redirect()->action('EmailsController@index');
    }

    public function destroy($id)
    {
        $customer = Auth::user()->customers()->findOrFail($id);

        $customer->delete();

        Flash::error('User deleted.');

        return redirect()->action('EmailsController@index');
    }
}
