<div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
    <div class="logo">
        <a hef="{{url('/home')}}"><img src="{{asset('img/logo.png')}}" width="180px" height="180px" alt="merkery_logo" class="hidden-xs hidden-sm">
            <img src="{{asset('img/logo.png')}}" alt="ParkAuto" class="visible-xs visible-sm circle-logo">
        </a>
    </div>
    <div class="navi">
        <ul>
            <li class="active"><a href="{{url('/home')}}"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Dashbord</span></a></li>
            <li><a href="{{url('mission')}}"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Missions</span></a></li>
            <li><a href="{{url('vehicule')}}"><i class="fa fa-th" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Véhicules</span></a></li>
            @guest
            
            @else
              @if(Auth::user()->is_admin)
            <li><a href="{{url('/listAgents')}}"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Agents</span></a></li>
              @endif
            @endguest
            <li><a href="{{url('depence')}}"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Dépences</span></a></li>
            <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Paramétres</span></a></li>
        </ul>
    </div>
</div>
<div class="row">
    <header>
        <div class="col-md-7">
            <nav class="navbar-default pull-left">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </nav>
            <div class="search hidden-xs hidden-sm">
                <input type="text" placeholder="Search" id="search">
            </div>
        </div>
        <div class="col-md-5">
            <div class="header-rightside">
                <ul class="list-inline header-top pull-right">
                  @guest
                    <li class="has-dropdown"><a href="{{url('login')}}"><button type="button" class="btn btn-primary">Connexion</button></a>
                    </li>
                    @else
                      @if(Auth::user()->is_admin ==1)
                    <li class="hidden-xs"><a href="{{url('register')}}" class="add-project">Ajouter agent</a></li>
                      @endif
                    <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                    <li>
                        <a href="#" class="icon-info">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            <span class="label label-primary">3</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('img/user.png')}}" alt="user">
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-content">
                                    <span>{{Auth::user()->name}}</span>
                                    <p class="text-muted small">
                                      {{Auth::user()->email}}
                                    </p>
                                    <div class="divider">
                                    </div>
                                    <a href="#" class="view btn-sm active">View Profile</a>
                                    <a href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();" class="btn btn-danger btn-block">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                         {{ csrf_field() }}
                                       </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </header>
</div>
<script type="text/javascript">
$(document).ready(function(){
 $('[data-toggle="offcanvas"]').click(function(){
     $("#navigation").toggleClass("hidden-xs");
 });
});

</script>
