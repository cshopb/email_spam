<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Email;
use App\Email_spam\Facades\Flash;
use App\Http\Requests\CommitEmailsRequest;
use App\Http\Requests\PrepareEmailsRequest;
use App\Http\Requests\UpdateEmailsRequest;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use PDOException;
use Session;

class EmailsController extends Controller {

    /**
     * Create a new emails controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all emails for the logged in user and assign the customer name.
     *
     * @param Request $request
     * @return string
     */
    public function index(request $request)
    {
        $data = $request->input();

        $customers_list = $this->customers_list();

        if ($data == null || $data['customer_id'] == 'all')
        {
            $customers = Auth::user()->customers()->orderBy('name', 'asc')->get();
        } else
        {
            $customers = Auth::user()->customers()->where('id', $data['customer_id'])->get();
        }

        foreach ($customers as $customer)
        {
            $customer['emails'] = $customer->emails()->orderBy('list', 'asc')->get();
        }

        return view('emails.index', compact(['customers', 'customers_list']));
    }

    /**
     * Show a page to add new emails.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $customers = Auth::user()->customers()->lists('name', 'name');

        return view('emails.create', compact('customers'));
    }

    /**
     * Ask the user to confirm the emails entered.
     *
     * @param PrepareEmailsRequest $request
     * @return \Illuminate\View\View
     */
    public function confirm(PrepareEmailsRequest $request)
    {
        $data = $request->all();

        $customer = Auth::user()->customers()->firstOrCreate(['name' => $data['customer_name']]);

        $data['customer_id'] = $customer->id;
        $data['emails'] = $this->extractEmails($data['emails']);
        $isEmail = $this->isEmail($data['emails'], $data['list'], $data['customer_id']);

        $data = $data + $this->assignViewElements($data['list'], $isEmail);

        Session::put('list', $request['list']);
        Session::put('customer_id', $data['customer_id']);

        return view('emails.confirm', $data);
    }

    /**
     * Saves the provided emails.
     *
     * @param CommitEmailsRequest $request
     * @return \redirect
     */
    public function store(CommitEmailsRequest $request)
    {
        $customer = new Customer();
        $customer['id'] = session()->get('customer_id');
        $data['list'] = session()->get('list');

        foreach ($request['email'] as $data['email'])
        {
            $email = Email::add($data);

            // Try to enter the new emails.
            // If the email is in the other list it will update it to the requested one.
            try
            {
                $customer->emails()->save($email);
            } catch (PDOException $e)
            {
                if ($e->errorInfo[0] == 23000 && $e->errorInfo[1] == 1062)
                {
                    Email::where('customer_id', $customer->id)
                        ->where('email', $data['email'])
                        ->update(['list' => $data['list']]);
                } else
                {
                    dd('There was an error!');
                }
            }
        }

        Flash::success('The new emails are added');

        return redirect()->action('EmailsController@index');
    }

    /**
     * Accepts the AJAX request and dynamically checks if the email in the input box
     * is still properly formatted and if it exists in the other list.
     *
     * @param Request $request
     * @return string
     */
    public function Refresh(Request $request)
    {
        if ($request->ajax())
        {
            $email[0] = $request['emailToCheck'];
            $customer_id = session()->get('customer_id');
            $list = session()->get('list');

            $result = $this->isEmail($email, $list, $customer_id);

            return $result[0];
        } else
        {
            return 'Incorrect request';
        }
    }

    /**
     * Show a page to edit all the emails for the requested customer.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $email = Auth::user()->emails()->findOrFail($id);
        $customer_name = Customer::name($email->customer_id)->first();

        return view('emails.edit', compact(['email', 'customer_name']));
    }

    /**
     * Update the requested email.
     *
     * @param UpdateEmailsRequest $request
     * @param $id
     * @return \redirect
     */
    public function update(UpdateEmailsRequest $request, $id)
    {
        $email_old = $email = Auth::user()->emails()->findOrFail($id);

        $email->update($request->except('customers'));

        Flash::message($email_old['email'] .' updated successfully to: ' .$email['email']);

        return redirect()->action('EmailsController@index');
    }


