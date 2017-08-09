<?php

namespace App\Http\Controllers;

use App\Person;
use Validator;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Person::where('active',true)->get();
        return response()->json($people);
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
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:70',
            'surname'=>'required|max:70',
            'wage'=>'required|numeric|max:3000000',
            'gender'=>'required|max:70',
            'departments'=>'required',
        ]);
        if ($validator->fails()) {
          return response()->json(['message'=>'Правильно заполните все поля'],500);
        }
        $person = new Person;
                $person->name = $request->name;
                $person->surname = $request->surname;
                $person->wage = $request->wage;
                $person->gender = $request->gender;
                $person->save();
                $person->departments = $request->departments;
        return response()->json(['success'=>'true']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:70',
            'surname'=>'required|max:70',
            'wage'=>'required|numeric|max:3000000',
            'gender'=>'required|max:70',
            'departments'=>'required',
        ]);
        if ($validator->fails()) {
          return response()->json(['message'=>'Правильно заполните все поля'],500);
        }
        $person->name = $request->name ?? $person->name;
        $person->surname = $request->surname ?? $person->surname;
        $person->wage = $request->wage ?? $person->wage;
        $person->gender = $request->gender ?? $person->gender;
        $person->save();
        $person->departments = $request->departments ?? $person->departments;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();
    }
}
