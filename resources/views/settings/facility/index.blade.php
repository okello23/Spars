@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-12">


                                    <div class="panel panel-default">
										<table class="table custom-data-table table-condensed table-striped dataTable no-footer display nowrap" id="facilities" data-form="deleteForm">

										<caption> 
											<h4 class="pull-left">Facilities</h4>
											<a type="button" href="{{ url('/facility/create') }}" class="hidden btn btn-sm btn-primary pull-right"><span class="ion-plus"> Add facility</span></a>
										</caption>
										
										  <thead>
										    <tr>
										      <th class="col-md-1" >#</th>
										      <th class="col-md-2" >Facility</th>
										      <th class="col-md-1 text-center" >Level</th>
										      <th class="col-md-1 text-center" >Owner</th>										      
										      <th class="col-md-1 text-center" >District</th>
										      <th class="col-md-2 text-center" >Sub-district</th>
										      <th class="col-md-2" >LSS</th>
										      <th class="col-md-1" >Contact</th>
										      <th class="col-md-1" ></th>

										    </tr>
										  </thead>
										  <tbody>
										  	<?php $row=1; ?>
										  	@foreach($facilities as $facility)
										    <tr>
										      <th class="col-md-1"> {{ $row }} </th>
										      <td class="col-md-2">{{ $facility->facility }}</td>
										      <td class="col-md-1 text-center">{{ $facility->level }}</td>
										      <td class="col-md-1 text-center">{{ $facility->ownership }}</td>			  
										      <td class="col-md-1 text-center">{{ $facility->district }}</td>
										      <td class="col-md-2 text-center">{{ $facility->hsd }}</td>	
										      <td class="col-md-2">{{ $facility->lss_fname.' '. $facility->lss_lname }}</td>	
										      <td class="col-md-1">{{ $facility->lss_contact }} </td>								
										      <td class="col-md-1">

										      	<a href="{{ route('facility.edit', $facility->id) }}" class="btn btn-link btn-spars-edit pull-right"><span class="ion-edit"> Edit</span></a>

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