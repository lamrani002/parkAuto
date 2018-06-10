@extends('layouts.app')

@section('content')

            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->

                <div class="user-dashboard">
                    <h1 >Bienvenu <strong>{{auth::user()->name}}</strong></h1>
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12 gutter">

                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12 gutter">


                        </div>
                    </div>
                </div>
            </div>




    <!-- Modal -->
@endsection
