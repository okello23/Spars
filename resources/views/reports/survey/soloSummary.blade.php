@include('settings.delete_modal')

@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">


                   <div class="row">
                    <div class="col-lg-12">
                      <h3 class="pull-left">VISITS SUMMARY</h3>
                      </div>
                   </div>



                    <div class="row" id="report-section">
                      <div class="col-md-12">

                                    <div class="panel panel-default">
                    <table class="table table-condensed table-striped dataTable table-bordered custom-data-table no-footer display nowrap"  id="report_table">



                      <thead>
                        <tr>
                          <th  class="col-md-1">#</th>
                          <th class="col-md-1 text-center">Status</th>
                          <th class="col-md-1 text-center">Region</th>
                          <th class="col-md-1 text-center">District</th>
                          <th class="col-md-1 text-center">Sub-district</th>
                          <th class="col-md-1 text-center">Facility</th>
                          <th class="col-md-1 text-center">Level</th>
                          <th class="col-md-1 text-center">Ownership</th>
                          <th class="col-md-1">Visit number</th>
                          <th class="col-md-1">Visit date</th>
                          <th class="col-md-1">Next visit date</th>
                          <th class="col-md-1">Submission date</th>
                          <th class="col-md-2">Submitted by</th>
                          <th class="col-md-2">Supervisor(s)</th>
                          <th class="col-md-2">Persons supervised</th>

                        </tr>
                      </thead>
                      <tbody>

                        <?php $row=1; ?>
                        @foreach($items as $item)

                        <tr>
                          <th scope="row" class="col-md-1">

                          @if($item[0]['step']==6)
                             {{ $row }}
                          @elseif($item[0]['step']!=6)
                            <a href="{{ route('survey.partial', $item[0]['id'] ) }}"> {{ $row }} </a>
                          @endif
                          </th>
                          @if($item[0]['step']==6 && $item[0]['upload_status'] =="")
                          <th>
                            <span class='badge badge-success'>Complete </span>
                            <br>
                            <span class='badge badge-danger'>Already in Central Lab Spars</span>
                          </th>

                            @elseif($item[0]['step']==6  && $item[0]['upload_status']==0 && $item[0]['upload_status']!="")
                          <th>  <a type="button" href="{{ url('remoteupload') }}" class="btn btn-sm btn-primary"><span>Upload</span></a>
                          </th>

                          @elseif($item[0]['upload_status']==1)
                          <th scope="row" class="col-md-1"><span class='badge badge-info'><b>UPLOADED</b></span></th>


                          @elseif($item[0]['step']!=6)
                            <th scope="row" class="col-md-1"> <span class='badge badge-warning'> Partial [ {{$item[0]['step']+1}}/6 ] </span> </th>
                          @endif
                          <td scope="row" class="col-md-1"> {{ $item[1]['region'] }} </td>
                          <td scope="row" class="col-md-1"> {{ $item[1]['district'] }} </td>
                          <td scope="row" class="col-md-1"> {{ $item[1]['hsd'] }} </td>
                          <td scope="row" class="col-md-1"> {{ $item[1]['facility'] }} </td>
                          <td scope="row" class="col-md-1"> {{ $item[1]['level'] }} </td>
                          <td scope="row" class="col-md-1"> {{ $item[1]['ownership'] }} </td>
                          <td scope="row" class="col-md-1"> {{ $item[1]['visit_number'] }} </td>
                          <td scope="row" class="col-md-1"> {{ date('d F Y', strtotime($item[0]['visit_date'])) }} </td>
                          <td scope="row" class="col-md-1"> {{ date('d F Y', strtotime($item[0]['next_visit_date'])) }} </td>
                          <td scope="row" class="col-md-1"> {{ date('d F Y', strtotime($item[0]['created_at']))  }} </td>
                          <td scope="row" class="col-md-1"> {{ $item[4] }} </td>
                          <td scope="row" class="col-md-1"> {{ $item[2] }} </td>
                          <td scope="row" class="col-md-1"> {{ $item[3] }} </td>

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
