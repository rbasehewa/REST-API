<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::get();
        return $exams;
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
            'code' => 'required',
            'name' => 'required',
        ]);


        if ($validator->fails()) {
            return ['response'=> $validator->messages(), 'success' => false];
        }

        $exam = new Exam();
        $exam->code = $request->input('code');
        $exam->name = $request->input('name');
        $exam->start_time = Carbon::parse($request->input('start_time'));
        $exam->end_time = Carbon::parse($request->input('end_time'));
        $exam->save();
        return response()->json($exam);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return single exam

        $exam = Exam::find($id);
        return response()->json($exam);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $request , int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), 
        [
            'code' => 'required',
            'name' => 'required'
        ]);


        if ($validator->fails()) {
            return ['response'=> $validator->messages(), 'success' => false];
        }

        $exam = Exam::find($id);
        $exam->code = $request->input('code');
        $exam->name = $request->input('name');
        $exam->start_time = Carbon::parse($request->input('start_time'));
        $exam->end_time = Carbon::parse($request->input('end_time'));
        $exam->save();
        return response()->json($exam);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $exam = Exam::find($id);
            $exam->delete();
            return ['response' => 'Exam deleted', 'success' => 'true'];
    }



    /**
     * filtered by a partial code and partial name
     *
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */ 

    public function list(Request $request)
    {

        $name = $request->input('name');
        $code = $request->input('code');
        $query = Exam::query();
        if(isset($name)) {
            $query = $query->where('name','like','%'.$name.'%');
        }
        if(isset($code)){
            $query = $query->where('code','like','%'.$code.'%');
        }
        return $query->get();
    }
}
