<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Social;
use Hash;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials = Social::all();
        $data = array(
            'socials' => $socials, 
        );
        return view('dashboard.socials.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.socials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
        ]);
       

        // Create social
        $social = new Social;
        $social->facebook = $request->input('facebook');
        $social->twitter = $request->input('twitter');
        $social->google_plus = $request->input('linkedin');
        $social->linkedin = $request->input('linkedin');
        $social->pinterest = $request->input('pinterest');
        $social->instagram = $request->input('instagram');
        $social->user_id = $request->input('user_id');
        $social->save();

        return Redirect::back()->with('success', 'Social Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $social = Social::find($id);
        $data = array(
            'social' => $social
        );
        return view('dashboard.socials.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $social = Social::find($id);
        $data = array(
            'social' => $social
        );
        return view('dashboard.socials.edit')->with($data);
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
        $this->validate($request, [
            'user_id' => 'required',
        ]);
       

        // Create social
        $social = Social::find($id);
        $social->facebook = $request->input('facebook');
        $social->twitter = $request->input('twitter');
        $social->google_plus = $request->input('linkedin');
        $social->linkedin = $request->input('linkedin');
        $social->pinterest = $request->input('pinterest');
        $social->instagram = $request->input('instagram');
        $social->user_id = $request->input('user_id');
        $social->save();

        return Redirect::back()->with('success', 'Social Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Social
        $social = Social::find($id);

        $social->delete();

        return Redirect::back()->with('success', 'Social Deleted');
    }
}
