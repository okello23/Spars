@extends('layouts.dashboard')

@section('content')
<div class="page_content">
                <div class="container-fluid">

                   
                   <div class="row">
                    <div class="col-lg-12">
                      <h3 class="pull-left">DISTRICT LEAGUE TABLE</h3>                         
                      </div>
                   </div>


                    <div class="row">
                        <div class="col-md-12">

                                    <div class="panel panel-default">
                                        <table class="table table-condensed table-striped no-footer display nowrap">
                                        

                                          <thead>
                                            <tr>
                                                <th class="col-md-1">#</th>
                                                <th class="col-md-3">District</th>
                                                <th class="col-md-2 text-right">Baseline score</th>
                                                <th class="col-md-2 text-right">Baseline position</th>
                                                <th class="col-md-2 text-right">Current score</th>
                                                <th class="col-md-2 text-right">Current position</th>

                                            </tr>
                                          </thead>
                                          <tbody>

                                                <?php $row=1; ?>
                                                @foreach($list as $item)
                                                <tr>
                                                  <th class="col-md-1" scope="row"> {{ $row }} </th>
                                                  <td class="col-md-3">{{ $item->get('district') }}</td>
                                                  <td class="text-right col-md-2">{{ number_format($item->get('baseline'),1) }}</td><td class="text-right col-md-2">{{ number_format($item->get('baseline_rank')) }}</td>
                                                  <td class="text-right col-md-2">{{ number_format($item->get('current'),1) }}</td><td class="text-right col-md-2">{{ number_format($item->get('current_rank')) }}</td>
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

