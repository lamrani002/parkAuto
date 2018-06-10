@extends('layouts.app')

@section('content')
<div class="container">
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
          <h3 class="modal-title">Entrer les dépences</h3>
	        <a class="close pull-right" href="{{url('depence')}}">&times;</a>

	      </div>
	      <div class="modal-body">
					<form action="{{url('depence')}}" method="post" enctype="multipart/form-data">
 			 		{{ csrf_field() }}
        <div class="row">
          <div class="col-md-6">
 			 		<div class="form-group @if($errors->get('mission_id')) has-error @endif">
 			 			<label>Mission</label>
 			 			<select name="mission_id" class="form-control" value="{{old('mission_id')}}" style="height:34px">
              @foreach($mission as $m)
                <option value="{{$m->id}}">{{$m->id}}</option>
              @endforeach
            </select>
 			 			@if($errors->get('mission_id'))
 			 				@foreach($errors->get('mission_id') as $message)
 			 				<li class="text-danger">{{$message}}</li>
 			 				@endforeach
 			 			@endif
 			 		</div>
          </div>
          <div class="col-md-6">
            <div class="form-group @if($errors->get('type')) has-error @endif">
              <label>Type de dépence</label>
              <select class="form-control" name="type" style="height:34px">
                <option value="Transport">Transport</option>
                <option value="Ebérgement">Ebérgement</option>
                <option value="autre">Autre</option>
              </select>
              @if($errors->get('type'))
   			 				@foreach($errors->get('type') as $message)
   			 				<li class="text-danger">{{$message}}</li>
   			 				@endforeach
   			 			@endif
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-12">
          <div class="form-group @if($errors->get('montant')) has-error @endif">
            <label>Montant</label>
            <input type="text" name="montant" class="form-control"  value="{{old('montant')}}"/>
            @if($errors->get('montant'))
              @foreach($errors->get('montant') as $message)
              <li class="text-danger">{{$message}}</li>
              @endforeach
            @endif
          </div>
        </div>
      </div>
        <div class="row">
          <div class="col-md-12">
 			 		<div class="form-group @if($errors->get('bon')) has-error @endif">
 			 			<label for="">Justificatif</label>
 			 			<input type="file" name="bon" class="form-control" value="{{old('bon')}}"  style="height:34px"/>
 			 			@if($errors->get('bon'))
 			 				@foreach($errors->get('bon') as $message)
 			 				<li class="text-danger">{{$message}}</li>
 			 				@endforeach
 			 			@endif
 			 		</div>
        </div>
      </div>

 			 		<div class="form-group">
 			 			<input type="submit" class="form-control btn btn-primary" value="Enregistrer"  style="height:34px"/>
 			 		</div>
 			 	</form>
	      </div>
	      <div class="modal-footer">
	        <button class="btn btn-default"><a type="button" href="{{url('depence')}}">Close</a></button>
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
