@extends('layouts.app')

@section('content')
<div class="container">
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
					<h3 class="modal-title">Modifier une mission</h3>
	        <a class="close pull-right" href="{{url('mission')}}">&times;</a>
	      </div>
	      <div class="modal-body">
					<form action="{{url('mission/'.$mission->id)}}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_method" value="put" />
 			 		{{ csrf_field() }}
        <div class="row">
          <div class="col-md-12">
   			 		<div class="form-group @if($errors->get('destination')) has-error @endif">
   			 			<label>Destination</label>
   			 			<input type="text" name="destination" class="form-control"  value="{{$mission->destination}}" />
   			 			@if($errors->get('destination'))
   			 				@foreach($errors->get('destination') as $message)
   			 				<li class="text-danger">{{$message}}</li>
   			 				@endforeach
   			 			@endif
   			 		</div>
          </div>

        </div>
          <div class="row">
          <div class="col-md-6">
   			 		<div class="form-group @if($errors->get('date_depart')) has-error @endif">
   			 			<label>Date départ</label>
   			 			<input type="date" name="date_depart" class="form-control"  value="{{$mission->date_depart}}" />
   			 			@if($errors->get('date_depart'))
   			 				@foreach($errors->get('date_depart') as $message)
   			 				<li class="text-danger">{{$message}}</li>
   			 				@endforeach
   			 			@endif
   			 		</div>
          </div>
          <div class="col-md-6">
 			 		<div class="form-group @if($errors->get('date_arrive')) has-error @endif">
 			 			<label>Date d'arrivée</label>
 			 			<input name="date_arrive" type="date" class="form-control" value="{{$mission->date_arrive}}"/>
 			 			@if($errors->get('date_arrive'))
 			 				@foreach($errors->get('date_arrive') as $message)
 			 				<li class="text-danger">{{$message}}</li>
 			 				@endforeach
 			 			@endif
 			 		</div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group @if($errors->get('vehicule_id')) has-error @endif">
              <label>Vehicule disponible</label>
              <select type="text" class="form-control" name="vehicule_id"  style="height:34px">
								<option value="">pas de vehicule</option>
								@foreach($vehicule as $v)
								@if($v->id == $mission->vehicule_id)
								<option value="{{$v->id}}" selected>{{$v->matricule}}</option>
								@elseif($v->id != $mission->vehicule_id)
                <option value="{{$v->id}}">{{$v->matricule}}</option>
								@endif
								@endforeach
              </select>
              @if($errors->get('vehicule_id'))
   			 				@foreach($errors->get('vehicule_id') as $message)
   			 				<li class="text-danger">{{$message}}</li>
   			 				@endforeach
   			 			@endif
            </div>
          </div>

          <div class="col-md-6">
 			 		<div class="form-group @if($errors->get('user_id')) has-error @endif">
 			 			<label for="">Agent</label>
 			 			<select type="text" name="user_id" class="form-control"  style="height:34px">
							@foreach($user as $us)
							@if($us->id == $mission->user_id)
								<option value="{{$mission->user_id}}" selected>{{$us->name}}</option>
							@elseif($us->id != $mission->user_id)
								<option value="{{$us->id}}">{{$us->name}}</option>
							@endif
							@endforeach
						</select>
 			 			@if($errors->get('user_id'))
 			 				@foreach($errors->get('user_id') as $message)
 			 				<li class="text-danger">{{$message}}</li>
 			 				@endforeach
 			 			@endif
 			 		</div>
        </div>
      </div>

			<div class="row">
				<div class="col-md-12">
					<div class="form-group @if($errors->get('description')) has-error @endif">
						<label>Description</label>
						<textarea type="text" name="description" class="form-control">{{$mission->description}}</textarea>
						@if($errors->get('description'))
							@foreach($errors->get('description') as $message)
							<li class="text-danger">{{$message}}</li>
							@endforeach
						@endif
					</div>
				</div>
			</div>


 			 		<div class="form-group">
 			 			<input type="submit" class="form-control btn btn-primary" value="Modifier"/>
 			 		</div>
 			 	</form>
	      </div>
	      <div class="modal-footer">
	        <button class="btn btn-default"><a type="button" href="{{url('mission')}}"> Close</a></button>
	      </div>
	    </div>

	  </div>
	</div>
</div>
<script type="text/javascript">
$(window).load(function(){
 $('#myModal').modal({backdrop: 'static', keyboard: false});
	});
</script>
@endsection
