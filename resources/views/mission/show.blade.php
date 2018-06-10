@extends('layouts.app')
@section('content')
<div class="container bod" ng-if="existenDatos">
    <div class="row">
        <div class="col-md-4">
            <div class="frame frame-left">
            <div class="panel panel-default panel-alt widget-messaging panel-1">
                <div class="panel-body">
                    <ul>
                        <li ng-repeat="empresa in resultadoBusqueda track by $index">
                            <div ng-click="buscarInformacionEmpresa(empresa.id)">
                                <h5 class="sender">Mission ID: <strong>{{$mission->id}}</strong></h5>
                                <h5 class="sender">Date de création : <strong>{{$mission->created_at->day}}/{{$mission->created_at->month}}/{{$mission->created_at->year}} TIME({{$mission->created_at->hour}}:{{$mission->created_at->minute}})</strong></h5>
                                @foreach($user as $u)
                                  @if($mission->user_id == $u->id)
                                  <h5 class="sender">Agent(ID) : <strong>{{$u->id}}</strong></h5>
                                  <h5 class="sender">Agent(username) :  <strong>{{$u->name}}</strong></h4>
                                  @endif
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="frame frame-right">
            <div class="row vdivide">
                <div class="col col-lg-5 col-sm-6 col-xs-12 text-center">
                    <div class="panel panel-default panel-alt widget-messaging">
                        <div class="panel-body">
                            <ul>
                              @foreach($vehicule as $v)
                                 @if($mission->vehicule_id == $v->id)
                                <li>
                                    <h3 class="sender"><strong>VEHICULE</strong></h3>
                                    <h4> ID: {{$v->id}}</h5>
                                </li>
                                <li>
                                    <h5 class="sender">MATRICULE</h5>
                                    <h4>{{$v->matricule}}</h4>
                                </li>
                                <li>
                                    <h5 class="sender">CARBURATEUR/KILOMETRAGE</h5>
                                    <h4>{{$v->model}} / ({{$v->kilometrage}})</h4>
                                </li>
                                @endif
                              @endforeach
                                <li>
                                    <h5 class="sender">DUREE DE MISSION </h5>
                                    <h6><strong>De : {{$mission->date_depart}} -Au : {{$mission->date_arrive}}</strong></h6>
                                </li>
                                <li>
                                    <h5 class="sender">DESTINATION</h5>
                                    <h4>{{$mission->destination}}</h4>
                                </li>
                                <li>
                                    <h5 class="sender">DESCRIPTION DE MISSION</h5>
                                    <h4>{{$mission->description}}</h4>
                                </li>
                            </ul>
                        </div><!-- panel-body -->
                    </div>
                </div>
                <div class="col col-lg-5 col-sm-6 col-xs-12 text-center">
                    <div class="panel panel-default panel-alt widget-messaging">
                        <div class="panel-body">
                            <ul>
                              @foreach($depence as $dp)
                                <li>
                                    <h3 class="sender"><strong>DEPENCES</strong></h3>
                                    <h4>Durant la mission ID : {{$mission->id}}</h4>
                                </li>
                                @if($depence != NULL and $dp->mission_id == $mission->id)
                                <li>
                                    <h5 class="sender">TYPE</h5>

                                    <h6>
                                      <ul id="list">
                                        @foreach($depence as $d)
                                          <li style="color:black"><strong>{{$d->type}} : {{$d->montant}} DH</strong></li>
                                        @endforeach
                                      </ul>
                                    </h6>

                                </li>
                                  @endif
                                  @if($depence != NULL)
                                <li>
                                    <h5 class="sender">Justificatif</h5>
                                    <h4>@if($dp->bon == NULL and $dp->mission_id == $mission->id)
                                       NON
                                       @else
                                       OUI
                                       @endif
                                    </h4>
                                </li>
                                @endif
                                <li>
                                    <h5 class="sender">Montant Totale</h5>
                                    <h4>{{$total}} DH</h4>
                                </li>
                                @endforeach
                            </ul>

                        </div><!-- panel-body -->

                    </div>

                </div>

            </div>
              <!--buttons-->
                    <div class="btn-float">
                      @if(Auth::user()->is_admin && $mission->validation ==0)
                        <button type="button" class="btn btn-default btn-circle">
                          <a href="{{url('mission/'.$mission->id.'/validate')}}" title="valider"><i class="glyphicon glyphicon-ok"></i></a>
                        </button>
                      @endif
                        <button type="button" class="btn btn-default btn-circle">
                          <a href="{{url('mission/'.$mission->id.'/pdf')}}"><i class="glyphicon glyphicon-floppy-open"></i></a>
                        </button>
                        <button type="button" class="btn btn-default btn-circle"><i class="glyphicon glyphicon-trash"></i></button>
                    </div>
                    <!--fin buttons -->
            </div>
        </div>
    </div>


</div>
<style media="screen">
li{
      text-align: left;
}

.widget-messaging ul{
  list-style: none;
  padding: 0;
  margin: 0;

}

.widget-messaging .panel-body{
  padding: 0;
}

.widget-messaging ul li:first-child{
  border-top: 0;
}

.widget-messaging ul li{
  padding: 15px;
  padding-bottom: 5px;
  padding-top: 5px;
  margin:5px;
  border-top: 0px solid #eee !important;
  border-bottom: 0px solid #eee !important;
  background-color: #fff;
}

.row.vdivide [class*='col-']:not(:last-child):after {
background: #e0e0e0;
width: 1px;
content: "";
display:block;
position: absolute;
top:0;
bottom: 0;
right: 0;
min-height: 70px;
}

.panel-default {
  border-color: transparent;
}



.panel {
  margin-bottom: 20px;
  background-color: rgb(255, 255, 255);
  box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px;
  border-width: 0px;
  border-style: double;
  border-color: transparent;
  border-image: initial;
  border-radius: 4px;
}

.frame{
  border-width: 1px;
  border-style: solid;
  border-color: #ddd;
  width: auto;
}
.frame-right{
  margin-left:-13px;
  -webkit-border-top-right-radius: 10px;
  -webkit-border-bottom-right-radius: 10px;
  -moz-border-radius-topright: 10px;
  -moz-border-radius-bottomright: 10px;
  border-top-left-radius: 0px;
  border-bottom-left-radius: 0px;
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
  background-color: white;
}
.frame-left{
  margin-right:-13px;
  -webkit-border-top-left-radius: 10px;
  -webkit-border-bottom-left-radius: 10px;
  -moz-border-radius-topleft: 10px;
  -moz-border-radius-bottomleft: 10px;
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;
  background-color: white;

}

.panel-body ul li:hover{
  background-color:#008ECF;
  color: #FFF;
  cursor: pointer;

}

.btn-circle {
width: 30px;
height: 30px;
text-align: center;
padding: 6px 0;
font-size: 12px;
line-height: 1.428571429;
border-radius: 15px;
}
.btn-circle.btn-lg {
width: 50px;
height: 50px;
padding: 10px 16px;
font-size: 18px;
line-height: 1.33;
border-radius: 25px;
}
.btn-circle.btn-xl {
width: 70px;
height: 70px;
padding: 10px 16px;
font-size: 24px;
line-height: 1.33;
border-radius: 35px;
}

.btn-float{
  position: fixed;
  right: 37px;
  bottom:21px;
}
.sender{
  color:  #00bfff;
  font-weight: 400;
  font-weight: bold;
}
.sender>strong{
  color: black;
}

@media (max-width: 992px) {
  .frame-right{
  margin-left:0px;
  }
  .frame-left{
  margin-left:0px;

}
}
</style>

@endsection
