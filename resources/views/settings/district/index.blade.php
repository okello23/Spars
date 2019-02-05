@include('settings.delete_modal')

@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-12">


                                    <div class="panel panel-default">
										<table class="table table-striped dataTable no-footer display nowrap" id="district" data-form="deleteForm">

										<caption> 
											<h4 class="pull-left">Districts</h4>
											<a type="button" href="{{ url('/district/create') }}" class="btn btn-sm btn-primary pull-right"><span class="ion-plus"> Add district</span></a>
										</caption>
										
										  <thead>
										    <tr>
										      <th class="col-md-3">#</th>
										      <th class="col-md-7">District</th>
										      <th class="col-md-2"></th>

										    </tr>
										  </thead>
										  <tbody>
										  	<?php $row=1; ?>
										  	@foreach($districts as $district)
										    <tr>
										      <th scope="row"> {{ $row }} </th>
										      <td>{{ $district->name }}</td>
										      <td>

								                {{ Form::open(array('url' => 'district/' . $district->id, 'class' => 'pull-right form-delete')) }}
								                    {{ Form::hidden('_method', 'DELETE') }}
								                    {{Form::button('<span class="ion-trash-a"> </span>Delete', array('type' => 'submit', 'class' => 'btn btn-link', 'name' => 'delete_modal'))}}
								                {{ Form::close() }}

										      	<a href="{{ route('district.edit', $district->id) }}" class="btn btn-link form-control-static pull-right"><span class="ion-edit"></span> Edit</a>
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