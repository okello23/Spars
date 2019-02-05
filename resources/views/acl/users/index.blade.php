@include('delete_modal')

@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-12">


                                    <div class="panel panel-default">
										<table class="table table-striped dataTable no-footer display nowrap" id="user" data-form="deleteForm">

										<caption> 
											<h4 class="pull-left">Users</h4>
											<a type="button" href="{{ url('/user/create') }}" class="btn btn-sm btn-primary pull-right"><span class="ion-plus"> Add user</span></a>
										</caption>
										
										  <thead>
										    <tr>
										      <th class="col-md-2">#</th>
										      <th class="col-md-3">Name</th>
										      <th class="col-md-3">Role</th>
										      <th class="col-md-2"></th>

										    </tr>
										  </thead>
										  <tbody>
										  	<?php $row=1; ?>
										  	@foreach($users as $acl)
										    <tr>
										      <th scope="row"> {{ $row }} </th>
										      <td>{{ $acl->user->name }}</td>
										      <td>{{ $acl->role->name }}</td>
										      <td>

								                {{ Form::open(array('url' => 'user/' . $acl->user_id, 'class' => 'pull-right form-delete')) }}
								                    {{ Form::hidden('_method', 'DELETE') }}
								                    {{Form::button('<span class="ion-trash-a"> </span>Delete', array('type' => 'submit', 'class' => 'btn btn-link', 'name' => 'delete_modal'))}}
								                {{ Form::close() }}

										      	<a href="{{ route('user.edit', $acl->user_id) }}" class="btn btn-link form-control-static pull-right"><span class="ion-edit"></span> Edit</a>
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