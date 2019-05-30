<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $contacts = Contact::where('is_read', 0)->where('deleted_at', null)->paginate(20);
        $reads = Contact::where('is_read', 1)->where('deleted_at', null)->paginate(20);
        $trash = Contact::where('deleted_at', 1)->paginate(20);
        return view('contacts.index', compact(['contacts', 'reads', 'trash']));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {

        $record = Contact::findOrFail($id);
        $record->is_read = 1;
        $record->save();
        return view('contacts.show', compact('record'));
    }


    /**
     * UPDATE `contacts` SET `is_read` = '0'
     * @param $id
     */

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        if ($contact->is_read == 1){

            $contact->is_read = 0;
        } else {
            $contact->is_read = 1;
        }
        $contact->save();
    }


    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function delete(Request $request)
    {
        $ids = $request->id;

        if (!empty($ids)){
            $count = DB::table('contacts')->whereIn('id', $ids)->update(['deleted_at' => 1]);
            return responseJson(1, $count.' Messages add to trash');
        } else {
            return responseJson(0, 'No messages selected');
        }

    }


    /**
     * Show all read messages
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function read()
    {
        $contacts = Contact::where('is_read', 0)->where('deleted_at', null)->paginate(20);
        $reads = Contact::where('is_read', 1)->where('deleted_at', null)->paginate(20);
        $trash = Contact::where('deleted_at', 1)->paginate(20);
        return view('contacts.read', compact(['contacts', 'reads', 'trash']));
    }

    /**
     * how all trash messages
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function trash()
    {
        $contacts = Contact::where('is_read', 0)->where('deleted_at', null)->paginate(20);
        $reads = Contact::where('is_read', 1)->where('deleted_at', null)->paginate(20);
        $trash = Contact::where('deleted_at', 1)->paginate(20);
        return view('contacts.trash', compact(['contacts', 'reads', 'trash']));
    }
}
