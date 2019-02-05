@extends('layouts.app')

@section('content')
<div class="page_content">

    {!! Form::model($storage10, array('route' => array('survey.update', $storage10->survey_summary_id),'autocomplete' => 'off', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'method' => 'PUT', 'id' => 'newProfileForm' )) !!}

            {{ csrf_field() }}

            <div class="row">
                    <div id="surveyAccordian" class="panel-group">


        <!-- Start Box 1 -->            
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#surveyAccordian" href="#collapseGeneral">{{ $facility->facility .' '. $facility->level . '  ('. $record->visit_date . ' )'}}</a>
                                </h4>
                            </div>


                            <div id="collapseGeneral" class="panel-collapse collapse">
                                        <div class="panel-body">
                            
                                    <div class="form-group{{ $errors->has('visit_number') ? ' has-error' : '' }}">
                                        <label for="visit_number" class="col-md-2 control-label">Visit number</label>

                                        <div class="col-md-3">
                                            <input id="visit_number" type="text" class="form-control" name="visit_number" value="{{$record->visit_number}}">

                                            @if ($errors->has('visit_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('visit_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('visit_date') ? ' has-error' : '' }}">
                                        <label for="visit_date" class="col-md-2 control-label">Visit date</label>

                                        <div class="col-md-3">
                                            {{ Form::text('visit_date',date_format(date_create($record->visit_date),'d F Y'),['data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','class' => 'form_datetime form-control input-sm','placeholder' => 'Visit date', 'required' => 'true']) }}

                                            @if ($errors->has('visit_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('visit_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('next_visit_date') ? ' has-error' : '' }}">
                                        <label for="next_visit_date" class="col-md-2 control-label">Next visit date</label>

                                        <div class="col-md-3">                                            
                                            {{ Form::text('next_visit_date',date_format(date_create($record->next_visit_date),'d F Y'),['data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','class' => 'form_datetime form-control input-sm','placeholder' => 'Visit date', 'required' => 'true']) }}

                                            @if ($errors->has('next_visit_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('next_visit_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                        </div>
                            </div>

                        </div>
        <!-- End Box 1 -->


        <!-- Start Box 2 -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title"> 
                                    <a data-toggle="collapse" data-parent="#surveyAccordian"  href="#collapseStock">I. Stock management</a>
                                </h4>
                            </div>
                            <div id="collapseStock" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p class=" small-font-11">
                                                <em>
                                                    1- 9 Availability of reagents and correct filling of stock cards, stock books etc.Verify information recorded for the selected vital tests and  reagents, complete  table1 with (Y=1/N=0): If the facility does not carry out a particular test i.e. C 1  write "0" for C1 and "NA" for the rest of the columns (C2 to C22) ; if the item is un available, write "0" in C2 and proceed to C3, if stock card unavailable write ‘0’ in C3 followed by ‘0’ for C4 to C13 and ask C14 If stock book unavailable write “0” in C14 followed by ‘NA” for C15 to C18.  If AMC not recorded write ‘NR’,  If item overstocked (C17) write “0” . NB: For all unselected items (vital tests) write “NS”.
                                                </em>
                                            </p>

                                            <div class="row  small-font">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                    <table class="table table-striped table-bordered">
  
                                                        <thead> 
                                                            <tr> 

                                                                <th >  </th>
                                                                <th >  </th>
                                                                <th >  </th>
                                                                <th >C1</th>
                                                                <th >C2</th>
                                                                <th >C3</th>
                                                                <th >C4</th>
                                                                <th >C5</th>
                                                                <th >C6</th>
                                                                <th >C7</th>
                                                                <th >C8</th>
                                                                <th >C9</th>
                                                                <th >C10</th>
                                                                <th >C11</th>
                                                                <th >C12</th>
                                                                <th >C13</th>
                                                                <th >C14</th>
                                                                <th >C15</th>
                                                                <th >C16</th>
                                                                <th >C17</th>
                                                                <th >C18</th>
                                                                <th >C19</th>
                                                                <th >C20</th>
                                                                <th >C21</th>
                                                                <th >C22</th>

                                                            </tr>

                                                            <tr> 
                                                                <th class="survey"></th>
                                                                <th class="survey">Selected test</th>
                                                                <th class="survey">
                                                                    <div ><span class="rotate">Reagent and unit size</span></div>
                                                                </th>  
                                                                <th class="survey">
                                                                    <div >Does the facility carry out these tests (Assessor ask for all ten tracer items  and  score yes=1 and No=0</div>
                                                                </th>
                                                                <th class="survey">
                                                                    <div >Item available? (check 1/0) Mark if expired (E)
                                                                    </div>
                                                                </th>                                                                                           
                                                                <th class="survey">
                                                                    <div >Stock card available (1/0)
                                                                    </div>
                                                                </th>     
                                                                <th class="survey">
                                                                    <div>Is physical count (PC) done every month and Physical count marked in stock card  (check 3 months) (1/0)</div>
                                                                </th>
                                                                <th class="survey">
                                                                    <div>Is the card filled correctly with name, unit size , Min& Max, special storage (1/0)</div>
                                                                </th>
                                                                <th class="survey">
                                                                    <div>Balance according to stock card (record no. from the card) </div>
                                                                </th>                                                               
                                                                <th class="survey">
                                                                    <div>Count the no. of reagents  in stock and record i.e. physical count (PC)</div>
                                                                </th>                                                               
                                                                <th class="survey">
                                                                    <div>Does balance according to the stock card & PC agree 100? (1/0)</div>
                                                                </th>                                                               
                                                                <th class="survey">
                                                                    <div>Record the amount issued in the last 3 months (From day of survey from the stock card) (record for 5 items)</div>
                                                                </th>
                                                                <th class="survey">
                                                                    <div>Record the number of days out of stock in the last 3 months from day of survey) (record for 5 items) </div>
                                                                </th>                                                               
                                                                <th class="survey">
                                                                    <div>Record their monthly consumption (AMC) from the stock card.  write NR if not recorded. (record for 5 items) </div>
                                                                </th>                                                               
                                                                <th class="survey">
                                                                    <div>Calculated AMC (only calculate for the 5 selected items) </div>
                                                                </th>                                                               
                                                                <th class="survey">
                                                                    <div>Does the AMC from the stock card agree with the calculated AMC (1/0) Write NR if no record  in C11 above</div>
                                                                </th>
                                                                <th class="survey">
                                                                    <div>Is the stock book available (1/0) </div>
                                                                </th>                                                               
                                                                <th class="survey">
                                                                    <div>Is stock book correctly filled (all fields filled & AMC) (1/0)
                                                                    </div>
                                                                </th>                                                               
                                                                <th class="survey">
                                                                    <div>Record their monthly consumption (AMC) from the stock book. Write if not recorded. (record for 5 items) </div>
                                                                </th>                                                               
                                                                <th class="survey">
                                                                    <div>Calculate AMC based on the stock book (only for the  5 selected items</div>
                                                                </th>
                                                                <th class="survey">
                                                                    <div>Does the  AMC from the stock book agree with the calculated AMC  (check for  5 selected items)</div>
                                                                </th>                                                               
                                                                <th class="survey">
                                                                    <div>No. of days out of stock for the  last 6 months; record no. of from days (from day of survey)</div>
                                                                </th>                                                               
                                                                <th class="survey">
                                                                    <div>Calculate the highest balance on hand in the last 6 months (from day of survey). </div>
                                                                </th>                                                               
                                                                <th class="survey">
                                                                    <div>Was the selected item ordered and delivered? (1/0)</div>
                                                                </th>
                                                                <th class="survey">
                                                                    <div>Order refill rate:  (Quantity ordered Minus quantity received).  .
                                                                    </div>
                                                                </th>                                                           

                                                            </tr>                                                              
                                                        </thead>                                                        

                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    R1
                                                                    {{ Form::label('r1_checkbox', '', ['class' => 'col-md-3 control-label hidden']) }}                                         
                                                                    {{ Form::checkbox('r1_checkbox', 'true', false) }}                                                                     
                                                                </td>
                                                                <td>
                                                                    HIV screening
                                                                </td>
                                                                <td>
                                                                    Determine strips(100)
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c1',$stock_management!=null?($stock_management->r1c1==-1?'NA':$stock_management->r1c1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c2',$stock_management!=null?($stock_management->r1c2==-1?'NA':$stock_management->r1c2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c3', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c3',$stock_management!=null?($stock_management->r1c3==-1?'NA':$stock_management->r1c3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c4', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c4',$stock_management!=null?($stock_management->r1c4==-1?'NA':$stock_management->r1c4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c5', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c5',$stock_management!=null?($stock_management->r1c5==-1?'NA':$stock_management->r1c5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 


                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c6',$stock_management!=null?($stock_management->r1c6==-1?'NA':$stock_management->r1c6):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                                                             
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c7', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r1_c7',$stock_management!=null?($stock_management->r1c7==-1?'NA':$stock_management->r1c7):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                      
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c8', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c8',$stock_management!=null?($stock_management->r1c8==-1?'NA':$stock_management->r1c8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c9', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c9',$stock_management!=null?($stock_management->r1c9==-1?'NA':$stock_management->r1c9):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c10', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c10',$stock_management!=null?($stock_management->r1c10==-1?'NA':$stock_management->r1c10):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$', 'min'=>'0','max'=>'180'])}}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c11', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c11',$stock_management!=null?($stock_management->r1c11==-1?'NA':$stock_management->r1c11):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c12', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r1_c12',$stock_management!=null?($stock_management->r1c12==-1?'NA':$stock_management->r1c12):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c13', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c13',$stock_management!=null?($stock_management->r1c13==-1?'NA':$stock_management->r1c13):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c14', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c14',$stock_management!=null?($stock_management->r1c14==-1?'NA':$stock_management->r1c14):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  
                                               
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c15', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c15',$stock_management!=null?($stock_management->r1c15==-1?'NA':$stock_management->r1c15):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c16', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c16',$stock_management!=null?($stock_management->r1c16==-1?'NA':$stock_management->r1c16):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c17', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c17',$stock_management!=null?($stock_management->r1c17==-1?'NA':$stock_management->r1c17):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                              
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c18', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c18',$stock_management!=null?($stock_management->r1c18==-1?'NA':$stock_management->r1c18):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c19', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c19',$stock_management!=null?($stock_management->r1c19==-1?'NA':$stock_management->r1c19):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c20', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c20',$stock_management!=null?($stock_management->r1c20==-1?'NA':$stock_management->r1c20):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c21', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c21',$stock_management!=null?($stock_management->r1c21==-1?'NA':$stock_management->r1c21):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only integer or NR permitted','pattern'=>'^(\d+)|(NR)|(NA)$','maxlength'=>'4']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r1_c22', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r1_c22',$stock_management!=null?($stock_management->r1c22==-1?'NA':$stock_management->r1c22):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                  
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    R2
                                                                    {{ Form::label('r2_checkbox', '', ['class' => 'col-md-3 control-label hidden']) }}                                         
                                                                    {{ Form::checkbox('r2_checkbox', 'true', false) }}                                                                     
                                                                </td>
                                                                <td>
                                                                    CD4 testing   
                                                                </td>  
                                                                <td>
                                                                    <div class="form-group">
                                                                        {{ Form::label('cd4_testing', 'cd4', ['class' => 'col-md-3 control-label hidden']) }}
                                                                          <div class="col-md-12">
                                                                            {{ Form::select('cd4_testing', [''=>'','1'=>'BD FACS, MultiTest CD3/CD8/CD45/CD4, 50 Tests','2'=>'BD FACSCount CD3/CD4 Reagent Kit 50 Tests','3'=>'BD FACS Flow Sheath Fluid','4'=>'Partec-CD4 % Easy Count Kit 100 tests','5'=>'Pima Analyzer CD4 Cartridge Kit, 100 tests'], $stock_management!=null?$stock_management->r2c2_cd4item:null, ['data-placeholder' => 'Select an item','class'=>' small-font' ]) }}


                                                                                @if ($errors->has('cd4_testing'))
                                                                                    <span class="text-danger">
                                                                                        <strong>{{ $errors->first('cd4_testing') }}</strong>
                                                                                    </span>
                                                                                @endif

                                                                          </div>
                                                                    </div>                                                                
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c1',$stock_management!=null?($stock_management->r2c1==-1?'NA':$stock_management->r2c1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c2',$stock_management!=null?($stock_management->r2c2==-1?'NA':$stock_management->r2c2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c3', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c3',$stock_management!=null?($stock_management->r2c3==-1?'NA':$stock_management->r2c3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c4', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c4',$stock_management!=null?($stock_management->r2c4==-1?'NA':$stock_management->r2c4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c5', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c5',$stock_management!=null?($stock_management->r2c5==-1?'NA':$stock_management->r2c5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 


                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c6',$stock_management!=null?($stock_management->r2c6==-1?'NA':$stock_management->r2c6):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                                                             
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c7', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r2_c7',$stock_management!=null?($stock_management->r2c7==-1?'NA':$stock_management->r2c7):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                      
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c8', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c8',$stock_management!=null?($stock_management->r2c8==-1?'NA':$stock_management->r2c8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c9', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c9',$stock_management!=null?($stock_management->r2c9==-1?'NA':$stock_management->r2c9):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c10', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c10',$stock_management!=null?($stock_management->r2c10==-1?'NA':$stock_management->r2c10):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$', 'min'=>'0','max'=>'180'])}}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c11', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c11',$stock_management!=null?($stock_management->r2c11==-1?'NA':$stock_management->r2c11):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c12', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r2_c12',$stock_management!=null?($stock_management->r2c12==-1?'NA':$stock_management->r2c12):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c13', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c13',$stock_management!=null?($stock_management->r2c13==-1?'NA':$stock_management->r2c13):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c14', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c14',$stock_management!=null?($stock_management->r2c14==-1?'NA':$stock_management->r2c14):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  
                                               
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c15', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c15',$stock_management!=null?($stock_management->r2c15==-1?'NA':$stock_management->r2c15):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c16', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c16',$stock_management!=null?($stock_management->r2c16==-1?'NA':$stock_management->r2c16):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c17', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c17',$stock_management!=null?($stock_management->r2c17==-1?'NA':$stock_management->r2c17):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                              
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c18', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c18',$stock_management!=null?($stock_management->r2c18==-1?'NA':$stock_management->r2c18):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c19', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c19',$stock_management!=null?($stock_management->r2c19==-1?'NA':$stock_management->r2c19):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c20', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c20',$stock_management!=null?($stock_management->r2c20==-1?'NA':$stock_management->r2c20):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c21', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c21',$stock_management!=null?($stock_management->r2c21==-1?'NA':$stock_management->r2c21):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only integer or NR permitted','pattern'=>'^(\d+)|(NR)|(NA)$','maxlength'=>'4']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r2_c22', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r2_c22',$stock_management!=null?($stock_management->r2c22==-1?'NA':$stock_management->r2c22):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                  
                 

                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    R3

                                                                    {{ Form::label('r3_checkbox', '', ['class' => 'col-md-3 control-label hidden']) }}                                         
                                                                    {{ Form::checkbox('r3_checkbox', 'true', false) }}                                                                     
                                                                </td>
                                                                <td>
                                                                   TB testing
                                                                </td>
                                                                <td>
                                                                    Strong Carbol Fuchsin 1000mls                                                               
                                                                </td>   
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c1',$stock_management!=null?($stock_management->r3c1==-1?'NA':$stock_management->r3c1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c2',$stock_management!=null?($stock_management->r3c2==-1?'NA':$stock_management->r3c2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c3', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c3',$stock_management!=null?($stock_management->r3c3==-1?'NA':$stock_management->r3c3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c4', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c4',$stock_management!=null?($stock_management->r3c4==-1?'NA':$stock_management->r3c4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c5', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c5',$stock_management!=null?($stock_management->r3c5==-1?'NA':$stock_management->r3c5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 


                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c6',$stock_management!=null?($stock_management->r3c6==-1?'NA':$stock_management->r3c6):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                                                             
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c7', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r3_c7',$stock_management!=null?($stock_management->r3c7==-1?'NA':$stock_management->r3c7):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                      
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c8', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c8',$stock_management!=null?($stock_management->r3c8==-1?'NA':$stock_management->r3c8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c9', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c9',$stock_management!=null?($stock_management->r3c9==-1?'NA':$stock_management->r3c9):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c10', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c10',$stock_management!=null?($stock_management->r3c10==-1?'NA':$stock_management->r3c10):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$', 'min'=>'0','max'=>'180'])}}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c11', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c11',$stock_management!=null?($stock_management->r3c11==-1?'NA':$stock_management->r3c11):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c12', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r3_c12',$stock_management!=null?($stock_management->r3c12==-1?'NA':$stock_management->r3c12):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c13', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c13',$stock_management!=null?($stock_management->r3c13==-1?'NA':$stock_management->r3c13):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c14', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c14',$stock_management!=null?($stock_management->r3c14==-1?'NA':$stock_management->r3c14):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  
                                               
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c15', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c15',$stock_management!=null?($stock_management->r3c15==-1?'NA':$stock_management->r3c15):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c16', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c16',$stock_management!=null?($stock_management->r3c16==-1?'NA':$stock_management->r3c16):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c17', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c17',$stock_management!=null?($stock_management->r3c17==-1?'NA':$stock_management->r3c17):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                              
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c18', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c18',$stock_management!=null?($stock_management->r3c18==-1?'NA':$stock_management->r3c18):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c19', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c19',$stock_management!=null?($stock_management->r3c19==-1?'NA':$stock_management->r3c19):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c20', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c20',$stock_management!=null?($stock_management->r3c20==-1?'NA':$stock_management->r3c20):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c21', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c21',$stock_management!=null?($stock_management->r3c21==-1?'NA':$stock_management->r3c21):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only integer or NR permitted','pattern'=>'^(\d+)|(NR)|(NA)$','maxlength'=>'4']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3_c22', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3_c22',$stock_management!=null?($stock_management->r3c22==-1?'NA':$stock_management->r3c22):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                  
                 
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    R4                                                                    
                                                                    {{ Form::label('r4_checkbox', '', ['class' => 'col-md-3 control-label hidden']) }}                                         
                                                                    {{ Form::checkbox('r4_checkbox', 'true', false) }} 
                                                                </td>
                                                                <td>
                                                                   TB testing
                                                                </td>
                                                                <td>
                                                                    GeneXpert cartridges                                                               
                                                                </td>   
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c1',$stock_management!=null?($stock_management->r11c1==-1?'NA':$stock_management->r11c1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c2',$stock_management!=null?($stock_management->r11c2==-1?'NA':$stock_management->r11c2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c3', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c3',$stock_management!=null?($stock_management->r11c3==-1?'NA':$stock_management->r11c3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c4', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c4',$stock_management!=null?($stock_management->r11c4==-1?'NA':$stock_management->r11c4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c5', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c5',$stock_management!=null?($stock_management->r11c5==-1?'NA':$stock_management->r11c5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 


                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c6',$stock_management!=null?($stock_management->r11c6==-1?'NA':$stock_management->r11c6):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                                                             
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c7', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r3b_c7',$stock_management!=null?($stock_management->r11c7==-1?'NA':$stock_management->r11c7):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                      
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c8', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c8',$stock_management!=null?($stock_management->r11c8==-1?'NA':$stock_management->r11c8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c9', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c9',$stock_management!=null?($stock_management->r11c9==-1?'NA':$stock_management->r11c9):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c10', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c10',$stock_management!=null?($stock_management->r11c10==-1?'NA':$stock_management->r11c10):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$', 'min'=>'0','max'=>'180'])}}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c11', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c11',$stock_management!=null?($stock_management->r11c11==-1?'NA':$stock_management->r11c11):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c12', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r3b_c12',$stock_management!=null?($stock_management->r11c12==-1?'NA':$stock_management->r11c12):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c13', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c13',$stock_management!=null?($stock_management->r11c13==-1?'NA':$stock_management->r11c13):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c14', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c14',$stock_management!=null?($stock_management->r11c14==-1?'NA':$stock_management->r11c14):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  
                                               
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c15', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c15',$stock_management!=null?($stock_management->r11c15==-1?'NA':$stock_management->r11c15):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c16', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c16',$stock_management!=null?($stock_management->r11c16==-1?'NA':$stock_management->r11c16):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c17', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c17',$stock_management!=null?($stock_management->r11c17==-1?'NA':$stock_management->r11c17):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                              
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c18', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c18',$stock_management!=null?($stock_management->r11c18==-1?'NA':$stock_management->r11c18):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c19', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c19',$stock_management!=null?($stock_management->r11c19==-1?'NA':$stock_management->r11c19):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c20', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c20',$stock_management!=null?($stock_management->r11c20==-1?'NA':$stock_management->r11c20):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c21', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c21',$stock_management!=null?($stock_management->r11c21==-1?'NA':$stock_management->r11c21):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only integer or NR permitted','pattern'=>'^(\d+)|(NR)|(NA)$','maxlength'=>'4']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r3b_c22', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r3b_c22',$stock_management!=null?($stock_management->r11c22==-1?'NA':$stock_management->r11c22):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                  
                 
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    R5
                                                                    {{ Form::label('r5_checkbox', '', ['class' => 'col-md-3 control-label hidden']) }}                                         
                                                                    {{ Form::checkbox('r5_checkbox', 'true', false) }} 
                                                                </td>
                                                                <td>
                                                                   Malaria testing
                                                                </td>
                                                                <td>
                                                                    RDTs (Box of 25)                                                                
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c1',$stock_management!=null?($stock_management->r10c1==-1?'NA':$stock_management->r10c1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c2',$stock_management!=null?($stock_management->r10c2==-1?'NA':$stock_management->r10c2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c3', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c3',$stock_management!=null?($stock_management->r10c3==-1?'NA':$stock_management->r10c3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c4', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c4',$stock_management!=null?($stock_management->r10c4==-1?'NA':$stock_management->r10c4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c5', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c5',$stock_management!=null?($stock_management->r10c5==-1?'NA':$stock_management->r10c5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 


                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c6',$stock_management!=null?($stock_management->r10c6==-1?'NA':$stock_management->r10c6):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                                                             
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c7', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r4b_c7',$stock_management!=null?($stock_management->r10c7==-1?'NA':$stock_management->r10c7):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                      
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c8', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c8',$stock_management!=null?($stock_management->r10c8==-1?'NA':$stock_management->r10c8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c9', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c9',$stock_management!=null?($stock_management->r10c9==-1?'NA':$stock_management->r10c9):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c10', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c10',$stock_management!=null?($stock_management->r10c10==-1?'NA':$stock_management->r10c10):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$', 'min'=>'0','max'=>'180'])}}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c11', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c11',$stock_management!=null?($stock_management->r10c11==-1?'NA':$stock_management->r10c11):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c12', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r4b_c12',$stock_management!=null?($stock_management->r10c12==-1?'NA':$stock_management->r10c12):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c13', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c13',$stock_management!=null?($stock_management->r10c13==-1?'NA':$stock_management->r10c13):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c14', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c14',$stock_management!=null?($stock_management->r10c14==-1?'NA':$stock_management->r10c14):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  
                                               
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c15', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c15',$stock_management!=null?($stock_management->r10c15==-1?'NA':$stock_management->r10c15):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c16', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c16',$stock_management!=null?($stock_management->r10c16==-1?'NA':$stock_management->r10c16):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c17', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c17',$stock_management!=null?($stock_management->r10c17==-1?'NA':$stock_management->r10c17):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                              
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c18', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c18',$stock_management!=null?($stock_management->r10c18==-1?'NA':$stock_management->r10c18):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c19', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c19',$stock_management!=null?($stock_management->r10c19==-1?'NA':$stock_management->r10c19):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c20', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c20',$stock_management!=null?($stock_management->r10c20==-1?'NA':$stock_management->r10c20):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c21', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c21',$stock_management!=null?($stock_management->r10c21==-1?'NA':$stock_management->r10c21):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only integer or NR permitted','pattern'=>'^(\d+)|(NR)|(NA)$','maxlength'=>'4']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4b_c22', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4b_c22',$stock_management!=null?($stock_management->r10c22==-1?'NA':$stock_management->r10c22):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                  

                                                              
                                                            </tr>


                                                            <tr>
                                                                <td>
                                                                    R6
                                                                    {{ Form::label('r6_checkbox', '', ['class' => 'col-md-3 control-label hidden']) }}                                         
                                                                    {{ Form::checkbox('r6_checkbox', 'true', false) }} 
                                                                </td>
                                                                <td>
                                                                    Malaria testing     
                                                                </td>
                                                                
                                                                <td>
                                                                    Field stain A/B (1000mls)                                                                
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c1',$stock_management!=null?($stock_management->r4c1==-1?'NA':$stock_management->r4c1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c2',$stock_management!=null?($stock_management->r4c2==-1?'NA':$stock_management->r4c2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c3', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c3',$stock_management!=null?($stock_management->r4c3==-1?'NA':$stock_management->r4c3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c4', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c4',$stock_management!=null?($stock_management->r4c4==-1?'NA':$stock_management->r4c4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c5', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c5',$stock_management!=null?($stock_management->r4c5==-1?'NA':$stock_management->r4c5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 


                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c6',$stock_management!=null?($stock_management->r4c6==-1?'NA':$stock_management->r4c6):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                                                             
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c7', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r4_c7',$stock_management!=null?($stock_management->r4c7==-1?'NA':$stock_management->r4c7):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                      
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c8', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c8',$stock_management!=null?($stock_management->r4c8==-1?'NA':$stock_management->r4c8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c9', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c9',$stock_management!=null?($stock_management->r4c9==-1?'NA':$stock_management->r4c9):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c10', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c10',$stock_management!=null?($stock_management->r4c10==-1?'NA':$stock_management->r4c10):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$', 'min'=>'0','max'=>'180'])}}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c11', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c11',$stock_management!=null?($stock_management->r4c11==-1?'NA':$stock_management->r4c11):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c12', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r4_c12',$stock_management!=null?($stock_management->r4c12==-1?'NA':$stock_management->r4c12):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c13', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c13',$stock_management!=null?($stock_management->r4c13==-1?'NA':$stock_management->r4c13):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c14', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c14',$stock_management!=null?($stock_management->r4c14==-1?'NA':$stock_management->r4c14):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  
                                               
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c15', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c15',$stock_management!=null?($stock_management->r4c15==-1?'NA':$stock_management->r4c15):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c16', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c16',$stock_management!=null?($stock_management->r4c16==-1?'NA':$stock_management->r4c16):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c17', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c17',$stock_management!=null?($stock_management->r4c17==-1?'NA':$stock_management->r4c17):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                              
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c18', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c18',$stock_management!=null?($stock_management->r4c18==-1?'NA':$stock_management->r4c18):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c19', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c19',$stock_management!=null?($stock_management->r4c19==-1?'NA':$stock_management->r4c19):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c20', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c20',$stock_management!=null?($stock_management->r4c20==-1?'NA':$stock_management->r4c20):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c21', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c21',$stock_management!=null?($stock_management->r4c21==-1?'NA':$stock_management->r4c21):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only integer or NR permitted','pattern'=>'^(\d+)|(NR)|(NA)$','maxlength'=>'4']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r4_c22', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r4_c22',$stock_management!=null?($stock_management->r4c22==-1?'NA':$stock_management->r4c22):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                  
                 

                                                            </tr>        

                                                            <tr>
                                                                <td>
                                                                    R7
                                                                    {{ Form::label('r7_checkbox', '', ['class' => 'col-md-3 control-label hidden']) }}                                         
                                                                    {{ Form::checkbox('r7_checkbox', 'true', false) }} 
                                                                </td>
                                                                <td>
                                                                    Haematology  testing    

 
                                                                </td>
                                                                <td>
                                                                    HC Diluent
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c1',$stock_management!=null?($stock_management->r5c1==-1?'NA':$stock_management->r5c1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c2',$stock_management!=null?($stock_management->r5c2==-1?'NA':$stock_management->r5c2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c3', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c3',$stock_management!=null?($stock_management->r5c3==-1?'NA':$stock_management->r5c3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c4', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c4',$stock_management!=null?($stock_management->r5c4==-1?'NA':$stock_management->r5c4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c5', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c5',$stock_management!=null?($stock_management->r5c5==-1?'NA':$stock_management->r5c5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 


                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c6',$stock_management!=null?($stock_management->r5c6==-1?'NA':$stock_management->r5c6):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                                                             
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c7', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r5_c7',$stock_management!=null?($stock_management->r5c7==-1?'NA':$stock_management->r5c7):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                      
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c8', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c8',$stock_management!=null?($stock_management->r5c8==-1?'NA':$stock_management->r5c8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c9', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c9',$stock_management!=null?($stock_management->r5c9==-1?'NA':$stock_management->r5c9):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c10', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c10',$stock_management!=null?($stock_management->r5c10==-1?'NA':$stock_management->r5c10):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$', 'min'=>'0','max'=>'180'])}}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c11', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c11',$stock_management!=null?($stock_management->r5c11==-1?'NA':$stock_management->r5c11):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c12', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r5_c12',$stock_management!=null?($stock_management->r5c12==-1?'NA':$stock_management->r5c12):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c13', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c13',$stock_management!=null?($stock_management->r5c13==-1?'NA':$stock_management->r5c13):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c14', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c14',$stock_management!=null?($stock_management->r5c14==-1?'NA':$stock_management->r5c14):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  
                                               
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c15', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c15',$stock_management!=null?($stock_management->r5c15==-1?'NA':$stock_management->r5c15):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c16', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c16',$stock_management!=null?($stock_management->r5c16==-1?'NA':$stock_management->r5c16):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c17', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c17',$stock_management!=null?($stock_management->r5c17==-1?'NA':$stock_management->r5c17):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                              
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c18', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c18',$stock_management!=null?($stock_management->r5c18==-1?'NA':$stock_management->r5c18):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c19', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c19',$stock_management!=null?($stock_management->r5c19==-1?'NA':$stock_management->r5c19):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c20', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c20',$stock_management!=null?($stock_management->r5c20==-1?'NA':$stock_management->r5c20):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c21', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c21',$stock_management!=null?($stock_management->r5c21==-1?'NA':$stock_management->r5c21):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only integer or NR permitted','pattern'=>'^(\d+)|(NR)|(NA)$','maxlength'=>'4']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r5_c22', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r5_c22',$stock_management!=null?($stock_management->r5c22==-1?'NA':$stock_management->r5c22):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                  


                                                            </tr> 

                                                            <tr>
                                                                <td>
                                                                    R8
                                                                    {{ Form::label('r8_checkbox', '', ['class' => 'col-md-3 control-label hidden']) }}                                         
                                                                    {{ Form::checkbox('r8_checkbox', 'true', false) }} 
                                                                </td>
                                                                <td>
                                                                    Gram stain test 
                                                                </td>
                                                                <td>
                                                                     Crystal violent 2% 1000ml
                                                                </td>  
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c1',$stock_management!=null?($stock_management->r6c1==-1?'NA':$stock_management->r6c1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c2',$stock_management!=null?($stock_management->r6c2==-1?'NA':$stock_management->r6c2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c3', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c3',$stock_management!=null?($stock_management->r6c3==-1?'NA':$stock_management->r6c3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c4', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c4',$stock_management!=null?($stock_management->r6c4==-1?'NA':$stock_management->r6c4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c5', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c5',$stock_management!=null?($stock_management->r6c5==-1?'NA':$stock_management->r6c5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 


                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c6',$stock_management!=null?($stock_management->r6c6==-1?'NA':$stock_management->r6c6):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                                                             
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c7', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r6_c7',$stock_management!=null?($stock_management->r6c7==-1?'NA':$stock_management->r6c7):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                      
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c8', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c8',$stock_management!=null?($stock_management->r6c8==-1?'NA':$stock_management->r6c8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c9', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c9',$stock_management!=null?($stock_management->r6c9==-1?'NA':$stock_management->r6c9):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c10', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c10',$stock_management!=null?($stock_management->r6c10==-1?'NA':$stock_management->r6c10):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$', 'min'=>'0','max'=>'180'])}}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c11', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c11',$stock_management!=null?($stock_management->r6c11==-1?'NA':$stock_management->r6c11):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c12', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r6_c12',$stock_management!=null?($stock_management->r6c12==-1?'NA':$stock_management->r6c12):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c13', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c13',$stock_management!=null?($stock_management->r6c13==-1?'NA':$stock_management->r6c13):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c14', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c14',$stock_management!=null?($stock_management->r6c14==-1?'NA':$stock_management->r6c14):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  
                                               
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c15', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c15',$stock_management!=null?($stock_management->r6c15==-1?'NA':$stock_management->r6c15):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c16', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c16',$stock_management!=null?($stock_management->r6c16==-1?'NA':$stock_management->r6c16):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c17', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c17',$stock_management!=null?($stock_management->r6c17==-1?'NA':$stock_management->r6c17):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                              
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c18', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c18',$stock_management!=null?($stock_management->r6c18==-1?'NA':$stock_management->r6c18):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c19', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c19',$stock_management!=null?($stock_management->r6c19==-1?'NA':$stock_management->r6c19):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c20', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c20',$stock_management!=null?($stock_management->r6c20==-1?'NA':$stock_management->r6c20):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c21', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c21',$stock_management!=null?($stock_management->r6c21==-1?'NA':$stock_management->r6c21):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only integer or NR permitted','pattern'=>'^(\d+)|(NR)|(NA)$','maxlength'=>'4']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r6_c22', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r6_c22',$stock_management!=null?($stock_management->r6c22==-1?'NA':$stock_management->r6c22):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                  
                 
   

                                                            </tr> 

                                                            <tr>
                                                                <td>
                                                                    R9
                                                                    {{ Form::label('r9_checkbox', '', ['class' => 'col-md-3 control-label hidden']) }}                                         
                                                                    {{ Form::checkbox('r9_checkbox', 'true', false) }} 
                                                                </td>
                                                                <td>
                                                                    Syphillis  
                                                                </td>
                                                                <td>
                                                                    RPR test strips 100
                                                                </td>  
                                                                

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c1',$stock_management!=null?($stock_management->r7c1==-1?'NA':$stock_management->r7c1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c2',$stock_management!=null?($stock_management->r7c2==-1?'NA':$stock_management->r7c2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c3', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c3',$stock_management!=null?($stock_management->r7c3==-1?'NA':$stock_management->r7c3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c4', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c4',$stock_management!=null?($stock_management->r7c4==-1?'NA':$stock_management->r7c4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c5', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c5',$stock_management!=null?($stock_management->r7c5==-1?'NA':$stock_management->r7c5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 


                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c6',$stock_management!=null?($stock_management->r7c6==-1?'NA':$stock_management->r7c6):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                                                             
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c7', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r7_c7',$stock_management!=null?($stock_management->r7c7==-1?'NA':$stock_management->r7c7):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                      
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c8', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c8',$stock_management!=null?($stock_management->r7c8==-1?'NA':$stock_management->r7c8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c9', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c9',$stock_management!=null?($stock_management->r7c9==-1?'NA':$stock_management->r7c9):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c10', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c10',$stock_management!=null?($stock_management->r7c10==-1?'NA':$stock_management->r7c10):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$', 'min'=>'0','max'=>'180'])}}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c11', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c11',$stock_management!=null?($stock_management->r7c11==-1?'NA':$stock_management->r7c11):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c12', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r7_c12',$stock_management!=null?($stock_management->r7c12==-1?'NA':$stock_management->r7c12):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c13', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c13',$stock_management!=null?($stock_management->r7c13==-1?'NA':$stock_management->r7c13):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c14', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c14',$stock_management!=null?($stock_management->r7c14==-1?'NA':$stock_management->r7c14):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  
                                               
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c15', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c15',$stock_management!=null?($stock_management->r7c15==-1?'NA':$stock_management->r7c15):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c16', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c16',$stock_management!=null?($stock_management->r7c16==-1?'NA':$stock_management->r7c16):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c17', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c17',$stock_management!=null?($stock_management->r7c17==-1?'NA':$stock_management->r7c17):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                              
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c18', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c18',$stock_management!=null?($stock_management->r7c18==-1?'NA':$stock_management->r7c18):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c19', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c19',$stock_management!=null?($stock_management->r7c19==-1?'NA':$stock_management->r7c19):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c20', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c20',$stock_management!=null?($stock_management->r7c20==-1?'NA':$stock_management->r7c20):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c21', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c21',$stock_management!=null?($stock_management->r7c21==-1?'NA':$stock_management->r7c21):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only integer or NR permitted','pattern'=>'^(\d+)|(NR)|(NA)$','maxlength'=>'4']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r7_c22', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r7_c22',$stock_management!=null?($stock_management->r7c22==-1?'NA':$stock_management->r7c22):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                  
                 

                                                            </tr> 

                                                            <tr>
                                                                <td>
                                                                    R10
                                                                    {{ Form::label('r10_checkbox', '', ['class' => 'col-md-3 control-label hidden']) }}                                         
                                                                    {{ Form::checkbox('r10_checkbox', 'true', false) }} 
                                                                </td>
                                                                <td>
                                                                    Blood grouping 
                                                                </td>
                                                                <td>
                                                                    Anti-sera (5mls)
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c1',$stock_management!=null?($stock_management->r8c1==-1?'NA':$stock_management->r8c1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c2',$stock_management!=null?($stock_management->r8c2==-1?'NA':$stock_management->r8c2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c3', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c3',$stock_management!=null?($stock_management->r8c3==-1?'NA':$stock_management->r8c3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c4', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c4',$stock_management!=null?($stock_management->r8c4==-1?'NA':$stock_management->r8c4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c5', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c5',$stock_management!=null?($stock_management->r8c5==-1?'NA':$stock_management->r8c5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 


                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c6',$stock_management!=null?($stock_management->r8c6==-1?'NA':$stock_management->r8c6):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                                                             
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c7', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r8_c7',$stock_management!=null?($stock_management->r8c7==-1?'NA':$stock_management->r8c7):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                      
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c8', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c8',$stock_management!=null?($stock_management->r8c8==-1?'NA':$stock_management->r8c8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c9', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c9',$stock_management!=null?($stock_management->r8c9==-1?'NA':$stock_management->r8c9):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c10', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c10',$stock_management!=null?($stock_management->r8c10==-1?'NA':$stock_management->r8c10):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$', 'min'=>'0','max'=>'180'])}}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c11', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c11',$stock_management!=null?($stock_management->r8c11==-1?'NA':$stock_management->r8c11):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c12', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r8_c12',$stock_management!=null?($stock_management->r8c12==-1?'NA':$stock_management->r8c12):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c13', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c13',$stock_management!=null?($stock_management->r8c13==-1?'NA':$stock_management->r8c13):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c14', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c14',$stock_management!=null?($stock_management->r8c14==-1?'NA':$stock_management->r8c14):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  
                                               
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c15', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c15',$stock_management!=null?($stock_management->r8c15==-1?'NA':$stock_management->r8c15):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c16', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c16',$stock_management!=null?($stock_management->r8c16==-1?'NA':$stock_management->r8c16):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c17', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c17',$stock_management!=null?($stock_management->r8c17==-1?'NA':$stock_management->r8c17):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                              
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c18', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c18',$stock_management!=null?($stock_management->r8c18==-1?'NA':$stock_management->r8c18):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c19', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c19',$stock_management!=null?($stock_management->r8c19==-1?'NA':$stock_management->r8c19):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c20', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c20',$stock_management!=null?($stock_management->r8c20==-1?'NA':$stock_management->r8c20):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c21', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c21',$stock_management!=null?($stock_management->r8c21==-1?'NA':$stock_management->r8c21):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only integer or NR permitted','pattern'=>'^(\d+)|(NR)|(NA)$','maxlength'=>'4']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r8_c22', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r8_c22',$stock_management!=null?($stock_management->r8c22==-1?'NA':$stock_management->r8c22):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                  

                                                                 
                                                            </tr> 

                                                            <tr>
                                                                <td>
                                                                    R11
                                                                    {{ Form::label('r11_checkbox', '', ['class' => 'col-md-3 control-label hidden']) }}                                         
                                                                    {{ Form::checkbox('r11_checkbox', 'true', false) }} 
                                                                </td>
                                                                <td>
                                                                    Blood glucose test 
                                                                </td>
                                                                <td>
                                                                    Glucometer strips 50 
                                                                </td> 
                 
   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c1',$stock_management!=null?($stock_management->r9c1==-1?'NA':$stock_management->r9c1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c2',$stock_management!=null?($stock_management->r9c2==-1?'NA':$stock_management->r9c2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c3', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c3',$stock_management!=null?($stock_management->r9c3==-1?'NA':$stock_management->r9c3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c4', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c4',$stock_management!=null?($stock_management->r9c4==-1?'NA':$stock_management->r9c4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c5', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c5',$stock_management!=null?($stock_management->r9c5==-1?'NA':$stock_management->r9c5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 


                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c6',$stock_management!=null?($stock_management->r9c6==-1?'NA':$stock_management->r9c6):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                                                             
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c7', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r9_c7',$stock_management!=null?($stock_management->r9c7==-1?'NA':$stock_management->r9c7):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                      
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c8', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c8',$stock_management!=null?($stock_management->r9c8==-1?'NA':$stock_management->r9c8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c9', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c9',$stock_management!=null?($stock_management->r9c9==-1?'NA':$stock_management->r9c9):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c10', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c10',$stock_management!=null?($stock_management->r9c10==-1?'NA':$stock_management->r9c10):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$', 'min'=>'0','max'=>'180'])}}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c11', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c11',$stock_management!=null?($stock_management->r9c11==-1?'NA':$stock_management->r9c11):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c12', '', ['class' => 'col-md-3 control-label hidden']) }}                                               
                                                                    {{ Form::text('r9_c12',$stock_management!=null?($stock_management->r9c12==-1?'NA':$stock_management->r9c12):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c13', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c13',$stock_management!=null?($stock_management->r9c13==-1?'NA':$stock_management->r9c13):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                                         <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c14', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c14',$stock_management!=null?($stock_management->r9c14==-1?'NA':$stock_management->r9c14):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  
                                               
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c15', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c15',$stock_management!=null?($stock_management->r9c15==-1?'NA':$stock_management->r9c15):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'1']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c16', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c16',$stock_management!=null?($stock_management->r9c16==-1?'NA':$stock_management->r9c16):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c17', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c17',$stock_management!=null?($stock_management->r9c17==-1?'NA':$stock_management->r9c17):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                              
                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c18', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c18',$stock_management!=null?($stock_management->r9c18==-1?'NA':$stock_management->r9c18):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>    

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c19', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c19',$stock_management!=null?($stock_management->r9c19==-1?'NA':$stock_management->r9c19):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>  

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c20', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c20',$stock_management!=null?($stock_management->r9c20==-1?'NA':$stock_management->r9c20):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>   

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c21', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c21',$stock_management!=null?($stock_management->r9c21==-1?'NA':$stock_management->r9c21):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only integer or NR permitted','pattern'=>'^(\d+)|(NR)|(NA)$','maxlength'=>'4']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td> 

                                                                <td class="form-group has-feedback">
                                                                    {{ Form::label('r9_c22', '', ['class' => 'col-md-3 control-label hidden']) }}                                              
                                                                    {{ Form::text('r9_c22',$stock_management!=null?($stock_management->r9c22==-1?'NA':$stock_management->r9c22):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                </td>                                                                  

                                                            </tr> 
                                                                  
                                                                                                                                                                                  
                                                                                                                                                                                                                                                
                                                        </tbody>
                                                    </table>
                                                    </div>            
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        {{ Form::label('stock_management_comments', 'Comments', ['class' => 'col-md-1 control-label']) }}
                                                      <div class="col-md-11">
                                                            {{ Form::textarea('stock_management_comments',null,['class' => 'form-control','rows'=>'5', 'placeholder' => 'Comments']) }}

                                                            @if ($errors->has('stock_management_comments'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('stock_management_comments') }}</strong>
                                                                </span>
                                                            @endif

                                                      </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p class=" small-font-11">
                                                        <em>
                                                           <strong>1 – 9. Availability of reagents and correct use of stock cards, stock books - continued
                                                           <br>Scoring:</strong><br>
                                                           Use the sums from table1 to calculate the score. Remember to subtract ‘NA’ from the 5 items for the first 8 indicators and NA from the 10 items for indicator 9 when calculating the score, e.g. where a product is not stocked by the facility.

                                                        </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                    <table class="table table-striped table-bordered">
  
                                                        <thead> 
                                                            <tr> 
                                                                <th>Indicator</th>
                                                                <th>How to score</th>
                                                                <th>Score</th>
                                                                <th>Percentage</th>
                                                            </tr>
                                                         
                                                        </thead>                                                        

                                                        <tbody>
                                                                
                                                            <tr> 
                                                                <td>1. Availability of reagents for selected tests on day of visit</td>
                                                                <td>Sum/(5-NA)</td>
                                                                <td>                                                                

                                                                    {{ Form::label('stock_management_1_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                                    {{ Form::text('stock_management_1_score',$scores->indicator1_score,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}} 

                                                                </td>
                                                                <td>
                                                                <span id="stock_management_1_percentage"></span>
                                                                </td>
                                                            </tr>                                                                                                                  

                                                            <tr> 
                                                                <td>2. Stock card availability</td>
                                                                <td>Sum/(5-NA)</td>
                                                                <td>                                                                
     
                                                                    {{ Form::label('stock_management_2_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                                    {{ Form::text('stock_management_2_score',$scores->indicator2_score,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}}
                                                                </td>
                                                                <td>
                                                                <span id="stock_management_2_percentage"></span>
                                                                </td>
                                                            </tr>    

                                                            <tr> 
                                                                <td>3. Correct filling of stock card </td>
                                                                <td>Sum/(5-NA)</td>
                                                                <td>                                                                
     
                                                                    {{ Form::label('stock_management_3_score', '', ['class' => 'col-md-3 control-label hidden']) }}                                                    
                                                                    {{ Form::text('stock_management_3_score',$scores->indicator3_score,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}} 
                                                                </td>
                                                                <td>
                                                                    <span id="stock_management_3_percentage"></span>         
                                                                </td>
                                                            </tr>                                                                                                                  

                                                            <tr> 
                                                                <td>4. Does physical count agree with stock card balance? </td>
                                                                <td>Sum/(5-NA)</td>
                                                                <td>                                                                
     
                                                                    {{ Form::label('stock_management_4_score', '', ['class' => 'col-md-3 control-label hidden']) }}                                                     
                                                                    {{ Form::text('stock_management_4_score',$scores->indicator4_score,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}} 
                                                                </td>
                                                                <td>
                                                                    <span id="stock_management_4_percentage"></span>           
                                                                </td>
                                                            </tr>                                                                                                                        

                                                            <tr> 
                                                                <td>5. Is AMC in the stock card correctly calculated?</td>
                                                                <td>Sum/(5-NA)</td>
                                                                <td>                                                                
     
                                                                    {{ Form::label('stock_management_5_score', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                                    {{ Form::text('stock_management_5_score',$scores->indicator5_score,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}} 
                                                                </td>
                                                                <td>
                                                                    <span id="stock_management_5_percentage"></span>
                                                                </td>
                                                            </tr>                                                                                                                  

                                                            <tr> 
                                                                <td>6. Is Stock book correctly filled?</td>
                                                                <td>Sum/(5-NA)</td>
                                                                <td>                                                                
     
                                                                    {{ Form::label('stock_management_6_score', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                                    {{ Form::text('stock_management_6_score',$scores->indicator6_score,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}} 
                                                                </td>
                                                                <td>
                                                                    <span id="stock_management_6_percentage"></span>
                                                                </td>
                                                            </tr>                                                                                                                               
                                                            <tr> 
                                                                <td>7. Is AMC in the stock book correctly calculated?</td>
                                                                <td>Sum/(5-NA)</td>
                                                                <td>                                                                
     
                                                                    {{ Form::label('stock_management_7_score', '', ['class' => 'col-md-3 control-label hidden']) }}          
                                                                    {{ Form::text('stock_management_7_score',$scores->indicator7_score,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}} 
                                                                </td>
                                                                <td>
                                                                    <span id="stock_management_7_percentage"></span>
                                                                </td>
                                                            </tr>                                                                                                                  

                                                            <tr> 
                                                                <td>8. Number of items not overstocked? </td>
                                                                <td>Sum/(5-NA)</td>
                                                                <td>                                                                
     
                                                                    {{ Form::label('stock_management_8_score', '', ['class' => 'col-md-3 control-label hidden']) }}          
                                                                    {{ Form::text('stock_management_8_score',$scores->indicator8_score,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}} 
                                                                </td>
                                                                <td>
                                                                    <span id="stock_management_8_percentage"></span>
                                                                </td>
                                                            </tr> 

                                                            <tr> 
                                                                <td>9. Order fill rate (C25)</td>
                                                                <td>Sum/(5-NA)</td>
                                                                <td>                                                                
     
                                                                    {{ Form::label('stock_management_9_score', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                                    {{ Form::text('stock_management_9_score',$scores->indicator9_score,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}} 

                                                                </td>
                                                                <td>
                                                                    <span id="stock_management_9_percentage"></span>
                                                                </td>
                                                            </tr> 

                                                        </tbody>
                                                    </table>
                                                    </div>              
                                                </div>
                                            </div>                                            
                                        </div>
                            </div>
                        </div>
        <!-- End Box 2 -->

        <!-- Start Box 3 -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title"> 
                                    <a data-toggle="collapse" data-parent="#surveyAccordian"  href="#collapseStorage">II. Storage management</a>
                                </h4>
                            </div>
                            <div id="collapseStorage" class="panel-collapse collapse">
                                        <div class="panel-body">
                                        
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>10. Cleanliness of the laboratory including storage facilities</strong><br>
                                                            <em>Make a physical observation of the place where laboratory supplies are stored.
                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6">Area</th>
                                                                    <th class="col-md-2">1/0/NA</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                    
                                                                <tr> 
                                                                    <td>a) The Lab store is clean and tidy</td>
                                                                    
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_10a', '', ['class' => 'col-md-3 control-label hidden']) }}                           

                                                                    {{ Form::text('storage_management_10a',$storage10->sub_indicator_10a==-1?'NA':$storage10->sub_indicator_10a,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    
                                                                    <td rowspan="4">
                                                                        {{ Form::textarea('storage_management_10_comments',$storage10->indicator_10_comments,['class' => 'form-control','rows'=>'8', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr>

                                                                <tr> 
                                                                    <td>b) The main store is clean and tidy</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_10b', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_10b',$storage10->sub_indicator_10b==-1?'NA':$storage10->sub_indicator_10b,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>


                                                                <tr> 
                                                                    <td>c) The storage areas within the  are laboratory  clean and tidy</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_10c', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_10c',$storage10->sub_indicator_10c==-1?'NA':$storage10->sub_indicator_10c,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>    


                                                                <tr> 
                                                                    <td>d) The Laboratory is clean and tidy</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_10d', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_10d',$storage10->sub_indicator_10d==-1?'NA':$storage10->sub_indicator_10d,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                                                
                                                            </tbody>
                                                        </table>                                                  
                                                    </div>
                                                    <p>

                                                    <span class="score-computation">Score:   
                                                    <span id="score_10"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_10"></span>  </span>  
                                                    {{ Form::label('storage_management_10_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('storage_management_10_score',$scores->indicator10_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }}                                                 
                                                           
                                                    </p>                                                          
                                                </div>
                                            </div>   


                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>11. Hygiene of the laboratory</strong><br>
                                                            <em>Ask to be shown the water points, hand washing and staining stations: score yes =1, No=0 and NA for not applicable
                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6">Area</th>
                                                                    <th class="col-md-2">1/0/NA</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                    
                                                                <tr> 
                                                                    <td>a)   Is there running water in the lab?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_11a', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_11a',$storage11->sub_indicator_11a==-1?'NA':$storage11->sub_indicator_11a,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td rowspan="5">
                                                                        {{ Form::textarea('storage_management_11_comments',$storage11->indicator_11_comments,['class' => 'form-control','rows'=>'10', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr>

                                                                <tr> 
                                                                    <td>b)   Is the hand washing area separate from the staining area?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_11b', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_11b',$storage11->sub_indicator_11b==-1?'NA':$storage11->sub_indicator_11b,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>


                                                                <tr> 
                                                                    <td>c)   Is hand washing facilities accessible, conveniently located, hygienic and functioning?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_11c', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_11c',$storage11->sub_indicator_11c==-1?'NA':$storage11->sub_indicator_11c,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>    


                                                                <tr> 
                                                                    <td>d)   Is the drainage system of suitable standards?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_11d', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_11d',$storage11->sub_indicator_11d==-1?'NA':$storage11->sub_indicator_11d,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                          

                                                                <tr> 
                                                                    <td>e)  Is there soap for hand washing?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_11e', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_11e',$storage11->sub_indicator_11e==-1?'NA':$storage11->sub_indicator_11e,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>  

                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         
                                                 <p>

                                                    <span class="score-computation">Score:   
                                                    <span id="score_11"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_11"></span>  </span>     
                                                    {{ Form::label('storage_management_11_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('storage_management_11_score',$scores->indicator11_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }}                                                             
                                                    </p>  
                                                </div>
                                            </div> 

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>12. System for storage of laboratory reagents and supplies</strong><br>
                                                            <em>Ask to be shown around the areas where laboratory supplies are stored and observe the following conditions, score yes =1 and No=0 
                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6">Area</th>
                                                                    <th class="col-md-1">Main store<br>1/0/NA</th>
                                                                    <th class="col-md-1">Lab store<br>1/0/NA</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                    
                                                                <tr> 
                                                                    <td>a) Are there shelves and cupboards for storage?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_12a1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_12a1',$storage12->sub_indicator_12a_main_store==-1?'NA':$storage12->sub_indicator_12a_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_12a2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_12a2',$storage12->sub_indicator_12a_lab_store==-1?'NA':$storage12->sub_indicator_12a_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td rowspan="5">
                                                                        {{ Form::textarea('storage_management_12_comments',$storage12->indicator_12_comments,['class' => 'form-control','rows'=>'10', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr>

                                                                <tr> 
                                                                    <td>b) Are reagents stored on shelves and /or in cupboards?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_12b1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_12b1',$storage12->sub_indicator_12b_main_store==-1?'NA':$storage12->sub_indicator_12b_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_12b2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_12b2',$storage12->sub_indicator_12b_lab_store==-1?'NA':$storage12->sub_indicator_12b_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    
                                                                </tr>


                                                                <tr> 
                                                                    <td>c) Are the stock cards kept next to the reagents on the shelves or in a file?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_12c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_12c1',$storage12->sub_indicator_12c_main_store==-1?'NA':$storage12->sub_indicator_12c_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>                                                 
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_12c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_12c2',$storage12->sub_indicator_12c_lab_store==-1?'NA':$storage12->sub_indicator_12c_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>    


                                                                <tr> 
                                                                    <td>d)  Are lab reagents stored on shelves or in cupboards stored in a systematic manner (alphabetic, usage form etc.)?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_12d1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_12d1',$storage12->sub_indicator_12d_main_store==-1?'NA':$storage12->sub_indicator_12d_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_12d2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_12d2',$storage12->sub_indicator_12d_lab_store==-1?'NA':$storage12->sub_indicator_12d_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                          

                                                                <tr> 
                                                                    <td>e)  Are the shelves labelled?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_12e1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_12e1',$storage12->sub_indicator_12e_main_store==-1?'NA':$storage12->sub_indicator_12e_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_12e2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_12e2',$storage12->sub_indicator_12e_lab_store==-1?'NA':$storage12->sub_indicator_12e_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>  

                                                            </tbody>
                                                        </table>                                                  
                                                    </div> 

                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_12"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_12"></span>  </span> 

                                                    {{ Form::label('storage_management_12_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('storage_management_12_score',$scores->indicator12_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }}                                                                 
                                                 </p>

                                                </div>
                                            </div> 
                                        
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>13. Storage conditions for laboratory supplies/reagents</strong><br>
                                                            <em>Ask to be shown around the main store and the store for lab supplies and observe the following conditions,  score yes =1, No=0 
                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6">Area</th>
                                                                    <th class="col-md-1">Main Store</br>1/0/NA</th>
                                                                    <th class="col-md-1">Lab Store</br>1/0/NA</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                    
                                                                <tr> 
                                                                    <td>a) No signs of pests/harmful insects/rodents seen in the area (Check traces, droppings etc. from bats, rats, ants, etc.)</td>
                                                                    
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13a1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13a1',$storage13->sub_indicator_13a_main_store==-1?'NA':$storage13->sub_indicator_13a_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13a2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13a2',$storage13->sub_indicator_13a_lab_store==-1?'NA':$storage13->sub_indicator_13a_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td rowspan="12">
                                                                        {{ Form::textarea('storage_management_13_comments',$storage13->indicator_13_comments,['class' => 'form-control','rows'=>'30', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr>

                                                                <tr> 
                                                                    <td> b) Are the supplies protected from direct sunlight (Painted glass, curtains or blinds – or no windows)?</td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13b1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13b1',$storage13->sub_indicator_13b_main_store==-1?'NA':$storage13->sub_indicator_13b_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13b2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13b2',$storage13->sub_indicator_13b_lab_store==-1?'NA':$storage13->sub_indicator_13b_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>


                                                                <tr> 
                                                                    <td>c)  Is the temperature of the storage room monitored?</td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13c1',$storage13->sub_indicator_13c_main_store==-1?'NA':$storage13->sub_indicator_13c_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13c2',$storage13->sub_indicator_13c_lab_store==-1?'NA':$storage13->sub_indicator_13c_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>    


                                                                <tr> 
                                                                    <td>d)  Can the temperature of the storeroom be regulated (Ventilation, , air-condition, windows)?</td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13d1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13d1',$storage13->sub_indicator_13d_main_store==-1?'NA':$storage13->sub_indicator_13d_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13d2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13d2',$storage13->sub_indicator_13d_lab_store==-1?'NA':$storage13->sub_indicator_13d_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                          

                                                                <tr> 
                                                                    <td>e) Roof is maintained in good condition to avoid water penetration?</td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13e1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13e1',$storage13->sub_indicator_13e_main_store==-1?'NA':$storage13->sub_indicator_13e_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13e2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13e2',$storage13->sub_indicator_13e_lab_store==-1?'NA':$storage13->sub_indicator_13e_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>   

                                                                <tr> 
                                                                    <td>f)  Is storage space sufficient and adequate?</td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13f1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13f1',$storage13->sub_indicator_13f_main_store==-1?'NA':$storage13->sub_indicator_13f_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13f2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13f2',$storage13->sub_indicator_13f_lab_store==-1?'NA':$storage13->sub_indicator_13f_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                          

                                                                <tr> 
                                                                    <td>g)  Is the store room lockable and access limited to authorised personnel?</td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13g1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13g1',$storage13->sub_indicator_13g_main_store==-1?'NA':$storage13->sub_indicator_13g_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13g2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13g2',$storage13->sub_indicator_13g_lab_store==-1?'NA':$storage13->sub_indicator_13g_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr>

                                                                <tr> 
                                                                    <td>h)  Fire safety equipment is available and accessible (any items for promotion of fire safety should be considered)</td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13h1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13h1',$storage13->sub_indicator_13h_main_store==-1?'NA':$storage13->sub_indicator_13h_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13h2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13h2',$storage13->sub_indicator_13h_lab_store==-1?'NA':$storage13->sub_indicator_13h_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>    


                                                                <tr> 
                                                                    <td>i)  Is there a functioning system for cold storage (Refrigerator)?</td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13i1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13i1',$storage13->sub_indicator_13i_main_store==-1?'NA':$storage13->sub_indicator_13i_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13i2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13i2',$storage13->sub_indicator_13i_lab_store==-1?'NA':$storage13->sub_indicator_13i_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                          

                                                                <tr> 
                                                                    <td>j)  If yes, are only reagents stored in the refrigerator – no food or beverage?</td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13j1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13j1',$storage13->sub_indicator_13j_main_store==-1?'NA':$storage13->sub_indicator_13j_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13j2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13j2',$storage13->sub_indicator_13j_lab_store==-1?'NA':$storage13->sub_indicator_13j_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>

                                                                <tr> 
                                                                    <td>k)  Is the temperature of the refrigerator recorded daily?</td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13k1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13k1',$storage13->sub_indicator_13k_main_store==-1?'NA':$storage13->sub_indicator_13k_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13k2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13k2',$storage13->sub_indicator_13k_lab_store==-1?'NA':$storage13->sub_indicator_13k_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                          

                                                                <tr> 
                                                                    <td>l)   Boxes are not directly on the floor in the store</td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13l1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13l1',$storage13->sub_indicator_13l_main_store==-1?'NA':$storage13->sub_indicator_13l_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_13l2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_13l2',$storage13->sub_indicator_13l_lab_store==-1?'NA':$storage13->sub_indicator_13l_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                                                    
                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         

                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_13"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_13"></span>  </span>    
                                                    {{ Form::label('storage_management_13_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('storage_management_13_score',$scores->indicator13_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }}                                                              
                                                 </p>  
                                                </div>
                                            </div> 
                                        
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>14. Storage practices of laboratory reagents </strong><br>
                                                            <em>Checks for the listed components and  score yes =1, No=0 and NA for not applicable 
                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6">Area</th>
                                                                    <th class="col-md-1">Main store <br>1/0/NA</th>
                                                                    <th class="col-md-1">Lab store <br>1/0/NA</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                    
                                                                <tr> 
                                                                    <td>a) Is there a record for expired reagents (Check)?</td>


                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14a1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14a1',$storage14->sub_indicator_14a_main_store==-1?'NA':$storage14->sub_indicator_14a_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14a2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14a2',$storage14->sub_indicator_14a_lab_store==-1?'NA':$storage14->sub_indicator_14a_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>                                                                    

                                                                    <td rowspan="8">
                                                                        {{ Form::textarea('storage_management_14_comments',$storage14->indicator_14_comments,['class' => 'form-control','rows'=>'18', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr>

                                                                <tr> 
                                                                    <td>b) Is there a place to store expired reagents separately?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14b1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14b1',$storage14->sub_indicator_14b_main_store==-1?'NA':$storage14->sub_indicator_14b_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14b2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14b2',$storage14->sub_indicator_14b_lab_store==-1?'NA':$storage14->sub_indicator_14b_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>


                                                                <tr> 
                                                                    <td>c) Is FEFO adhered to? (Check 5 randomly selected reagents)</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14c1',$storage14->sub_indicator_14c_main_store==-1?'NA':$storage14->sub_indicator_14c_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14c2',$storage14->sub_indicator_14c_lab_store==-1?'NA':$storage14->sub_indicator_14c_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>                                                                    

                                                                </tr>    


                                                                <tr> 
                                                                    <td>d) Are reagent bottles/kits  labelled with the date of opening ( enter date when the bottle was first opened)?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14d1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14d1',$storage14->sub_indicator_14d_main_store==-1?'NA':$storage14->sub_indicator_14d_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14d2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14d2',$storage14->sub_indicator_14d_lab_store==-1?'NA':$storage14->sub_indicator_14d_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                          

                                                                <tr> 
                                                                    <td>e) Do all bottles that have been opened have a lid on?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14e1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14e1',$storage14->sub_indicator_14e_main_store==-1?'NA':$storage14->sub_indicator_14e_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14e2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14e2',$storage14->sub_indicator_14e_lab_store==-1?'NA':$storage14->sub_indicator_14e_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>   

                                                                <tr> 
                                                                    <td>f) Are chemicals labelled with the chemical’s name and with hazard markings?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14f1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14f1',$storage14->sub_indicator_14f_main_store==-1?'NA':$storage14->sub_indicator_14f_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14f2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14f2',$storage14->sub_indicator_14f_lab_store==-1?'NA':$storage14->sub_indicator_14f_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                          

                                                                <tr> 
                                                                    <td>g) Are flammable chemicals stored out of sunlight and below their flashpoint, preferably in a steel cabinet in a well-ventilated area?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14g1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14g1',$storage14->sub_indicator_14g_main_store==-1?'NA':$storage14->sub_indicator_14g_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14g2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14g2',$storage14->sub_indicator_14g_lab_store==-1?'NA':$storage14->sub_indicator_14g_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>  
                                                                <tr> 
                                                                    <td>h) Are flammable and corrosive agents stored separate from one another?</td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14h1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14h1',$storage14->sub_indicator_14h_main_store==-1?'NA':$storage14->sub_indicator_14h_main_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('storage_management_14h2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('storage_management_14h2',$storage14->sub_indicator_14h_lab_store==-1?'NA':$storage14->sub_indicator_14h_lab_store,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>    
                                                                  
                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_14"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_14"></span>  </span>  

                                                    {{ Form::label('storage_management_14_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('storage_management_14_score',$scores->indicator14_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }}                                                                
                                                 </p>  
                                                </div>
                                            </div> 

                                        </div>
                            </div>
                        </div>
        <!-- End Box 3 -->


        <!-- Start Box 4 -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title"> 
                                    <a data-toggle="collapse" data-parent="#surveyAccordian"  href="#collapseOrdering">III. Ordering, receipt and recording</a>
                                </h4>
                            </div>
                            <div id="collapseOrdering" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>15. Reorder level calculation</strong><br>
                                                            <em>Ask the supervisee how, s/he decides the amount to order (if they were to re-order),score appropriately. The supervisee should show knowledge about the process of using  the consumption log and the stock card to extract figures such as;Stock on Hand, AMC and both Min-max for the commodity in question). Write NR in case the order form is missing for part a and c, Write NR for part b if the laboratory does not have the standard TEST MENU by level 
                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6">Area</th>
                                                                    <th class="col-md-2">1/0/NR</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                                                                 
                                                                <tr> 
                                                                    <td>a) Select a stock card or stock book; select one reagent/test kit (e.g. determine test kits) and check whether the person knows how to calculate the quantity to order.

                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            Record: SOH                            
                                                                        {{ Form::label('ordering_15a1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                {{ Form::text('ordering_15a1',$ordering15->sub_indicator_15a_soh,['class' => 'form-control input-sm custom-input-md']) }}
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        Issued out                     
                                                                        {{ Form::label('ordering_15a2', '', ['class' => 'col-md-3 control-label hidden']) }}   
                                                                            {{ Form::text('ordering_15a2',$ordering15->sub_indicator_15a_issued,['class' => 'form-control input-sm custom-input-md','maxlength'=>'3']) }}
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        {{ Form::label('ordering_15a3', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                                            AMC{{ Form::text('ordering_15a3',$ordering15->sub_indicator_15a_amc,['class' => 'form-control input-sm custom-input-md','maxlength'=>'3']) }}
                                                                        </div>
                                                                    </div> 

                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            Maximum quantity                           
                                                                        {{ Form::label('ordering_15a4', '', ['class' => 'col-md-3 control-label hidden']) }}   
                                                                            {{ Form::text('ordering_15a4',null,['class' => 'form-control input-sm custom-input-md','maxlength'=>'3']) }}
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        {{ Form::label('ordering_15a5', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                                            Quantity to order{{ Form::text('ordering_15a5',null,['class' => 'form-control input-sm custom-input-md','maxlength'=>'3']) }}
                                                                        </div>
                                                                    </div> 

                                                                    <br><br>
                                                                    Score 1 if quantity to order is correct otherwise 0 or NR for missing order forms

                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('ordering_15a', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('ordering_15a',$ordering15->sub_indicator_15a==-1?'NA':$ordering15->sub_indicator_15a,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td rowspan="3">
                                                                        {{ Form::textarea('ordering_15_comments',$ordering15->indicator_15_comments,['class' => 'form-control','rows'=>'7', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>b) Is there a TEST MENU at laboratory facility on the day of visit?  </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('ordering_15b', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('ordering_15b',$ordering15->sub_indicator_15b==-1?'NA':$ordering15->sub_indicator_15b,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>

                                                                </tr> 

                                                                <tr> 
                                                                    <td>c) Review 3 previous orders and identify any 5 commodities that appear in all the orders.
                                                                    </br>Score  1 if all items that are vital else 0 (refer to  EMHS LIST for Uganda by level)
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('ordering_15c', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('ordering_15c',$ordering15->sub_indicator_15c==-1?'NA':$ordering15->sub_indicator_15c,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr>                                    

                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_15"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_15"></span>  </span>         
                                                 </p>   
                                                    {{ Form::label('ordering_15_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('ordering_15_score',$scores->indicator15_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }} 
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>16. Adherence to ordering and delivery procedures</strong><br>
                                                            <em>Complete the dates of orders and delivery in the table below for the last order. The final score is 1 or 0 depending on timeliness of ordering and delivery. Write NR for missing delivery schedule, order forms or delivery forms 
                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6">Area</th>
                                                                    <th class="col-md-2">1/0/NR</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                                                                 
                                                                <tr> 
                                                                    <td>a) Ordering schedule date ( check the warehouse schedules) </td>
                                                                    <td>
                                                                    {{ Form::label('ordering_16a', '', ['class' => 'col-md-3 control-label hidden']) }}  
                                                                    {{ Form::text('ordering_16a',$ordering16->sub_indicator_16a,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                                                    </td>

                                                                    <td rowspan="6">
                                                                        {{ Form::textarea('ordering_16_comments',$ordering16->indicator_16_comments,['class' => 'form-control','rows'=>'14', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>b) Actual date of ordering by facility (write date stamped by in-charge) </td>
                                                                    <td>
                                                                    {{ Form::label('ordering_16b', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                                    {{ Form::text('ordering_16b',$ordering16->sub_indicator_16b,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                                                    </td>

                                                                </tr> 

                                                                <tr> 
                                                                    <td>c) Was ordering timely (Y=1/N=0)? </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('ordering_16c', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                       
                                                                     {{ Form::text('ordering_16c',$ordering16->sub_indicator_16c,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                </tr>
                                                                
                                                                <tr> 
                                                                    <td>d) Delivery schedule date </td>
                                                                    <td>{{ Form::label('ordering_16d', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                                    {{ Form::text('ordering_16d',$ordering16->sub_indicator_16d,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                                                    </td>

                                                                </tr> 

                                                                <tr> 
                                                                    <td>e) Date of delivery from warehouse </td>
                                                                    <td>{{ Form::label('ordering_16e', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                                    {{ Form::text('ordering_16e',$ordering16->sub_indicator_16e,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                                                    </td>

                                                                </tr> 

                                                                <tr> 
                                                                    <td>f) Was delivery on schedule (timely) (Y=1/N=0)? </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('ordering_16f', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                      
                                                                     {{ Form::text('ordering_16f',$ordering16->sub_indicator_16f,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>

                                                                </tr>                                     

                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                           
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_16"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_16"></span>  </span>         
                                                 </p> 
                                                    {{ Form::label('ordering_16_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('ordering_16_score',$scores->indicator16_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }}                                                  
                                                </div>
                                            </div> 

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>17. Availability of a laboratory product catalogue</strong><br>
                                                            <em>Check to see if it’s the official product catalogue issued by the national warehouses.<br>Score 1 if available otherwise 0, (if not yet distributed by the national warehouses NA)

                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6">Area</th>
                                                                    <th class="col-md-2">1/0/NA</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                    
                                                                <tr> 
                                                                    <td>a) Availability of a product catalogue (yes=1, No=0) </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('ordering_17a', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('ordering_17a',$ordering17->sub_indicator_17a==-1?'NA':$ordering17->sub_indicator_17a,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>

                                                                    <td>
                                                                        {{ Form::textarea('ordering_17_comments',$ordering17->indicator_17_comments,['class' => 'form-control','rows'=>'3', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr> 

                                                            </tbody>
                                                        </table>                                                  
                                                    </div>                                                             
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_17"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_17"></span>  </span>    
                                                </p>  
                                                {{ Form::label('ordering_17_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                {{ Form::text('ordering_17_score',$scores->indicator17_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }} 
                                                </div>
                                            </div> 

                                        </div>
                            </div>
                        </div>
        <!-- Start Box 4 -->



       
        <!-- Start Box 5 -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title"> 
                                    <a data-toggle="collapse" data-parent="#surveyAccordian"  href="#collapseEquipment"> IV. Laboratory equipment</a>
                                </h4>
                            </div>
                            <div id="collapseEquipment" class="panel-collapse collapse">
                                <div class="panel-body">

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>18. Developing and maintaining facility equipment inventory</strong><br>
                                                            <em>Complete the table and score yes= 1 or No= 0</em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6">Area</th>
                                                                    <th class="col-md-2">1/0</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                    
                                                                <tr> 
                                                                    <td>a) Is the inventory equipment form available (see a copy of the form and yes= 1, No=0) </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_18a', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_18a',$equipment18!=null?($equipment18->sub_indicator_18a==-1?'NA':$equipment18->sub_indicator_18a):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td rowspan="4">
                                                                        {{ Form::textarea('lab_equipment_18_comments',$equipment18!=null?$equipment18->indicator_18_comments:null,['class' => 'form-control','rows'=>'8', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr> 
                                                                <tr> 
                                                                    <td>b) Does the facility have an equipment inventory(yes= 1, No=0) </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_18b', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_18b',$equipment18!=null?($equipment18->sub_indicator_18b==-1?'NA':$equipment18->sub_indicator_18b):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr> 
                                                                <tr> 
                                                                    <td>c) Has the inventory been updated  in the last 1 year see a copy of the form last updated in the last 1 year  (yes= 1, No=0) </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_18c', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_18c',$equipment18!=null?($equipment18->sub_indicator_18c==-1?'NA':$equipment18->sub_indicator_18c):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr> 
                                                                <tr> 
                                                                    <td>d) Is equipment standardization guideline available at the facility? (see a copy of the form and (yes= 1, No=0) </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_18d', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_18d',$equipment18!=null?($equipment18->sub_indicator_18d==-1?'NA':$equipment18->sub_indicator_18d):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                                                 
                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_18"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_18"></span>  </span>         
                                                 </p>  
                                                    {{ Form::label('lab_equipment_18_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('lab_equipment_18_score',$scores->indicator18_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }}                                                     
                                                </div>
                                            </div> 
                                        
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>19. Equipment management plan to ensure functionality</strong><br>
                                                            <em>Complete the table below Score 1/0 or NA depending on the facility situation NB: evaluate the facility based on equipment platforms available</em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6">Area</th>
                                                                    <th class="col-md-2">1/0/NA</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                    
                                                                <tr> 
                                                                    <td>a) Is  relevant major equipment service information readily available in the laboratory (look out for equipment book of life for CD4, heamatology, clinical chemistry/ colorimeter and microscope. (Score 1 based on availability of the above equipment information)
                                                                    </br>NB: for any available equipment all service information must be available to score 1
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_19a', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_19a',$equipment19!=null?($equipment19->sub_indicator_19a==-1?'NA':$equipment19->sub_indicator_19a):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[(0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td rowspan="4">
                                                                        {{ Form::textarea('lab_equipment_19_comments',$equipment19!=null?$equipment19->indicator_19_comments:null,['class' => 'form-control','rows'=>'12', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr> 
                                                                <tr> 
                                                                    <td>b) Is major equipment routinely serviced according to schedule and documented in the service logs? (check records and any available platform need to be a yes to score a 1) </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_19b', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_19b',$equipment19!=null?($equipment19->sub_indicator_19b==-1?'NA':$equipment19->sub_indicator_19b):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[(0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr> 
                                                                <tr> 
                                                                    <td>c) Is internal quality control (IQC) performed for CD4, heamatology and clinical chemistry/colorimeter equipment, documented, and reviewed prior to release of patient results? (Review the last 5 days the test were done (look in the lab register) check records and any available platform need to be a yes to score a 1) </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_19c', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_19c',$equipment19!=null?($equipment19->sub_indicator_19c==-1?'NA':$equipment19->sub_indicator_19c):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[(0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr> 
                                                                <tr> 
                                                                    <td>d) Are the manufacturers’ operator manuals for major equipment (CD4, heamatology and clinical chemistry/calorimeter) readily available? (check records and any available platform need to be a yes to score a 1) </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_19d', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_19d',$equipment19!=null?($equipment19->sub_indicator_19d==-1?'NA':$equipment19->sub_indicator_19d):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[(0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                                                 
                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_19"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_19"></span>  </span>         
                                                 </p> 

                                                    {{ Form::label('lab_equipment_19_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('lab_equipment_19_score',$scores->indicator19_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }}

                                                </div>
                                            </div> 

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>20. Equipment functionality</strong><br>
                                                            <em>Has the laboratory provided uninterrupted testing services, with no disruptions due to equipment downtime since the last visit (Please note for baseline visit look at the past 1 year)? Yes=1, No =0, N/A = not applicable (not available). NB: Verify from the equipment maintenance log and record the equipment downtime in months if there were some interruptions.
                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-2">Equipment</th>
                                                                    <th class="col-md-1">1/0/NA</th>
                                                                    <th class="col-md-1">Duration of downtime (months)</th>
                                                                    <th class="col-md-1">Non-functional due to equipment (hardware / oftware) (1/0) </th>
                                                                    <th class="col-md-1">Non-functional due to reagents (1/0) </th>
                                                                    <th class="col-md-1">Non-functional due to other factors e.g. power, manpower </th>
                                                                    <th class="col-md-1">Response time (days)</th>  
                                                                    <th class="col-md-3">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                    
                                                                <tr> 
                                                                    <td>a) CD4
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20a1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20a1',$equipment20!=null?($equipment20->sub_indicator_20a1==-1?'NA':$equipment20->sub_indicator_20a1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20a2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20a2',$equipment20!=null?($equipment20->sub_indicator_20a2==-1?'NA':$equipment20->sub_indicator_20a2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0-12 permitted','pattern'=>'^([0-9]|[1-9][0-2])|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20a3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20a3',$equipment20!=null?($equipment20->sub_indicator_20a3==-1?'NA':$equipment20->sub_indicator_20a3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20a4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20a4',$equipment20!=null?($equipment20->sub_indicator_20a4==-1?'NA':$equipment20->sub_indicator_20a4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20a5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20a5',$equipment20!=null?($equipment20->sub_indicator_20a5==-1?'NA':$equipment20->sub_indicator_20a5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20a6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20a6',$equipment20!=null?($equipment20->sub_indicator_20a6==-1?'NA':$equipment20->sub_indicator_20a6):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
    
                                                                    <td rowspan="6">
                                                                        {{ Form::textarea('storage_management_20_comments',$equipment20!=null?$equipment20->indicator_20_comments:null,['class' => 'form-control','rows'=>'15', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr> 
                                                                <tr> 
                                                                    <td>b) Hematology </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20b1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20b1',$equipment20!=null?($equipment20->sub_indicator_20b1==-1?'NA':$equipment20->sub_indicator_20b1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20b2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20b2',$equipment20!=null?($equipment20->sub_indicator_20b2==-1?'NA':$equipment20->sub_indicator_20b2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0-12 permitted','pattern'=>'^([0-9]|[1-9][0-2])|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20b3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20b3',$equipment20!=null?($equipment20->sub_indicator_20b3==-1?'NA':$equipment20->sub_indicator_20b3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20b4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20b4',$equipment20!=null?($equipment20->sub_indicator_20b4==-1?'NA':$equipment20->sub_indicator_20b4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20b5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20b5',$equipment20!=null?($equipment20->sub_indicator_20b5==-1?'NA':$equipment20->sub_indicator_20b5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20b6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                                                                      {{ Form::text('lab_equipment_20b6',$equipment20!=null?($equipment20->sub_indicator_20b6==-1?'NA':$equipment20->sub_indicator_20b6):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr> 
                                                                <tr> 
                                                                    <td>c) Microscope </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20c1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20c1',$equipment20!=null?($equipment20->sub_indicator_20c1==-1?'NA':$equipment20->sub_indicator_20c1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20c2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20c2',$equipment20!=null?($equipment20->sub_indicator_20c2==-1?'NA':$equipment20->sub_indicator_20c2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 1-12 permitted','pattern'=>'^([0-9]|[1-9][0-2])|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20c3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20c3',$equipment20!=null?($equipment20->sub_indicator_20c3==-1?'NA':$equipment20->sub_indicator_20c3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20c4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20c4',$equipment20!=null?($equipment20->sub_indicator_20c4==-1?'NA':$equipment20->sub_indicator_20c4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20c5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20c5',$equipment20!=null?($equipment20->sub_indicator_20c5==-1?'NA':$equipment20->sub_indicator_20c5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                                                                      {{ Form::text('lab_equipment_20c6',$equipment20!=null?($equipment20->sub_indicator_20c6==-1?'NA':$equipment20->sub_indicator_20c6):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>


                                                                </tr> 
                                                                <tr> 
                                                                    <td>d) Centrifuge </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20d1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20d1',$equipment20!=null?($equipment20->sub_indicator_20d1==-1?'NA':$equipment20->sub_indicator_20d1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20d2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20d2',$equipment20!=null?($equipment20->sub_indicator_20d2==-1?'NA':$equipment20->sub_indicator_20d2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 1-12 permitted','pattern'=>'^([0-9]|[1-9][0-2])|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20d3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20d3',$equipment20!=null?($equipment20->sub_indicator_20d3==-1?'NA':$equipment20->sub_indicator_20d3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20d4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20d4',$equipment20!=null?($equipment20->sub_indicator_20d4==-1?'NA':$equipment20->sub_indicator_20d4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20d5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20d5',$equipment20!=null?($equipment20->sub_indicator_20d5==-1?'NA':$equipment20->sub_indicator_20d5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20d6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                                                                      {{ Form::text('lab_equipment_20d6',$equipment20!=null?($equipment20->sub_indicator_20d6==-1?'NA':$equipment20->sub_indicator_20d6):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr>                                          

                                                                <tr> 
                                                                    <td>e) HB meter </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20e1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20e1',$equipment20!=null?($equipment20->sub_indicator_20e1==-1?'NA':$equipment20->sub_indicator_20e1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20e2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20e2',$equipment20!=null?($equipment20->sub_indicator_20e2==-1?'NA':$equipment20->sub_indicator_20e2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 1-12 permitted','pattern'=>'^([0-9]|[1-9][0-2])|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20e3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20e3',$equipment20!=null?($equipment20->sub_indicator_20e3==-1?'NA':$equipment20->sub_indicator_20e3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20e4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20e4',$equipment20!=null?($equipment20->sub_indicator_20e4==-1?'NA':$equipment20->sub_indicator_20e4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20e5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20e5',$equipment20!=null?($equipment20->sub_indicator_20e5==-1?'NA':$equipment20->sub_indicator_20e5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20e6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                                                                      {{ Form::text('lab_equipment_20e6',$equipment20!=null?($equipment20->sub_indicator_20e6==-1?'NA':$equipment20->sub_indicator_20e6):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>  

                                                                <tr> 
                                                                    <td>f) Chemistry </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20f1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20f1',$equipment20!=null?($equipment20->sub_indicator_20f1==-1?'NA':$equipment20->sub_indicator_20f1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20f2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20f2',$equipment20!=null?($equipment20->sub_indicator_20f2==-1?'NA':$equipment20->sub_indicator_20f2):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 1-12 permitted','pattern'=>'^([0-9]|[1-9][0-2])|(NA)$','maxlength'=>'2']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20f3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20f3',$equipment20!=null?($equipment20->sub_indicator_20f3==-1?'NA':$equipment20->sub_indicator_20f3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20f4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20f4',$equipment20!=null?($equipment20->sub_indicator_20f4==-1?'NA':$equipment20->sub_indicator_20f4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20f5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_equipment_20f5',$equipment20!=null?($equipment20->sub_indicator_20f5==-1?'NA':$equipment20->sub_indicator_20f5):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_equipment_20f6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                                                                      {{ Form::text('lab_equipment_20f6',$equipment20!=null?($equipment20->sub_indicator_20f6==-1?'NA':$equipment20->sub_indicator_20f6):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                                                                                                                                         
                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_20"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_20"></span>  </span>    
                                                </p>   

                                                    {{ Form::label('lab_equipment_20_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('lab_equipment_20_score',$scores->indicator20_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }}                                                   
                                                </div>
                                            </div> 

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>21. Equipment utilization for; chemistry, haematology and CD4 platforms.</strong><br>
                                                            <em>Note: Excluding general purpose equipment like microscopes.
                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th  colspan="9">CD4 Equipment</th>
                                                                </tr>
                                                                <tr> 
                                                                    <th class="col-md-2">A</th>
                                                                    <th class="col-md-1">B</th>
                                                                    <th class="col-md-1">C</th>
                                                                    <th class="col-md-1">D</th>
                                                                    <th class="col-md-1">E</th>
                                                                    <th class="col-md-1">F</th>
                                                                    <th class="col-md-1">G</th>  
                                                                    <th class="col-md-1">H</th>
                                                                    <th class="col-md-1">I</th>
                                                                </tr>
                                                                <tr> 
                                                                    <th class="col-md-2">Equipment name</th>
                                                                    <th class="col-md-1">Throughput (per day)</th>
                                                                    <th class="col-md-1">Average no. of days running per month </th>
                                                                    <th class="col-md-1">Average actual output (lab registers) </th>
                                                                    <th class="col-md-1">Average Expected out (B*C)</th>
                                                                    <th class="col-md-1"> Utilization ((D/E)*100) </th>
                                                                    <th class="col-md-1">If F more than 70 score 1 else 0)</th>  
                                                                    <th class="col-md-1">Capacity of equipment (health worker)</th>
                                                                    <th class="col-md-1">If B=H score 1 else 0</th>
                                                                </tr>                                                                
                                                            </thead>                                                        

                                                            <tbody>
                                                                <tr> 
                                                                    <td>a) BD FACS Presto
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_presto_21e1">60</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_facs_presto_21e2', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('cd4_facs_presto_21e2',$equipment21!=null?($equipment21->sub_indicator_211ac==-1?'NA':$equipment21->sub_indicator_211ac):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_facs_presto_21e3', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('cd4_facs_presto_21e3',$equipment21!=null?($equipment21->sub_indicator_211ad==-1?'NA':$equipment21->sub_indicator_211ad):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_presto_21e4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_presto_21e5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_presto_21e6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_facs_presto_21e7', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('cd4_facs_presto_21e7',$equipment21!=null?($equipment21->sub_indicator_211ah==-1?'NA':$equipment21->sub_indicator_211ah):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_presto_21e8"></span></p></td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>b) BD FACS Calibur
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_calibre_21a1">200</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_facs_calibre_21a2', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('cd4_facs_calibre_21a2',$equipment21!=null?($equipment21->sub_indicator_211bc==-1?'NA':$equipment21->sub_indicator_211bc):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_facs_calibre_21a3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                                    {{ Form::text('cd4_facs_calibre_21a3',$equipment21!=null?($equipment21->sub_indicator_211bd==-1?'NA':$equipment21->sub_indicator_211bd):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_calibre_21a4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_calibre_21a5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_calibre_21a6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_facs_calibre_21a7', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('cd4_facs_calibre_21a7',$equipment21!=null?($equipment21->sub_indicator_211bh==-1?'NA':$equipment21->sub_indicator_211bh):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_calibre_21a8"></span></p></td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>c) BD FACS Count
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_count_21b1">70</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_facs_count_21b2', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('cd4_facs_count_21b2',$equipment21!=null?($equipment21->sub_indicator_211cc==-1?'NA':$equipment21->sub_indicator_211cc):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_facs_count_21b3', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                                    {{ Form::text('cd4_facs_count_21b3',$equipment21!=null?($equipment21->sub_indicator_211cd==-1?'NA':$equipment21->sub_indicator_211cd):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_count_21b4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_count_21b5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_count_21b6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_facs_count_21b7', '', ['class' => 'col-md-3 control-label hidden']) }}  
                                                                    {{ Form::text('cd4_facs_count_21b7',$equipment21!=null?($equipment21->sub_indicator_211ch==-1?'NA':$equipment21->sub_indicator_211ch):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_facs_count_21b8"></span></p></td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>d) PARTEC CyFlow
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_partec_count_21c1">60</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_partec_count_21c2', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('cd4_partec_count_21c2',$equipment21!=null?($equipment21->sub_indicator_211dc==-1?'NA':$equipment21->sub_indicator_211dc):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_partec_count_21c3', '', ['class' => 'col-md-3 control-label hidden']) }}   
                                                                    {{ Form::text('cd4_partec_count_21c3',$equipment21!=null?($equipment21->sub_indicator_211dd==-1?'NA':$equipment21->sub_indicator_211dd):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_partec_count_21c4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_partec_count_21c5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_partec_count_21c6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_partec_count_21c7', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('cd4_partec_count_21c7',$equipment21!=null?($equipment21->sub_indicator_211dh==-1?'NA':$equipment21->sub_indicator_211dh):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_partec_count_21c8"></span></p></td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>e) PIMA analyser
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_pima_21d1">20</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_pima_21d2', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('cd4_pima_21d2',$equipment21!=null?($equipment21->sub_indicator_211ec==-1?'NA':$equipment21->sub_indicator_211ec):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_pima_21d3', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('cd4_pima_21d3',$equipment21!=null?($equipment21->sub_indicator_211ed==-1?'NA':$equipment21->sub_indicator_211ed):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_pima_21d4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_pima_21d5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_pima_21d6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('cd4_pima_21d7', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                                    {{ Form::text('cd4_pima_21d7',$equipment21!=null?($equipment21->sub_indicator_211eh==-1?'NA':$equipment21->sub_indicator_211eh):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="cd4_pima_21d8"></span></p></td>
                                                                </tr> 

                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    

                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th  colspan="9">Chemistry Equipment</th>
                                                                </tr>
                                                                <tr> 
                                                                    <th class="col-md-2">A</th>
                                                                    <th class="col-md-1">B</th>
                                                                    <th class="col-md-1">C</th>
                                                                    <th class="col-md-1">D</th>
                                                                    <th class="col-md-1">E</th>
                                                                    <th class="col-md-1">F</th>
                                                                    <th class="col-md-1">G</th>  
                                                                    <th class="col-md-1">H</th>
                                                                    <th class="col-md-1">I</th>
                                                                </tr>
                                                                <tr> 
                                                                    <th class="col-md-2">Equipment name</th>
                                                                    <th class="col-md-1">Throughput (per day)</th>
                                                                    <th class="col-md-1">Average no. of days running per month </th>
                                                                    <th class="col-md-1">Average actual output (lab registers) </th>
                                                                    <th class="col-md-1">Average Expected out (B*C)</th>
                                                                    <th class="col-md-1"> Utilization ((D/E)*100) </th>
                                                                    <th class="col-md-1">If F more than 70 score 1 else 0)</th>  
                                                                    <th class="col-md-1">Capacity of equipment (health worker)</th>
                                                                    <th class="col-md-1">If B=H score 1 else 0</th>
                                                                </tr>                                                                
                                                            </thead>                                                        

                                                            <tbody>
                                                                                                                       
                                                                <tr> 
                                                                    <td>a) Roche Cobas C311
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="chemistry_c311_21a1">520</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('chemistry_c311_21a2', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('chemistry_c311_21a2',$equipment21!=null?($equipment21->sub_indicator_212ac==-1?'NA':$equipment21->sub_indicator_212ac):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('chemistry_c311_21a3', '', ['class' => 'col-md-3 control-label hidden']) }}  
                                                                    {{ Form::text('chemistry_c311_21a3',$equipment21!=null?($equipment21->sub_indicator_212ad==-1?'NA':$equipment21->sub_indicator_212ad):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="chemistry_c311_21a4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="chemistry_c311_21a5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="chemistry_c311_21a6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('chemistry_c311_21a7', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                                    {{ Form::text('chemistry_c311_21a7',$equipment21!=null?($equipment21->sub_indicator_212ah==-1?'NA':$equipment21->sub_indicator_212ah):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="chemistry_c311_21a8"></span></p></td>
                                                                </tr> 
                                                                
                                                                <tr> 
                                                                    <td>b) Roche Cobas C111
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="chemistry_c111_21b1">450</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('chemistry_c111_21b2', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('chemistry_c111_21b2',$equipment21!=null?($equipment21->sub_indicator_212bc==-1?'NA':$equipment21->sub_indicator_212bc):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('chemistry_c111_21b3', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('chemistry_c111_21b3',$equipment21!=null?($equipment21->sub_indicator_212bd==-1?'NA':$equipment21->sub_indicator_212bd):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="chemistry_c111_21b4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="chemistry_c111_21b5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="chemistry_c111_21b6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('chemistry_c111_21b7', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('chemistry_c111_21b7',$equipment21!=null?($equipment21->sub_indicator_212bh==-1?'NA':$equipment21->sub_indicator_212bh):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="chemistry_c111_21b8"></span></p></td>
                                                                </tr> 

                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th  colspan="9">Haematology Equipment</th>
                                                                </tr>
                                                                <tr> 
                                                                    <th class="col-md-2">A</th>
                                                                    <th class="col-md-1">B</th>
                                                                    <th class="col-md-1">C</th>
                                                                    <th class="col-md-1">D</th>
                                                                    <th class="col-md-1">E</th>
                                                                    <th class="col-md-1">F</th>
                                                                    <th class="col-md-1">G</th>  
                                                                    <th class="col-md-1">H</th>
                                                                    <th class="col-md-1">I</th>
                                                                </tr>
                                                                <tr> 
                                                                    <th class="col-md-2">Equipment name</th>
                                                                    <th class="col-md-1">Throughput (per day)</th>
                                                                    <th class="col-md-1">Average no. of days running per month </th>
                                                                    <th class="col-md-1">Average actual output (lab registers) </th>
                                                                    <th class="col-md-1">Average Expected out (B*C)</th>
                                                                    <th class="col-md-1"> Utilization ((D/E)*100) </th>
                                                                    <th class="col-md-1">If F more than 70 score 1 else 0)</th>  
                                                                    <th class="col-md-1">Capacity of equipment (health worker)</th>
                                                                    <th class="col-md-1">If B=H score 1 else 0</th>
                                                                </tr>                                                                
                                                            </thead>                                                        

                                                            <tbody>
                                                                <tr> 
                                                                    <td>a) Humastar 600
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma600_21a1">4800</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_huma600_21a2', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_huma600_21a2',$equipment21!=null?($equipment21->sub_indicator_213ac==-1?'NA':$equipment21->sub_indicator_213ac):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_huma600_21a3', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_huma600_21a3',$equipment21!=null?($equipment21->sub_indicator_213ad==-1?'NA':$equipment21->sub_indicator_213ad):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma600_21a4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma600_21a5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma600_21a6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_huma600_21a7', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_huma600_21a7',$equipment21!=null?($equipment21->sub_indicator_213ah==-1?'NA':$equipment21->sub_indicator_213ah):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma600_21a8"></span></p></td>
                                                                </tr>                                                                     
                                                                <tr> 
                                                                    <td>b) HumaCount 30TS
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma30TS_21b1">300</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_huma30TS_21b2', '', ['class' => 'col-md-3 control-label hidden']) }}     
                                                                    {{ Form::text('haematology_huma30TS_21b2',$equipment21!=null?($equipment21->sub_indicator_213bc==-1?'NA':$equipment21->sub_indicator_213bc):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_huma30TS_21b3', '', ['class' => 'col-md-3 control-label hidden']) }}     
                                                                    {{ Form::text('haematology_huma30TS_21b3',$equipment21!=null?($equipment21->sub_indicator_213bd==-1?'NA':$equipment21->sub_indicator_213bd):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma30TS_21b4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma30TS_21b5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma30TS_21b6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_huma30TS_21b7', '', ['class' => 'col-md-3 control-label hidden']) }}     
                                                                    {{ Form::text('haematology_huma30TS_21b7',$equipment21!=null?($equipment21->sub_indicator_213bh==-1?'NA':$equipment21->sub_indicator_213bh):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma30TS_21b8"></span></p></td>
                                                                </tr>   

                                                                <tr> 
                                                                    <td>c) HumaCount 60TS
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma60TS_21c1">600</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_huma60TS_21c2', '', ['class' => 'col-md-3 control-label hidden']) }}     
                                                                    {{ Form::text('haematology_huma60TS_21c2',$equipment21!=null?($equipment21->sub_indicator_213cc==-1?'NA':$equipment21->sub_indicator_213cc):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_huma60TS_21c3', '', ['class' => 'col-md-3 control-label hidden']) }}      
                                                                    {{ Form::text('haematology_huma60TS_21c3',$equipment21!=null?($equipment21->sub_indicator_213cd==-1?'NA':$equipment21->sub_indicator_213cd):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma60TS_21c4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma60TS_21c5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma60TS_21c6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_huma60TS_21c7', '', ['class' => 'col-md-3 control-label hidden']) }}       
                                                                    {{ Form::text('haematology_huma60TS_21c7',$equipment21!=null?($equipment21->sub_indicator_213ch==-1?'NA':$equipment21->sub_indicator_213ch):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_huma60TS_21c8"></span></p></td>
                                                                </tr>  

                                                                <tr> 
                                                                    <td>d) Mindray BC 3200
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind3200_21e1">480</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_mind3200_21e2', '', ['class' => 'col-md-3 control-label hidden']) }}      
                                                                    {{ Form::text('haematology_mind3200_21e2',$equipment21!=null?($equipment21->sub_indicator_213dc==-1?'NA':$equipment21->sub_indicator_213dc):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_mind3200_21e3', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_mind3200_21e3',$equipment21!=null?($equipment21->sub_indicator_213dd==-1?'NA':$equipment21->sub_indicator_213dd):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind3200_21e4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind3200_21e5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind3200_21e6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_mind3200_21e7', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_mind3200_21e7',$equipment21!=null?($equipment21->sub_indicator_213dh==-1?'NA':$equipment21->sub_indicator_213dh):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind3200_21e8"></span></p></td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>e) Mindray BC 3000
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind3000_21f1">480</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_mind3000_21f2', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_mind3000_21f2',$equipment21!=null?($equipment21->sub_indicator_213ec==-1?'NA':$equipment21->sub_indicator_213ec):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_mind3000_21f3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                                    {{ Form::text('haematology_mind3000_21f3',$equipment21!=null?($equipment21->sub_indicator_213ed==-1?'NA':$equipment21->sub_indicator_213ed):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind3000_21f4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind3000_21f5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind3000_21f6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_mind3000_21f7', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_mind3000_21f7',$equipment21!=null?($equipment21->sub_indicator_213eh==-1?'NA':$equipment21->sub_indicator_213eh):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind3000_21f8"></span></p></td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>f) Mindray BC 2800
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind2800_21j1">240</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_mind2800_21j2', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_mind2800_21j2',$equipment21!=null?($equipment21->sub_indicator_213fc==-1?'NA':$equipment21->sub_indicator_213fc):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_mind2800_21j3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                                    {{ Form::text('haematology_mind2800_21j3',$equipment21!=null?($equipment21->sub_indicator_213fd==-1?'NA':$equipment21->sub_indicator_213fd):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind2800_21j4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind2800_21j5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind2800_21j6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_mind2800_21j7', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_mind2800_21j7',$equipment21!=null?($equipment21->sub_indicator_213fh==-1?'NA':$equipment21->sub_indicator_213fh):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind2800_21j8"></span></p></td>
                                                                </tr> 


                                                                <tr> 
                                                                    <td>g) Mindray BC 2300
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind2300_21i1">240</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_mind2300_21i2', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_mind2300_21i2',$equipment21!=null?($equipment21->sub_indicator_213gc==-1?'NA':$equipment21->sub_indicator_213gc):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_mind2300_21i3', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_mind2300_21i3',$equipment21!=null?($equipment21->sub_indicator_213gd==-1?'NA':$equipment21->sub_indicator_213gd):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind2300_21i4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind2300_21i5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind2300_21i6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_mind2300_21i7', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_mind2300_21i7',$equipment21!=null?($equipment21->sub_indicator_213gh==-1?'NA':$equipment21->sub_indicator_213gh):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_mind2300_21i8"></span></p></td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>h) Medonic M-Series
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_medonic_21k1">640</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_medonic_21k2', '', ['class' => 'col-md-3 control-label hidden']) }}     
                                                                    {{ Form::text('haematology_medonic_21k2',$equipment21!=null?($equipment21->sub_indicator_213hc==-1?'NA':$equipment21->sub_indicator_213hc):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_medonic_21k3', '', ['class' => 'col-md-3 control-label hidden']) }}        
                                                                    {{ Form::text('haematology_medonic_21k3',$equipment21!=null?($equipment21->sub_indicator_213hd==-1?'NA':$equipment21->sub_indicator_213hd):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_medonic_21k4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_medonic_21k5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_medonic_21k6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_medonic_21k7', '', ['class' => 'col-md-3 control-label hidden']) }}      
                                                                    {{ Form::text('haematology_medonic_21k7',$equipment21!=null?($equipment21->sub_indicator_213hh==-1?'NA':$equipment21->sub_indicator_213hh):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_medonic_21k8"></span></p></td>
                                                                </tr>

                                                                <tr> 
                                                                    <td>i) Sysmes POCH-100i 
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_sysmex100_21g1">200</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_sysmex100_21g2', '', ['class' => 'col-md-3 control-label hidden']) }}     
                                                                    {{ Form::text('haematology_sysmex100_21g2',$equipment21!=null?($equipment21->sub_indicator_213ic==-1?'NA':$equipment21->sub_indicator_213ic):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_sysmex100_21g3', '', ['class' => 'col-md-3 control-label hidden']) }}          
                                                                    {{ Form::text('haematology_sysmex100_21g3',$equipment21!=null?($equipment21->sub_indicator_213id==-1?'NA':$equipment21->sub_indicator_213id):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_sysmex100_21g4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_sysmex100_21g5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_sysmex100_21g6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_sysmex100_21g7', '', ['class' => 'col-md-3 control-label hidden']) }}      
                                                                    {{ Form::text('haematology_sysmex100_21g7',$equipment21!=null?($equipment21->sub_indicator_213ih==-1?'NA':$equipment21->sub_indicator_213ih):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_sysmex100_21g8"></span></p></td>
                                                                </tr> 
                                      
                                                                <tr> 
                                                                    <td>j) Sysmes XP-300/500i 
                                                                    </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_sysmex300_21h1">480</span></p>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_sysmex300_21h2', '', ['class' => 'col-md-3 control-label hidden']) }}    
                                                                    {{ Form::text('haematology_sysmex300_21h2',$equipment21!=null?($equipment21->sub_indicator_213jc==-1?'NA':$equipment21->sub_indicator_213jc):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_sysmex300_21h3', '', ['class' => 'col-md-3 control-label hidden']) }}{{ Form::text('haematology_sysmex300_21h3',$equipment21!=null?($equipment21->sub_indicator_213jd==-1?'NA':$equipment21->sub_indicator_213jd):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_sysmex300_21h4"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_sysmex300_21h5"></span></p></td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_sysmex300_21h6"></span></p></td>
                                                                   <td class="form-group has-feedback">
                                                                    {{ Form::label('haematology_sysmex300_21h7', '', ['class' => 'col-md-3 control-label hidden']) }}        
                                                                    {{ Form::text('haematology_sysmex300_21h7',$equipment21!=null?($equipment21->sub_indicator_213jh==-1?'NA':$equipment21->sub_indicator_213jh):null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                                                    <div class="help-block with-errors"></div>
                                                                     </td>
                                                                    <td><p class="form-control-static text-center"><span id="haematology_sysmex300_21h8"></span></p></td>
                                                                </tr>                                                                                         
                                                            </tbody>
                                                        </table>                                                  
                                                    </div>                                                             
                                                            
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_21"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_21"></span>  </span>    
                                                </p>                                                                                        


                                                    {{ Form::label('lab_equipment_21_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('lab_equipment_21_score',$scores->indicator21_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }}   

                                                </div>
                                            </div> 

                                </div>
                            </div>
                        </div>
        <!-- Start Box 5 -->   

        
        
        <!-- Start Box 6 -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title"> 
                                    <a data-toggle="collapse" data-parent="#surveyAccordian"  href="#collapseInformation"> V. Laboratory information system</a>
                                </h4>
                            </div>
                            <div id="collapseInformation" class="panel-collapse collapse">
                                        <div class="panel-body">
                                          
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>22. Availability of Laboratory Data collection forms </strong><br>
                                                            <em>Check and verify to see that the documents are the official and current documents for MoH; yes= 1, No= 0 (add all numbers for all the tools) (N/A for facilities that don’t perform a particular test Category) 
                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6"></th>
                                                                    <th class="col-md-2">1/0/NA</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                                                                 
                                                                <tr> 
                                                                    <td>a) HC III daily Activity register HMIS form 055a1.
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22a', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22a',$info_system22!=null?($info_system22->sub_indicator_22a==-1?'NA':$info_system22->sub_indicator_22a):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td rowspan="14">
                                                                        {{ Form::textarea('lab_info_system_22_comments',$info_system22!=null?($info_system22->indicator_22_comments):null,['class' => 'form-control','rows'=>'40', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>b) HC IV daily activity Register HMIS form 055a2? </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22b', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22b',$info_system22!=null?($info_system22->sub_indicator_22b==-1?'NA':$info_system22->sub_indicator_22b):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr> 

                                                                <tr> 
                                                                    <td>c) General hospital daily activity register HMIS form 055a3
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22c', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22c',$info_system22!=null?($info_system22->sub_indicator_22c==-1?'NA':$info_system22->sub_indicator_22c):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr>  

                                                                <tr> 
                                                                    <td>d) Daily activity log for HIV test kits (HMIS form 055a4) </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22d', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22d',$info_system22!=null?($info_system22->sub_indicator_22d==-1?'NA':$info_system22->sub_indicator_22d):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr> 

                                                                <tr> 
                                                                    <td>e) TB Register (HMIS form 089)
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22e', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22e',$info_system22!=null?($info_system22->sub_indicator_22e==-1?'NA':$info_system22->sub_indicator_22e):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr>  
                                                                <tr> 
                                                                    <td>f) Clinical Chemistry Register (HMIS form 090)? </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22f', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22f',$info_system22!=null?($info_system22->sub_indicator_22f==-1?'NA':$info_system22->sub_indicator_22f):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr> 

                                                                <tr> 
                                                                    <td>g) Blood Transfusion Record (HMIS form 091B
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22g', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22g',$info_system22!=null?($info_system22->sub_indicator_22g==-1?'NA':$info_system22->sub_indicator_22g):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr>  

                                                                <tr> 
                                                                    <td>h) CD 4 Register (HMIS form 095) </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22h', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22h',$info_system22!=null?($info_system22->sub_indicator_22h==-1?'NA':$info_system22->sub_indicator_22h):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr> 

                                                                <tr> 
                                                                    <td>i) Haematological Indices  HMIS form 094
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22i', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22i',$info_system22!=null?($info_system22->sub_indicator_22i==-1?'NA':$info_system22->sub_indicator_22i):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr>  
                                                                <tr> 
                                                                    <td>j) Microbiology & Serology Lab Register (HMIS form 093) </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22j', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22j',$info_system22!=null?($info_system22->sub_indicator_22j==-1?'NA':$info_system22->sub_indicator_22j):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr> 

                                                                <tr> 
                                                                    <td>k) Facility Monthly Summary report (HMIS 105 (stock status report (section 6 page 8)
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22k', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22k',$info_system22!=null?($info_system22->sub_indicator_22k==-1?'NA':$info_system22->sub_indicator_22k):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr> 


                                                                <tr> 
                                                                    <td>l) Facility Monthly Summary report (HMIS 105-Section 7 page 9)
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22l', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22l',$info_system22!=null?($info_system22->sub_indicator_22l==-1?'NA':$info_system22->sub_indicator_22l):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>m) Laboratory reagents & consumable order form HMIS form 018b </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22m', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22m',$info_system22!=null?($info_system22->sub_indicator_22m==-1?'NA':$info_system22->sub_indicator_22m):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr> 

                                                                <tr> 
                                                                    <td>n) Bi-Monthly report & order calculation form for HIV test kits HMIS form 018b2
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_22n', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_22n',$info_system22!=null?($info_system22->sub_indicator_22n==-1?'NA':$info_system22->sub_indicator_22n):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr>                                                                 


                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_22"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_22"></span>  </span>    
                                                </p>    

                                                    {{ Form::label('lab_info_system_22_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('lab_info_system_22_score',$scores->indicator22_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required']) }}                                                
                                                </div>
                                            </div> 

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>23. Availability of HMIS 105 reports </strong><br>
                                                            <em>Check for availability of the specified form and score 1=Yes (if available and seen 0=No (not available or not seen) 
                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6"></th>
                                                                    <th class="col-md-2">1/0</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                                                                 
                                                                <tr> 
                                                                    <td>a) Does the laboratory keep copies of the Laboratory HMIS 105 Section 7 page 9 monthly reports sent to the facility in-charge?
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_23a', '', ['class' => 'col-md-3 control-label hidden']) }}                                   

                                                                    {{ Form::text('lab_info_system_23a',$info_system23!=null?($info_system23->sub_indicator_23a==-1?'NA':$info_system23->sub_indicator_23a):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td rowspan="2">
                                                                        {{ Form::textarea('lab_info_system_23_comments',$info_system23!=null?$info_system23->indicator_23_comments:null,['class' => 'form-control','rows'=>'4', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>b) Does the facility have HMIS reports for all the previous 2 months(verify , if all Score 1 otherwise 0)? </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_23b', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_23b',$info_system23!=null?($info_system23->sub_indicator_23b==-1?'NA':$info_system23->sub_indicator_23b):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                   

                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_23"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_23"></span>  </span>    
                                                </p>   
                                                    {{ Form::label('lab_info_system_23_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('lab_info_system_23_score',$scores->indicator23_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required'])  }}                                                
                                                </div>
                                            </div> 
                                        
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>24. Timeliness of HMIS 105 reports </strong><br>
                                                            <em>Please check the dates the reports for the previous month was submitted, if submitted on time score 1 otherwise 0  (NB: Timely reporting means; 5th, 7th and 14th for facility, HSD and district respectively) 
                                                            </em>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6"></th>
                                                                    <th class="col-md-2"></th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                                                                 
                                                                <tr> 
                                                                    <td>a) Report schedule date (write the expected reporting date)
                                                                    </td>
                                                                    <td>
                                                                    {{ Form::label('lab_info_system_24a', '', ['class' => 'col-md-3 control-label hidden']) }}   
                                                                    {{ Form::text('lab_info_system_24a',$info_system24!=null?$info_system24->sub_indicator_24a:null,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                                                    </td>

                                                                    <td rowspan="3">
                                                                        {{ Form::textarea('lab_info_system_24comments',$info_system24!=null?($info_system24->indicator_24_comments):null,['class' => 'form-control','rows'=>'6', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>b) Date HMIS 105 Section 7 page 9 report was submitted to the district </td>
                                                                    <td>
                                                                    {{ Form::label('lab_info_system_24b', '', ['class' => 'col-md-3 control-label hidden']) }}                                                             {{ Form::text('lab_info_system_24b',$info_system24!=null?$info_system24->sub_indicator_24b:null,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                                                    </td>
                                                                </tr>
                                                                <tr> 
                                                                    <td>c) Was the HMIS 105 Section 7 page 9 report submitted to the health sub district on time (Yes=1/No=0) </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_24c', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_24c',$info_system24!=null?($info_system24->sub_indicator_24c==-1?'NA':$info_system24->sub_indicator_24c):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                   
                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_24"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_24"></span>  </span>    
                                                </p>    
                                                    {{ Form::label('lab_info_system_24_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('lab_info_system_24_score',$scores->indicator24_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required'])   }}                                               
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>25. Completeness and accuracy of HMIS 105 report (Section 6 and 7) </strong>

                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
                                                            <caption>
                                                                A. 
                                                            </caption>      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6"></th>
                                                                    <th class="col-md-2"></th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                                                                 
                                                                <tr> 
                                                                    <td>a) Date report was filled 
                                                                    </td>
                                                                    <td>
                                                                    {{ Form::label('lab_info_system_25a', '', ['class' => 'col-md-3 control-label hidden']) }}  
                                                                    {{ Form::text('lab_info_system_25a',$info_system25!=null?$info_system25->sub_indicator_25aa:null,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                                                    </td>

                                                                    <td rowspan="3">
                                                                        {{ Form::textarea('lab_info_system_25_comments',$info_system25!=null?($info_system25->indicator_25_comments):null,['class' => 'form-control','rows'=>'6', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>b) HMIS 105 report section 6 is completely filled (No blanks left) then score 1 ELSE 0 </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25b', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25b',$info_system25!=null?($info_system25->sub_indicator_25ab==-1?'NA':$info_system25->sub_indicator_25ab):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr> 
                                                                    <td>c) HMIS 105 report section 7 is completely filled (No blanks left) then score 1 ELSE 0 </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25c', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25c',$info_system25!=null?($info_system25->sub_indicator_25ac==-1?'NA':$info_system25->sub_indicator_25ac):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                   
                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    

                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
                                                            <caption>
                                                                B. Check the accuracy of the last HMIS 105 report (Yes=1/ No=0)
                                                            </caption>
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-4">Stock status</th>
                                                                    <th class="col-md-1">Is information on stock out days available from the last report  </br>(1/0/NA)</th>

                                                                    <th class="col-md-1">Quantity consumed</th>                                                                                                                                        
                                                                    <th class="col-md-1">
                                                                    No. of stock out days for month as recorded on the report (# days)
                                                                    </th> 

                                                                    <th class="col-md-1">Stock on hand</th>   

                                                                    <th class="col-md-1">Quantity consumed</th>  

                                                                    <th class="col-md-1">Stock out days for that month on the Stock book (# days)
                                                                    </th>
                                                                    <th class="col-md-1">Stock on hand</th>                                                                       
                                                                    <th class="col-md-1">Do the report and stock book data agree? (1/0) </th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                <tr> 
                                                                    <td>a) Determine HIV Screening test, tests </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ba1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ba1',$info_system25!=null?($info_system25->sub_indicator_25ba1==-1?'NA':$info_system25->sub_indicator_25ba1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ba2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ba2',$info_system25!=null?($info_system25->sub_indicator_25ba2==-1?'NA':$info_system25->sub_indicator_25ba2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ba3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ba3',$info_system25!=null?($info_system25->sub_indicator_25ba3==-1?'NA':$info_system25->sub_indicator_25ba3):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ba4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ba4',$info_system25!=null?($info_system25->sub_indicator_25ba4==-1?'NA':$info_system25->sub_indicator_25ba4):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ba5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ba5',$info_system25!=null?($info_system25->sub_indicator_25ba5==-1?'NA':$info_system25->sub_indicator_25ba5):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ba6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ba6',$info_system25!=null?($info_system25->sub_indicator_25ba6==-1?'NA':$info_system25->sub_indicator_25ba6):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ba7', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ba7',$info_system25!=null?($info_system25->sub_indicator_25ba7==-1?'NA':$info_system25->sub_indicator_25ba7):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>                                                                    
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ba8', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ba8',$info_system25!=null?($info_system25->sub_indicator_25ba8==-1?'NA':$info_system25->sub_indicator_25ba8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>
                                  
                                                                <tr> 
                                                                    <td>b) Stat -pack HIV Confirmatory rapid tests, tests </td>
                                                                                                                                        <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bb1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bb1',$info_system25!=null?($info_system25->sub_indicator_25bb1==-1?'NA':$info_system25->sub_indicator_25bb1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bb2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bb2',$info_system25!=null?($info_system25->sub_indicator_25bb2==-1?'NA':$info_system25->sub_indicator_25bb2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bb3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bb3',$info_system25!=null?($info_system25->sub_indicator_25bb3==-1?'NA':$info_system25->sub_indicator_25bb3):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bb4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bb4',$info_system25!=null?($info_system25->sub_indicator_25bb4==-1?'NA':$info_system25->sub_indicator_25bb4):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bb5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bb5',$info_system25!=null?($info_system25->sub_indicator_25bb5==-1?'NA':$info_system25->sub_indicator_25bb5):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bb6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bb6',$info_system25!=null?($info_system25->sub_indicator_25bb6==-1?'NA':$info_system25->sub_indicator_25bb6):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bb7', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bb7',$info_system25!=null?($info_system25->sub_indicator_25bb7==-1?'NA':$info_system25->sub_indicator_25bb7):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>                                                                    
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bb8', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bb8',$info_system25!=null?($info_system25->sub_indicator_25bb8==-1?'NA':$info_system25->sub_indicator_25bb8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>


                                                                </tr>

                                                                <tr> 
                                                                    <td>c) Unigold HIV RDT Tie-breaker test, tests </td>
                                                                                                                                        <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bc1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bc1',$info_system25!=null?($info_system25->sub_indicator_25bc1==-1?'NA':$info_system25->sub_indicator_25bc1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bc2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bc2',$info_system25!=null?($info_system25->sub_indicator_25bc2==-1?'NA':$info_system25->sub_indicator_25bc2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bc3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bc3',$info_system25!=null?($info_system25->sub_indicator_25bc3==-1?'NA':$info_system25->sub_indicator_25bc3):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bc4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bc4',$info_system25!=null?($info_system25->sub_indicator_25bc4==-1?'NA':$info_system25->sub_indicator_25bc4):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bc5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bc5',$info_system25!=null?($info_system25->sub_indicator_25bc5==-1?'NA':$info_system25->sub_indicator_25bc5):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bc6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bc6',$info_system25!=null?($info_system25->sub_indicator_25bc6==-1?'NA':$info_system25->sub_indicator_25bc6):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bc7', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bc7',$info_system25!=null?($info_system25->sub_indicator_25bc7==-1?'NA':$info_system25->sub_indicator_25bc7):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>                                                                    
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bc8', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bc8',$info_system25!=null?($info_system25->sub_indicator_25bc8==-1?'NA':$info_system25->sub_indicator_25bc8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>  

                                                                <tr> 
                                                                <td>
                                                                    <div class="form-group">
                                                                        {{ Form::label('cd4_testing', 'd) CD4 testing', ['class' => 'col-md-3 small-font control-label']) }}
                                                                          <div class="col-md-6">
                                                                            {{ Form::select('cd4_testing', [''=>'','1'=>'BD FACS, MultiTest CD3/CD8/CD45/CD4, 50 Tests','2'=>'BD FACSCount CD3/CD4 Reagent Kit 50 Tests','3'=>'BD FACS Flow Sheath Fluid','4'=>'Partec-CD4 % Easy Count Kit 100 tests','5'=>'Pima Analyzer CD4 Cartridge Kit, 100 tests'], $info_system25!=null?$info_system25->sub_indicator_cd4item:null, ['data-placeholder' => 'Select an item','class'=>' small-font' ]) }}


                                                                                @if ($errors->has('cd4_testing'))
                                                                                    <span class="text-danger">
                                                                                        <strong>{{ $errors->first('cd4_testing') }}</strong>
                                                                                    </span>
                                                                                @endif

                                                                          </div>
                                                                    </div>                                                                
                                                                </td> 
                                                                                                                                        <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bd1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bd1',$info_system25!=null?($info_system25->sub_indicator_25bd1==-1?'NA':$info_system25->sub_indicator_25bd1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bd2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bd2',$info_system25!=null?($info_system25->sub_indicator_25bd2==-1?'NA':$info_system25->sub_indicator_25bd2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bd3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bd3',$info_system25!=null?($info_system25->sub_indicator_25bd3==-1?'NA':$info_system25->sub_indicator_25bd3):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bd4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bd4',$info_system25!=null?($info_system25->sub_indicator_25bd4==-1?'NA':$info_system25->sub_indicator_25bd4):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bd5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bd5',$info_system25!=null?($info_system25->sub_indicator_25bd5==-1?'NA':$info_system25->sub_indicator_25bd5):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bd6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bd6',$info_system25!=null?($info_system25->sub_indicator_25bd6==-1?'NA':$info_system25->sub_indicator_25bd6):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bd7', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bd7',$info_system25!=null?($info_system25->sub_indicator_25bd7==-1?'NA':$info_system25->sub_indicator_25bd7):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>                                                                    
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bd8', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bd8',$info_system25!=null?($info_system25->sub_indicator_25bd8==-1?'NA':$info_system25->sub_indicator_25bd8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>
                                  
                                                                <tr> 
                                                                    <td>e) Malaria Rapid Diagnostic tests </td>
                                                                                                                                        <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25be1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25be1',$info_system25!=null?($info_system25->sub_indicator_25be1==-1?'NA':$info_system25->sub_indicator_25be1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25be2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25be2',$info_system25!=null?($info_system25->sub_indicator_25be2==-1?'NA':$info_system25->sub_indicator_25be2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25be3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25be3',$info_system25!=null?($info_system25->sub_indicator_25be3==-1?'NA':$info_system25->sub_indicator_25be3):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25be4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25be4',$info_system25!=null?($info_system25->sub_indicator_25be4==-1?'NA':$info_system25->sub_indicator_25be4):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25be5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25be5',$info_system25!=null?($info_system25->sub_indicator_25be5==-1?'NA':$info_system25->sub_indicator_25be5):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25be6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25be6',$info_system25!=null?($info_system25->sub_indicator_25be6==-1?'NA':$info_system25->sub_indicator_25be6):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25be7', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25be7',$info_system25!=null?($info_system25->sub_indicator_25be7==-1?'NA':$info_system25->sub_indicator_25be7):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>                                                                    
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25be8', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25be8',$info_system25!=null?($info_system25->sub_indicator_25be8==-1?'NA':$info_system25->sub_indicator_25be8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>

                                                                <tr> 
                                                                    <td>f) ZN reagent for AFB </td>
                                                                                                                                        <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bf1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bf1',$info_system25!=null?($info_system25->sub_indicator_25bf1==-1?'NA':$info_system25->sub_indicator_25bf1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bf2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bf2',$info_system25!=null?($info_system25->sub_indicator_25bf2==-1?'NA':$info_system25->sub_indicator_25bf2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bf3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bf3',$info_system25!=null?($info_system25->sub_indicator_25bf3==-1?'NA':$info_system25->sub_indicator_25bf3):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bf4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bf4',$info_system25!=null?($info_system25->sub_indicator_25bf4==-1?'NA':$info_system25->sub_indicator_25bf4):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bf5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bf5',$info_system25!=null?($info_system25->sub_indicator_25bf5==-1?'NA':$info_system25->sub_indicator_25bf5):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bf6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bf6',$info_system25!=null?($info_system25->sub_indicator_25bf6==-1?'NA':$info_system25->sub_indicator_25bf6):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bf7', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bf7',$info_system25!=null?($info_system25->sub_indicator_25bf7==-1?'NA':$info_system25->sub_indicator_25bf7):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>                                                                    
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bf8', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bf8',$info_system25!=null?($info_system25->sub_indicator_25bf8==-1?'NA':$info_system25->sub_indicator_25bf8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr>                                                                            

                                                                <tr> 
                                                                    <td>g) Blood 450 ml </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bg1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bg1',$info_system25!=null?($info_system25->sub_indicator_25bg1==-1?'NA':$info_system25->sub_indicator_25bg1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bg2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bg2',$info_system25!=null?($info_system25->sub_indicator_25bg2==-1?'NA':$info_system25->sub_indicator_25bg2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bg3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bg3',$info_system25!=null?($info_system25->sub_indicator_25bg3==-1?'NA':$info_system25->sub_indicator_25bg3):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bg4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bg4',$info_system25!=null?($info_system25->sub_indicator_25bg4==-1?'NA':$info_system25->sub_indicator_25bg4):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bg5', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bg5',$info_system25!=null?($info_system25->sub_indicator_25bg5==-1?'NA':$info_system25->sub_indicator_25bg5):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bg6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bg6',$info_system25!=null?($info_system25->sub_indicator_25bg6==-1?'NA':$info_system25->sub_indicator_25bg6):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bg7', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bg7',$info_system25!=null?($info_system25->sub_indicator_25bg7==-1?'NA':$info_system25->sub_indicator_25bg7):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>                                                                    
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25bg8', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25bg8',$info_system25!=null?($info_system25->sub_indicator_25bg8==-1?'NA':$info_system25->sub_indicator_25bg8):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                                                                        
                                                            </tbody>
                                                        </table>                                                  
                                                    </div>

                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
                                                            <caption>
                                                                C. Check the accuracy of the last HMIS 105 report (Yes=1/ No=0)
                                                            </caption>
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-4">Service statistics</th>
                                                                    <th class="col-md-2">Is information on service statistics available from the last report </br>(1/0/NA)</th>                                                                    <th class="col-md-2">
                                                                        No. of tests as recorded on HMIS 105
                                                                    </th> 

                                                                    <th class="col-md-2">Number of tests as recorded in lab register that month
                                                                    </th>                                                                    
                                                                    <th class="col-md-2">Do the two agree? (1/0) </th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                <tr> 
                                                                    <td>a) Blood slide (Malaria) </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ca1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ca1',$info_system25!=null?($info_system25->sub_indicator_25ca1==-1?'NA':$info_system25->sub_indicator_25ca1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ca2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ca2',$info_system25!=null?($info_system25->sub_indicator_25ca2==-1?'NA':$info_system25->sub_indicator_25ca2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ca3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ca3',$info_system25!=null?($info_system25->sub_indicator_25ca3==-1?'NA':$info_system25->sub_indicator_25ca3):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ca4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ca4',$info_system25!=null?($info_system25->sub_indicator_25ca4==-1?'NA':$info_system25->sub_indicator_25ca4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>
                                  
                                                                <tr> 
                                                                    <td>b) Urinalysis </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cb1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cb1',$info_system25!=null?($info_system25->sub_indicator_25cb1==-1?'NA':$info_system25->sub_indicator_25cb1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cb2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cb2',$info_system25!=null?($info_system25->sub_indicator_25cb2==-1?'NA':$info_system25->sub_indicator_25cb2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cb3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cb3',$info_system25!=null?($info_system25->sub_indicator_25cb3==-1?'NA':$info_system25->sub_indicator_25cb3):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cb4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cb4',$info_system25!=null?($info_system25->sub_indicator_25cb4==-1?'NA':$info_system25->sub_indicator_25cb4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>

                                                                <tr> 
                                                                    <td>c) Stool Microscopy </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cc1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cc1',$info_system25!=null?($info_system25->sub_indicator_25cc1==-1?'NA':$info_system25->sub_indicator_25cc1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cc2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cc2',$info_system25!=null?($info_system25->sub_indicator_25cc2==-1?'NA':$info_system25->sub_indicator_25cc2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cc3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cc3',$info_system25!=null?($info_system25->sub_indicator_25cc3==-1?'NA':$info_system25->sub_indicator_25cc3):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cc4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cc4',$info_system25!=null?($info_system25->sub_indicator_25cc4==-1?'NA':$info_system25->sub_indicator_25cc4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>  

                                                                <tr> 
                                                                    <td>d) HIV </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cd1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cd1',$info_system25!=null?($info_system25->sub_indicator_25cd1==-1?'NA':$info_system25->sub_indicator_25cd1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cd2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cd2',$info_system25!=null?($info_system25->sub_indicator_25cd2==-1?'NA':$info_system25->sub_indicator_25cd2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cd3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cd3',$info_system25!=null?($info_system25->sub_indicator_25cd3==-1?'NA':$info_system25->sub_indicator_25cd3):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cd4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cd4',$info_system25!=null?($info_system25->sub_indicator_25cd4==-1?'NA':$info_system25->sub_indicator_25cd4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>
                                  
                                                                <tr> 
                                                                    <td>e) Syphilis (TPHA) test </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ce1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ce1',$info_system25!=null?($info_system25->sub_indicator_25ce1==-1?'NA':$info_system25->sub_indicator_25ce1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ce2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ce2',$info_system25!=null?($info_system25->sub_indicator_25ce2==-1?'NA':$info_system25->sub_indicator_25ce2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ce3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ce3',$info_system25!=null?($info_system25->sub_indicator_25ce3==-1?'NA':$info_system25->sub_indicator_25ce3):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25ce4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25ce4',$info_system25!=null?($info_system25->sub_indicator_25ce4==-1?'NA':$info_system25->sub_indicator_25ce4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>

                                                                <tr> 
                                                                    <td>f) Pregnancy test </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cf1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cf1',$info_system25!=null?($info_system25->sub_indicator_25cf1==-1?'NA':$info_system25->sub_indicator_25cf1):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cf2', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cf2',$info_system25!=null?($info_system25->sub_indicator_25cf2==-1?'NA':$info_system25->sub_indicator_25cf2):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cf3', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cf3',$info_system25!=null?($info_system25->sub_indicator_25cf3==-1?'NA':$info_system25->sub_indicator_25cf3):null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_25cf4', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_25cf4',$info_system25!=null?($info_system25->sub_indicator_25cf4==-1?'NA':$info_system25->sub_indicator_25cf4):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                                                                                  
                                                            </tbody>
                                                        </table>                                                  
                                                    </div>

                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_25"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_25"></span>  </span>    
                                                </p>
                                                    {{ Form::label('lab_info_system_25_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('lab_info_system_25_score',$scores->indicator25_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required'])  
                                                    }}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>26. Availability of displayed information on day of visit </strong><br>
                                                            <em>Check for the presence of any of the monthly statistics displayed either in table/graph/chart or map, Any display of the above statistics in the past 3 months, is awarded a score of 1 otherwise 0
                                                            </em>
                                                    </p>

                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6"></th>
                                                                    <th class="col-md-2">1/0</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                                                                 
                                                                <tr> 
                                                                    <td>a) Table/graph/chart/map
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_26a', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_26a',$info_system26!=null?($info_system26->sub_indicator_26a==-1?'NA':$info_system26->sub_indicator_26a):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                    <td rowspan="2">
                                                                        {{ Form::textarea('lab_info_system_26_comments',$info_system26!=null?($info_system26->indicator_26_comments):null,['class' => 'form-control','rows'=>'4', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr>                              

                                                                <tr> 
                                                                    <td>b) Updated in last quarter
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_26b', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_26b',$info_system26!=null?($info_system26->sub_indicator_26b==-1?'NA':$info_system26->sub_indicator_26b):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>   

                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_26"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_26"></span>  </span>    
                                                </p>
                                                    {{ Form::label('lab_info_system_26_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('lab_info_system_26_score',$scores->indicator26_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required'])  
                                                    }}
                                                </div>
                                            </div> 
                                            
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>

                                                           <strong>27. Filing of reports </strong><br>
                                                            <em>Are the following documents filed?  Verify
                                                            </em>
                                                    </p>

                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
      
                                                            <thead> 
                                                                <tr> 
                                                                    <th class="col-md-6"></th>
                                                                    <th class="col-md-2">1/0</th>
                                                                    <th class="col-md-4">Comments</th>
                                                                </tr>
                                                            </thead>                                                        

                                                            <tbody>
                                                                                                                 
                                                                <tr> 
                                                                    <td>a) HMIS 105(6) monthly reports
                                                                    </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_27a', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_27a',$info_system27!=null?($info_system27->sub_indicator_27a==-1?'NA':$info_system27->sub_indicator_27a):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                    <td rowspan="6">
                                                                        {{ Form::textarea('lab_info_system_27_comments',$info_system27!=null?($info_system27->indicator_27_comments):null,['class' => 'form-control','rows'=>'10', 'placeholder' => 'Comments']) }}
                                                                    </td>
                                                                </tr> 

                                                                <tr> 
                                                                    <td>b) Bi-Monthly report & HIV test kit order calculation form </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_27b', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_27b',$info_system27!=null?($info_system27->sub_indicator_27b==-1?'NA':$info_system27->sub_indicator_27b):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>

                                                                </tr>                                   

                                                                <tr> 
                                                                    <td>c) HMIS 018 </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_27c', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_27c',$info_system27!=null?($info_system27->sub_indicator_27c==-1?'NA':$info_system27->sub_indicator_27c):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr> 
 

                                                                <tr> 
                                                                    <td>d) Requisition & issue vouchers </td>
                                                                    <td class="form-group has-feedback">
                                                                    {{ Form::label('lab_info_system_27d', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                                                    {{ Form::text('lab_info_system_27d',$info_system27!=null?($info_system27->sub_indicator_27d==-1?'NA':$info_system27->sub_indicator_27d):null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                                        <div class="help-block with-errors"></div>
                                                                    </td>
                                                                </tr> 



                                                            </tbody>
                                                        </table>                                                  
                                                    </div>    
                                                         
                                                 <p>
                                                    <span class="score-computation">Score:   
                                                    <span id="score_27"></span>  </span> 
                                                    <span class="percentage-computation pull-right">Percentage: <span id="percentage_27"></span>  </span>    
                                                </p> 
                                                    {{ Form::label('lab_info_system_27_score', '', ['class' => 'col-md-3 control-label hidden']) }} 
                                                    {{ Form::text('lab_info_system_27_score',$scores->indicator27_score,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required'])  
                                                    }}                                                
                                                </div>
                                            </div> 


                                        </div>
                            </div>
                        </div>
        <!-- Start Box 6 -->


                    </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-offset-5">
                        <a href="{{url('/home')}}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
                        <button type="button" class="btn btn-primary hidden disabled"  id="submit_spin_btn"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i>Submit</button>
                        </div>
                    </div>  
                </div>
            </div>
    {!! Form::close() !!}


</div>
@endsection

@section('page-js-script')
<script type="text/javascript">

$('.form_datetime').click(function(){
    var popup =$(this).offset();
    var popupTop = popup.top - 1000;
    $('.ui-datepicker').css({
      'top' : popupTop
     });
});


$('#newProfileForm').submit(function()
 {
            $('.page_content').removeClass('hidden');
            $(".page_content").LoadingOverlay("show",
                    {
                        image       : "",
                        fontawesome : "fa fa-spinner fa-spin"
                    });    

            $("#submit_btn").val("Please Wait...")
              .attr('disabled', 'disabled');
         

            $(".page_content").LoadingOverlay("hide", true);

            return true;

  });




//set next visit date to 2 months later
   $('#visit_date').change(function(e){

        var m = moment(e.target.value, 'DD MMMM YYYY');
        
        $('#next_visit_date').val(m.add(60,'d').format('DD MMMM YYYY'));    
 

        var x = moment($('#visit_date').val(), 'DD MMMM YYYY');

    $("#ordering_16a").datepicker({
        endDate: x.add(0,'d').format( 'DD MMMM YYYY'),
    });

    $("#ordering_16b").datepicker({
        endDate: x.add(0,'d').format( 'DD MMMM YYYY'),
    });

    $("#ordering_16d").datepicker({
        endDate: x.add(0,'d').format( 'DD MMMM YYYY'),
    });

    $("#ordering_16e").datepicker({
        endDate: x.add(0,'d').format( 'DD MMMM YYYY'),
    });

  });


var arr_supervised=[];

//add row to supervised
$('#add_drug').click(function(e){

    arr_supervised.push({person_name:$('#drug_medical_item').val(),quantity:$('#drug_medical_quantity').val()});

    var id = parseInt(arr_supervised.length)-1;

    //populate
    $('#supervised_list').val(JSON.stringify(arr_supervised));

});


//remove row from investigations
$('#tbl_drugs').on('click', '.remove_drug', function(){
    
    arr_supervised.splice($(this).data('id'),1);

    //populate
    $('#supervised_list').val(JSON.stringify(arr_supervised));
});


//get sub districts
   $('#district_id').change(function(e){

            var data = {
                district: e.target.value,
                "_token": "{{ csrf_token() }}"  
            };

        $.ajax({
            type: 'POST',
            url: '/get_sub_districts',
            data: data
        }).done(function(response) {
            $('#sub_district_id').empty();

                $('#sub_district_id').append("<option/>");

            $.each(response, function(key, value) {
                $('#sub_district_id').append($("<option/>", {
                    value: key,
                    text: value
                }));
            });

        }).fail(function (jqXHR, textStatus, errorThrown) {
            //TODO handle fails on note post backs.
            console.log(textStatus + ' : ' + errorThrown);
        });

  });

//get facilities
   $('#sub_district_id').change(function(e){

            var data = {
                sub_district: e.target.value,
                district: $("#district_id").val(),
                "_token": "{{ csrf_token() }}"
            };

        $.ajax({
            type: 'POST',
            url: '/get_facility_list',
            data: data
        }).done(function(response) {
            $('#facility_id').empty();

                $('#facility_id').append("<option/>");

            $.each(response, function(key, value) {
                $('#facility_id').append($("<option/>", {
                    value: key,
                    text: value
                }));
            });

        }).fail(function (jqXHR, textStatus, errorThrown) {
            //TODO handle fails on note post backs.
            console.log(textStatus + ' : ' + errorThrown);
        });

  }); 


  //get facility information
   $('#facility_id').change(function(e){

            var data = {
                facility_id: e.target.value,
                "_token": "{{ csrf_token() }}"
            };

        $.ajax({
            type: 'POST',
            url: '/get_facility_info',
            data: data
        }).done(function(response) {

            var json = $.parseJSON(response);
            
            $('#facility_level').val(json.level);
            $('#ownership').val(json.ownership);
            $('#in_charge_name').val(json.in_charge_fname.concat(" ").concat(json.in_charge_lname));
            $('#in_charge_telephone').val(json.in_charge_contact);
            $('#responsible_lss').val(json.lss_fname.concat(" ").concat(json.lss_lname));
            $('#dhis_region').val(json.region);
            $('#visit_number').val(parseInt(json.visit_number)+1);

        }).fail(function (jqXHR, textStatus, errorThrown) {
            //TODO handle fails on note post backs.
            console.log(textStatus + ' : ' + errorThrown);
        });

  });   


   $('#stock_management_1_score,#stock_management_2_score,#stock_management_3_score,#stock_management_4_score,#stock_management_5_score,#stock_management_6_score,#stock_management_7_score,#stock_management_8_score,#stock_management_9_score').keyup(function(e){
    
        var value = $(this).val();

        if( value>1) 
        {
            $(this).val(value.replace(value, ''));
        }

   });


   $('#stock_management_1_score').change(function(e){
        var value = $(this).val();

        if( !isNaN(value) && value<=1) 
        {
            var score = parseFloat(value)*100;
            $('#stock_management_1_percentage').text((score).toFixed(2)+" %"); 

        }

   });


   $('#stock_management_2_score').change(function(e){
        var value = $(this).val();

        if( !isNaN(value) && value<=1) 
        {
            var score = parseFloat(value)*100;
            $('#stock_management_2_percentage').text((score).toFixed(2)+" %"); 

        }

   });

   $('#stock_management_3_score').change(function(e){
        var value = $(this).val();

        if( !isNaN(value) && value<=1) 
        {
            var score = parseFloat(value)*100;
            $('#stock_management_3_percentage').text((score).toFixed(2)+" %"); 

        }

   });

   $('#stock_management_4_score').change(function(e){
        var value = $(this).val();

        if( !isNaN(value) && value<=1) 
        {
            var score = parseFloat(value)*100;
            $('#stock_management_4_percentage').text((score).toFixed(2)+" %"); 

        }

   });

   $('#stock_management_5_score').change(function(e){
        var value = $(this).val();

        if( !isNaN(value) && value<=1) 
        {
            var score = parseFloat(value)*100;
            $('#stock_management_5_percentage').text((score).toFixed(2)+" %"); 

        }

   });

   $('#stock_management_6_score').change(function(e){
        var value = $(this).val();

        if( !isNaN(value) && value<=1) 
        {
            var score = parseFloat(value)*100;
            $('#stock_management_6_percentage').text((score).toFixed(2)+" %"); 

        }

   });

   $('#stock_management_7_score').change(function(e){
        var value = $(this).val();

        if( !isNaN(value) && value<=1) 
        {
            var score = parseFloat(value)*100;
            $('#stock_management_7_percentage').text((score).toFixed(2)+" %"); 

        }

   });

   $('#stock_management_8_score').change(function(e){
        var value = $(this).val();

        if( !isNaN(value) && value<=1) 
        {
            var score = parseFloat(value)*100;
            $('#stock_management_8_percentage').text((score).toFixed(2)+" %"); 

        }

   });

   $('#stock_management_9_score').change(function(e){
        var value = $(this).val();

        if( !isNaN(value) && value<=1) 
        {
            var score = parseFloat(value)*100;
            $('#stock_management_9_percentage').text((score).toFixed(2)+" %"); 

        }

   });

   $('#r1_c1,#r1_c3,#r1_c4,#r1_c5,#r1_c8,#r1_c13,#r1_c14,#r1_c15,#r1_c18,#r1_c20,#r2_c1,#r2_c3,#r2_c4,#r2_c5,#r2_c8,#r2_c13,#r2_c14,#r2_c15,#r2_c18,#r2_c20,#r3_c1,#r3_c3,#r3_c4,#r3_c5,#r3_c8,#r3_c13,#r3_c14,#r3_c15,#r3_c18,#r3_c20,#r4_c1,#r4_c3,#r4_c4,#r4_c5,#r4_c8,#r4_c13,#r4_c14,#r4_c15,#r4_c18,#r4_c20,#r5_c1,#r5_c3,#r5_c4,#r5_c5,#r5_c8,#r5_c13,#r5_c14,#r5_c15,#r5_c18,#r5_c20,#r6_c1,#r6_c3,#r6_c4,#r6_c5,#r6_c8,#r6_c13,#r6_c14,#r6_c15,#r6_c18,#r6_c20,#r7_c1,#r7_c3,#r7_c4,#r7_c5,#r7_c8,#r7_c13,#r7_c14,#r7_c15,#r7_c18,#r7_c20,#r8_c1,#r8_c3,#r8_c4,#r8_c5,#r8_c8,#r8_c13,#r8_c14,#r8_c15,#r8_c18,#r8_c20,#r9_c1,#r9_c3,#r9_c4,#r9_c5,#r9_c8,#r9_c13,#r9_c14,#r9_c15,#r9_c18,#r9_c20,#lab_equipment_18a,#lab_equipment_18b,#lab_equipment_18c,#lab_equipment_18d,#lab_equipment_19a,#lab_equipment_19b,#lab_equipment_19c,#lab_equipment_19d,#lab_equipment_20a3,#lab_equipment_20b3,#lab_equipment_20c3,#lab_equipment_20d3,#lab_equipment_20e3,#lab_equipment_20f3,#lab_equipment_20a4,#lab_equipment_20b4,#lab_equipment_20c4,#lab_equipment_20d4,#lab_equipment_20e4,#lab_equipment_20f4,#lab_equipment_20a5,#lab_equipment_20b5,#lab_equipment_20c5,#lab_equipment_20d5,#lab_equipment_20e5,#lab_equipment_20f5,#lab_info_system_23a,#lab_info_system_23b,#lab_info_system_24c,#lab_info_system_25a,#lab_info_system_25b,#lab_info_system_25c,#lab_info_system_25b,#lab_info_system_25ba1,#lab_info_system_25bb1,#lab_info_system_25bc1,#lab_info_system_25bd1,#lab_info_system_25be1,#lab_info_system_25bf1,#lab_info_system_25bg1,#lab_info_system_25ca1,#lab_info_system_25cb1,#lab_info_system_25cc1,#lab_info_system_25cd1,#lab_info_system_25ce1,#lab_info_system_25cf1,#lab_info_system_26a,#lab_info_system_26b,#lab_info_system_27a,#lab_info_system_27b,#lab_info_system_27c,#lab_info_system_27d').keyup(function(e){
    

        var pattern_number = new RegExp('^[0-1]|(N)$');
        var pattern_na = new RegExp('^(NA)|(NR)$');

        var value = $(this).val();



        if( value.length == 1 && !(pattern_number.test( value )) )
        {
            $(this).val(value.replace(value, ''));
        }
        else if( value.length == 2 && !(pattern_na.test( value )) )
        {
            $(this).val(value.replace(value, ''));
        }

   });


   $('#r1_c2,#r2_c2,#r3_c2,#r4_c2,#r5_c2,#r6_c2,#r7_c2,#r8_c2,#r9_c2').keyup(function(e){
        
        var pattern_number = new RegExp('^[0-1]|(E)$');
        
        var value = $(this).val();


        if( value.length == 1 && !(pattern_number.test( value )) )
        {
            $(this).val(value.replace(value, ''));
        }

   });


$('#r1_c1').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r1_c2,#r1_c3,#r1_c4,#r1_c5,#r1_c6,#r1_c7,#r1_c8,#r1_c9,#r1_c10,#r1_c11,#r1_c12,#r1_c13,#r1_c14,#r1_c15,#r1_c16,#r1_c17,#r1_c18,#r1_c19,#r1_c20,#r1_c21,#r1_c22').val('NA').prop("readonly",true);
        }
        else
        {
            $('#r1_c2,#r1_c3,#r1_c4,#r1_c5,#r1_c6,#r1_c7,#r1_c8,#r1_c9,#r1_c10,#r1_c11,#r1_c12,#r1_c13,#r1_c14,#r1_c15,#r1_c16,#r1_c17,#r1_c18,#r1_c19,#r1_c20,#r1_c21,#r1_c22').val('').prop("readonly",false);
        }

});

$('#r2_c1').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r2_c2,#r2_c3,#r2_c4,#r2_c5,#r2_c6,#r2_c7,#r2_c8,#r2_c9,#r2_c10,#r2_c11,#r2_c12,#r2_c13,#r2_c14,#r2_c15,#r2_c16,#r2_c17,#r2_c18,#r2_c19,#r2_c20,#r2_c21,#r2_c22').val('NA').prop("readonly",true);
        }
        else
        {
            $('#r2_c2,#r2_c3,#r2_c4,#r2_c5,#r2_c6,#r2_c7,#r2_c8,#r2_c9,#r2_c10,#r2_c11,#r2_c12,#r2_c13,#r2_c14,#r2_c15,#r2_c16,#r2_c17,#r2_c18,#r2_c19,#r2_c20,#r2_c21,#r2_c22').val('').prop("readonly",false);
        }

});

$('#r3_c1').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r3_c2,#r3_c3,#r3_c4,#r3_c5,#r3_c6,#r3_c7,#r3_c8,#r3_c9,#r3_c10,#r3_c11,#r3_c12,#r3_c13,#r3_c14,#r3_c15,#r3_c16,#r3_c17,#r3_c18,#r3_c19,#r3_c20,#r3_c21,#r3_c22').val('NA').prop("readonly",true);
        }
        else
        {
            $('#r3_c2,#r3_c3,#r3_c4,#r3_c5,#r3_c6,#r3_c7,#r3_c8,#r3_c9,#r3_c10,#r3_c11,#r3_c12,#r3_c13,#r3_c14,#r3_c15,#r3_c16,#r3_c17,#r3_c18,#r3_c19,#r3_c20,#r3_c21,#r3_c22').val('').prop("readonly",false);
        }

});


$('#r3b_c1').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r3b_c2,#r3b_c3,#r3b_c4,#r3b_c5,#r3b_c6,#r3b_c7,#r3b_c8,#r3b_c9,#r3b_c10,#r3b_c11,#r3b_c12,#r3b_c13,#r3b_c14,#r3b_c15,#r3b_c16,#r3b_c17,#r3b_c18,#r3b_c19,#r3b_c20,#r3b_c21,#r3b_c22').val('NA').prop("readonly",true);
        }
        else
        {
            $('#r3b_c2,#r3b_c3,#r3b_c4,#r3b_c5,#r3b_c6,#r3b_c7,#r3b_c8,#r3b_c9,#r3b_c10,#r3b_c11,#r3b_c12,#r3b_c13,#r3b_c14,#r3b_c15,#r3b_c16,#r3b_c17,#r3b_c18,#r3b_c19,#r3b_c20,#r3b_c21,#r3b_c22').val('').prop("readonly",false);
        }

});

$('#r4_c1').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r4_c2,#r4_c3,#r4_c4,#r4_c5,#r4_c6,#r4_c7,#r4_c8,#r4_c9,#r4_c10,#r4_c11,#r4_c12,#r4_c13,#r4_c14,#r4_c15,#r4_c16,#r4_c17,#r4_c18,#r4_c19,#r4_c20,#r4_c21,#r4_c22').val('NA').prop("readonly",true);
        }
        else
        {
            $('#r4_c2,#r4_c3,#r4_c4,#r4_c5,#r4_c6,#r4_c7,#r4_c8,#r4_c9,#r4_c10,#r4_c11,#r4_c12,#r4_c13,#r4_c14,#r4_c15,#r4_c16,#r4_c17,#r4_c18,#r4_c19,#r4_c20,#r4_c21,#r4_c22').val('').prop("readonly",false);
        }

});

$('#r4b_c1').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r4b_c2,#r4b_c3,#r4b_c4,#r4b_c5,#r4b_c6,#r4b_c7,#r4b_c8,#r4b_c9,#r4b_c10,#r4b_c11,#r4b_c12,#r4b_c13,#r4b_c14,#r4b_c15,#r4b_c16,#r4b_c17,#r4b_c18,#r4b_c19,#r4b_c20,#r4b_c21,#r4b_c22').val('NA').prop("readonly",true);
        }
        else
        {
            $('#r4b_c2,#r4b_c3,#r4b_c4,#r4b_c5,#r4b_c6,#r4b_c7,#r4b_c8,#r4b_c9,#r4b_c10,#r4b_c11,#r4b_c12,#r4b_c13,#r4b_c14,#r4b_c15,#r4b_c16,#r4b_c17,#r4b_c18,#r4b_c19,#r4b_c20,#r4b_c21,#r4b_c22').val('').prop("readonly",false);
        }

});

$('#r5_c1').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r5_c2,#r5_c3,#r5_c4,#r5_c5,#r5_c6,#r5_c7,#r5_c8,#r5_c9,#r5_c10,#r5_c11,#r5_c12,#r5_c13,#r5_c14,#r5_c15,#r5_c16,#r5_c17,#r5_c18,#r5_c19,#r5_c20,#r5_c21,#r5_c22').val('NA').prop("readonly",true);
        }
        else
        {
            $('#r5_c2,#r5_c3,#r5_c4,#r5_c5,#r5_c6,#r5_c7,#r5_c8,#r5_c9,#r5_c10,#r5_c11,#r5_c12,#r5_c13,#r5_c14,#r5_c15,#r5_c16,#r5_c17,#r5_c18,#r5_c19,#r5_c20,#r5_c21,#r5_c22').val('').prop("readonly",false);
        }

});

$('#r6_c1').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r6_c2,#r6_c3,#r6_c4,#r6_c5,#r6_c6,#r6_c7,#r6_c8,#r6_c9,#r6_c10,#r6_c11,#r6_c12,#r6_c13,#r6_c14,#r6_c15,#r6_c16,#r6_c17,#r6_c18,#r6_c19,#r6_c20,#r6_c21,#r6_c22').val('NA').prop("readonly",true);
        }
        else
        {
            $('#r6_c2,#r6_c3,#r6_c4,#r6_c5,#r6_c6,#r6_c7,#r6_c8,#r6_c9,#r6_c10,#r6_c11,#r6_c12,#r6_c13,#r6_c14,#r6_c15,#r6_c16,#r6_c17,#r6_c18,#r6_c19,#r6_c20,#r6_c21,#r6_c22').val('').prop("readonly",false);
        }

});


$('#r7_c1').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r7_c2,#r7_c3,#r7_c4,#r7_c5,#r7_c6,#r7_c7,#r7_c8,#r7_c9,#r7_c10,#r7_c11,#r7_c12,#r7_c13,#r7_c14,#r7_c15,#r7_c16,#r7_c17,#r7_c18,#r7_c19,#r7_c20,#r7_c21,#r7_c22').val('NA').prop("readonly",true);
        }
        else
        {
            $('#r7_c2,#r7_c3,#r7_c4,#r7_c5,#r7_c6,#r7_c7,#r7_c8,#r7_c9,#r7_c10,#r7_c11,#r7_c12,#r7_c13,#r7_c14,#r7_c15,#r7_c16,#r7_c17,#r7_c18,#r7_c19,#r7_c20,#r7_c21,#r7_c22').val('').prop("readonly",false);
        }

});


$('#r8_c1').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r8_c2,#r8_c3,#r8_c4,#r8_c5,#r8_c6,#r8_c7,#r8_c8,#r8_c9,#r8_c10,#r8_c11,#r8_c12,#r8_c13,#r8_c14,#r8_c15,#r8_c16,#r8_c17,#r8_c18,#r8_c19,#r8_c20,#r8_c21,#r8_c22').val('NA').prop("readonly",true);
        }
        else
        {
            $('#r8_c2,#r8_c3,#r8_c4,#r8_c5,#r8_c6,#r8_c7,#r8_c8,#r8_c9,#r8_c10,#r8_c11,#r8_c12,#r8_c13,#r8_c14,#r8_c15,#r8_c16,#r8_c17,#r8_c18,#r8_c19,#r8_c20,#r8_c21,#r8_c22').val('').prop("readonly",false);
        }

});


$('#r9_c1').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r9_c2,#r9_c3,#r9_c4,#r9_c5,#r9_c6,#r9_c7,#r9_c8,#r9_c9,#r9_c10,#r9_c11,#r9_c12,#r9_c13,#r9_c14,#r9_c15,#r9_c16,#r9_c17,#r9_c18,#r9_c19,#r9_c20,#r9_c21,#r9_c22').val('NA').prop("readonly",true);
        }
        else
        {
            $('#r9_c2,#r9_c3,#r9_c4,#r9_c5,#r9_c6,#r9_c7,#r9_c8,#r9_c9,#r9_c10,#r9_c11,#r9_c12,#r9_c13,#r9_c14,#r9_c15,#r9_c16,#r9_c17,#r9_c18,#r9_c19,#r9_c20,#r9_c21,#r9_c22').val('').prop("readonly",false);
        }

});


$('#r1_c3').change(function(e){
        
        var value = $(this).val();


        if( value==0 )
        {
            $('#r1_c4,#r1_c5,#r1_c6,#r1_c7,#r1_c8,#r1_c9,#r1_c10,#r1_c11,#r1_c12,#r1_c13').val('0').prop("readonly",true);
        }
        else
        {
            $('#r1_c4,#r1_c5,#r1_c6,#r1_c7,#r1_c8,#r1_c9,#r1_c10,#r1_c11,#r1_c12,#r1_c13').val('').prop("readonly",false);
        }

});


$('#r2_c3').change(function(e){
        
        var value = $(this).val();


        if( value==0 )
        {
            $('#r2_c4,#r2_c5,#r2_c6,#r2_c7,#r2_c8,#r2_c9,#r2_c10,#r2_c11,#r2_c12,#r2_c13').val('0').prop("readonly",true);
        }
        else
        {
            $('#r2_c4,#r2_c5,#r2_c6,#r2_c7,#r2_c8,#r2_c9,#r2_c10,#r2_c11,#r2_c12,#r2_c13').val('').prop("readonly",false);
        }

});


$('#r3_c3').change(function(e){
        
        var value = $(this).val();


        if( value==0 )
        {
            $('#r3_c4,#r3_c5,#r3_c6,#r3_c7,#r3_c8,#r3_c9,#r3_c10,#r3_c11,#r3_c12,#r3_c13').val('0').prop("readonly",true);
        }
        else
        {
            $('#r3_c4,#r3_c5,#r3_c6,#r3_c7,#r3_c8,#r3_c9,#r3_c10,#r3_c11,#r3_c12,#r3_c13').val('').prop("readonly",false);
        }

});


$('#r3b_c3').change(function(e){
        
        var value = $(this).val();


        if( value==0 )
        {
            $('#r3b_c4,#r3b_c5,#r3b_c6,#r3b_c7,#r3b_c8,#r3b_c9,#r3b_c10,#r3b_c11,#r3b_c12,#r3b_c13').val('0').prop("readonly",true);
        }
        else
        {
            $('#r3b_c4,#r3b_c5,#r3b_c6,#r3b_c7,#r3b_c8,#r3b_c9,#r3b_c10,#r3b_c11,#r3b_c12,#r3b_c13').val('').prop("readonly",false);
        }

});

$('#r4_c3').change(function(e){
        
        var value = $(this).val();


        if( value==0 )
        {
            $('#r4_c4,#r4_c5,#r4_c6,#r4_c7,#r4_c8,#r4_c9,#r4_c10,#r4_c11,#r4_c12,#r4_c13').val('0').prop("readonly",true);
        }
        else
        {
            $('#r4_c4,#r4_c5,#r4_c6,#r4_c7,#r4_c8,#r4_c9,#r4_c10,#r4_c11,#r4_c12,#r4_c13').val('').prop("readonly",false);
        }

});

$('#r4b_c3').change(function(e){
        
        var value = $(this).val();


        if( value==0 )
        {
            $('#r4b_c4,#r4b_c5,#r4b_c6,#r4b_c7,#r4b_c8,#r4b_c9,#r4b_c10,#r4b_c11,#r4b_c12,#r4b_c13').val('0').prop("readonly",true);
        }
        else
        {
            $('#r4b_c4,#r4b_c5,#r4b_c6,#r4b_c7,#r4b_c8,#r4b_c9,#r4b_c10,#r4b_c11,#r4b_c12,#r4b_c13').val('').prop("readonly",false);
        }

});

$('#r5_c3').change(function(e){
        
        var value = $(this).val();


        if( value==0 )
        {
            $('#r5_c4,#r5_c5,#r5_c6,#r5_c7,#r5_c8,#r5_c9,#r5_c10,#r5_c11,#r5_c12,#r5_c13').val('0').prop("readonly",true);
        }
        else
        {
            $('#r5_c4,#r5_c5,#r5_c6,#r5_c7,#r5_c8,#r5_c9,#r5_c10,#r5_c11,#r5_c12,#r5_c13').val('').prop("readonly",false);
        }

});


$('#r6_c3').change(function(e){
        
        var value = $(this).val();


        if( value==0 )
        {
            $('#r6_c4,#r6_c5,#r6_c6,#r6_c7,#r6_c8,#r6_c9,#r6_c10,#r6_c11,#r6_c12,#r6_c13').val('0').prop("readonly",true);
        }
        else
        {
            $('#r6_c4,#r6_c5,#r6_c6,#r6_c7,#r6_c8,#r6_c9,#r6_c10,#r6_c11,#r6_c12,#r6_c13').val('').prop("readonly",false);
        }

});


$('#r7_c3').change(function(e){
        
        var value = $(this).val();


        if( value==0 )
        {
            $('#r7_c4,#r7_c5,#r7_c6,#r7_c7,#r7_c8,#r7_c9,#r7_c10,#r7_c11,#r7_c12,#r7_c13').val('0').prop("readonly",true);
        }
        else
        {
            $('#r7_c4,#r7_c5,#r7_c6,#r7_c7,#r7_c8,#r7_c9,#r7_c10,#r7_c11,#r7_c12,#r7_c13').val('').prop("readonly",false);
        }

});


$('#r8_c3').change(function(e){
        
        var value = $(this).val();


        if( value==0 )
        {
            $('#r8_c4,#r8_c5,#r8_c6,#r8_c7,#r8_c8,#r8_c9,#r8_c10,#r8_c11,#r8_c12,#r8_c13').val('0').prop("readonly",true);
        }
        else
        {
            $('#r8_c4,#r8_c5,#r8_c6,#r8_c7,#r8_c8,#r8_c9,#r8_c10,#r8_c11,#r8_c12,#r8_c13').val('').prop("readonly",false);
        }

});


$('#r9_c3').change(function(e){
        
        var value = $(this).val();


        if( value==0 )
        {
            $('#r9_c4,#r9_c5,#r9_c6,#r9_c7,#r9_c8,#r9_c9,#r9_c10,#r9_c11,#r9_c12,#r9_c13').val('0').prop("readonly",true);
        }
        else
        {
            $('#r9_c4,#r9_c5,#r9_c6,#r9_c7,#r9_c8,#r9_c9,#r9_c10,#r9_c11,#r9_c12,#r9_c13').val('').prop("readonly",false);
        }

});


$('#r1_c14').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r1_c18,#r1_c15,#r1_c16,#r1_c17').val('0').prop("readonly",true);
        }
        else
        {
            $('#r1_c18,#r1_c15,#r1_c16,#r1_c17').val('').prop("readonly",false);
        }

});


$('#r2_c14').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r2_c18,#r2_c15,#r2_c16,#r2_c17').val('0').prop("readonly",true);
        }
        else
        {
            $('#r2_c18,#r2_c15,#r2_c16,#r2_c17').val('').prop("readonly",false);
        }

});


$('#r3_c14').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r3_c18,#r3_c15,#r3_c16,#r3_c17').val('0').prop("readonly",true);
        }
        else
        {
            $('#r3_c18,#r3_c15,#r3_c16,#r3_c17').val('').prop("readonly",false);
        }

});



$('#r4_c14').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r4_c18,#r4_c15,#r4_c16,#r4_c17').val('0').prop("readonly",true);
        }
        else
        {
            $('#r4_c18,#r4_c15,#r4_c16,#r4_c17').val('').prop("readonly",false);
        }

});


$('#r5_c14').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r5_c18,#r5_c15,#r5_c16,#r5_c17').val('0').prop("readonly",true);
        }
        else
        {
            $('#r5_c18,#r5_c15,#r5_c16,#r5_c17').val('').prop("readonly",false);
        }

});


$('#r6_c14').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r6_c18,#r6_c15,#r6_c16,#r6_c17').val('0').prop("readonly",true);
        }
        else
        {
            $('#r6_c18,#r6_c15,#r6_c16,#r6_c17').val('').prop("readonly",false);
        }

});




$('#r7_c14').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r7_c18,#r7_c15,#r7_c16,#r7_c17').val('0').prop("readonly",true);
        }
        else
        {
            $('#r7_c18,#r7_c15,#r7_c16,#r7_c17').val('').prop("readonly",false);
        }

});


$('#r8_c14').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r8_c18,#r8_c15,#r8_c16,#r8_c17').val('0').prop("readonly",true);
        }
        else
        {
            $('#r8_c18,#r8_c15,#r8_c16,#r8_c17').val('').prop("readonly",false);
        }

});


$('#r9_c14').change(function(e){
        
        var value = $(this).val();


        if( value!=1 )
        {
            $('#r9_c18,#r9_c15,#r9_c16,#r9_c17').val('0').prop("readonly",true);
        }
        else
        {
            $('#r9_c18,#r9_c15,#r9_c16,#r9_c17').val('').prop("readonly",false);
        }

});


$('#r9_c22').change(function(e){



});


$('#lab_equipment_20a2,#lab_equipment_20b2,#lab_equipment_20c2,#lab_equipment_20d2,#lab_equipment_20e2,#lab_equipment_20f2,lab_equipment_20a6,#lab_equipment_20b6,#lab_equipment_20c6,#lab_equipment_20d6,#lab_equipment_20e6,#lab_equipment_20f6').keyup(function(e){
        
            
            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(N)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) && !(value>=0 && value<=31) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_na.test( value )) && !(value>=0 && value<=31) )
            {
                $(this).val(value.replace(value, ''));
            }


   });


    $('#cd4_facs_calibre_21a2,#cd4_facs_count_21b2,#cd4_partec_count_21c2,#cd4_pima_21d2,cd4_facs_presto_21e2,#chemistry_c311_21a2,#chemistry_c111_21b2,#haematology_huma600_21a2,#haematology_huma30TS_21b2,#haematology_huma60TS_21c2,#haematology_huma5L_21d2,#haematology_mind3200_21e2,#haematology_mind3000_21f2,#haematology_sysmex100_21g2,#haematology_sysmex300_21h2').keyup(function(e){
            
            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(N)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) && !(value>=0 && value<=31) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_na.test( value )) && !(value>=0 && value<=31) )
            {
                $(this).val(value.replace(value, ''));
            }


       });


   $('#ordering_15a,#ordering_15b,#ordering_15c,#ordering_16c,#ordering_16f').keyup(function(e){
        
        var pattern_number = new RegExp('^[0-1]|(N)$');
        var pattern_na = new RegExp('^(NR)$');

        var value = $(this).val();


        if( value.length == 1 && !(pattern_number.test( value )) )
        {
            $(this).val(value.replace(value, ''));
        }
        else if( value.length == 2 && !(pattern_na.test( value )) )
        {
            $(this).val(value.replace(value, ''));
        }

   });


    $('#lab_info_system_25ba1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25ba2,#lab_info_system_25ba3,#lab_info_system_25ba4,#lab_info_system_25ba5,#lab_info_system_25ba6,#lab_info_system_25ba7,#lab_info_system_25ba8').val('NA').prop("readonly",true);
            }
            else if( value==0 )
            {
                $('#lab_info_system_25ba2,#lab_info_system_25ba3,#lab_info_system_25ba4,#lab_info_system_25ba5,#lab_info_system_25ba6,#lab_info_system_25ba7').val('NA').prop("readonly",true);                
                $('#lab_info_system_25ba8').val('0').prop("readonly",true);
            }
            else
            {
                $('#lab_info_system_25ba2,#lab_info_system_25ba3,#lab_info_system_25ba4,#lab_info_system_25ba5,#lab_info_system_25ba6,#lab_info_system_25ba7,#lab_info_system_25ba8').val('').prop("readonly",false);
            }

    });




    $('#lab_equipment_20a1').change(function(e){

            var pattern_number = new RegExp('^[0-1]|(N)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_na.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( (value.length == 1 && (pattern_number.test( value ))) && value!=1  )
            {
                $('#lab_equipment_20a2,#lab_equipment_20a3,#lab_equipment_20a4,#lab_equipment_20a5,#lab_equipment_20a6').val('').prop("readonly",false);
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#lab_equipment_20a2,#lab_equipment_20a3,#lab_equipment_20a4,#lab_equipment_20a5,#lab_equipment_20a6').val('NA').prop("readonly",true);
            }            
            else if( value.length == 1  && value==1 ) 
            {
                $('#lab_equipment_20a2,#lab_equipment_20a3,#lab_equipment_20a4,#lab_equipment_20a5,#lab_equipment_20a6').val('NA').prop("readonly",true);
            }

    });



    $('#lab_equipment_20b1').change(function(e){

            var pattern_number = new RegExp('^[0-1]|(N)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_na.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( (value.length == 1 && (pattern_number.test( value ))) &&  (value!=1) )
            {
                $('#lab_equipment_20b2,#lab_equipment_20b3,#lab_equipment_20b4,#lab_equipment_20b5,#lab_equipment_20b6').val('').prop("readonly",false);
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#lab_equipment_20b2,#lab_equipment_20b3,#lab_equipment_20b4,#lab_equipment_20b5,#lab_equipment_20b6').val('NA').prop("readonly",true);
            }            
            else if( value.length == 1  && value==1 ) 
            {
                $('#lab_equipment_20b2,#lab_equipment_20b3,#lab_equipment_20b4,#lab_equipment_20b5,#lab_equipment_20b6').val('NA').prop("readonly",true);
            }

    });


    $('#lab_equipment_20c1').change(function(e){

            var pattern_number = new RegExp('^[0-1]|(N)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_na.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( (value.length == 1 && (pattern_number.test( value ))) && (value!=1) )
            {
                $('#lab_equipment_20c2,#lab_equipment_20c3,#lab_equipment_20c4,#lab_equipment_20c5,#lab_equipment_20c6').val('').prop("readonly",false);
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#lab_equipment_20c2,#lab_equipment_20c3,#lab_equipment_20c4,#lab_equipment_20c5,#lab_equipment_20c6').val('NA').prop("readonly",true);
            }            
            else if( value.length == 1  && value==1 ) 
            {
                $('#lab_equipment_20c2,#lab_equipment_20c3,#lab_equipment_20c4,#lab_equipment_20c5,#lab_equipment_20c6').val('NA').prop("readonly",true);
            }

    });



    $('#lab_equipment_20d1').change(function(e){

            var pattern_number = new RegExp('^[0-1]|(N)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_na.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( (value.length == 1 && (pattern_number.test( value ))) && (value!=1) )
            {
                $('#lab_equipment_20d2,#lab_equipment_20d3,#lab_equipment_20d4,#lab_equipment_20d5,#lab_equipment_20d6').val('').prop("readonly",false);
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#lab_equipment_20d2,#lab_equipment_20d3,#lab_equipment_20d4,#lab_equipment_20d5,#lab_equipment_20d6').val('NA').prop("readonly",true);
            }             
            else if( value.length == 1  && value==1 ) 
            {
                $('#lab_equipment_20d2,#lab_equipment_20d3,#lab_equipment_20d4,#lab_equipment_20d5,#lab_equipment_20d6').val('NA').prop("readonly",true);
            }           


    });


    $('#lab_equipment_20e1').change(function(e){

            var pattern_number = new RegExp('^[0-1]|(N)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_na.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( (value.length == 1 && (pattern_number.test( value )))&& (value!=1) )
            {
                $('#lab_equipment_20e2,#lab_equipment_20e3,#lab_equipment_20e4,#lab_equipment_20e5,#lab_equipment_20e6').val('').prop("readonly",false);
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#lab_equipment_20e2,#lab_equipment_20e3,#lab_equipment_20e4,#lab_equipment_20e5,#lab_equipment_20e6').val('NA').prop("readonly",true);
            }        
            else if( value.length == 1  && value==1 ) 
            {
                $('#lab_equipment_20e2,#lab_equipment_20e3,#lab_equipment_20e4,#lab_equipment_20e5,#lab_equipment_20e6').val('NA').prop("readonly",true);
            }                 


    });



    $('#lab_equipment_20f1').change(function(e){

            var pattern_number = new RegExp('^[0-1]|(N)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_na.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( (value.length == 1 && (pattern_number.test( value ))) && (value!=1) )
            {
                $('#lab_equipment_20f2,#lab_equipment_20f3,#lab_equipment_20f4,#lab_equipment_20f5,#lab_equipment_20f6').val('').prop("readonly",false);
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#lab_equipment_20f2,#lab_equipment_20f3,#lab_equipment_20f4,#lab_equipment_20f5,#lab_equipment_20f6').val('NA').prop("readonly",true);
            }       
            else if( value.length == 1  && value==1 ) 
            {
                $('#lab_equipment_20f2,#lab_equipment_20f3,#lab_equipment_20f4,#lab_equipment_20f5,#lab_equipment_20f6').val('NA').prop("readonly",true);
            }                 
          

    });

    $('#cd4_facs_calibre_21a2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');            
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }



            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#cd4_facs_calibre_21a3,#cd4_facs_calibre_21a7').val('').prop("readonly",false);
                $('#cd4_facs_calibre_21a4,#cd4_facs_calibre_21a5,#cd4_facs_calibre_21a6,#cd4_facs_calibre_21a8').text('');
                indicator21_a1();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#cd4_facs_calibre_21a3,#cd4_facs_calibre_21a7').val('NA').prop("readonly",true);
                $('#cd4_facs_calibre_21a4,#cd4_facs_calibre_21a5,#cd4_facs_calibre_21a6,#cd4_facs_calibre_21a8').text('NA');
                indicator21_a1();
                indicator21_score();            
            }            


    });

    $('#cd4_facs_count_21b2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');            
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#cd4_facs_count_21b3,#cd4_facs_count_21b7').val('').prop("readonly",false);
                $('#cd4_facs_count_21b4,#cd4_facs_count_21b5,#cd4_facs_count_21b6,#cd4_facs_count_21b8').text('');
                indicator21_a2();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#cd4_facs_count_21b3,#cd4_facs_count_21b7').val('NA').prop("readonly",true);
                $('#cd4_facs_count_21b4,#cd4_facs_count_21b5,#cd4_facs_count_21b6,#cd4_facs_count_21b8').text('NA');
                indicator21_a2();
                indicator21_score();            
            }            


    });

    $('#cd4_partec_count_21c2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');            
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#cd4_partec_count_21c3,#cd4_partec_count_21c7').val('').prop("readonly",false);
                $('#cd4_partec_count_21c4,#cd4_partec_count_21c5,#cd4_partec_count_21c6,#cd4_partec_count_21c8').text('');
                indicator21_a3();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#cd4_partec_count_21c3,#cd4_partec_count_21c7').val('NA').prop("readonly",true);
                $('#cd4_partec_count_21c4,#cd4_partec_count_21c5,#cd4_partec_count_21c6,#cd4_partec_count_21c8').text('NA');
                indicator21_a3();
                indicator21_score();            
            }            


    });

    $('#cd4_pima_21d2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#cd4_pima_21d3,#cd4_pima_21d7').val('').prop("readonly",false);
                $('#cd4_pima_21d4,#cd4_pima_21d5,#cd4_pima_21d6,#cd4_pima_21d8').text('');
                indicator21_a4();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#cd4_pima_21d3,#cd4_pima_21d7').val('NA').prop("readonly",true);
                $('#cd4_pima_21d4,#cd4_pima_21d5,#cd4_pima_21d6,#cd4_pima_21d8').text('NA');
                indicator21_a4();
                indicator21_score();            
            }            


    });

    $('#cd4_facs_presto_21e2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#cd4_facs_presto_21e3,#cd4_facs_presto_21e7').val('').prop("readonly",false);
                $('#cd4_facs_presto_21e4,#cd4_facs_presto_21e5,#cd4_facs_presto_21e6,#cd4_facs_presto_21e8').text('');
                indicator21_a5();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#cd4_facs_presto_21e3,#cd4_facs_presto_21e7').val('NA').prop("readonly",true);
                $('#cd4_facs_presto_21e4,#cd4_facs_presto_21e5,#cd4_facs_presto_21e6,#cd4_facs_presto_21e8').text('NA');
                indicator21_a5();
                indicator21_score();            
            }            


    });


    $('#chemistry_c311_21a2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');            
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#chemistry_c311_21a3,#chemistry_c311_21a7').val('').prop("readonly",false);
                $('#chemistry_c311_21a4,#chemistry_c311_21a5,#chemistry_c311_21a6,#chemistry_c311_21a8').text('');
                indicator21_b1();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#chemistry_c311_21a3,#chemistry_c311_21a7').val('NA').prop("readonly",true);
                $('#chemistry_c311_21a4,#chemistry_c311_21a5,#chemistry_c311_21a6,#chemistry_c311_21a8').text('NA');
                indicator21_b1();
                indicator21_score();            
            }            


    });

    $('#chemistry_c111_21b2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#chemistry_c111_21b3,#chemistry_c111_21b7').val('').prop("readonly",false);
                $('#chemistry_c111_21b4,#chemistry_c111_21b5,#chemistry_c111_21b6,#chemistry_c111_21b8').text('');
                indicator21_b2();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#chemistry_c111_21b3,#chemistry_c111_21b7').val('NA').prop("readonly",true);
                $('#chemistry_c111_21b4,#chemistry_c111_21b5,#chemistry_c111_21b6,#chemistry_c111_21b8').text('NA');
                indicator21_b2();
                indicator21_score();            
            }            

    });


    $('#haematology_huma600_21a2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#haematology_huma600_21a3,#haematology_huma600_21a7').val('').prop("readonly",false);
                $('#haematology_huma600_21a4,#haematology_huma600_21a5,#haematology_huma600_21a6,#haematology_huma600_21a8').text('');
                indicator21_c1();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#haematology_huma600_21a3,#haematology_huma600_21a7').val('NA').prop("readonly",true);
                $('#haematology_huma600_21a4,#haematology_huma600_21a5,#haematology_huma600_21a6,#haematology_huma600_21a8').text('NA');
                indicator21_c1();
                indicator21_score();            
            }            


    });

    $('#haematology_huma30TS_21b2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#haematology_huma30TS_21b3,#haematology_huma30TS_21b7').val('').prop("readonly",false);
                $('#haematology_huma30TS_21b4,#haematology_huma30TS_21b5,#haematology_huma30TS_21b6,#haematology_huma30TS_21b8').text('');
                indicator21_c2();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#haematology_huma30TS_21b3,#haematology_huma30TS_21b7').val('NA').prop("readonly",true);
                $('#haematology_huma30TS_21b4,#haematology_huma30TS_21b5,#haematology_huma30TS_21b6,#haematology_huma30TS_21b8').text('NA');
                indicator21_c2();
                indicator21_score();            
            }            


    });


    $('#haematology_huma60TS_21c2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#haematology_huma60TS_21c3,#haematology_huma60TS_21c7').val('').prop("readonly",false);
                $('#haematology_huma60TS_21c4,#haematology_huma60TS_21c5,#haematology_huma60TS_21c6,#haematology_huma60TS_21c8').text('');
                indicator21_c3();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#haematology_huma60TS_21c3,#haematology_huma60TS_21c7').val('NA').prop("readonly",true);
                $('#haematology_huma60TS_21c4,#haematology_huma60TS_21c5,#haematology_huma60TS_21c6,#haematology_huma60TS_21c8').text('NA');
                indicator21_c3();
                indicator21_score();            
            }            


    });

    $('#haematology_mind3200_21e2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#haematology_mind3200_21e3,#haematology_mind3200_21e7').val('').prop("readonly",false);
                $('#haematology_mind3200_21e4,#haematology_mind3200_21e5,#haematology_mind3200_21e6,#haematology_mind3200_21e8').text('');
                indicator21_c5();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#haematology_mind3200_21e3,#haematology_mind3200_21e7').val('NA').prop("readonly",true);
                $('#haematology_mind3200_21e4,#haematology_mind3200_21e5,#haematology_mind3200_21e6,#haematology_mind3200_21e8').text('NA');
                indicator21_c5();
                indicator21_score();            
            }            

    });


    $('#haematology_mind3000_21f2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }

            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#haematology_mind3000_21f3,#haematology_mind3000_21f7').val('').prop("readonly",false);
                $('#haematology_mind3000_21f4,#haematology_mind3000_21f5,#haematology_mind3000_21f6,#haematology_mind3000_21f8').text('');
                indicator21_c6();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#haematology_mind3000_21f3,#haematology_mind3000_21f7').val('NA').prop("readonly",true);
                $('#haematology_mind3000_21f4,#haematology_mind3000_21f5,#haematology_mind3000_21f6,#haematology_mind3000_21f8').text('NA');
                indicator21_c6();
                indicator21_score();            
            }            

    });


    $('#haematology_mind2800_21j2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#haematology_mind2800_21j3,#haematology_mind2800_21j7').val('').prop("readonly",false);
                $('#haematology_mind2800_21j4,#haematology_mind2800_21j5,#haematology_mind2800_21j6,#haematology_mind2800_21j8').text('');
                indicator21_c10();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#haematology_mind2800_21j3,#haematology_mind2800_21j7').val('NA').prop("readonly",true);
                $('#haematology_mind2800_21j4,#haematology_mind2800_21j5,#haematology_mind2800_21j6,#haematology_mind2800_21j8').text('NA');
                indicator21_c10();
                indicator21_score();            
            }            

    });


    $('#haematology_mind2300_21i2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#haematology_mind2300_21i3,#haematology_mind2300_21i7').val('').prop("readonly",false);
                $('#haematology_mind2300_21i4,#haematology_mind2300_21i5,#haematology_mind2300_21i6,#haematology_mind2300_21i8').text('');
                indicator21_c9();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#haematology_mind2300_21i3,#haematology_mind2300_21i7').val('NA').prop("readonly",true);
                $('#haematology_mind2300_21i4,#haematology_mind2300_21i5,#haematology_mind2300_21i6,#haematology_mind2300_21i8').text('NA');
                indicator21_c9();
                indicator21_score();            
            }            


    });

    $('#haematology_medonic_21k2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#haematology_medonic_21k3,#haematology_medonic_21k7').val('').prop("readonly",false);
                $('#haematology_medonic_21k4,#haematology_medonic_21k5,#haematology_medonic_21k6,#haematology_medonic_21k8').text('');
                indicator21_c11();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#haematology_medonic_21k3,#haematology_medonic_21k7').val('NA').prop("readonly",true);
                $('#haematology_medonic_21k4,#haematology_medonic_21k5,#haematology_medonic_21k6,#haematology_medonic_21k8').text('NA');
                indicator21_c11();
                indicator21_score();            
            }            


    });


    $('#haematology_sysmex100_21g2').change(function(e){

            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#haematology_sysmex100_21g3,#haematology_sysmex100_21g7').val('').prop("readonly",false);
                $('#haematology_sysmex100_21g4,#haematology_sysmex100_21g5,#haematology_sysmex100_21g6,#haematology_sysmex100_21g8').text('');
                indicator21_c7();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#haematology_sysmex100_21g3,#haematology_sysmex100_21g7').val('NA').prop("readonly",true);
                $('#haematology_sysmex100_21g4,#haematology_sysmex100_21g5,#haematology_sysmex100_21g6,#haematology_sysmex100_21g8').text('NA');
                indicator21_c7();
                indicator21_score();            
            }            


    });

    $('#haematology_sysmex300_21h2').change(function(e){


            var pattern_number = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');
            var pattern_na = new RegExp('^(NA)$');

            var value = $(this).val();


            if( value.length == 1 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }
            else if( value.length == 2 && !(pattern_number.test( value )) )
            {
                $(this).val(value.replace(value, ''));
            }


            if( value.length == 1 && (pattern_number.test( value )) )
            {
                $('#haematology_sysmex300_21h3,#haematology_sysmex300_21h7').val('').prop("readonly",false);
                $('#haematology_sysmex300_21h4,#haematology_sysmex300_21h5,#haematology_sysmex300_21h6,#haematology_sysmex300_21h8').text('');
                indicator21_c8();
                indicator21_score(); 
            }
            else if( value.length == 2 && (pattern_na.test( value )) )
            {
                $('#haematology_sysmex300_21h3,#haematology_sysmex300_21h7').val('NA').prop("readonly",true);
                $('#haematology_sysmex300_21h4,#haematology_sysmex300_21h5,#haematology_sysmex300_21h6,#haematology_sysmex300_21h8').text('NA');
                indicator21_c8();
                indicator21_score();            
            }            


    });

    $('#lab_info_system_25bb1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25bb2,#lab_info_system_25bb3,#lab_info_system_25bb4,#lab_info_system_25bb5,#lab_info_system_25bb6,#lab_info_system_25bb7,#lab_info_system_25bb8').val('NA').prop("readonly",true);
            }
            else if( value==0 )
            {
                $('#lab_info_system_25bb2,#lab_info_system_25bb3,#lab_info_system_25bb4,#lab_info_system_25bb5,#lab_info_system_25bb6,#lab_info_system_25bb7').val('NA').prop("readonly",true);                
                $('#lab_info_system_25bb8').val('0').prop("readonly",true);
            }
            else
            {
                $('#lab_info_system_25bb2,#lab_info_system_25bb3,#lab_info_system_25bb4,#lab_info_system_25bb5,#lab_info_system_25bb6,#lab_info_system_25bb7,#lab_info_system_25bb8').val('').prop("readonly",false);
            }

    });


    $('#lab_info_system_25bc1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25bc2,#lab_info_system_25bc3,#lab_info_system_25bc4,#lab_info_system_25bc5,#lab_info_system_25bc6,#lab_info_system_25bc7,#lab_info_system_25bc8').val('NA').prop("readonly",true);
            }            
            else if( value==0 )
            {
                $('#lab_info_system_25bc2,#lab_info_system_25bc3,#lab_info_system_25bc4,#lab_info_system_25bc5,#lab_info_system_25bc6,#lab_info_system_25bc7,#lab_info_system_25bc8').val('NA').prop("readonly",true);
                $('#lab_info_system_25bc8').val('0').prop("readonly",true);
            }
            else
            {
                $('#lab_info_system_25bc2,#lab_info_system_25bc3,#lab_info_system_25bc4,#lab_info_system_25bc5,#lab_info_system_25bc6,#lab_info_system_25bc7,#lab_info_system_25bc8').val('').prop("readonly",false);
            }

    });


    $('#lab_info_system_25bd1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25bd2,#lab_info_system_25bd3,#lab_info_system_25bd4,#lab_info_system_25bd5,#lab_info_system_25bd6,#lab_info_system_25bd7,#lab_info_system_25bd8').val('NA').prop("readonly",true);
            }
            else if( value==0 )
            {
                $('#lab_info_system_25bd2,#lab_info_system_25bd3,#lab_info_system_25bd4,#lab_info_system_25bd5,#lab_info_system_25bd6,#lab_info_system_25bd7,#lab_info_system_25bd8').val('NA').prop("readonly",true);
                $('#lab_info_system_25bd8').val('0').prop("readonly",true);
            }
            else
            {
                $('#lab_info_system_25bd2,#lab_info_system_25bd3,#lab_info_system_25bd4,#lab_info_system_25bd5,#lab_info_system_25bd6,#lab_info_system_25bd7,#lab_info_system_25bd8').val('').prop("readonly",false);
            }

    });

    $('#lab_info_system_25be1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25be2,#lab_info_system_25be3,#lab_info_system_25be4,#lab_info_system_25be5,#lab_info_system_25be6,#lab_info_system_25be7,#lab_info_system_25be8').val('NA').prop("readonly",true);
            }
            else if( value==0 )
            {
                $('#lab_info_system_25be2,#lab_info_system_25be3,#lab_info_system_25be4,#lab_info_system_25be5,#lab_info_system_25be6,#lab_info_system_25be7').val('NA').prop("readonly",true);  
                $('#lab_info_system_25be8').val('0').prop("readonly",true);
            }            
            else
            {
                $('#lab_info_system_25be2,#lab_info_system_25be3,#lab_info_system_25be4,#lab_info_system_25be5,#lab_info_system_25be6,#lab_info_system_25be7,#lab_info_system_25be8').val('').prop("readonly",false);
            }

    });


    $('#lab_info_system_25bf1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25bf2,#lab_info_system_25bf3,#lab_info_system_25bf4,#lab_info_system_25bf5,#lab_info_system_25bf6,#lab_info_system_25bf7,#lab_info_system_25bf8').val('NA').prop("readonly",true);
            }
            else if( value==0 )
            {
                $('#lab_info_system_25bf2,#lab_info_system_25bf3,#lab_info_system_25bf4,#lab_info_system_25bf5,#lab_info_system_25bf6,#lab_info_system_25bf7').val('NA').prop("readonly",true);
                $('#lab_info_system_25bf8').val('0').prop("readonly",true);
            }
            else
            {
                $('#lab_info_system_25bf2,#lab_info_system_25bf3,#lab_info_system_25bf4,#lab_info_system_25bf5,#lab_info_system_25bf6,#lab_info_system_25bf7,#lab_info_system_25bf8').val('').prop("readonly",false);
            }

    });




    $('#lab_info_system_25bg1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25bg2,#lab_info_system_25bg3,#lab_info_system_25bg4,#lab_info_system_25bg5,#lab_info_system_25bg6,#lab_info_system_25bg7,#lab_info_system_25bg8').val('NA').prop("readonly",true);
            }
            else if( value==0 )
            {
                $('#lab_info_system_25bg2,#lab_info_system_25bg3,#lab_info_system_25bg4,#lab_info_system_25bg5,#lab_info_system_25bg6,#lab_info_system_25bg7').val('NA').prop("readonly",true);
                $('#lab_info_system_25bg8').val('0').prop("readonly",true);
            }
            else
            {
                $('#lab_info_system_25bg2,#lab_info_system_25bg3,#lab_info_system_25bg4,#lab_info_system_25bg5,#lab_info_system_25bg6,#lab_info_system_25bg7,#lab_info_system_25bg8').val('').prop("readonly",false);
            }

    });



    $('#lab_info_system_25ca1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25ca2,#lab_info_system_25ca3,#lab_info_system_25ca4').val('NA').prop("readonly",true);
            }            
            else if( value==0 )
            {
                $('#lab_info_system_25ca2,#lab_info_system_25ca3').val('NA').prop("readonly",true);
                $('#lab_info_system_25ca4').val('0').prop("readonly",true);
            }
            else
            {
                $('#lab_info_system_25ca2,#lab_info_system_25ca3,#lab_info_system_25ca4').val('').prop("readonly",false);
            }


    });


    $('#lab_info_system_25cb1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25cb2,#lab_info_system_25cb3,#lab_info_system_25cb4').val('NA').prop("readonly",true);
            }
            else if( value==0 )
            {
                $('#lab_info_system_25cb2,#lab_info_system_25cb3').val('NA').prop("readonly",true);
                $('#lab_info_system_25cb4').val('0').prop("readonly",true);
            }
            else
            {
                $('#lab_info_system_25cb2,#lab_info_system_25cb3,#lab_info_system_25cb4').val('').prop("readonly",false);
            }


    });


    $('#lab_info_system_25cc1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25cc2,#lab_info_system_25cc3,#lab_info_system_25cc4').val('NA').prop("readonly",true);
            }
            else if( value==0 )
            {
                $('#lab_info_system_25cc2,#lab_info_system_25cc3').val('NA').prop("readonly",true);
                $('#lab_info_system_25cc4').val('0').prop("readonly",true);
            }
            else
            {
                $('#lab_info_system_25cc2,#lab_info_system_25cc3,#lab_info_system_25cc4').val('').prop("readonly",false);
            }


    });


    $('#lab_info_system_25cd1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25cd2,#lab_info_system_25cd3,#lab_info_system_25cd4').val('NA').prop("readonly",true);
            }            
            else if( value==0 )
            {
                $('#lab_info_system_25cd2,#lab_info_system_25cd3').val('NA').prop("readonly",true);
                $('#lab_info_system_25cd4').val('0').prop("readonly",true);
            }
            else
            {
                $('#lab_info_system_25cd2,#lab_info_system_25cd3,#lab_info_system_25cd4').val('').prop("readonly",false);
            }

    });

    $('#lab_info_system_25ce1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25ce2,#lab_info_system_25ce3,#lab_info_system_25ce4').val('NA').prop("readonly",true);
            }            
            else if( value==0 )
            {
                $('#lab_info_system_25ce2,#lab_info_system_25ce3').val('NA').prop("readonly",true);
                $('#lab_info_system_25ce4').val('0').prop("readonly",true);
            }
            else
            {
                $('#lab_info_system_25ce2,#lab_info_system_25ce3,#lab_info_system_25ce4').val('').prop("readonly",false);
            }

    });


    $('#lab_info_system_25cf1').change(function(e){

            var value = $(this).val();


            if( value=='NA' )
            {
                $('#lab_info_system_25cf2,#lab_info_system_25cf3,#lab_info_system_25cf4').val('NA').prop("readonly",true);
            }
            else if( value==0 )
            {
                $('#lab_info_system_25cf2,#lab_info_system_25cf3').val('NA').prop("readonly",true); 
                $('#lab_info_system_25cf4').val('0').prop("readonly",true);
            }
            else
            {
                $('#lab_info_system_25cf2,#lab_info_system_25cf3,#lab_info_system_25cf4').val('').prop("readonly",false);
            }


    });


    $('#lab_info_system_25ba2,#lab_info_system_25ba3,#lab_info_system_25ba4,#lab_info_system_25ba5,#lab_info_system_25ba6,#lab_info_system_25ba7').change(function(e){

            if( ($('#lab_info_system_25ba2').val()!= null) &&($('#lab_info_system_25ba3').val()!= null) &&($('#lab_info_system_25ba4').val()!= null) && ($('#lab_info_system_25ba5').val()!= null) && ($('#lab_info_system_25ba6').val()!= null) && ($('#lab_info_system_25ba7').val()!= null) )
            {
                if( ($('#lab_info_system_25ba2').val()==$('#lab_info_system_25ba5').val()) && ($('#lab_info_system_25ba3').val()==$('#lab_info_system_25ba6').val()) && ($('#lab_info_system_25ba4').val()==$('#lab_info_system_25ba7').val()) )
                {
                     $('#lab_info_system_25ba8').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25ba8').val('0').prop("readonly",true); 

                }
            }

    });


    $('#lab_info_system_25bb2,#lab_info_system_25bb3,#lab_info_system_25bb4,#lab_info_system_25bb5,#lab_info_system_25bb6,#lab_info_system_25bb7').change(function(e){

            if( (($('#lab_info_system_25bb2').val()!= null) && ($('#lab_info_system_25bb5').val()!= null)) && (($('#lab_info_system_25bb3').val()!= null) && ($('#lab_info_system_25bb6').val()!= null)) && (($('#lab_info_system_25bb4').val()!= null) && ($('#lab_info_system_25bb7').val()!= null)) )
            {
                if( ($('#lab_info_system_25bb2').val()==$('#lab_info_system_25bb5').val()) && ($('#lab_info_system_25bb3').val()==$('#lab_info_system_25bb6').val()) && ($('#lab_info_system_25bb4').val()==$('#lab_info_system_25bb7').val()) ) 
                {
                     $('#lab_info_system_25bb8').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25bb8').val('0').prop("readonly",true); 

                }
            }

    });


    $('#lab_info_system_25bc2,#lab_info_system_25bc3,#lab_info_system_25bc4,#lab_info_system_25bc5,#lab_info_system_25bc6,#lab_info_system_25bc7').change(function(e){

            if( ($('#lab_info_system_25bc2').val()!= null) && ($('#lab_info_system_25bc3').val()!= null) && ($('#lab_info_system_25bc4').val()!= null)  && ($('#lab_info_system_25bc5').val()!= null) && ($('#lab_info_system_25bc6').val()!= null) && ($('#lab_info_system_25bc7').val()!= null))
            {
                if( ($('#lab_info_system_25bc2').val()==$('#lab_info_system_25bc5').val()) && ($('#lab_info_system_25bc3').val()==$('#lab_info_system_25bc6').val()) && ($('#lab_info_system_25bc4').val()==$('#lab_info_system_25bc7').val()) )
                {
                     $('#lab_info_system_25bc8').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25bc8').val('0').prop("readonly",true); 

                }
            }

    });


    $('#lab_info_system_25bd2,#lab_info_system_25bd3,#lab_info_system_25bd4,#lab_info_system_25bd5,#lab_info_system_25bd6,#lab_info_system_25bd7').change(function(e){

            if( ($('#lab_info_system_25bd2').val()!= null) && ($('#lab_info_system_25bd3').val()!= null) && ($('#lab_info_system_25bd4').val()!= null) && ($('#lab_info_system_25bd5').val()!= null) && ($('#lab_info_system_25bd6').val()!= null) && ($('#lab_info_system_25bd7').val()!= null) )
            {
                if( ($('#lab_info_system_25bd2').val()==$('#lab_info_system_25bd5').val()) && ($('#lab_info_system_25bd3').val()==$('#lab_info_system_25bd6').val()) && ($('#lab_info_system_25bd4').val()==$('#lab_info_system_25bd7').val()) ) 
                {
                     $('#lab_info_system_25bd8').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25bd8').val('0').prop("readonly",true); 

                }
            }

    });


    $('#lab_info_system_25be2,#lab_info_system_25be3,#lab_info_system_25be4,#lab_info_system_25be5,#lab_info_system_25be6,#lab_info_system_25be7').change(function(e){

            if( ($('#lab_info_system_25be2').val()!= null) && ($('#lab_info_system_25be3').val()!= null) && ($('#lab_info_system_25be4').val()!= null) && ($('#lab_info_system_25be5').val()!= null) && ($('#lab_info_system_25be6').val()!= null) && ($('#lab_info_system_25be7').val()!= null) )
            {
                if( ($('#lab_info_system_25be2').val()==$('#lab_info_system_25be5').val())&& ($('#lab_info_system_25be3').val()==$('#lab_info_system_25be6').val()) && ($('#lab_info_system_25be4').val()==$('#lab_info_system_25be7').val()) )
                {
                     $('#lab_info_system_25be8').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25be8').val('0').prop("readonly",true); 

                }
            }

    });


    $('#lab_info_system_25bf2,#lab_info_system_25bf3,#lab_info_system_25bf4,#lab_info_system_25bf5,#lab_info_system_25bf6,#lab_info_system_25bf7').change(function(e){

            if( ($('#lab_info_system_25bf2').val()!= null) &&  ($('#lab_info_system_25bf3').val()!= null) &&  ($('#lab_info_system_25bf4').val()!= null) &&  ($('#lab_info_system_25bf5').val()!= null) &&  ($('#lab_info_system_25bf6').val()!= null) && ($('#lab_info_system_25bf7').val()!= null) )
            {
                if( ($('#lab_info_system_25bf2').val()==$('#lab_info_system_25bf5').val()) && ($('#lab_info_system_25bf3').val()==$('#lab_info_system_25bf6').val()) && ($('#lab_info_system_25bf4').val()==$('#lab_info_system_25bf7').val()) )
                {
                     $('#lab_info_system_25bf8').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25bf8').val('0').prop("readonly",true); 

                }
            }

    });


    $('#lab_info_system_25bg2,#lab_info_system_25bg3,#lab_info_system_25bg4,#lab_info_system_25bg5,#lab_info_system_25bg6,#lab_info_system_25bg7').change(function(e){

            if( ($('#lab_info_system_25bg2').val()!= null) &&  ($('#lab_info_system_25bg3').val()!= null) &&  ($('#lab_info_system_25bg4').val()!= null) &&  ($('#lab_info_system_25bg5').val()!= null) &&  ($('#lab_info_system_25bg6').val()!= null) && ($('#lab_info_system_25bg7').val()!= null) )
            {
                if( ($('#lab_info_system_25bg2').val()==$('#lab_info_system_25bg5').val()) &&  ($('#lab_info_system_25bg3').val()==$('#lab_info_system_25bg6').val()) && ($('#lab_info_system_25bg4').val()==$('#lab_info_system_25bg7').val()) )
                {
                     $('#lab_info_system_25bg8').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25bg8').val('0').prop("readonly",true); 

                }
            }

    });



    $('#lab_info_system_25ca2,#lab_info_system_25ca3').change(function(e){

            if( ($('#lab_info_system_25ca2').val()!= null) && ($('#lab_info_system_25ca3').val()!= null) )
            {
                if($('#lab_info_system_25ca2').val()==$('#lab_info_system_25ca3').val())
                {
                     $('#lab_info_system_25ca4').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25ca4').val('0').prop("readonly",true); 

                }
            }

            indicator25_score();   

    });


    $('#lab_info_system_25cb2,#lab_info_system_25cb3').change(function(e){

            if( ($('#lab_info_system_25cb2').val()!= null) && ($('#lab_info_system_25cb3').val()!= null) )
            {
                if($('#lab_info_system_25cb2').val()==$('#lab_info_system_25cb3').val())
                {
                     $('#lab_info_system_25cb4').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25cb4').val('0').prop("readonly",true); 

                }
            }

            indicator25_score();   

    });


    $('#lab_info_system_25cc2,#lab_info_system_25cc3').change(function(e){

            if( ($('#lab_info_system_25cc2').val()!= null) && ($('#lab_info_system_25cc3').val()!= null) )
            {
                if($('#lab_info_system_25cc2').val()==$('#lab_info_system_25cc3').val())
                {
                     $('#lab_info_system_25cc4').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25cc4').val('0').prop("readonly",true); 

                }
            }

            indicator25_score();   
    });


    $('#lab_info_system_25cd2,#lab_info_system_25cd3').change(function(e){

            if( ($('#lab_info_system_25cd2').val()!= null) && ($('#lab_info_system_25cd3').val()!= null) )
            {
                if($('#lab_info_system_25cd2').val()==$('#lab_info_system_25cd3').val())
                {
                     $('#lab_info_system_25cd4').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25cd4').val('0').prop("readonly",true); 

                }
            }

            indicator25_score();   
    });


    $('#lab_info_system_25ce2,#lab_info_system_25ce3').change(function(e){

            if( ($('#lab_info_system_25ce2').val()!= null) && ($('#lab_info_system_25ce3').val()!= null) )
            {
                if($('#lab_info_system_25ce2').val()==$('#lab_info_system_25ce3').val())
                {
                     $('#lab_info_system_25ce4').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25ce4').val('0').prop("readonly",true); 

                }
            }

            indicator25_score();   
    });


    $('#lab_info_system_25cf2,#lab_info_system_25cf3').change(function(e){

            if( ($('#lab_info_system_25cf2').val()!= null) && ($('#lab_info_system_25cf3').val()!= null) )
            {
                if($('#lab_info_system_25cf2').val()==$('#lab_info_system_25cf3').val())
                {
                     $('#lab_info_system_25cf4').val('1').prop("readonly",true);   
                }
                else
                {
                     $('#lab_info_system_25cf4').val('0').prop("readonly",true); 

                }
            }

            indicator25_score();   
    });


   $('#storage_management_10a,#storage_management_10b,#storage_management_10c,#storage_management_10d,#storage_management_11a,#storage_management_11b,#storage_management_11c,#storage_management_11d,#storage_management_11e,#storage_management_12a1,#storage_management_12b1,#storage_management_12c1,#storage_management_12d1,#storage_management_12e1,#storage_management_12a2,#storage_management_12b2,#storage_management_12c2,#storage_management_12d2,#storage_management_12e2,#storage_management_13a1,#storage_management_13b1,#storage_management_13c1,#storage_management_13d1,#storage_management_13e1,#storage_management_13f1,#storage_management_13g1,#storage_management_13h1,#storage_management_13i1,#storage_management_13j1,#storage_management_13k1,#storage_management_13l1,#storage_management_13a2,#storage_management_13b2,#storage_management_13c2,#storage_management_13d2,#storage_management_13e2,#storage_management_13f2,#storage_management_13g2,#storage_management_13h2,#storage_management_13i2,#storage_management_13j2,#storage_management_13k2,#storage_management_13l2,#storage_management_14a1,#storage_management_14b1,#storage_management_14c1,#storage_management_14d1,#storage_management_14e1,#storage_management_14f1,#storage_management_14g1,#storage_management_14h1,#storage_management_14a2,#storage_management_14b2,#storage_management_14c2,#storage_management_14d2,#storage_management_14e2,#storage_management_14f2,#storage_management_14g2,#storage_management_14h2,#lab_equipment_20a1,#lab_equipment_20b1,#lab_equipment_20c1,#lab_equipment_20d1,#lab_equipment_20e1,#lab_equipment_20f1,#lab_info_system_22a,#lab_info_system_22b,#lab_info_system_22c,#lab_info_system_22d,#lab_info_system_22e,#lab_info_system_22f,#lab_info_system_22g,#lab_info_system_22h,#lab_info_system_22i,#lab_info_system_22j,#lab_info_system_22k,#lab_info_system_22l,#lab_info_system_22m,#lab_info_system_22n,#ordering_17a').keyup(function(e){
        
        var pattern_number = new RegExp('^[0-1]|(N)$');
        var pattern_na = new RegExp('^(NA)$');

        var value = $(this).val();


        if( value.length == 1 && !(pattern_number.test( value )) )
        {
            $(this).val(value.replace(value, ''));
        }
        else if( value.length == 2 && !(pattern_na.test( value )) )
        {
            $(this).val(value.replace(value, ''));
        }

   });

   $('#storage_management_10a,#storage_management_10b,#storage_management_10c,#storage_management_10d').change(function(e){
        
        indicator10_score();
   });

   $('#storage_management_11a,#storage_management_11b,#storage_management_11c,#storage_management_11d,#storage_management_11e').change(function(e){
        
        indicator11_score();
   });

   $('#storage_management_12a1,#storage_management_12b1,#storage_management_12c1,#storage_management_12d1,#storage_management_12e1,#storage_management_12a2,#storage_management_12b2,#storage_management_12c2,#storage_management_12d2,#storage_management_12e2').change(function(e){
        
        indicator12_score();
   });

   $('#storage_management_13a1,#storage_management_13b1,#storage_management_13c1,#storage_management_13d1,#storage_management_13e1,#storage_management_13f1,#storage_management_13g1,#storage_management_13h1,#storage_management_13i1,#storage_management_13j1,#storage_management_13k1,#storage_management_13l1,#storage_management_13a2,#storage_management_13b2,#storage_management_13c2,#storage_management_13d2,#storage_management_13e2,#storage_management_13f2,#storage_management_13g2,#storage_management_13h2,#storage_management_13i2,#storage_management_13j2,#storage_management_13k2,#storage_management_13l2').change(function(e){
        indicator13_score();
   });

   $('#storage_management_14a1,#storage_management_14b1,#storage_management_14c1,#storage_management_14d1,#storage_management_14e1,#storage_management_14f1,#storage_management_14g1,#storage_management_14h1,#storage_management_14a2,#storage_management_14b2,#storage_management_14c2,#storage_management_14d2,#storage_management_14e2,#storage_management_14f2,#storage_management_14g2,#storage_management_14h2').change(function(e){
        indicator14_score();
   });

   $('#ordering_15a,#ordering_15b,#ordering_15c').change(function(e){
        
        indicator15_score();
   });

   $('#ordering_16c,#ordering_16f').change(function(e){
        
        indicator16_score();
   });

   $('#ordering_17a').change(function(e){
        
        indicator17_score();   
   });

   $('#lab_equipment_18a,#lab_equipment_18b,#lab_equipment_18c,#lab_equipment_18d').change(function(e){
        
        indicator18_score();
   });

   $('#lab_equipment_19a,#lab_equipment_19b,#lab_equipment_19c,#lab_equipment_19d').change(function(e){
        
        indicator19_score();
   });

   $('#lab_equipment_20a1,#lab_equipment_20b1,#lab_equipment_20c1,#lab_equipment_20d1,#lab_equipment_20e1,#lab_equipment_20f1').change(function(e){
        
        indicator20_score();
   });

   $('#cd4_facs_calibre_21a3,#cd4_facs_calibre_21a7').change(function(e){
        
        indicator21_a1();
        indicator21_score();        
   });

   $('#cd4_facs_count_21b3,#cd4_facs_count_21b7').change(function(e){
        
        indicator21_a2();
        indicator21_score();        
   });

   $('#cd4_partec_count_21c3,#cd4_partec_count_21c7').change(function(e){
        
        indicator21_a3();
        indicator21_score();        
   });

    $('#cd4_pima_21d3,#cd4_pima_21d7').change(function(e){
        
        indicator21_a4();
        indicator21_score();        
   });

   $('#cd4_facs_presto_21e3,#cd4_facs_presto_21e7').change(function(e){
        indicator21_a5();
        indicator21_score();        
   });

    $('#chemistry_c311_21a2,#chemistry_c311_21a3,#chemistry_c311_21a7').change(function(e){
        
        indicator21_b1();
        indicator21_score();      
   });
    
    $('#chemistry_c111_21b2,#chemistry_c111_21b3,#chemistry_c111_21b7').change(function(e){
        
        indicator21_b2();
        indicator21_score();      
   });



    $('#haematology_huma600_21a2,#haematology_huma600_21a3,#haematology_huma600_21a7').change(function(e){
        
        indicator21_c1();
        indicator21_score();      
   });

    $('#haematology_huma30TS_21b2,#haematology_huma30TS_21b3,#haematology_huma30TS_21b7').change(function(e){
        
        indicator21_c2();
        indicator21_score();      
   });

    $('#haematology_huma60TS_21c2,#haematology_huma60TS_21c3,#haematology_huma60TS_21c7').change(function(e){
        
        indicator21_c3();
        indicator21_score();      
   });

    $('#haematology_huma5L_21d2,#haematology_huma5L_21d3,#haematology_huma5L_21d7').change(function(e){
        
        indicator21_c4();
        indicator21_score();      
   });

    $('#haematology_mind3200_21e2,#haematology_mind3200_21e3,#haematology_mind3200_21e7').change(function(e){
        
        indicator21_c5();
        indicator21_score();      
   });

    $('#haematology_mind3000_21f2,#haematology_mind3000_21f3,#haematology_mind3000_21f7').change(function(e){
        
        indicator21_c6();
        indicator21_score();      
   });

    $('#haematology_sysmex100_21g2,#haematology_sysmex100_21g3,#haematology_sysmex100_21g7').change(function(e){
        
        indicator21_c7();        
        indicator21_score();      
   });

    $('#haematology_sysmex300_21h2,#haematology_sysmex300_21h3,#haematology_sysmex300_21h7').change(function(e){
        
        indicator21_c8();
        indicator21_score();      
   });


    $('#haematology_mind2300_21i2,#haematology_mind2300_21i3,#haematology_mind2300_21i7').change(function(e){
        
        indicator21_c9();
        indicator21_score();      
   });



    $('#haematology_mind2800_21j2,#haematology_mind2800_21j3,#haematology_mind2800_21j7').change(function(e){
        
        indicator21_c10();
        indicator21_score();      
   });


    $('#haematology_medonic_21k2,#haematology_medonic_21k3,#haematology_medonic_21k7').change(function(e){
        
        indicator21_c11();
        indicator21_score();      
   });

   $('#lab_info_system_22a,#lab_info_system_22b,#lab_info_system_22c,#lab_info_system_22d,#lab_info_system_22e,#lab_info_system_22f,#lab_info_system_22g,#lab_info_system_22h,#lab_info_system_22i,#lab_info_system_22j,#lab_info_system_22k,#lab_info_system_22l,#lab_info_system_22m,#lab_info_system_22n').change(function(e){
        indicator22_score();
   });


   $('#lab_info_system_23a,#lab_info_system_23b').change(function(e){
        
        indicator23_score();   
   });

   $('#lab_info_system_24c').change(function(e){
        
        indicator24_score();   
   });

   $('#lab_info_system_25a,#lab_info_system_25b,#lab_info_system_25c,#lab_info_system_25ba1,#lab_info_system_25bb1,#lab_info_system_25bc1,#lab_info_system_25bd1,#lab_info_system_25be1,#lab_info_system_25bf1').change(function(e){
        
        indicator25_score();   

   });

   $('#lab_info_system_27a,#lab_info_system_27b,#lab_info_system_27c,#lab_info_system_27d').change(function(e){
        
        indicator27_score();
   });

   $('#lab_info_system_26a,#lab_info_system_26b').change(function(e){
        
        indicator26_score();
   });

   function indicator10_score()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        var na = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#storage_management_10a').val()) )
        {
            if($('#storage_management_10a').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                a=$('#storage_management_10a').val();
            }
        }

        if( pattern.test($('#storage_management_10b').val()) )
        {
            if($('#storage_management_10b').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                b=$('#storage_management_10b').val();
            }
        }   

        if( pattern.test($('#storage_management_10c').val()) )
        {
            if($('#storage_management_10c').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                c=$('#storage_management_10c').val();
            }
        }

        if( pattern.test($('#storage_management_10d').val()) )
        {
            if($('#storage_management_10d').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                d=$('#storage_management_10d').val();
            }
        }

        //ensure that denominator is not zero
        if(na!=4)
        {
            score = (parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d))/(4-na);
        }           

        $('#score_10').text( (score).toFixed(2) );     
        $('#percentage_10').text( (score *100).toFixed(1) +' %');
        $('#storage_management_10_score').val( (score).toFixed(2) );     

    }

   function indicator11_score()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        var e = 0;
        var na = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#storage_management_11a').val()) )
        {
            if($('#storage_management_11a').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                a=$('#storage_management_11a').val();
            }
        }

        if( pattern.test($('#storage_management_11b').val()) )
        {
            if($('#storage_management_11b').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                b=$('#storage_management_11b').val();
            }
        }   

        if( pattern.test($('#storage_management_11c').val()) )
        {
            if($('#storage_management_11c').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                c=$('#storage_management_11c').val();
            }
        }

        if( pattern.test($('#storage_management_11d').val()) )
        {
            if($('#storage_management_11d').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                d=$('#storage_management_11d').val();
            }
        }

        if( pattern.test($('#storage_management_11e').val()) )
        {
            if($('#storage_management_11e').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                e=$('#storage_management_11e').val();
            }
        }
        //ensure that denominator is not zero
        if(na!=5)
        {
            score = (parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d)+parseInt(e))/(5-na);
        }           

        $('#score_11').text( (score).toFixed(2) );        
        $('#percentage_11').text( (score *100).toFixed(1)+' %');
        $('#storage_management_11_score').val( (score).toFixed(2) );     

    }

   function indicator12_score()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        var e = 0;
        var f = 0;
        var g = 0;
        var h = 0;
        var i = 0;
        var j = 0;
        var na1 = 0;
        var na2 = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#storage_management_12a1').val()) )
        {
            if($('#storage_management_12a1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                a=$('#storage_management_12a1').val();
            }
        }

        if( pattern.test($('#storage_management_12b1').val()) )
        {
            if($('#storage_management_12b1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                b=$('#storage_management_12b1').val();
            }
        }   

        if( pattern.test($('#storage_management_12c1').val()) )
        {
            if($('#storage_management_12c1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                c=$('#storage_management_12c1').val();
            }
        }

        if( pattern.test($('#storage_management_12d1').val()) )
        {
            if($('#storage_management_12d1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                d=$('#storage_management_12d1').val();
            }
        }

        if( pattern.test($('#storage_management_12e1').val()) )
        {
            if($('#storage_management_12e1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                e=$('#storage_management_12e1').val();
            }
        }


        if( pattern.test($('#storage_management_12a2').val()) )
        {
            if($('#storage_management_12a2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                f=$('#storage_management_12a2').val();
            }
        }

        if( pattern.test($('#storage_management_12b2').val()) )
        {
            if($('#storage_management_12b2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                g=$('#storage_management_12b2').val();
            }
        }   

        if( pattern.test($('#storage_management_12c2').val()) )
        {
            if($('#storage_management_12c2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                h=$('#storage_management_12c2').val();
            }
        }

        if( pattern.test($('#storage_management_12d2').val()) )
        {
            if($('#storage_management_12d2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                i=$('#storage_management_12d2').val();
            }
        }

        if( pattern.test($('#storage_management_12e2').val()) )
        {
            if($('#storage_management_12e2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                j=$('#storage_management_12e2').val();
            }
        }

        var score1=0;
        var score2=0;
        var score =0;


        //ensure that denominator is not zero
        if(na1!=5)
        {
            score1 = (parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d)+parseInt(e))/(5-na1);
        }           

        if(na2!=5)
        {
            score2 = (parseInt(f)+parseInt(g)+parseInt(h)+parseInt(i)+parseInt(j))/(5-na2);
        }  

        if(na1!=5 && na2!=5)
        {
             score = (score1+score2)/2;
        }
        else if(na1==5 && na2!=5)
        {
             score = score2;
        }
        else if(na1!=5 && na2==5)
        {
             score = score1;
        }             
        else if(na1==5 && na2==5)
        {

            $('#score_12').text( 'NA' );        
            $('#percentage_12').text('NA');
            $('#storage_management_12_score').val( -1 ); 
            return;
        }   

        $('#score_12').text( (score).toFixed(2) );        
        $('#percentage_12').text( (score *100).toFixed(1) +' %');
        $('#storage_management_12_score').val( (score).toFixed(2) );     
    }

   function indicator13_score()
   {
        var a1 = 0;
        var b1 = 0;
        var c1 = 0;
        var d1 = 0;
        var e1 = 0;
        var f1 = 0;
        var g1 = 0;
        var h1 = 0;
        var i1 = 0;
        var j1 = 0;
        var k1 = 0;
        var l1 = 0;

        var a2 = 0;
        var b2 = 0;
        var c2 = 0;
        var d2 = 0;
        var e2 = 0;
        var f2 = 0;
        var g2 = 0;
        var h2 = 0;
        var i2 = 0;
        var j2 = 0;
        var k2 = 0;
        var l2 = 0;


        var score1 = 0; 
        var score2 = 0; 

        var score = 0;        
        var na1 = 0;        
        var na2 = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#storage_management_13a1').val()) )
        {
            if($('#storage_management_13a1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                a1=$('#storage_management_13a1').val();
            }
        }

        if( pattern.test($('#storage_management_13b1').val()) )
        {
            if($('#storage_management_13b1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                b1=$('#storage_management_13b1').val();
            }
        }   

        if( pattern.test($('#storage_management_13c1').val()) )
        {
            if($('#storage_management_13c1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                c1=$('#storage_management_13c1').val();
            }
        }

        if( pattern.test($('#storage_management_13d1').val()) )
        {
            if($('#storage_management_13d1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                d1=$('#storage_management_13d1').val();
            }
        }

        if( pattern.test($('#storage_management_13e1').val()) )
        {
            if($('#storage_management_13e1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                e1=$('#storage_management_13e1').val();
            }
        }


        if( pattern.test($('#storage_management_13f1').val()) )
        {
            if($('#storage_management_13f1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                f1=$('#storage_management_13f1').val();
            }
        }


        if( pattern.test($('#storage_management_13g1').val()) )
        {
            if($('#storage_management_13g1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                g1=$('#storage_management_13g1').val();
            }
        }

        if( pattern.test($('#storage_management_13h1').val()) )
        {
            if($('#storage_management_13h1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                h1=$('#storage_management_13h1').val();
            }
        }   

        if( pattern.test($('#storage_management_13i1').val()) )
        {
            if($('#storage_management_13i1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                i1=$('#storage_management_13i1').val();
            }
        }

        if( pattern.test($('#storage_management_13j1').val()) )
        {
            if($('#storage_management_13j1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                j1=$('#storage_management_13j1').val();
            }
        }

        if( pattern.test($('#storage_management_13k1').val()) )
        {
            if($('#storage_management_13k1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                k1=$('#storage_management_13k1').val();
            }
        }


        if( pattern.test($('#storage_management_13l1').val()) )
        {
            if($('#storage_management_13l1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                l1=$('#storage_management_13l1').val();
            }
        }


        if( pattern.test($('#storage_management_13a2').val()) )
        {
            if($('#storage_management_13a2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                a2=$('#storage_management_13a2').val();
            }
        }

        if( pattern.test($('#storage_management_13b2').val()) )
        {
            if($('#storage_management_13b2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                b2=$('#storage_management_13b2').val();
            }
        }   

        if( pattern.test($('#storage_management_13c2').val()) )
        {
            if($('#storage_management_13c2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                c2=$('#storage_management_13c2').val();
            }
        }

        if( pattern.test($('#storage_management_13d2').val()) )
        {
            if($('#storage_management_13d2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                d2=$('#storage_management_13d2').val();
            }
        }

        if( pattern.test($('#storage_management_13e2').val()) )
        {
            if($('#storage_management_13e2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                e2=$('#storage_management_13e2').val();
            }
        }


        if( pattern.test($('#storage_management_13f2').val()) )
        {
            if($('#storage_management_13f2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                f2=$('#storage_management_13f2').val();
            }
        }


        if( pattern.test($('#storage_management_13g2').val()) )
        {
            if($('#storage_management_13g2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                g2=$('#storage_management_13g2').val();
            }
        }

        if( pattern.test($('#storage_management_13h2').val()) )
        {
            if($('#storage_management_13h2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                h2=$('#storage_management_13h2').val();
            }
        }   

        if( pattern.test($('#storage_management_13i2').val()) )
        {
            if($('#storage_management_13i2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                i2=$('#storage_management_13i2').val();
            }
        }

        if( pattern.test($('#storage_management_13j2').val()) )
        {
            if($('#storage_management_13j2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                j2=$('#storage_management_13j2').val();
            }
        }

        if( pattern.test($('#storage_management_13k2').val()) )
        {
            if($('#storage_management_13k2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                k2=$('#storage_management_13k2').val();
            }
        }


        if( pattern.test($('#storage_management_13l2').val()) )
        {
            if($('#storage_management_13l2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                l2=$('#storage_management_13l2').val();
            }
        }
        

        //ensure that denominator is not zero
        if(na1!=12)
        {
            score1 = (parseInt(a1)+parseInt(b1)+parseInt(c1)+parseInt(d1)+parseInt(e1)+parseInt(f1)+parseInt(g1)+parseInt(h1)+parseInt(i1)+parseInt(j1)+parseInt(k1)+parseInt(l1))/(12-na1);
        }           

        if(na2!=12)
        {
            score2 = (parseInt(a2)+parseInt(b2)+parseInt(c2)+parseInt(d2)+parseInt(e2)+parseInt(f2)+parseInt(g2)+parseInt(h2)+parseInt(i2)+parseInt(j2)+parseInt(k2)+parseInt(l2))/(12-na2);
        }  


        if(na1!=12 && na2!=12)
        {
             score = (score1+score2)/2;
        }
        else if(na1==12 && na2!=12)
        {
             score = score2;
        }
        else if(na1!=12 && na2==12)
        {
             score = score1;
        }             
        else if(na1==12 && na2==12)
        {

            $('#score_13').text( 'NA' );        
            $('#percentage_13').text('NA');
            $('#storage_management_13_score').val( -1 ); 
            return;
        }   

        
        $('#score_13').text( (score).toFixed(2) );        
        $('#percentage_13').text( (score *100).toFixed(1) +' %');
        $('#storage_management_13_score').val( (score).toFixed(2) ); 

    }

   function indicator14_score()
   {
        var a1 = 0;
        var b1 = 0;
        var c1 = 0;
        var d1 = 0;
        var e1 = 0;
        var f1 = 0;
        var g1 = 0;
        var h1 = 0;

        var a2 = 0;
        var b2 = 0;
        var c2 = 0;
        var d2 = 0;
        var e2 = 0;
        var f2 = 0;
        var g2 = 0;
        var h2 = 0;
        
        var score1 = 0;     
        var score2 = 0;     
        var score = 0;        
        var na1 = 0;  
        var na2 = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#storage_management_14a1').val()) )
        {
            if($('#storage_management_14a1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                a1=$('#storage_management_14a1').val();
            }
        }

        if( pattern.test($('#storage_management_14b1').val()) )
        {
            if($('#storage_management_14b1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                b1=$('#storage_management_14b1').val();
            }
        }   

        if( pattern.test($('#storage_management_14c1').val()) )
        {
            if($('#storage_management_14c1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                c1=$('#storage_management_14c1').val();
            }
        }

        if( pattern.test($('#storage_management_14d1').val()) )
        {
            if($('#storage_management_14d1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                d1=$('#storage_management_14d1').val();
            }
        }

        if( pattern.test($('#storage_management_14e1').val()) )
        {
            if($('#storage_management_14e1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                e1=$('#storage_management_14e1').val();
            }
        }


        if( pattern.test($('#storage_management_14f1').val()) )
        {
            if($('#storage_management_14f1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                f1=$('#storage_management_14f1').val();
            }
        }


        if( pattern.test($('#storage_management_14g1').val()) )
        {
            if($('#storage_management_14g1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                g1=$('#storage_management_14g1').val();
            }
        }

        if( pattern.test($('#storage_management_14h1').val()) )
        {
            if($('#storage_management_14h1').val()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                h1=$('#storage_management_14h1').val();
            }
        }   


        if( pattern.test($('#storage_management_14a2').val()) )
        {
            if($('#storage_management_14a2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                a2=$('#storage_management_14a2').val();
            }
        }

        if( pattern.test($('#storage_management_14b2').val()) )
        {
            if($('#storage_management_14b2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                b2=$('#storage_management_14b2').val();
            }
        }   

        if( pattern.test($('#storage_management_14c2').val()) )
        {
            if($('#storage_management_14c2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                c2=$('#storage_management_14c2').val();
            }
        }

        if( pattern.test($('#storage_management_14d2').val()) )
        {
            if($('#storage_management_14d2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                d2=$('#storage_management_14d2').val();
            }
        }

        if( pattern.test($('#storage_management_14e2').val()) )
        {
            if($('#storage_management_14e2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                e2=$('#storage_management_14e2').val();
            }
        }


        if( pattern.test($('#storage_management_14f2').val()) )
        {
            if($('#storage_management_14f2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                f2=$('#storage_management_14f2').val();
            }
        }


        if( pattern.test($('#storage_management_14g2').val()) )
        {
            if($('#storage_management_14g2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                g2=$('#storage_management_14g2').val();
            }
        }

        if( pattern.test($('#storage_management_14h2').val()) )
        {
            if($('#storage_management_14h2').val()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                h2=$('#storage_management_14h2').val();
            }
        }   

        //ensure that denominator is not zero
        if(na1!=8)
        {
            score1 = (parseInt(a1)+parseInt(b1)+parseInt(c1)+parseInt(d1)+parseInt(e1)+parseInt(f1)+parseInt(g1)+parseInt(h1))/(8-na1);
        }           

        if(na2!=8)
        {
            score2 = (parseInt(a2)+parseInt(b2)+parseInt(c2)+parseInt(d2)+parseInt(e2)+parseInt(f2)+parseInt(g2)+parseInt(h2))/(8-na2);
        }  


        if(na1!=8 && na2!=8)
        {
             score = (score1+score2)/2;
        }
        else if(na1==8 && na2!=8)
        {
             score = score2;
        }
        else if(na1!=8 && na2==8)
        {
             score = score1;
        }             
        else if(na1==8 && na2==8)
        {

            $('#score_14').text( 'NA' );        
            $('#percentage_14').text('NA');
            $('#storage_management_14_score').val( -1 ); 
            return;
        }   

                
        $('#score_14').text( (score).toFixed(2) );        
        $('#percentage_14').text( (score *100).toFixed(1) +' %');
        $('#storage_management_14_score').val( (score).toFixed(2) ); 

    }

   function indicator15_score()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var nr = 0;

        var pattern = new RegExp('^[0-1]|(NR)$');

        if( pattern.test($('#ordering_15a').val()) )
        {
            if($('#ordering_15a').val()=='NR')
            {
                nr=nr+1;
            }
            else
            {
                a=$('#ordering_15a').val();
            }
        }

        if( pattern.test($('#ordering_15b').val()) )
        {
            if($('#ordering_15b').val()=='NR')
            {
                nr=nr+1;
            }
            else
            {
                b=$('#ordering_15b').val();
            }
        }   

        if( pattern.test($('#ordering_15c').val()) )
        {
            if($('#ordering_15c').val()=='NR')
            {
                nr=nr+1;
            }
            else
            {
                c=$('#ordering_15c').val();
            }
        }

        //ensure that denominator is not zero
        if(nr!=3)
        {
            score = (parseInt(a)+parseInt(b)+parseInt(c))/(3-nr);
        }           

        $('#score_15').text( (score).toFixed(2) );        
        $('#percentage_15').text( (score *100).toFixed(1) +' %');
        $('#ordering_15_score').val( (score).toFixed(2) );          
    }

   function indicator16_score()
   {
        var c = 0;
        var f = 0;
        var nr = 0;
        var score = 0;

        var pattern = new RegExp('^[0-1]|(NR)$');

        if( pattern.test($('#ordering_16c').val()) )
        {
            if($('#ordering_16c').val()=='NR')
            {
                nr=nr+1;
            }
            else
            {
                c=$('#ordering_16c').val();
            }
        } 

        if( pattern.test($('#ordering_16f').val()) )
        {
            if($('#ordering_16f').val()=='NR')
            {
                nr=nr+1;
            }
            else
            {
                f=$('#ordering_16f').val();
            }
        }          

        //ensure that denominator is not zero
        if(nr!=2)
        {
            score = (parseInt(c)+parseInt(f))/(2-nr);
        }

        $('#score_16').text( (score).toFixed(2) );        
        $('#percentage_16').text( (score*100).toFixed(1)+' %');        
        $('#ordering_16_score').val( (score).toFixed(2) );  
    }

   function indicator17_score()
   {
        var a = 0;
        var score = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#ordering_17a').val()) )
        {
            if($('#ordering_17a').val()!='NA')
            {
                score=parseInt($('#ordering_17a').val());
            }
        }     

        $('#score_17').text( (score).toFixed(2) );              
        $('#percentage_17').text( (score*100).toFixed(1) +' %');        
        $('#ordering_17_score').val( (score).toFixed(2) );  
    }

    function indicator18_score()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        var na = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#lab_equipment_18a').val()) )
        {
            if($('#lab_equipment_18a').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                a=$('#lab_equipment_18a').val();
            }
        }

        if( pattern.test($('#lab_equipment_18b').val()) )
        {
            if($('#lab_equipment_18b').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                b=$('#lab_equipment_18b').val();
            }
        }

        if( pattern.test($('#lab_equipment_18c').val()) )
        {
            if($('#lab_equipment_18c').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                c=$('#lab_equipment_18c').val();
            }
        }

        if( pattern.test($('#lab_equipment_18d').val()) )
        {
            if($('#lab_equipment_18d').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                d=$('#lab_equipment_18d').val();
            }
        }

        //ensure that denominator is not zero
        if(na!=4)
        {
            score = (parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d))/(4-na);
        }           

        $('#score_18').text( (score).toFixed(2) );        
        $('#percentage_18').text( (score *100).toFixed(1) +' %');   
        $('#lab_equipment_18_score').val( (score).toFixed(2) );    
    
    }  

    function indicator19_score()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        var na = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#lab_equipment_19a').val()) )
        {
            if($('#lab_equipment_19a').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                a=$('#lab_equipment_19a').val();
            }
        }

        if( pattern.test($('#lab_equipment_19b').val()) )
        {
            if($('#lab_equipment_19b').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                b=$('#lab_equipment_19b').val();
            }
        }

        if( pattern.test($('#lab_equipment_19c').val()) )
        {
            if($('#lab_equipment_19c').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                c=$('#lab_equipment_19c').val();
            }
        }

        if( pattern.test($('#lab_equipment_19d').val()) )
        {
            if($('#lab_equipment_19d').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                d=$('#lab_equipment_19d').val();
            }
        }

        //ensure that denominator is not zero
        if(na!=4)
        {
            score = (parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d))/(4-na);
        }           

        $('#score_19').text( (score).toFixed(2) );        
        $('#percentage_19').text( (score *100).toFixed(1) +' %');   
        $('#lab_equipment_19_score').val( (score).toFixed(2) );    
    
    }  

    function indicator20_score()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        var e = 0;
        var f = 0;
        var na = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#lab_equipment_20a1').val()) )
        {
            if($('#lab_equipment_20a1').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                a=$('#lab_equipment_20a1').val();
            }
        }

        if( pattern.test($('#lab_equipment_20b1').val()) )
        {
            if($('#lab_equipment_20b1').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                b=$('#lab_equipment_20b1').val();
            }
        }

        if( pattern.test($('#lab_equipment_20c1').val()) )
        {
            if($('#lab_equipment_20c1').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                c=$('#lab_equipment_20c1').val();
            }
        }

        if( pattern.test($('#lab_equipment_20d1').val()) )
        {
            if($('#lab_equipment_20d1').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                d=$('#lab_equipment_20d1').val();
            }
        }

        if( pattern.test($('#lab_equipment_20e1').val()) )
        {
            if($('#lab_equipment_20e1').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                e=$('#lab_equipment_20e1').val();
            }
        }

        if( pattern.test($('#lab_equipment_20f1').val()) )
        {
            if($('#lab_equipment_20f1').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                f=$('#lab_equipment_20f1').val();
            }
        }        

        //ensure that denominator is not zero
        if(na!=6)
        {
            score = (parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d)+parseInt(e)+parseInt(f))/(6-na);
        }           

        $('#score_20').text( (score).toFixed(2) );        
        $('#percentage_20').text( (score *100).toFixed(1) +' %');   
        $('#lab_equipment_20_score').val( (score).toFixed(2) );    
    
    }  

    function indicator21_a1()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g=0;                
        var h=0;
        var na = 0;


            if( !isNaN( parseInt($('#cd4_facs_calibre_21a1').text())) && parseInt($('#cd4_facs_calibre_21a2').val()) )  
            {
                var e=parseInt($('#cd4_facs_calibre_21a1').text()) * parseInt($('#cd4_facs_calibre_21a2').val());
                var f=parseInt($('#cd4_facs_calibre_21a3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#cd4_facs_calibre_21a4').text(e);
                $('#cd4_facs_calibre_21a5').text(f.toFixed(2) );
                $('#cd4_facs_calibre_21a6').text(g);

            }


            if( parseInt($('#cd4_facs_calibre_21a2').val())==0 )
            {

                var e=parseInt($('#cd4_facs_calibre_21a1').text()) * parseInt($('#cd4_facs_calibre_21a2').val());
                var f= 0 ;
                

                if(f>70)
                {
                    g=1;
                }
                $('#cd4_facs_calibre_21a4').text(e);
                $('#cd4_facs_calibre_21a5').text(f.toFixed(2) );
                $('#cd4_facs_calibre_21a6').text(g);

            }

            if( !isNaN( parseInt($('#cd4_facs_calibre_21a7').val()))  )  
            {
                var e=parseInt($('#cd4_facs_calibre_21a7').val()) ;

                if(parseInt($('#cd4_facs_calibre_21a1').text())==parseInt($('#cd4_facs_calibre_21a7').val()) )
                {
                    h=1;
                }

                $('#cd4_facs_calibre_21a8').text(h);

            }
    }  

    function indicator21_a2()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g=0;                
        var h=0;
        var na = 0;


            if( !isNaN( parseInt($('#cd4_facs_count_21b1').text())) && parseInt($('#cd4_facs_count_21b2').val()) )  
            {
                var e=parseInt($('#cd4_facs_count_21b1').text()) * parseInt($('#cd4_facs_count_21b2').val());
                var f=parseInt($('#cd4_facs_count_21b3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#cd4_facs_count_21b4').text(e);
                $('#cd4_facs_count_21b5').text(f.toFixed(2) );
                $('#cd4_facs_count_21b6').text(g);

            }


            if( parseInt($('#cd4_facs_count_21b2').val())==0 )
            {

                var e=parseInt($('#cd4_facs_count_21b1').text()) * parseInt($('#cd4_facs_count_21b2').val());
                var f= 0 ;
                

                if(f>70)
                {
                    g=1;
                }
                $('#cd4_facs_count_21b4').text(e);
                $('#cd4_facs_count_21b5').text(f.toFixed(2) );
                $('#cd4_facs_count_21b6').text(g);

            }


            if( !isNaN( parseInt($('#cd4_facs_count_21b7').val()))  )  
            {
                var e=parseInt($('#cd4_facs_count_21b7').val()) ;

                if(parseInt($('#cd4_facs_count_21b1').text())==parseInt($('#cd4_facs_count_21b7').val()) )
                {
                    h=1;
                }

                $('#cd4_facs_count_21b8').text(h);

            }
    }  

    function indicator21_a3()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g=0;                
        var h=0;
        var na = 0;


            if( !isNaN( parseInt($('#cd4_partec_count_21c1').text())) && parseInt($('#cd4_partec_count_21c2').val()) )  
            {
                var e=parseInt($('#cd4_partec_count_21c1').text()) * parseInt($('#cd4_partec_count_21c2').val());
                var f=parseInt($('#cd4_partec_count_21c3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#cd4_partec_count_21c4').text(e);
                $('#cd4_partec_count_21c5').text(f.toFixed(2) );
                $('#cd4_partec_count_21c6').text(g);

            }


            if( parseInt($('#cd4_partec_count_21c2').val())==0 )
            {

                var e=parseInt($('#cd4_partec_count_21c1').text()) * parseInt($('#cd4_partec_count_21c2').val());
                var f= 0 ;
                

                if(f>70)
                {
                    g=1;
                }
                $('#cd4_partec_count_21c4').text(e);
                $('#cd4_partec_count_21c5').text(f.toFixed(2) );
                $('#cd4_partec_count_21c6').text(g);

            }


            if( !isNaN( parseInt($('#cd4_partec_count_21c7').val()))  )  
            {
                var e=parseInt($('#cd4_partec_count_21c7').val()) ;

                if(parseInt($('#cd4_partec_count_21c1').text())==parseInt($('#cd4_partec_count_21c7').val()) )
                {
                    h=1;
                }

                $('#cd4_partec_count_21c8').text(h);

            }
    }

    function indicator21_a4()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g=0;                
        var h=0;
        var na = 0;


            if( !isNaN( parseInt($('#cd4_pima_21d1').text())) && parseInt($('#cd4_pima_21d2').val()) )  
            {
                var e=parseInt($('#cd4_pima_21d1').text()) * parseInt($('#cd4_pima_21d2').val());
                var f=parseInt($('#cd4_pima_21d3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#cd4_pima_21d4').text(e);
                $('#cd4_pima_21d5').text(f.toFixed(2) );
                $('#cd4_pima_21d6').text(g);

            }



            if( parseInt($('#cd4_pima_21d2').val())==0 )
            {

                var e=parseInt($('#cd4_pima_21d1').text()) * parseInt($('#cd4_pima_21d2').val());
                var f= 0 ;
                

                if(f>70)
                {
                    g=1;
                }
                $('#cd4_pima_21d4').text(e);
                $('#cd4_pima_21d5').text(f.toFixed(2) );
                $('#cd4_pima_21d6').text(g);

            }

            if( !isNaN( parseInt($('#cd4_pima_21d7').val()))  )  
            {
                var e=parseInt($('#cd4_pima_21d7').val()) ;

                if(parseInt($('#cd4_pima_21d1').text())==parseInt($('#cd4_pima_21d7').val()) )
                {
                    h=1;
                }

                $('#cd4_pima_21d8').text(h);

            }
    }

function indicator21_a5()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g=0;                
        var h=0;
        var na = 0;

              
            if( !isNaN( parseInt($('#cd4_facs_presto_21e1').text())) && parseInt($('#cd4_facs_presto_21e2').val()) )  
            {
                var e=parseInt($('#cd4_facs_presto_21e1').text()) * parseInt($('#cd4_facs_presto_21e2').val());
                var f= parseInt($('#cd4_facs_presto_21e3').val()) / e *100 ;
                

                if(f>70)
                {
                    g=1;
                }
                $('#cd4_facs_presto_21e4').text(e);
                $('#cd4_facs_presto_21e5').text(f.toFixed(2) );
                $('#cd4_facs_presto_21e6').text(g);

            }


            if( parseInt($('#cd4_facs_presto_21e2').val())==0 )
            {

                var e=parseInt($('#cd4_facs_presto_21e1').text()) * parseInt($('#cd4_facs_presto_21e2').val());
                var f= 0 ;
                

                if(f>70)
                {
                    g=1;
                }
                $('#cd4_facs_presto_21e4').text(e);
                $('#cd4_facs_presto_21e5').text(f.toFixed(2) );
                $('#cd4_facs_presto_21e6').text(g);

            }


            if( !isNaN( parseInt($('#cd4_facs_presto_21e7').val()))  )  
            {
                var e=parseInt($('#cd4_facs_presto_21e7').val()) ;

                if(parseInt($('#cd4_facs_presto_21e1').text())==parseInt($('#cd4_facs_presto_21e7').val()) )
                {
                    h=1;
                }

                $('#cd4_facs_presto_21e8').text(h);

            }
    }  

    function indicator21_b1()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g=0;                
        var h=0;
        var na = 0;


            if( !isNaN( parseInt($('#chemistry_c311_21a1').text())) && parseInt($('#chemistry_c311_21a2').val()) )  
            {
                var e=parseInt($('#chemistry_c311_21a1').text()) * parseInt($('#chemistry_c311_21a2').val());
                var f=parseInt($('#chemistry_c311_21a3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#chemistry_c311_21a4').text(e);
                $('#chemistry_c311_21a5').text(f.toFixed(2) );
                $('#chemistry_c311_21a6').text(g);

            }


            if( parseInt($('#chemistry_c311_21a2').val())==0 )
            {

                var e=parseInt($('#chemistry_c311_21a1').text()) * parseInt($('#chemistry_c311_21a2').val());
                var f= 0 ;
                

                if(f>70)
                {
                    g=1;
                }
                $('#chemistry_c311_21a4').text(e);
                $('#chemistry_c311_21a5').text(f.toFixed(2) );
                $('#chemistry_c311_21a6').text(g);

            }

            if( !isNaN( parseInt($('#chemistry_c311_21a7').val()))  )  
            {
                var e=parseInt($('#chemistry_c311_21a7').val()) ;

                if(parseInt($('#chemistry_c311_21a1').text())==parseInt($('#chemistry_c311_21a7').val()) )
                {
                    h=1;
                }

                $('#chemistry_c311_21a8').text(h);

            }
    }


    function indicator21_b2()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g=0;                
        var h=0;
        var na = 0;


            if( !isNaN( parseInt($('#chemistry_c111_21b1').text())) && parseInt($('#chemistry_c111_21b2').val()) )  
            {
                var e=parseInt($('#chemistry_c111_21b1').text()) * parseInt($('#chemistry_c111_21b2').val());
                var f=parseInt($('#chemistry_c111_21b3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#chemistry_c111_21b4').text(e);
                $('#chemistry_c111_21b5').text(f.toFixed(2) );
                $('#chemistry_c111_21b6').text(g);

            }


            if( parseInt($('#chemistry_c111_21b2').val())==0 )
            {

                var e=parseInt($('#chemistry_c111_21b1').text()) * parseInt($('#chemistry_c111_21b2').val());
                var f= 0 ;
                

                if(f>70)
                {
                    g=1;
                }
                $('#chemistry_c111_21b4').text(e);
                $('#chemistry_c111_21b5').text(f.toFixed(2) );
                $('#chemistry_c111_21b6').text(g);

            }


            if( !isNaN( parseInt($('#chemistry_c111_21b7').val()))  )  
            {
                var e=parseInt($('#chemistry_c111_21b7').val()) ;

                if(parseInt($('#chemistry_c111_21b1').text())==parseInt($('#chemistry_c111_21b7').val()) )
                {
                    h=1;
                }

                $('#chemistry_c111_21b8').text(h);

            }
    }


    function indicator21_c1()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g = 0;                
        var h = 0;
        var na  = 0;

            if( !isNaN( parseInt($('#haematology_huma600_21a1').text())) && parseInt($('#haematology_huma600_21a2').val()) )  
            {
                var e=parseInt($('#haematology_huma600_21a1').text()) * parseInt($('#haematology_huma600_21a2').val());
                var f=parseInt($('#haematology_huma600_21a3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#haematology_huma600_21a4').text(e);
                $('#haematology_huma600_21a5').text(f.toFixed(2) );
                $('#haematology_huma600_21a6').text(g);

            }


            if( !isNaN( parseInt($('#haematology_huma600_21a7').val()))  )  
            {
                var e=parseInt($('#haematology_huma600_21a7').val()) ;

                if(parseInt($('#haematology_huma600_21a1').text())==parseInt($('#haematology_huma600_21a7').val()) )
                {
                    h=1;
                }

                $('#haematology_huma600_21a8').text(h);

            }
    }

    function indicator21_c2()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g = 0;                
        var h = 0;
        var na  = 0;


            if( !isNaN( parseInt($('#haematology_huma30TS_21b1').text())) && parseInt($('#haematology_huma30TS_21b2').val()) )  
            {
                var e=parseInt($('#haematology_huma30TS_21b1').text()) * parseInt($('#haematology_huma30TS_21b2').val());
                var f=parseInt($('#haematology_huma30TS_21b3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#haematology_huma30TS_21b4').text(e);
                $('#haematology_huma30TS_21b5').text(f.toFixed(2) );
                $('#haematology_huma30TS_21b6').text(g);

            }


            if( !isNaN( parseInt($('#haematology_huma30TS_21b7').val()))  )  
            {
                var e=parseInt($('#haematology_huma30TS_21b7').val()) ;

                if(parseInt($('#haematology_huma30TS_21b1').text())==parseInt($('#haematology_huma30TS_21b7').val()) )
                {
                    h=1;
                }

                $('#haematology_huma30TS_21b8').text(h);

            }
    }

    function indicator21_c3()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g = 0;                
        var h = 0;
        var na  = 0;


            if( !isNaN( parseInt($('#haematology_huma60TS_21c1').text())) && parseInt($('#haematology_huma60TS_21c2').val()) )  
            {
                var e=parseInt($('#haematology_huma60TS_21c1').text()) * parseInt($('#haematology_huma60TS_21c2').val());
                var f=parseInt($('#haematology_huma60TS_21c3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#haematology_huma60TS_21c4').text(e);
                $('#haematology_huma60TS_21c5').text(f.toFixed(2) );
                $('#haematology_huma60TS_21c6').text(g);

            }


            if( !isNaN( parseInt($('#haematology_huma60TS_21c7').val()))  )  
            {
                var e=parseInt($('#haematology_huma60TS_21c7').val()) ;

                if(parseInt($('#haematology_huma60TS_21c1').text())==parseInt($('#haematology_huma60TS_21c7').val()) )
                {
                    h=1;
                }

                $('#haematology_huma60TS_21c8').text(h);

            }
    }

    function indicator21_c4()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g = 0;                
        var h = 0;
        var na  = 0;


            if( !isNaN( parseInt($('#haematology_huma5L_21d1').text())) && parseInt($('#haematology_huma5L_21d2').val()) )  
            {
                var e=parseInt($('#haematology_huma5L_21d1').text()) * parseInt($('#haematology_huma5L_21d2').val());
                var f=parseInt($('#haematology_huma5L_21d3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#haematology_huma5L_21d4').text(e);
                $('#haematology_huma5L_21d5').text(f.toFixed(2) );
                $('#haematology_huma5L_21d6').text(g);

            }


            if( !isNaN( parseInt($('#haematology_huma5L_21d7').val()))  )  
            {
                var e=parseInt($('#haematology_huma5L_21d7').val()) ;

                if(parseInt($('#haematology_huma5L_21d1').text())==parseInt($('#haematology_huma5L_21d7').val()) )
                {
                    h=1;
                }

                $('#haematology_huma5L_21d8').text(h);

            }
    }

    function indicator21_c5()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g = 0;                
        var h = 0;
        var na  = 0;


            if( !isNaN( parseInt($('#haematology_mind3200_21e1').text())) && parseInt($('#haematology_mind3200_21e2').val()) )  
            {
                var e=parseInt($('#haematology_mind3200_21e1').text()) * parseInt($('#haematology_mind3200_21e2').val());
                var f=parseInt($('#haematology_mind3200_21e3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#haematology_mind3200_21e4').text(e);
                $('#haematology_mind3200_21e5').text(f.toFixed(2) );
                $('#haematology_mind3200_21e6').text(g);

            }


            if( !isNaN( parseInt($('#haematology_mind3200_21e7').val()))  )  
            {
                var e=parseInt($('#haematology_mind3200_21e7').val()) ;

                if(parseInt($('#haematology_mind3200_21e1').text())==parseInt($('#haematology_mind3200_21e7').val()) )
                {
                    h=1;
                }

                $('#haematology_mind3200_21e8').text(h);

            }
    }

    function indicator21_c6()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g = 0;                
        var h = 0;
        var na  = 0;


            if( !isNaN( parseInt($('#haematology_mind3000_21f1').text())) && parseInt($('#haematology_mind3000_21f2').val()) )  
            {
                var e=parseInt($('#haematology_mind3000_21f1').text()) * parseInt($('#haematology_mind3000_21f2').val());
                var f=parseInt($('#haematology_mind3000_21f3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#haematology_mind3000_21f4').text(e);
                $('#haematology_mind3000_21f5').text(f.toFixed(2) );
                $('#haematology_mind3000_21f6').text(g);

            }


            if( !isNaN( parseInt($('#haematology_mind3000_21f7').val()))  )  
            {
                var e=parseInt($('#haematology_mind3000_21f7').val()) ;

                if(parseInt($('#haematology_mind3000_21f1').text())==parseInt($('#haematology_mind3000_21f7').val()) )
                {
                    h=1;
                }

                $('#haematology_mind3000_21f8').text(h);

            }
    }

    function indicator21_c7()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var g = 0;                
        var h = 0;
        var na  = 0;


            if( !isNaN( parseInt($('#haematology_sysmex100_21g1').text())) && parseInt($('#haematology_sysmex100_21g2').val()) )  
            {
                var e=parseInt($('#haematology_sysmex100_21g1').text()) * parseInt($('#haematology_sysmex100_21g2').val());
                var f=parseInt($('#haematology_sysmex100_21g3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#haematology_sysmex100_21g4').text(e);
                $('#haematology_sysmex100_21g5').text(f.toFixed(2) );
                $('#haematology_sysmex100_21g6').text(g);

            }


            if( !isNaN( parseInt($('#haematology_sysmex100_21g7').val()))  )  
            {
                var e=parseInt($('#haematology_sysmex100_21g7').val()) ;

                if(parseInt($('#haematology_sysmex100_21g1').text())==parseInt($('#haematology_sysmex100_21g7').val()) )
                {
                    h=1;
                }

                $('#haematology_sysmex100_21g8').text(h);

            }
    }

    function indicator21_c8()
    {
        var a = 0;
        var b = 0;
        var c = 0;
        var g = 0;                
        var h = 0;
        var na  = 0;


            if( !isNaN( parseInt($('#haematology_sysmex300_21h1').text())) && parseInt($('#haematology_sysmex300_21h2').val()) )  
            {
                var e=parseInt($('#haematology_sysmex300_21h1').text()) * parseInt($('#haematology_sysmex300_21h2').val());
                var f=parseInt($('#haematology_sysmex300_21h3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#haematology_sysmex300_21h4').text(e);
                $('#haematology_sysmex300_21h5').text(f.toFixed(2) );
                $('#haematology_sysmex300_21h6').text(g);

            }


            if( !isNaN( parseInt($('#haematology_sysmex300_21h7').val()))  )  
            {
                var e=parseInt($('#haematology_sysmex300_21h7').val()) ;

                if(parseInt($('#haematology_sysmex300_21h1').text())==parseInt($('#haematology_sysmex300_21h7').val()) )
                {
                    h=1;
                }

                $('#haematology_sysmex300_21h8').text(h);

            }
    }


    function indicator21_c9()
    {
        var a = 0;
        var b = 0;
        var c = 0;
        var g = 0;                
        var h = 0;
        var na  = 0;


            if( !isNaN( parseInt($('#haematology_mind2300_21i1').text())) && parseInt($('#haematology_mind2300_21i2').val()) )  
            {
                var e=parseInt($('#haematology_mind2300_21i1').text()) * parseInt($('#haematology_mind2300_21i2').val());
                var f=parseInt($('#haematology_mind2300_21i3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#haematology_mind2300_21i4').text(e);
                $('#haematology_mind2300_21i5').text(f.toFixed(2) );
                $('#haematology_mind2300_21i6').text(g);

            }


            if( !isNaN( parseInt($('#haematology_mind2300_21i7').val()))  )  
            {
                var e=parseInt($('#haematology_mind2300_21i7').val()) ;

                if(parseInt($('#haematology_mind2300_21i1').text())==parseInt($('#haematology_mind2300_21i7').val()) )
                {
                    h=1;
                }

                $('#haematology_mind2300_21i8').text(h);

            }
    }


    function indicator21_c10()
    {
        var a = 0;
        var b = 0;
        var c = 0;
        var g = 0;                
        var h = 0;
        var na  = 0;


            if( !isNaN( parseInt($('#haematology_mind2800_21j1').text())) && parseInt($('#haematology_mind2800_21j2').val()) )  
            {
                var e=parseInt($('#haematology_mind2800_21j1').text()) * parseInt($('#haematology_mind2800_21j2').val());
                var f=parseInt($('#haematology_mind2800_21j3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#haematology_mind2800_21j4').text(e);
                $('#haematology_mind2800_21j5').text(f.toFixed(2) );
                $('#haematology_mind2800_21j6').text(g);

            }


            if( !isNaN( parseInt($('#haematology_mind2800_21j7').val()))  )  
            {
                var e=parseInt($('#haematology_mind2800_21j7').val()) ;

                if(parseInt($('#haematology_mind2800_21j1').text())==parseInt($('#haematology_mind2800_21j7').val()) )
                {
                    h=1;
                }

                $('#haematology_mind2800_21j8').text(h);

            }
    }


    function indicator21_c11()
    {
        var a = 0;
        var b = 0;
        var c = 0;
        var g = 0;                
        var h = 0;
        var na  = 0;


            if( !isNaN( parseInt($('#haematology_medonic_21k1').text())) && parseInt($('#haematology_medonic_21k2').val()) )  
            {
                var e=parseInt($('#haematology_medonic_21k1').text()) * parseInt($('#haematology_medonic_21k2').val());
                var f=parseInt($('#haematology_medonic_21k3').val()) / e *100 ;

                if(f>70)
                {
                    g=1;
                }
                $('#haematology_medonic_21k4').text(e);
                $('#haematology_medonic_21k5').text(f.toFixed(2) );
                $('#haematology_medonic_21k6').text(g);

            }


            if( !isNaN( parseInt($('#haematology_medonic_21k7').val()))  )  
            {
                var e=parseInt($('#haematology_medonic_21k7').val()) ;

                if(parseInt($('#haematology_medonic_21k1').text())==parseInt($('#haematology_medonic_21k7').val()) )
                {
                    h=1;
                }

                $('#haematology_medonic_21k8').text(h);

            }
    }



   function indicator21a_score()
   {

        var a1 = 0;
        var a2 = 0;
        var b1 = 0;
        var b2 = 0;  
        var c1 = 0;
        var c2 = 0;
        var d1 = 0;
        var d2 = 0;  
        var e1 = 0;
        var e2 = 0;
        var na1 = 0;  
        var na2 = 0;
        var na3 = 0;  
        var na4 = 0;
        var na5 = 0;  


        var pattern = new RegExp('^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$');

        if( pattern.test($('#cd4_facs_calibre_21a6').text()) )
        {
            if($('#cd4_facs_calibre_21a6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                a1=$('#cd4_facs_calibre_21a6').text();
            }
        }


        if( pattern.test($('#cd4_facs_calibre_21a8').text()) )
        {
            if($('#cd4_facs_calibre_21a8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                a2=$('#cd4_facs_calibre_21a8').text();
            }
        }


        if( pattern.test($('#cd4_facs_count_21b6').text()) )
        {
            if($('#cd4_facs_count_21b6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                b1=$('#cd4_facs_count_21b6').text();
            }
        }


        if( pattern.test($('#cd4_facs_count_21b8').text()) )
        {
            if($('#cd4_facs_count_21b8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                b2=$('#cd4_facs_count_21b8').text();
            }
        }

        if( pattern.test($('#cd4_partec_count_21c6').text()) )
        {
            if($('#cd4_partec_count_21c6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                c1=$('#cd4_partec_count_21c6').text();
            }
        }


        if( pattern.test($('#cd4_partec_count_21c8').text()) )
        {
            if($('#cd4_partec_count_21c8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                c2=$('#cd4_partec_count_21c8').text();
            }
        }



        if( pattern.test($('#cd4_pima_21d6').text()) )
        {
            if($('#cd4_pima_21d6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                d1=$('#cd4_pima_21d6').text();
            }
        }


        if( pattern.test($('#cd4_pima_21d8').text()) )
        {
            if($('#cd4_pima_21d8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                d2=$('#cd4_pima_21d8').text();
            }
        }


        if( pattern.test($('#cd4_facs_presto_21e6').text()) )
        {
            if($('#cd4_facs_presto_21e6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                e1=$('#cd4_facs_presto_21e6').text();
            }
        }


        if( pattern.test($('#cd4_facs_presto_21e8').text()) )
        {
            if($('#cd4_facs_presto_21e8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                e2=$('#cd4_facs_presto_21e8').text();
            }
        }
        
        var score1=0;
        var score2=0;
        var score =0;


        //ensure that denominator is not zero
        if(na1!=5)
        {
            score1 = ( parseInt(a1)+parseInt(b1)+parseInt(c1)+parseInt(d1)+parseInt(e1) )/(5-na1);
        }           

        if(na2!=5)
        {
            score2 = ( parseInt(a2)+parseInt(b2)+parseInt(c2)+parseInt(d2)+parseInt(e2) )/(5-na2);
        }  

        if(na1==5 && na2==5)
        {
             score = -1;
        }  
        else
        {
             score = (score1+score2)/2;
        }     

        return score;

    }



   function indicator21b_score()
   {
        var a1 = 0;
        var a2 = 0;
        var b1 = 0;
        var b2 = 0;  
        var na1 = 0;  
        var na2 = 0;


        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#chemistry_c311_21a6').text()) )
        {
            if($('#chemistry_c311_21a6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                a1=$('#chemistry_c311_21a6').text();
            }
        }


        if( pattern.test($('#chemistry_c311_21a8').text()) )
        {
            if($('#chemistry_c311_21a8').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                a2=$('#chemistry_c311_21a8').text();
            }
        }


        if( pattern.test($('#chemistry_c111_21b6').text()) )
        {
            if($('#chemistry_c111_21b6').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                b1=$('#chemistry_c111_21b6').text();
            }
        }


        if( pattern.test($('#chemistry_c111_21b8').text()) )
        {
            if($('#chemistry_c111_21b8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                b2=$('#chemistry_c111_21b8').text();
            }
        }


        var score1=0;
        var score2=0;
        var score =0;


        //ensure that denominator is not zero
        if(na1!=2)
        {
            score1 = (parseInt(a1)+parseInt(b1))/(2-na1);
        }           

        if(na2!=2)
        {
            score2 = (parseInt(a2)+parseInt(b2))/(2-na2);
        }  

        if(na1==2 && na2==2)
        {
             score = -1;
        }  
        else
        {
             score = (score1+score2)/2;
        }     

        return score;

    }



   function indicator21c_score()
   {
        var a1 = 0;
        var b1 = 0;
        var c1 = 0;
        var d1 = 0;
        var e1 = 0;
        var f1 = 0;
        var g1 = 0;
        var h1 = 0;
        var i1 = 0;
        var j1 = 0;
        var a2 = 0;
        var b2 = 0;
        var c2 = 0;
        var d2 = 0;
        var e2 = 0;
        var f2 = 0;
        var g2 = 0;
        var h2 = 0;
        var i2 = 0;
        var j2 = 0;       
        var na1 = 0;      
        var na2 = 0;      
        var na3 = 0;      
        var na4 = 0;      
        var na5 = 0;      
        var na6 = 0;      
        var na7 = 0;      
        var na8 = 0;      
        var na9 = 0;      
        var na10 = 0;


        var pattern = new RegExp('^[0-1]|(NA)$');


        if( pattern.test($('#haematology_huma600_21a6').text()) )
        {
            if($('#haematology_huma600_21a6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                a1=$('#haematology_huma600_21a6').text();
            }
        }


        if( pattern.test($('#haematology_huma600_21a8').text()) )
        {
            if($('#haematology_huma600_21a8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                a2=$('#haematology_huma600_21a8').text();
            }
        }


        if( pattern.test($('#haematology_huma30TS_21b6').text()) )
        {
            if($('#haematology_huma30TS_21b6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                b1=$('#haematology_huma30TS_21b6').text();
            }
        }


        if( pattern.test($('#haematology_huma30TS_21b8').text()) )
        {
            if($('#haematology_huma30TS_21b8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                b2=$('#haematology_huma30TS_21b8').text();
            }
        }


        if( pattern.test($('#haematology_huma60TS_21c6').text()) )
        {
            if($('#haematology_huma60TS_21c6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                c1=$('#haematology_huma60TS_21c6').text();
            }
        }


        if( pattern.test($('#haematology_huma60TS_21c8').text()) )
        {
            if($('#haematology_huma60TS_21c8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                c2=$('#haematology_huma60TS_21c8').text();
            }
        }


        if( pattern.test($('#haematology_mind3200_21e6').text()) )
        {
            if($('#haematology_mind3200_21e6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                d1=$('#haematology_mind3200_21e6').text();
            }
        }


        if( pattern.test($('#haematology_mind3200_21e8').text()) )
        {
            if($('#haematology_mind3200_21e8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                d2=$('#haematology_mind3200_21e8').text();
            }
        }

        if( pattern.test($('#haematology_mind3000_21f6').text()) )
        {
            if($('#haematology_mind3000_21f6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                e1=$('#haematology_mind3000_21f6').text();
            }
        }


        if( pattern.test($('#haematology_mind3000_21f8').text()) )
        {
            if($('#haematology_mind3000_21f8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                e2=$('#haematology_mind3000_21f8').text();
            }
        }


        if( pattern.test($('#haematology_mind2800_21j6').text()) )
        {
            if($('#haematology_mind2800_21j6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                f1=$('#haematology_mind2800_21j6').text();
            }
        }


        if( pattern.test($('#haematology_mind2800_21j8').text()) )
        {
            if($('#haematology_mind2800_21j8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                f2=$('#haematology_mind2800_21j8').text();
            }
        }


        if( pattern.test($('#haematology_mind2300_21i6').text()) )
        {
            if($('#haematology_mind2300_21i6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                g1=$('#haematology_mind2300_21i6').text();
            }
        }


        if( pattern.test($('#haematology_mind2300_21i8').text()) )
        {
            if($('#haematology_mind2300_21i8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                g2=$('#haematology_mind2300_21i8').text();
            }
        }


        if( pattern.test($('#haematology_medonic_21k6').text()) )
        {
            if($('#haematology_medonic_21k6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                h1=$('#haematology_medonic_21k6').text();
            }
        }


        if( pattern.test($('#haematology_medonic_21k8').text()) )
        {
            if($('#haematology_medonic_21k8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                h2=$('#haematology_medonic_21k8').text();
            }
        }


        if( pattern.test($('#haematology_sysmex100_21g6').text()) )
        {
            if($('#haematology_sysmex100_21g6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                i1=$('#haematology_sysmex100_21g6').text();
            }
        }


        if( pattern.test($('#haematology_sysmex100_21g8').text()) )
        {
            if($('#haematology_sysmex100_21g8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                i2=$('#haematology_sysmex100_21g8').text();
            }
        }


        if( pattern.test($('#haematology_sysmex300_21h6').text()) )
        {
            if($('#haematology_sysmex300_21h6').text()=='NA')
            {
                na1=na1+1;
            }
            else
            {
                j1=$('#haematology_sysmex300_21h6').text();
            }
        }


        if( pattern.test($('#haematology_sysmex300_21h8').text()) )
        {
            if($('#haematology_sysmex300_21h8').text()=='NA')
            {
                na2=na2+1;
            }
            else
            {
                j2=$('#haematology_sysmex300_21h8').text();
            }
        }


        var score1=0;
        var score2=0;
        var score =0;


        //ensure that denominator is not zero
        if(na1!=10)
        {
            score1 = ( parseInt(a1)+parseInt(b1)+parseInt(c1)+parseInt(d1)+parseInt(e1)+parseInt(f1)+parseInt(g1)+parseInt(h1)+parseInt(i1)+parseInt(j1) )/(10-na1);
        }           

        if(na2!=10)
        {
            score2 = ( parseInt(a2)+parseInt(b2)+parseInt(c2)+parseInt(d2)+parseInt(e2)+parseInt(f2)+parseInt(g2)+parseInt(h2)+parseInt(i2)+parseInt(j2) )/(10-na2);
        }   

        if(na1==10 && na2==10)
        {
             score = -1;
        }  
        else
        {
             score = (score1+score2)/2;
        }     


        return score;
   
    }


   function indicator21_score()
   {

        var a= indicator21a_score();
        var b= indicator21b_score();
        var c= indicator21c_score();
        var na=0;

        var score = -1;

        if(a==-1 && b==-1 && c==-1)
        {

            $('#score_21').text('NA');        
            $('#percentage_21').text('NA');
            $('#lab_equipment_21_score').val(-1);
            return;    

        }

        if(a==-1)
        {
            na=na+1;
            a=0;
        }

        if(b==-1)
        {
            na=na+1;
            b=0;
        }

        if(c==-1)
        {
            na=na+1;
            c=0;
        }

        score = (a+b+c)/(3-na);

        $('#score_21').text( (score).toFixed(2) );        
        $('#percentage_21').text( (score *100).toFixed(1) +' %');
        $('#lab_equipment_21_score').val( (score).toFixed(2) );    
    }
        
   function indicator22_score()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        var e = 0;
        var f = 0;
        var g = 0;
        var h = 0;
        var i = 0;
        var j = 0;
        var k = 0;
        var l = 0;
        var m = 0;
        var n = 0;
        var score = 0;        
        var na = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#lab_info_system_22a').val()) )
        {
            if($('#lab_info_system_22a').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                a=$('#lab_info_system_22a').val();
            }
        }

        if( pattern.test($('#lab_info_system_22b').val()) )
        {
            if($('#lab_info_system_22b').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                b=$('#lab_info_system_22b').val();
            }
        }   

        if( pattern.test($('#lab_info_system_22c').val()) )
        {
            if($('#lab_info_system_22c').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                c=$('#lab_info_system_22c').val();
            }
        }

        if( pattern.test($('#lab_info_system_22d').val()) )
        {
            if($('#lab_info_system_22d').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                d=$('#lab_info_system_22d').val();
            }
        }

        if( pattern.test($('#lab_info_system_22e').val()) )
        {
            if($('#lab_info_system_22e').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                e=$('#lab_info_system_22e').val();
            }
        }


        if( pattern.test($('#lab_info_system_22f').val()) )
        {
            if($('#lab_info_system_22f').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                f=$('#lab_info_system_22f').val();
            }
        }


        if( pattern.test($('#lab_info_system_22g').val()) )
        {
            if($('#lab_info_system_22g').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                g=$('#lab_info_system_22g').val();
            }
        }

        if( pattern.test($('#lab_info_system_22h').val()) )
        {
            if($('#lab_info_system_22h').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                h=$('#lab_info_system_22h').val();
            }
        }   

        if( pattern.test($('#lab_info_system_22i').val()) )
        {
            if($('#lab_info_system_22i').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                i=$('#lab_info_system_22i').val();
            }
        }

        if( pattern.test($('#lab_info_system_22j').val()) )
        {
            if($('#lab_info_system_22j').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                j=$('#lab_info_system_22j').val();
            }
        }

        if( pattern.test($('#lab_info_system_22k').val()) )
        {
            if($('#lab_info_system_22k').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                k=$('#lab_info_system_22k').val();
            }
        }


        if( pattern.test($('#lab_info_system_22l').val()) )
        {
            if($('#lab_info_system_22l').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                l=$('#lab_info_system_22l').val();
            }
        }

        if( pattern.test($('#lab_info_system_22m').val()) )
        {
            if($('#lab_info_system_22m').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                m=$('#lab_info_system_22m').val();
            }
        }

        if( pattern.test($('#lab_info_system_22n').val()) )
        {
            if($('#lab_info_system_22n').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                n=$('#lab_info_system_22n').val();
            }
        }        
        //ensure that denominator is not zero
        if(na!=14)
        {
            score = (parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d)+parseInt(e)+parseInt(f)+parseInt(g)+parseInt(h)+parseInt(i)+parseInt(j)+parseInt(k)+parseInt(l)+parseInt(m)+parseInt(n))/(14-na);
        }           

        $('#score_22').text( (score).toFixed(2) );        
        $('#percentage_22').text( (score *100).toFixed(1) +' %');
        $('#lab_info_system_22_score').val( (score).toFixed(2) );    
    }

   function indicator23_score()
   {
        var a = 0;
        var b = 0;
        var nr = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#lab_info_system_23a').val()) )
        {
            if($('#lab_info_system_23a').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                a=$('#lab_info_system_23a').val();
            }
        }

        if( pattern.test($('#lab_info_system_23b').val()) )
        {
            if($('#lab_info_system_23b').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                b=$('#lab_info_system_23b').val();
            }
        }   


        //ensure that denominator is not zero
        if(nr!=2)
        {
            score = (parseInt(a)+parseInt(b))/(2-nr);
        }           

        $('#score_23').text( (score).toFixed(2) );        
        $('#percentage_23').text( (score *100).toFixed(1) +' %');
        $('#lab_info_system_23_score').val( (score).toFixed(2) );    
    }

   function indicator24_score()
   {
        var a = 0;
        var score = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#lab_info_system_24c').val()) )
        {
            if($('#lab_info_system_24c').val()!='NA')
            {
                score=parseInt($('#lab_info_system_24c').val());
            }
        }     

        $('#score_24').text( (score).toFixed(2) );              
        $('#percentage_24').text( (score*100).toFixed(1) +' %');
        $('#lab_info_system_24_score').val( (score).toFixed(2) );    
    }


   function indicator25a_score()
   {
        var a = 0;
        var b = 0;  
        var nr = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#lab_info_system_25b').val()) )
        {
            if($('#lab_info_system_25b').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                a=$('#lab_info_system_25b').val();
            }
        }

        if( pattern.test($('#lab_info_system_25c').val()) )
        {
            if($('#lab_info_system_25c').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                b=$('#lab_info_system_25c').val();
            }
        }   


        var score = 0;
        
        //ensure that denominator is not zero
        if(nr!=2)
        {
            score = ( parseInt(a)+parseInt(b) )/(2-nr);
        }           
        return score;   
    }


   function indicator25b_score()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        var e = 0;
        var f = 0;
        var g = 0;      
        var nr = 0;   

        var pattern = new RegExp('^[0-1]|(NA)$');
 

        if( pattern.test($('#lab_info_system_25ba8').val()) )
        {
            if($('#lab_info_system_25ba8').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                a=$('#lab_info_system_25ba8').val();
            }
        }           

        if( pattern.test($('#lab_info_system_25bb8').val()) )
        {
            if($('#lab_info_system_25bb8').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                b=$('#lab_info_system_25bb8').val();
            }
        }

        if( pattern.test($('#lab_info_system_25bc8').val()) )
        {
            if($('#lab_info_system_25bc8').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                c=$('#lab_info_system_25bc8').val();
            }
        }

        if( pattern.test($('#lab_info_system_25bd8').val()) )
        {
            if($('#lab_info_system_25bd8').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                d=$('#lab_info_system_25bd8').val();
            }
        }    

        if( pattern.test($('#lab_info_system_25be8').val()) )
        {
            if($('#lab_info_system_25be8').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                e=$('#lab_info_system_25be8').val();
            }
        }

        if( pattern.test($('#lab_info_system_25bf8').val()) )
        {
            if($('#lab_info_system_25bf8').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                f=$('#lab_info_system_25bf8').val();
            }
        }


        if( pattern.test($('#lab_info_system_25bg8').val()) )
        {
            if($('#lab_info_system_25bg8').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                g=$('#lab_info_system_25bg8').val();
            }
        }


        score = 0;
        
        //ensure that denominator is not zero
        if(nr!=7)
        {
            score = ( parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d)+parseInt(e)+parseInt(f)+parseInt(g) )/(7-nr);
        }           
        
        return score;   

    }



   function indicator25c_score()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        var e = 0;
        var f = 0;     
        var nr = 0;   

        var pattern = new RegExp('^[0-1]|(NA)$');
 
        if( pattern.test($('#lab_info_system_25ca4').val()) )
        {
            if($('#lab_info_system_25ca4').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                a=$('#lab_info_system_25ca4').val();
            }
        }           

        if( pattern.test($('#lab_info_system_25cb4').val()) )
        {
            if($('#lab_info_system_25cb4').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                b=$('#lab_info_system_25cb4').val();
            }
        }

        if( pattern.test($('#lab_info_system_25cc4').val()) )
        {
            if($('#lab_info_system_25cc4').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                c=$('#lab_info_system_25cc4').val();
            }
        }

        if( pattern.test($('#lab_info_system_25cd4').val()) )
        {
            if($('#lab_info_system_25cd4').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                d=$('#lab_info_system_25cd4').val();
            }
        }    

        if( pattern.test($('#lab_info_system_25ce4').val()) )
        {
            if($('#lab_info_system_25ce4').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                e=$('#lab_info_system_25ce4').val();
            }
        }

        if( pattern.test($('#lab_info_system_25cf4').val()) )
        {
            if($('#lab_info_system_25cf4').val()=='NA')
            {
                nr=nr+1;
            }
            else
            {
                f=$('#lab_info_system_25cf4').val();
            }
        }

        score = 0;


        //ensure that denominator is not zero
        if(nr!=6)
        {
            score = ( parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d)+parseInt(e)+parseInt(f) )/(6-nr);
            //alert(score);
        }           
        
        return score;   
   
    }


   function indicator25_score()
   {
        var a = indicator25a_score();
        var b = indicator25b_score();
        var c = indicator25c_score();
       
        var score = (a+b+c)/3;
        //var score = b;

        $('#score_25').text( (score).toFixed(2) );        
        $('#percentage_25').text( (score *100).toFixed(1) +' %');
        $('#lab_info_system_25_score').val( (score).toFixed(2) );    
    }




   function indicator26_score()
   {
        var a = 0;
        var b = 0;

        var na = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#lab_info_system_26a').val()) )
        {
            if($('#lab_info_system_26a').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                a=$('#lab_info_system_26a').val();
            }
        }

        if( pattern.test($('#lab_info_system_26b').val()) )
        {
            if($('#lab_info_system_26b').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                b=$('#lab_info_system_26b').val();
            }
        }


        //ensure that denominator is not zero
        if(na!=2)
        {
            score = (parseInt(a)+parseInt(b))/(2-na);
        }           

        $('#score_26').text( (score).toFixed(2) );        
        $('#percentage_26').text( (score *100).toFixed(1) +' %');
        $('#lab_info_system_26_score').val( (score).toFixed(2) );    
    }
       
    function indicator27_score()
   {
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        var na = 0;

        var pattern = new RegExp('^[0-1]|(NA)$');

        if( pattern.test($('#lab_info_system_27a').val()) )
        {
            if($('#lab_info_system_27a').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                a=$('#lab_info_system_27a').val();
            }
        }

        if( pattern.test($('#lab_info_system_27b').val()) )
        {
            if($('#lab_info_system_27b').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                b=$('#lab_info_system_27b').val();
            }
        }

        if( pattern.test($('#lab_info_system_27c').val()) )
        {
            if($('#lab_info_system_27c').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                c=$('#lab_info_system_27c').val();
            }
        }

        if( pattern.test($('#lab_info_system_27d').val()) )
        {
            if($('#lab_info_system_27d').val()=='NA')
            {
                na=na+1;
            }
            else
            {
                d=$('#lab_info_system_27d').val();
            }
        }
        

        //ensure that denominator is not zero
        if(na!=4)
        {
            score = (parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d))/(4-na);
        }           

        $('#score_27').text( (score).toFixed(2) );        
        $('#percentage_27').text( (score *100).toFixed(1) +' %');
        $('#lab_info_system_27_score').val( (score).toFixed(2) );     

    }  

</script>
@stop
