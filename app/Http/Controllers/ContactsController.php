<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts')
            ->with('horisontalBanners', Banner::randHorisontal(3));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

}