    /**
     * Delete the requested email entry.
     *
     * @param $id
     * @return \redirect
     * @throws \Exception
     */
    public function destroy($id)
    {
        $email = Auth::user()->emails()->findOrFail($id);

        $email->delete();

        Flash::error($email['email'] .'has been deleted');

        return redirect()->action('EmailsController@index');
    }

    //<editor-fold desc="Private Functions">
    /*******************************************************************/
    /*******************************************************************/
    /**                                                               **/
    /**                       Private Functions                       **/
    /**                                                               **/
    /*******************************************************************/
    /*******************************************************************/

    /**
     * Takes the provided list of emails and extracts them individually
     *
     * @param $emails
     * @return array|mixed
     */
    private function extractEmails($emails)
    {
        // preg_replace with this setup will remove whitespace and space.
        $emails = preg_replace('/\s+/', '', $emails);
        $emails = explode(';', $emails);

        return $emails;
    }

    /**
     * Checks if the email provided is properly formatted
     * and if it already exists in the other list.
     *
     * @param $emails
     * @param $list
     * @param $customer_id
     * @return array
     */
    private function isEmail($emails, $list, $customer_id)
    {
        $list_to_check = ($list == 'black_list') ? 'white_list' : 'black_list';

        $email_status = null;

        for ($email_no = 0; $email_no < count($emails); $email_no++)
        {
            $email_status[$email_no] = (filter_var($emails[$email_no], FILTER_VALIDATE_EMAIL)) ? 'isEmail' : 'notEmail';
            // This was the only way I knew how to make it an array and not a collection. With lists->all.
            $email_exists = Auth::user()->emails()->Exists($customer_id, $list_to_check, $emails[$email_no])
                ->get(['email'])->all();
            if ($email_exists != null)
            {
                $email_status[$email_no] = 'emailExists';
            }
        }

        return $email_status;
    }

    /**
     * Assigns values to the elements on the view page depending on what list
     * we are adding the emails and if there are errors with emails.
     *
     * @param $list
     * @param $isEmail
     * @return mixed
     */
    private function assignViewElements($list, $isEmail)
    {
        // White list elements
        $name_white_list = 'white list';
        $button_white_list = 'btn btn-default';
        $panel_white_list = 'panel panel-default';

        // Black list elements
        $name_black_list = 'black list';
        $button_black_list = 'btn btn-primary';
        $panel_black_list = 'panel panel-primary';

        //glyphicons
        $glyphicon_isEmail = 'glyphicon-ok';
        $glyphicon_notEmail = 'glyphicon-remove';
        $glyphicon_emailExists = 'glyphicon-warning-sign';

        //input feedback colors
        $isEmail_color = 'has-success';
        $notEmail_color = 'has-error';
        $emailExists_color = 'has-warning';

        if ($list == 'white_list')
        {
            $result['list_type'] = $name_white_list;
            $result['button'] = $button_white_list;
            $result['panel'] = $panel_white_list;
        } else
        {
            $result['list_type'] = $name_black_list;
            $result['button'] = $button_black_list;
            $result['panel'] = $panel_black_list;
        }

        for ($email_count = 0; $email_count < count($isEmail); $email_count++)
        {
            if ($isEmail[$email_count] == 'isEmail')
            {
                $result['icon'][$email_count] = $glyphicon_isEmail;
                $result['input_color_feedback'][$email_count] = $isEmail_color;
            } elseif ($isEmail[$email_count] == 'notEmail')
            {
                $result['icon'][$email_count] = $glyphicon_notEmail;
                $result['input_color_feedback'][$email_count] = $notEmail_color;
            }

            if ($isEmail[$email_count] == 'emailExists')
            {
                $result['icon'][$email_count] = $glyphicon_emailExists;
                $result['input_color_feedback'][$email_count] = $emailExists_color;
            }
        }

        return $result;
    }

    /**
     * List for the drop down menu on index page.
     *
     * @return array
     */
    private function customers_list()
    {
        return ['all' => '<ALL>'] + Auth::user()->customers()->list()->all();
    }
    //</editor-fold>
}
