@include('settings.delete_modal')

@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-12">


                                    <div class="panel panel-default">
										<table class="custom-data-table table table-striped dataTable no-footer display nowrap" id="personnel" data-form="deleteForm">

										<caption> 
											<h4 class="pull-left">Personnel</h4>
											<a type="button" href="{{ url('/personnel/create') }}" class="btn btn-sm btn-primary pull-right"><span class="ion-plus"> Add person</span></a>
										</caption>
										
										  <thead>
										    <tr>
										      <th >#</th>
										      <th >First Name</th>
										      <th >Last Name</th>
										      <th >Email</th>
										      <th >Phone</th>
										      <th >Cadre</th>
										      <th ></th>

										    </tr>
										  </thead>
										  <tbody>
										  	<?php $row=1; ?>
										  	@foreach($persons as $person)
										    <tr>
										      <th> {{ $row }} </th>
										      <td>{{ $person->first_name }}</td>
										      <td>{{ $person->last_name }}</td>
										      <td>{{ $person->email }}</td>
										      <td>{{ $person->telephone }}</td>
										      <td>{{ $person->cadre->name }}</td>										      
										      <td>

								                {{ Form::open(array('url' => 'personnel/' . $person->id, 'class' => 'pull-right form-delete')) }}
								                    {{ Form::hidden('_method', 'DELETE') }}
								                    {{Form::button('<span class="ion-trash-a"> </span>Delete', array('type' => 'submit', 'class' => 'btn btn-link', 'name' => 'delete_modal'))}}
								                {{ Form::close() }}

										      	<a href="{{ route('personnel.edit', $person->id) }}" class="btn btn-link form-control-static pull-right"><span class="ion-edit"></span> Edit</a>
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