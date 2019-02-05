@extends('layouts.dashboard')

@section('content')
<div class="page_content">
                <div class="container-fluid">

                   
                   <div class="row">
                    <div class="col-lg-12">
                      <h3 class="pull-left">FACILITY PERFORMANCE</h3>                         
                      </div>
                   </div>


                    <div class="row">
                        <div class="col-md-12">

                                    <div class="panel panel-default">
                                        <table class="table table-condensed table-striped no-footer display nowrap">
                                        

                                          <thead>
                                            <tr>
                                                <th  class="col-md-1">#</th>
                                                <th class="col-md-4">Facility</th>
                                                <th class="col-md-2 text-right">Baseline score</th>
                                                <th class="col-md-2 text-right">Current score</th>
                                                <th class="col-md-2 text-right">Percentage change</th>

                                            </tr>
                                          </thead>
                                          <tbody>                                           
                                            <?php $row=1; ?>
                                            @foreach($summary_list as $item)
                                            <tr>
                                              <th scope="row"> {{ $row }} </th>
                                              <td>{{ $item[0] }}</td>
                                              <td class="text-right">{{ number_format($item[1],1) }}</td>
                                              <td class="text-right">{{ number_format($item[2],1) }}</td>
                                              <td class="text-right">{{ number_format(($item[2]-$item[1])/$item[1]*100,1) . ' %' }}</td>
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


@section('page-js-script')
<script type="text/javascript">

    $('table').dataTable({searching: false, paging: false, info: false});

</script>
@stop

