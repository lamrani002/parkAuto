@extends('layouts.app')

@section('content')
<div class="container">
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
          <h3 class="modal-title">Modifier une dépence</h3>
	        <a class="close pull-right" href="{{url('mission')}}">&times;</a>

	      </div>
	      <div class="modal-body">
					<form action="{{url('depence/'.$depence->id)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="put" />
 			 		{{ csrf_field() }}
        <div class="row">
          <div class="col-md-6">
 			 		<div class="form-group @if($errors->get('mission_id')) has-error @endif">
 			 			<label>Mission</label>
 			 			<select name="mission_id" class="form-control" style="height:34px">
							<option value="{{$depence->mission_id}}">mission {{$depence->mission_id}}</option>
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
            <input type="text" name="montant" class="form-control"  value="{{$depence->montant}}"/>
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
 			 			<input type="file" name="bon" class="form-control" value="{{$depence->bon}}"/>
              <em><img src="{{asset('storage/'.$depence->bon)}}" width="60" height="60"></em>
 			 			@if($errors->get('bon'))
 			 				@foreach($errors->get('bon') as $message)
 			 				<li class="text-danger">{{$message}}</li>
 			 				@endforeach
 			 			@endif
 			 		</div>
        </div>
      </div>

 			 		<div class="form-group">
 			 			<input type="submit" class="form-control btn btn-primary" value="Modifier"  style="height:34px"/>
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
