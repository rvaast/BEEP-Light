<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sensor;

class SensorController extends Controller
{
    
    protected $sensorTypes = ['HAP'=>'Household Air Pollution (HAP)','SSU'=>'Standard Surface Unit (SSU)','SUM'=>'Stove Usage Monitoring (SUM)','WAP'=>'Water Pressure unit (WAP)','Other'=>'Other'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sensors = Sensor::orderBy('id','DESC')->paginate(10);
        return view('sensors.index',compact('sensors'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = $this->sensorTypes;
        return view('sensors.create',compact('types'));
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
            'name' => 'required',
            'type' => 'required',
            'key' => 'required',
        ]);

        Sensor::create($request->all());

        return redirect()->route('sensors.index')
                        ->with('success','Sensor created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Sensor::find($id);
        return view('sensors.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Sensor::find($id);
        $types = $this->sensorTypes;
        return view('sensors.edit',compact('item','types'));
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
            'name' => 'required',
            'type' => 'required',
            'key' => 'required',
        ]);

        Sensor::find($id)->update($request->all());

        return redirect()->route('sensors.index')
                        ->with('success','Sensor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sensor::find($id)->delete();
        return redirect()->route('sensors.index')
                        ->with('success','Sensor deleted successfully');
    }
}