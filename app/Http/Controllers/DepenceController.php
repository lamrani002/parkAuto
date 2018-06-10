<?php

namespace App\Http\Controllers;

use App\Depence,App\Mission;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Auth;

class DepenceController extends Controller
{

  public function __construct(){

    $this->middleware('auth');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mission = Auth::user()->missions;
        $depences = Depence::where('mission_id')->get();
        $total = Depence::where('mission_id')->sum('montant');
        return view('depence.index',['depences'=>$depences,'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mission = Mission::where('user_id','=',Auth::user()->id)->get();
        $depence = Depence::where('mission_id','=','$mission->id')->get();
        return view('depence.create',['mission'=>$mission]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $depence = new Depence;
        $depence->type = $request->input('type');
        if ($request->hasFile('bon')){
            $depence->bon = $request->bon->store('img');
          }
        $depence->montant = $request->input('montant');
        $depence->mission_id = $request->input('mission_id');
        $depence->save();
        session()->flash('success','depence  ajoutée!!');
        return redirect('depence');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Depence  $depence
     * @return \Illuminate\Http\Response
     */
    public function show(Depence $depence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Depence  $depence
     * @return \Illuminate\Http\Response
     */
    public function edit(Depence $depence)
    {   $mission = Mission::where('user_id','=',Auth::user()->id)->get();
        $depence = Depence::find($depence->id);
        return view('depence.edit',['depence' => $depence,'mission'=>$mission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Depence  $depence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Depence $depence)
    {
      $depence = Depence::find($depence->id);
      $depence->type = $request->input('type');
      if ($request->hasFile('bon')){
          $depence->bon = $request->bon->store('img');
        }
      $depence->montant = $request->input('montant');
      $depence->mission_id = $request->input('mission_id');
      $depence->save();
      session()->flash('success','depence  modifiée!!');
      return redirect('depence');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Depence  $depence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depence $depence)
    {
      $depence = Depence::find($depence->id);
      $depence->delete();
      return redirect('depence');
    }
}
