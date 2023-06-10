<?php

namespace App\Http\Controllers;

use App\Models\NoteUser;
use Illuminate\Http\Request;

class NoteUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = NoteUser::join('users', 'users.id', 'note_user.user_id')
            ->select('note_user.*', 'users.name')
            ->orderBy('created_at', 'DESC')
            ->get();
            return view('noteUsers.index', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NoteUser  $noteUser
     * @return \Illuminate\Http\Response
     */
    public function show(NoteUser $noteUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NoteUser  $noteUser
     * @return \Illuminate\Http\Response
     */
    public function edit(NoteUser $noteUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NoteUser  $noteUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NoteUser $noteUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NoteUser  $noteUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(NoteUser $noteUser)
    {
        //
    }
}
