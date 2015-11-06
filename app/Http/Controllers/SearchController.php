<?php

namespace App\Http\Controllers;

use App\Email_spam\Facades\Search;
use Illuminate\Http\Request;
use App\Http\Requests;

class SearchController extends Controller {

    /**
     * Create a new search controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show search results.
     *
     * @param Request $request
     * @return string
     */
    public function index(request $request)
    {
        $result['search'] = $request['search'];

        if ($result['search'] != null)
        {
            $result['customers'] = Search::customers($result['search'])->all();
            $result['emails'] = Search::emails($result['search'])->all();
        } else {
            $result['search'] = "You didn't search for anything";
        }

        return view('search.index')->with($result);
    }
}
