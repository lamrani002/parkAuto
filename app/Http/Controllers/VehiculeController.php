<?php

namespace App\Http\Controllers;

use App\Vehicule,App\Mission;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Auth;

class VehiculeController extends Controller
{
    //limiter l'acces sauf s'il est connécté
    public function __construct(){

      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //select * from vehicules where disponibilite = 1
    public function index()
    {
      //si admin afficher tout les vehicules
      if(Auth::user()->is_admin){
        $v = Vehicule::all();
      }
      else {
        $v = Vehicule::where('disponibilite','=','1')->get();
      }
        return view('vehicule.index',['vehicules' => $v]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('vehicule.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     //insert into DBvehcule
    public function store(Request $request)
    {
        $vehicule = new Vehicule;
        $vehicule->matricule = $request->input('matricule');
        $vehicule->marque = $request->input('marque');
        $vehicule->model = $request->input('model');
        $vehicule->carburateur = $request->input('carburateur');
        $vehicule->disponibilite = $request->input('disponibilite');
        $vehicule->kilometrage = $request->input('kilometrage');
        if ($request->hasFile('photo')){
            $vehicule->photo = $request->photo->store('img');
          }
        $vehicule->save();
        session()->flash('success','le vehicule à été bien enregistré !!');
        return redirect('vehicule');
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
     //select * from vehicules where id = $vehicule passer en parrametre
     //reserver vehicule pour l'agent
    public function show(Vehicule $vehicule)
    {
        $v = Vehicule::find($vehicule->id);
        if ($v->disponibilite ==0) {
          session()->flash('danger','le vehicule est déja resérver !!');
          return redirect('vehicule');
        }
        else {
        $user = Auth::user()->id;
        $mission = Mission::where('user_id','=',$user)->update(['vehicule_id'=>$v->id]);
        $v->disponibilite = 0;
        $v->save();
        session()->flash('success','le vehicule à été bien resérver !!');
        return redirect('mission');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
     //relurn la view edit
    public function edit($id)
    {
      $v = Vehicule::find($id);
      $this->authorize('update',$v); //autoriser l'acces a editer un vehicule
      return view('vehicule.edit',['v' => $v]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
     //update vehicules set (champs...)=valeur where id = $id
    public function update(Request $request, $id)
    {
      $vehicule = Vehicule::find($id);
      $this->authorize('update',$vehicule);
      $vehicule->matricule = $request->input('matricule');
      $vehicule->marque = $request->input('marque');
      $vehicule->model = $request->input('model');
      $vehicule->carburateur = $request->input('carburateur');
      $vehicule->disponibilite = $request->input('disponibilite');
      $vehicule->kilometrage = $request->input('kilometrage');
      if ($request->hasFile('photo')){
          $vehicule->photo = $request->photo->store('img');
        }
      $vehicule->save();
      session()->flash('success','le vehicule à été bien modifié !!');
      return redirect('vehicule');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
     //delete from vehicules where id = $vehicule;
    public function destroy(Vehicule $vehicule)
    {
      $vehicule = Vehicule::find($vehicule->id);
      $this->authorize('delete',$vehicule);
      $vehicule->delete();
      return redirect('vehicule'); //return view index
    }
}
