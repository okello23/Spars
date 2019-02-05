@include('settings.delete_modal')

@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-12">


                                    <div class="panel panel-default">
										<table class="custom-data-table table table-striped dataTable no-footer display nowrap" id="cadre" data-form="deleteForm">

										<caption> 
											<h4 class="pull-left">Cadres</h4>
											<a type="button" href="{{ url('/cadre/create') }}" class="btn btn-sm btn-primary pull-right"><span class="ion-plus"> Add cadre</span></a>
										</caption>
										
										  <thead>
										    <tr>
										      <th class="col-md-3">#</th>
										      <th class="col-md-7">Cadre</th>
										      <th class="col-md-2"></th>

										    </tr>
										  </thead>
										  <tbody>
										  	<?php $row=1; ?>
										  	@foreach($cadres as $cadre)
										    <tr>
										      <th scope="row"> {{ $row }} </th>
										      <td>{{ $cadre->name }}</td>
										      <td>

								                {{ Form::open(array('url' => 'cadre/' . $cadre->id, 'class' => 'pull-right form-delete')) }}
								                    {{ Form::hidden('_method', 'DELETE') }}
								                    {{Form::button('<span class="ion-trash-a"> </span>Delete', array('type' => 'submit', 'class' => 'btn btn-link', 'name' => 'delete_modal'))}}
								                {{ Form::close() }}

										      	<a href="{{ route('cadre.edit', $cadre->id) }}" class="btn btn-link form-control-static pull-right"><span class="ion-edit"></span> Edit</a>
											</td>
										    </tr>
										    <?php $row++; ?>
										    @endforeach
										  </tbody>
										</table>
									</div>

                    	</div>
                    </div>
                </div>
</div>
@endsection