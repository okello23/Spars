@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">Edit Sub-district</div>
                <div class="panel-body">
                    {!! Form::model($subdistrict, array('route' => array('subdistrict.update', $subdistrict->id),'autocomplete' => 'off', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'method' => 'PUT')) !!}


                        {{ csrf_field() }}

                            <fieldset> 

                                <div class="form-group">
                                {{ Form::label('district_id', 'District', ['class' => 'col-lg-2 control-label']) }}
                                  <div class="col-lg-7">
                                        {{ Form::select('district_id', $district_list, $subdistrict->district_id, ['data-placeholder' => 'Select a district','class'=>'form-control' ]) }}

                                        @if ($errors->has('district_id'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('district_id') }}</strong>
                                            </span>
                                        @endif

                                  </div>
                                </div>

                                <div class="form-group">
                                {{ Form::label('sub_district_name', 'Sub-district', ['class' => 'col-lg-2 control-label']) }}
                                  <div class="col-lg-7">
                                        {{ Form::text('sub_district_name',$subdistrict->name,['class' => 'form-control','placeholder' => 'Sub-district', 'required' => 'true']) }}

                                        @if ($errors->has('sub_district_name'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('sub_district_name') }}</strong>
                                            </span>
                                        @endif

                                  </div>
                                </div>

                                    <div class="form-group">
                                      <div class="col-lg-10 col-lg-offset-2">
                                        <a href="{{url('/subdistrict')}}" class="btn btn-default">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
                                    </div>
                                </div>                                

                            </fieldset>

                {!! Form::close() !!}
                </div>
            </div>

                    	</div>
                    </div>
                </div>
</div>
@endsection