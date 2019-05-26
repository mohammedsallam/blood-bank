<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::where('is_read', 0)->paginate(20);
        $reads = Contact::where('is_read', 1)->paginate(20);
        return view('contacts.index', compact(['contacts', 'reads']));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * UPDATE `contacts` SET `is_read` = '0'
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        dd($id);
        $record = Contact::findOrFail($id);
        $record->delete();
        return redirect(route('contacts.index'))->with('success', 'Contact deleted successfully');

    }

    public function read()
    {
        $contacts = Contact::where('is_read', 0)->paginate(20);
        $reads = Contact::where('is_read', 1)->paginate(20);
        return view('contacts.read', compact(['contacts', 'reads']));
    }

    public function trash()
    {
        $contacts = Contact::where('is_read', 0)->paginate(20);
        $reads = Contact::where('is_read', 1)->paginate(20);
        return view('contacts.read', compact(['contacts', 'reads']));
    }
}
