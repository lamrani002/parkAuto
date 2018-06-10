<?php

namespace App\Http\Controllers;

use App\Mission,App\Vehicule,App\Depence;
use Illuminate\Http\Request;
use Auth;
use App\User;

class MissionController extends Controller
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
        if(Auth::user()->is_admin){
          $user = User::all();
          $mission = Mission::all();
          $vehicules =  Vehicule::all();
        }
        else {
            $user = Auth::user()->get();
            $mission = Auth::user()->missions;
            $vehicules =  Vehicule::all();
        }

        return view('mission.index',['missions' => $mission,'vehicules' =>$vehicules,'user' =>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user =User::all();
        $vehicule = Vehicule::where('disponibilite','=','1')->get();
        return view('mission.create',['vehicule'=> $vehicule,'user' =>$user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicule = Vehicule::where('disponibilite','=',1)->get();
        $mission = new Mission;
        $mission->destination = $request->input('destination');
        $mission->description = $request->input('description');
        $mission->date_depart = $request->input('date_depart');
        $mission->date_arrive = $request->input('date_arrive');
        $mission->user_id = $request->input('user_id');
        $mission->vehicule_id = $request->input('vehicule_id');
        $mission->save();
        session()->flash('success','la mission à été bien ajoutée!!');
        return redirect('mission');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show(Mission $mission)
    {
        $mission = Mission::find($mission->id);
        $user =User::all();
        $vehicule = Vehicule::all();
        $depence = Depence::join('missions','depences.mission_id','=','missions.id')->Where('mission_id','=',$mission)->get();
        $total = Depence::sum('montant');
        return view('mission.show', ['mission' => $mission,'vehicule'=> $vehicule,'user' =>$user,'depence' => $depence,'total'=>$total]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function edit(Mission $mission)
    {
      $mission = Mission::find($mission->id);
      $user =User::all();
      $vehicule = Vehicule::where('disponibilite','=','1')->get();
      $this->authorize('update',$mission);
      return view('mission.edit', ['mission' =>$mission,'vehicule'=> $vehicule,'user' =>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $vehicule = Vehicule::where('disponibilite','=',1)->get();
        $mission = Mission::find($id);
        $this->authorize('update',$mission);
        $mission->destination = $request->input('destination');
        $mission->description = $request->input('description');
        $mission->date_depart = $request->input('date_depart');
        $mission->date_arrive = $request->input('date_arrive');
        $mission->user_id = $request->input('user_id');
        $mission->vehicule_id = $request->input('vehicule_id');
        $vehicule = Vehicule::where('id','=',$mission->vehicule_id)->update(['disponibilite' => 0]);
        $mission->save();
        session()->flash('success','la mission à été bien modifiée!!');
        return redirect('mission');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mission $mission)
    {
        $mission = Mission::find($mission->id);
        $mission->delete();
        return redirect('mission');
    }

}
