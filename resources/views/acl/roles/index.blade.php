@include('delete_modal')

@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-12">


                                    <div class="panel panel-default">
										<table class="table table-striped dataTable no-footer display nowrap" id="role" data-form="deleteForm">

										<caption> 
											<h4 class="pull-left">Roles</h4>
											
										</caption>
										
										  <thead>
										    <tr>
										      <th class="col-md-3">#</th>
										      <th class="col-md-7">Role</th>
										      <th class="col-md-2"></th>

										    </tr>
										  </thead>
										  <tbody>
										  	<?php $row=1; ?>
										  	@foreach($roles as $role)
										    <tr>
										      <th scope="row"> {{ $row }} </th>
										      <td>{{ $role->name }}</td>
										      <td>

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