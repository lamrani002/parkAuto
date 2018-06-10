@extends('layouts.app')

@section('content')
<div class="container">
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
          <h3 class="modal-title">Entrer un véhicule</h3>
	        <a class="close pull-right" href="{{url('vehicule')}}">&times;</a>

	      </div>
	      <div class="modal-body">
					<form action="{{url('vehicule')}}" method="post" enctype="multipart/form-data">
 			 		{{ csrf_field() }}
        <div class="row">
          <div class="col-md-6">
   			 		<div class="form-group @if($errors->get('matricule')) has-error @endif">
   			 			<label>Matricule</label>
   			 			<input type="text" name="matricule" class="form-control"  value="{{old('matricule')}}" />
   			 			@if($errors->get('matricule'))
   			 				@foreach($errors->get('matricule') as $message)
   			 				<li class="text-danger">{{$message}}</li>
   			 				@endforeach
   			 			@endif
   			 		</div>
          </div>
          <div class="col-md-6">
   			 		<div class="form-group @if($errors->get('marque')) has-error @endif">
   			 			<label>Marque</label>
   			 			<input type="text" name="marque" class="form-control"  value="{{old('marque')}}" />
   			 			@if($errors->get('marque'))
   			 				@foreach($errors->get('marque') as $message)
   			 				<li class="text-danger">{{$message}}</li>
   			 				@endforeach
   			 			@endif
   			 		</div>
          </div>
        </div>
          <div class="row">
          <div class="col-md-6">
   			 		<div class="form-group @if($errors->get('model')) has-error @endif">
   			 			<label>Model</label>
   			 			<input type="text" name="model" class="form-control"  value="{{old('model')}}" />
   			 			@if($errors->get('model'))
   			 				@foreach($errors->get('model') as $message)
   			 				<li class="text-danger">{{$message}}</li>
   			 				@endforeach
   			 			@endif
   			 		</div>
          </div>
          <div class="col-md-6">
 			 		<div class="form-group @if($errors->get('carburateur')) has-error @endif">
 			 			<label>carburateur</label>
 			 			<input name="carburateur"class="form-control" value="{{old('carburateur')}}"/>
 			 			@if($errors->get('carburateur'))
 			 				@foreach($errors->get('carburateur') as $message)
 			 				<li class="text-danger">{{$message}}</li>
 			 				@endforeach
 			 			@endif
 			 		</div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group @if($errors->get('disponibilite')) has-error @endif">
              <label>Disponibilité</label>
              <select class="form-control" name="disponibilite" style="height:34px">
                <option value="1">Oui</option>
                <option value="0">Non</option>
              </select>
              @if($errors->get('disponibilite'))
   			 				@foreach($errors->get('disponibilite') as $message)
   			 				<li class="text-danger">{{$message}}</li>
   			 				@endforeach
   			 			@endif
            </div>
          </div>

          <div class="col-md-6">
 			 		<div class="form-group @if($errors->get('photo')) has-error @endif">
 			 			<label for="">Image</label>
 			 			<input type="file" name="photo" class="form-control" value="{{old('photo')}}"/>
 			 			@if($errors->get('photo'))
 			 				@foreach($errors->get('photo') as $message)
 			 				<li class="text-danger">{{$message}}</li>
 			 				@endforeach
 			 			@endif
 			 		</div>
        </div>
      </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group @if($errors->get('kilometrage')) has-error @endif">
     			 			<label>kilometrage</label>
     			 			<input type="text" name="kilometrage" class="form-control"  value="{{old('kilometrage')}}" />
     			 			@if($errors->get('kilometrage'))
     			 				@foreach($errors->get('kilometrage') as $message)
     			 				<li class="text-danger">{{$message}}</li>
     			 				@endforeach
     			 			@endif
     			 		</div>
            </div>
          </div>

 			 		<div class="form-group">
 			 			<input type="submit" class="form-control btn btn-primary" value="Enregistrer"/>
 			 		</div>
 			 	</form>
	      </div>
	      <div class="modal-footer">
	        <button class="btn btn-default"><a type="button" href="{{url('vehicule')}}"> Close</a></button>
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
