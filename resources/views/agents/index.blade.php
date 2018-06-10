@extends('layouts.app')
@section('content')
<div class="container bod">
	<div class="row">
		<div class="col-md-12">
			<div class="pull-right">
				<a href="{{url('/register')}}" class="btn btn-success" ><i class="glyphicon glyphicon-plus"></i></a>
			</div>
		</div>
	</div>
			<div class="row" style="margin-top:15px">
				<div class="col-md-12">
				<div class="panel panel-default" style="background-color:#eee">
					<div class="panel-heading"  style="background-color:#d9534f">
						<h3 class="panel-title">Liste des agents</h3>
						<div class="pull-right" style="margin-top:-15px">
							<span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body" >
								<i class="glyphicon glyphicon-filter" ></i>
							</span>
						</div>
					</div>
					<div class="panel-body">
						<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter les agents" />
					</div>
					<table class="table table-hover" id="dev-table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Username</th>
								<th>Email</th>
								<th>Date d'enregistrement</th>
								<th>Status</th>
								<th>Missions affectée</td>
							</tr>
						</thead>
						<tbody>
							@foreach($user as $u)
								<tr class="ligne">
									<td>{{$u->id}}</td>
								  <td>{{$u->name}}</td>
  								<td>{{$u->email}}</td>
  								<td>{{$u->created_at}}</td>
                  <td>
                  @if($u->status == 0)
                    <span class="text-danger">Compte non confimé</span>
                  @else
                    <span class="text-success">Compte confimé</span>
                  @endif
                </td>
								 <td>
                   @foreach($mission as $m)
                   @if($u->id == $m->user_id )
                   <ul style="display:inline;float:left;padding:5px">
                    <li><a href="{{url('mission/'.$m->id)}}"><button type="button" class="btn btn-warning" >{{$m->id}}</button></a></li>
                  </ul>
                  @endif
  								@endforeach
                </td>

								</tr>

							@endforeach
						</tbody>
					</table>
				</div>


			</div>
		</div>
</div>
<script type="text/javascript">
(function(){
	'use strict';
var $ = jQuery;
$.fn.extend({
	filterTable: function(){
		return this.each(function(){
			$(this).on('keyup', function(e){
				$('.filterTable_no_results').remove();
				var $this = $(this),
											search = $this.val().toLowerCase(),
											target = $this.attr('data-filters'),
											$target = $(target),
											$rows = $target.find('tbody tr');

				if(search == '') {
					$rows.show();
				} else {
					$rows.each(function(){
						var $this = $(this);
						$this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
					})
					if($target.find('tbody tr:visible').size() === 0) {
						var col_count = $target.find('tr').first().find('td').size();
						var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
						$target.find('tbody').append(no_results);
					}
				}
			});
		});
	}
});
$('[data-action="filter"]').filterTable();
})(jQuery);

$(function(){
	// attach table filter plugin to inputs
$('[data-action="filter"]').filterTable();

$('.container').on('click', '.panel-heading span.filter', function(e){
	var $this = $(this),
		$panel = $this.parents('.panel');

	$panel.find('.panel-body').slideToggle();
	if($this.css('display') != 'none') {
		$panel.find('.panel-body input').focus();
	}
});
$('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection
