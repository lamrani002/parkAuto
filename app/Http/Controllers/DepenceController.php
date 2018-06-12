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
      $user = Auth::user()->id;
      if(Auth::user()->is_admin){
        $depences =Depence::all();
        $total = Depence::sum('montant');
      }
      else {

        $mission = Mission::where([['user_id','=',$user],['validation','=',0]])->first();
        $depences = Depence::where([['user_id','=',$user],['mission_id','=',$mission->id]])->get();
        $total = Depence::where([['user_id','=',$user],['mission_id','=',$mission->id]])->sum('montant');
      }
        return view('depence.index',['depences'=>$depences,'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user()->fonction;
        $mission = Mission::where([['user_id',Auth::user()->id],['validation','=','0']])->get();
        if($user =='cadre'){
          $prix=5;
        }
        elseif ($user == 'Technicien') {
          $prix=4;
        }
        elseif ($user == 'agent') {
          $prix=3;
        }
        else {
          $prix=0;
        }
        return view('depence.create',['mission'=>$mission,'user'=>$user,'prix'=>$prix]);
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
          $user = Auth::user()->fonction;
          $prix=0;
          if($user =='cadre'){
            $prix=5*$request->nbrKm;
          }
          elseif ($user == 'Technicien') {
            $prix=4*$request->nbrKm;
          }
          elseif ($user == 'agent') {
            $prix=3*$request->nbrKm;
          }
          else {
            $prix=0;
          }
        $depence->user_id = Auth::user()->id;
        $depence->nbrKm  =$request->input('nbrKm');
        $depence->montant = $prix;
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
