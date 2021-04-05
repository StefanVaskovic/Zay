<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class ContactController extends ParentController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('pages.contact', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        DB::beginTransaction();
        try {
            $contact = new Contact();
            $contact->name = $request->input('name');
            $contact->email = $request->input('email');
            $contact->subject = $request->input('subject');
            $contact->message = $request->input('message');
            $contact->save();


            Mail::to('testiranjesajta2000@gmail.com')->send(new ContactMail($contact));

            $request->session()->put('success', 'You have successfully sent a message!');

            DB::commit();

            return response()->view('pages.contact', $this->data)->setStatusCode(201);

        } catch (\PDOException $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            $request->session()->put('error', 'We have a problems with server!');
            return response()->view('pages.contact', $this->data)->setStatusCode(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
