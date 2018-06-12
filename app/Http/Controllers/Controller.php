<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Mission,App\Vehicule,App\Depence,App\User;
use PDF;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){

      $this->middleware('auth');
    }

  /*  public function validate($id)
    {
        $mission = Mission::find($id);
        if($mission->validation ==0){
        $vehicule = Vehicule::where('id','=',$mission->vehicule_id)->update(['disponibilite'=>1]);
        $mission->validation = 1;
        $mission->save();
        session()->flash('success','Mission validée!!');
        redirect('mission');
        return $this->getPdf($id);
        }
        else {
          session()->flash('danger','Mission déja validée!!');
          return redirect('mission');
        }
    }*/

    public function getPdf($id){
      $mission = Mission::find($id);
      $user = User::where('id','=',$mission->user_id)->get();
      $vehicule = Vehicule::where('id','=',$mission->vehicule_id)->get();
      $depence = Depence::where('mission_id','=',$mission->id)->get();
      $total = Depence::sum('montant');
      $pdf = PDF::loadView('facture',compact('mission','user','vehicule','depence','total'));
        return $pdf->setPaper('a4','landscape')->download('facture.pdf');
    }
}
