@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row" id="section-0">

    {{ Form::open(array('url' => 'end_wizard','data-toggle' => 'validator', 'autocomplete' => 'off', 'id'=>'profileForm')) }}

    {{ Form::label('form_id', '', ['class' => 'col-md-3 control-label hidden']) }}
    {{ Form::text('form_id',null,['class' => ' hidden form-control input-md']) }}
    <h2>General</h2>
    <section data-step="0">

      <div class="row">
        <div class="col-lg-6">

          <div class="form-group form-template col-lg-9 has-feedback">
            {{ Form::label('district_id', 'District') }}
            {{ Form::select('district_id', $district_list ,null, array('class' => 'form-control has-feedback input-md', 'required' => 'required')) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('district_id'))
              <span class="text-danger">
                <strong>{{ $errors->first('district_id') }}</strong>
              </span>
              @endif
            </div>

          </div>


          <div class="form-group form-template col-lg-9 has-feedback">
            {{ Form::label('sub_district_id', 'Sub district') }}
            {{ Form::select('sub_district_id', [] ,null, array('class' => 'form-control has-feedback input-md', 'required' => 'required')) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('sub_district_id'))
              <span class="text-danger">
                <strong>{{ $errors->first('sub_district_id') }}</strong>
              </span>
              @endif
            </div>

          </div>


          <div class="form-group form-template col-lg-9 has-feedback">
            {{ Form::label('facility_id', 'Facility') }}
            {{ Form::select('facility_id', [] ,null, array('class' => 'form-control has-feedback input-md', 'required' => 'required')) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('facility_id'))
              <span class="text-danger">
                <strong>{{ $errors->first('facility_id') }}</strong>
              </span>
              @endif
            </div>

          </div>

          <div class="form-group form-template col-lg-9 has-feedback">
            {{ Form::label('visit_date', 'Date of visit') }}

            <div class="input-group">
              {{ Form::text('visit_date',null,['data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','class' => 'form_datetime form-control','required'=>'true']) }}

              <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
            @if ($errors->has('visit_date'))
            <span class="text-danger">
              <strong>{{ $errors->first('visit_date') }}</strong>
            </span>
            @endif

          </div>


          <div class="form-group form-template col-lg-9 has-feedback">
            {{ Form::label('next_visit_date', 'Date of next visit') }}

            <div class="input-group">
              {{ Form::text('next_visit_date',null,['data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','class' => 'form_datetime form-control','required'=>'true']) }}

              <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
            @if ($errors->has('next_visit_date'))
            <span class="text-danger">
              <strong>{{ $errors->first('next_visit_date') }}</strong>
            </span>
            @endif

          </div>

          <div class="form-group form-template col-lg-9 has-feedback">
            {{ Form::label('visit_number', 'Visit number') }}
            {{ Form::text('visit_number',null,['class' => 'form-control','placeholder' => 'Supervision visit number', 'readonly' => 'true']) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('visit_number'))
              <span class="text-danger">
                <strong>{{ $errors->first('visit_number') }}</strong>
              </span>
              @endif
            </div>

          </div>

        </div>


        <div class="col-md-6">

          <div class="form-group form-template col-lg-9 has-feedback">
            {{ Form::label('dhis_region', 'DHIS2 Region') }}
            {{ Form::text('dhis_region',null,['class' => 'form-control','placeholder' => 'DHIS2 Region', 'readonly' => 'true']) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('dhis_region'))
              <span class="text-danger">
                <strong>{{ $errors->first('dhis_region') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group form-template col-lg-9 has-feedback">
            {{ Form::label('in_charge_name', 'Lab in-charge name') }}
            {{ Form::text('in_charge_name',null,['class' => 'form-control','placeholder' => 'Lab in-charge name']) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('in_charge_name'))
              <span class="text-danger">
                <strong>{{ $errors->first('in_charge_name') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group form-template col-lg-9 has-feedback">
            {{ Form::label('in_charge_telephone', 'Lab in-charge telephone') }}
            {{ Form::text('in_charge_telephone',null,['class' => 'form-control','placeholder' => 'Lab in-charge telephone']) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('in_charge_telephone'))
              <span class="text-danger">
                <strong>{{ $errors->first('in_charge_telephone') }}</strong>
              </span>
              @endif
            </div>
          </div>


          <div class="form-group form-template col-lg-9 has-feedback">
            {{ Form::label('responsible_lss', 'Responsible LSS') }}
            {{ Form::text('responsible_lss',null,['class' => 'form-control','placeholder' => 'Responsible LSS', 'required' => 'true']) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('responsible_lss'))
              <span class="text-danger">
                <strong>{{ $errors->first('responsible_lss') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group form-template col-lg-9 has-feedback">
            {{ Form::label('facility_level', 'Level') }}
            {{ Form::text('facility_level',null,['class' => 'form-control','placeholder' => 'Level', 'readonly' => 'true']) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('facility_level'))
              <span class="text-danger">
                <strong>{{ $errors->first('facility_level') }}</strong>
              </span>
              @endif
            </div>
          </div>


          <div class="form-group form-template col-lg-9 has-feedback">
            {{ Form::label('ownership', 'Ownership') }}
            {{ Form::text('ownership',null,['class' => 'form-control','placeholder' => 'Ownership', 'readonly' => 'true']) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('ownership'))
              <span class="text-danger">
                <strong>{{ $errors->first('ownership') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>


      <strong>Name(s) of persons supervised</strong>

      <div class="row ">
        <div class="col-md-12 ">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-condensed table-bordered table-hover" id="tab_supervised">
                <thead>
                  <tr >
                    <th class="text-center">
                      #
                    </th>
                    <th class="text-center">
                      Name
                    </th>
                    <th class="text-center col-md-2">
                      Sex
                    </th>
                    <th class="text-center col-md-3">
                      Profession
                    </th>
                    <th class="text-center">
                      Phone number
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr id='supervised0'>
                    <td>
                      1
                    </td>
                    <td>
                      {{ Form::label('name0', 'Name', ['class' => 'col-md-1 control-label hidden']) }}
                      <input type="text" name='name0' id='name0' placeholder='Name' class="form-control input-sm" required="required"/>
                    </td>
                    <td>
                      {{ Form::label('gender0', 'Name', ['class' => 'col-md-1 control-label hidden']) }}
                      {{ Form::select('gender0', [''=>'','M'=>'Male','F'=>'Female'], null, ['data-placeholder' => 'Select gender','class'=>'form-control input-sm','required'=>'required' ]) }}
                    </td>
                    <td>
                      {{ Form::label('profession0', 'Name', ['class' => 'col-md-1 control-label hidden']) }}
                      {{ Form::select('profession0', $cadre_list, null, ['data-placeholder' => 'Select profession','class'=>'form-control','required'=>'required' ]) }}
                    </td>
                    <td>
                      {{ Form::label('mobile0', 'Name', ['class' => 'col-md-1 control-label hidden']) }}
                      {{ Form::text('mobile0',null,['class' => 'form-control input-sm','placeholder' => 'Telephone','pattern'=>'^(07\d{8})$','required'=>'required']) }}
                    </td>
                  </tr>
                  <tr id='supervised1'></tr>
                </tbody>
              </table>

            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
              <a id="add_supervised_row" class="btn btn-default pull-left">Add Row</a><a id='delete_supervised_row' class="pull-right btn btn-default">Delete Row</a>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            {{ Form::label('supervised_counter', 'supervised_counter', ['class' => 'col-md-1 control-label hidden']) }}
            <div class="col-md-4">
              {{ Form::text('supervised_counter',1,['class' => 'form-control hidden']) }}
            </div>
          </div>
        </div>

      </div>


      <strong>Name(s) of supervisors</strong>

      <div class="row ">
        <div class="col-md-12 ">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-sm table-bordered table-hover" id="tab_supervisor">
                <thead>
                  <tr >
                    <th class="text-center">
                      #
                    </th>
                    <th class="text-center col-md-4">
                      Name
                    </th>
                    <th class="text-center">
                      Phone number
                    </th>
                    <th class="text-center">
                      Title
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr id='supervisor0'>
                    <td>
                      1
                    </td>
                    <td>
                      {{ Form::label('supervisor_name0', 'Name', ['class' => 'col-md-1 control-label hidden']) }}
                      {{ Form::select('supervisor_name0', $personnel_list, null, ['data-placeholder' => 'Select supervisor','class'=>'form-control supervisor_dl', 'required'=>'required' ]) }}
                    </td>
                    <td>
                      <input  pattern='^(07\d{8})$' type='text' name='supervisor_telephone0' placeholder='Telephone' class="form-control input-sm"/>
                    </td>
                    <td>
                      <input type="text" name='supervisor_title0' placeholder='Title' class="form-control input-sm"/>
                    </td>
                  </tr>
                  <tr id='supervisor1'></tr>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-md-12">
          <a id="add_supervisor_row" class="btn btn-default pull-left">Add Row</a><a id='delete_supervisor_row' class="pull-right btn btn-default">Delete Row</a>
        </div>
      </div>


      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            {{ Form::label('supervisor_counter', 'supervisor_counter', ['class' => 'col-md-1 control-label hidden']) }}
            <div class="col-md-4">
              {{ Form::text('supervisor_counter',1,['class' => 'form-control hidden']) }}
            </div>
          </div>
        </div>

      </div>



      <div class="row">
        <div class="col-lg-12">

          <div class="form-group form-template col-lg-8 has-feedback">
            {{ Form::label('general_d1', 'D1. Where are Laboratory supplies MAINLY stored in the facility?') }}
            {{ Form::select('general_d1', [''=>'','1'=>'Main store','2'=>'Laboratory store','3'=>'Pharmacy store','4'=>'Wards store','5'=>'Cupboards in laboratory','6'=>'Others'] ,null, array('class' => 'form-control has-feedback input-md', 'required' => 'required','data-placeholder' => 'Select a store')) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('general_d1'))
              <span class="text-danger">
                <strong>{{ $errors->first('general_d1') }}</strong>
              </span>
              @endif
            </div>

          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-lg-12">

          <div class="form-group form-template col-lg-7 has-feedback">
            {{ Form::label('general_d2', 'D2. Where ELSE are  Laboratory  supplies stored in the facility?') }}
            {{ Form::select('general_d2', [] ,null, array('multiple' => 'multiple', 'class' => 'form-control has-feedback input-md')) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('general_d2'))
              <span class="text-danger">
                <strong>{{ $errors->first('general_d2') }}</strong>
              </span>
              @endif
            </div>

          </div>

          <div class="form-group form-template col-lg-5 has-feedback">
            {{ Form::label('general_d2_comment', '',['class' => 'col-md-3 control-label hidden']) }}
            {{ Form::textarea('general_d2_comment',null,['class' => 'form-control','rows'=>'3', 'placeholder' => 'Comments']) }}
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-md-12">

          <p>

            <strong>D3. Does the facility use stock cards to track the use of laboratory supplies </strong> <em>(Assessor, ask to be shown a copy of the stock card)</em>
          </p>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">

              <thead>
                <tr>
                  <th class="col-md-2">Yes</th>
                  <th class="col-md-2">No</th>
                  <th class="col-md-8">Comments</th>
                </tr>
              </thead>

              <tbody>

                <tr>


                  <td class="form-group">
                    {{ Form::label('general_d3', '', ['class' => 'col-md-3 control-label hidden']) }}
                    {{ Form::radio('general_d3', 'true', false) }}
                  </td>
                  <td class="form-group">
                    {{ Form::radio('general_d3', 'false', false) }}
                  </td>
                  <td rowspan="1">
                    {{ Form::label('general_d3_comment', '',['class' => 'col-md-3 control-label hidden']) }}
                    {{ Form::textarea('general_d3_comment',null,['class' => 'form-control','rows'=>'3', 'placeholder' => 'Comments']) }}
                  </td>
                </tr>

              </tbody>
            </table>
          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">

          <div class="form-group form-template col-lg-7 has-feedback">
            {{ Form::label('general_d4', 'D4. Where are stock cards kept in the facility? (Assessor, ask to be shown a copy of the stock card).') }}
            {{ Form::select('general_d4', ['1'=>'Main store','2'=>'Laboratory store','3'=>'Pharmacy store','4'=>'Wards store','5'=>'Cupboards in laboratory','6'=>'Others'] ,null, array('multiple' => 'multiple', 'class' => 'form-control has-feedback input-md')) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('general_d4'))
              <span class="text-danger">
                <strong>{{ $errors->first('general_d4') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group form-template col-lg-5 has-feedback">
            {{ Form::label('general_d4_comment', '',['class' => 'col-md-3 control-label hidden']) }}
            {{ Form::textarea('general_d4_comment',null,['class' => 'form-control','rows'=>'3', 'placeholder' => 'Comments']) }}
          </div>

        </div>
      </div>


      <div class="row">
        <div class="col-md-12">

          <div class="form-group form-template has-feedback col-md-12 ">
            {{ Form::label('general_d5', 'D5. Assessor: If stock cards are kept in multiple places, ask;  How  is the consumption reconciled with the main store/stock card?') }}

            {{ Form::textarea('general_d5',null,['class' => 'form-control','rows'=>'5', 'placeholder' => 'Type here']) }}

            <div class="help-block with-errors text-danger">
              @if ($errors->has('general_d5'))
              <span class="text-danger">
                <strong>{{ $errors->first('general_d5') }}</strong>
              </span>
              @endif
            </div>

          </div>
          <p>
          </div>
        </div>
      </section>

      <h2>Stock management</h2>
      <section data-step="1">

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
                      <div >Reagent and unit size</span></div>
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
                      {{ Form::text('r1_c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c4', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c5', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>


                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c6', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c6',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c7',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c8', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c8',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c9', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c9',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c10', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c10',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-8][0-9]|9[0-9]|1[0-7][0-9]|180)|(NA)$'])}}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c11', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c11',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c12', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c12',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c13', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c13',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r1_c14', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c14',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c15', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c15',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c16', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c16',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c17', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c17',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c18', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c18',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c19', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c19',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c20', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c20',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c21', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c21',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r1_c22', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r1_c22',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
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
                          {{ Form::select('cd4_testing', [''=>'','1'=>'BD FACS, MultiTest CD3/CD8/CD45/CD4, 50 Tests','2'=>'BD FACSCount CD3/CD4 Reagent Kit 50 Tests','3'=>'BD FACS Flow Sheath Fluid','4'=>'Partec-CD4 % Easy Count Kit 100 tests','5'=>'Pima Analyzer CD4 Cartridge Kit, 100 tests'], null, ['data-placeholder' => 'Select an item','class'=>' small-font' ]) }}


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
                      {{ Form::text('r2_c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c4', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c5', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>


                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c6', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c6',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c7',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c8', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c8',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c9', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c9',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c10', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c10',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-8][0-9]|9[0-9]|1[0-7][0-9]|180)|(NA)$'])}}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c11', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c11',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c12', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c12',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c13', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c13',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r2_c14', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c14',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c15', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c15',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c16', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c16',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c17', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c17',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r2_c18', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c18',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c19', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c19',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c20', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c20',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c21', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c21',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r2_c22', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r2_c22',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
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
                      {{ Form::text('r3_c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c4', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c5', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>


                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c6', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c6',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c7',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c8', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c8',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c9', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c9',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c10', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c10',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-8][0-9]|9[0-9]|1[0-7][0-9]|180)|(NA)$'])}}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c11', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c11',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c12', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c12',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c13', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c13',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r3_c14', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c14',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c15', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c15',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c16', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c16',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c17', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c17',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r3_c18', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c18',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c19', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c19',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c20', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c20',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c21', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c21',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3_c22', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3_c22',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
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
                      {{ Form::text('r3b_c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c4', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c5', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>


                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c6', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c6',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c7',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c8', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c8',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c9', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c9',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c10', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c10',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-8][0-9]|9[0-9]|1[0-7][0-9]|180)|(NA)$'])}}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c11', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c11',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c12', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c12',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c13', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c13',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r3b_c14', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c14',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c15', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c15',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c16', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c16',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c17', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c17',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r3b_c18', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c18',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c19', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c19',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c20', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c20',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c21', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c21',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r3b_c22', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r3b_c22',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
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
                      {{ Form::text('r4b_c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c4', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c5', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>


                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c6', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c6',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c7',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c8', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c8',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c9', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c9',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c10', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c10',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-8][0-9]|9[0-9]|1[0-7][0-9]|180)|(NA)$'])}}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c11', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c11',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c12', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c12',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c13', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c13',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r4b_c14', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c14',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c15', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c15',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c16', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c16',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c17', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c17',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r4b_c18', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c18',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c19', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c19',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c20', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c20',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c21', '', ['class' => 'col-md-3 control-label hidden']) }}

                      {{ Form::text('r4b_c21',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4b_c22', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4b_c22',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
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
                      {{ Form::text('r4_c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c4', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c5', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>


                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c6', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c6',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c7',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c8', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c8',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c9', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c9',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c10', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c10',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-8][0-9]|9[0-9]|1[0-7][0-9]|180)|(NA)$'])}}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c11', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c11',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c12', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c12',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c13', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c13',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r4_c14', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c14',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c15', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c15',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c16', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c16',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c17', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c17',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r4_c18', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c18',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c19', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c19',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c20', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c20',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c21', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c21',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r4_c22', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r4_c22',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
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
                      {{ Form::text('r5_c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c4', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c5', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>


                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c6', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c6',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c7',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c8', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c8',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c9', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c9',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c10', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c10',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-8][0-9]|9[0-9]|1[0-7][0-9]|180)|(NA)$'])}}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c11', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c11',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c12', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c12',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c13', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c13',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r5_c14', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c14',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c15', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c15',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c16', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c16',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c17', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c17',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r5_c18', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c18',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c19', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c19',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c20', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c20',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c21', '', ['class' => 'col-md-3 control-label hidden']) }}

                      {{ Form::text('r5_c21',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r5_c22', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r5_c22',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
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
                      {{ Form::text('r6_c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c4', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c5', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>


                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c6', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c6',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c7',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c8', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c8',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c9', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c9',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c10', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c10',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-8][0-9]|9[0-9]|1[0-7][0-9]|180)|(NA)$'])}}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c11', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c11',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c12', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c12',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c13', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c13',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r6_c14', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c14',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c15', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c15',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c16', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c16',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c17', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c17',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r6_c18', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c18',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c19', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c19',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c20', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c20',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c21', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c21',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r6_c22', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r6_c22',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
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
                      {{ Form::text('r7_c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c4', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c5', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>


                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c6', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c6',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c7',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c8', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c8',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c9', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c9',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c10', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c10',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-8][0-9]|9[0-9]|1[0-7][0-9]|180)|(NA)$'])}}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c11', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c11',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c12', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c12',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c13', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c13',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r7_c14', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c14',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c15', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c15',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c16', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c16',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c17', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c17',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r7_c18', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c18',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c19', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c19',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c20', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c20',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c21', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c21',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r7_c22', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r7_c22',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
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
                      {{ Form::text('r8_c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c4', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c5', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>


                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c6', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c6',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c7',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c8', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c8',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c9', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c9',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c10', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c10',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-8][0-9]|9[0-9]|1[0-7][0-9]|180)|(NA)$'])}}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c11', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c11',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c12', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c12',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c13', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c13',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r8_c14', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c14',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c15', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c15',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c16', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c16',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c17', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c17',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r8_c18', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c18',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c19', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c19',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c20', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c20',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c21', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c21',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r8_c22', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r8_c22',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
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
                      {{ Form::text('r9_c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or E permitted','pattern'=>'^[0-1]|E|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c4', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c5', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>


                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c6', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c6',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c7',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$'])  }}
                      <div class="help-block with-errors"></div>
                    </td>
                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c8', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c8',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c9', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c9',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'^(\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c10', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c10',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-8][0-9]|9[0-9]|1[0-7][0-9]|180)|(NA)$'])}}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c11', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c11',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c12', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c12',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c13', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c13',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r9_c14', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c14',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c15', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c15',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c16', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c16',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c17', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c17',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Number(2dp) or NR permitted','pattern'=>'^\d+(\.\d{1,2})?|(NR)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>                                                                                         <td class="form-group has-feedback">
                      {{ Form::label('r9_c18', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c18',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c19', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c19',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Values between 0 and 180 permitted','pattern'=>'^([0-9]|[1-9][0-9]|[1][0-7][0-9]|18[0-0])|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c20', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c20',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits permitted','pattern'=>'(^\d+)|(NA)$']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c21', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c21',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2']) }}
                      <div class="help-block with-errors"></div>
                    </td>

                    <td class="form-group has-feedback">
                      {{ Form::label('r9_c22', '', ['class' => 'col-md-3 control-label hidden']) }}
                      {{ Form::text('r9_c22',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1,NR or PS permitted','pattern'=>'^[0-1]|(NR)|(PS)|(NA)$','maxlength'=>'2']) }}
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
                        {{ Form::text('stock_management_1_score',null,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}}

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
                        {{ Form::text('stock_management_2_score',null,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}}
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
                        {{ Form::text('stock_management_3_score',null,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}}
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
                        {{ Form::text('stock_management_4_score',null,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}}
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
                        {{ Form::text('stock_management_5_score',null,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}}
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
                        {{ Form::text('stock_management_6_score',null,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}}
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
                        {{ Form::text('stock_management_7_score',null,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}}
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
                        {{ Form::text('stock_management_8_score',null,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}}
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
                        {{ Form::text('stock_management_9_score',null,['class' => 'form-control input-sm custom-input-md', 'data-error'=>'Only numbers permitted','pattern'=>'^\d+(\.\d{1,2})?$','required'=>'required'])}}

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

        </section>


        <h2>Storage management</h2>
        <section data-step="2">
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

                        {{ Form::text('storage_management_10a',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                        <div class="help-block with-errors"></div>
                      </td>

                      <td rowspan="4">
                        {{ Form::textarea('storage_management_10_comments',null,['class' => 'form-control','rows'=>'8', 'placeholder' => 'Comments']) }}
                      </td>
                    </tr>

                    <tr>
                      <td>b) The main store is clean and tidy</td>
                      <td class="form-group has-feedback">
                        {{ Form::label('storage_management_10b', '', ['class' => 'col-md-3 control-label hidden']) }}
                        {{ Form::text('storage_management_10b',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                        <div class="help-block with-errors"></div>
                      </td>

                    </tr>


                    <tr>
                      <td>c) The storage areas within the  are laboratory  clean and tidy</td>
                      <td class="form-group has-feedback">
                        {{ Form::label('storage_management_10c', '', ['class' => 'col-md-3 control-label hidden']) }}
                        {{ Form::text('storage_management_10c',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                        <div class="help-block with-errors"></div>
                      </td>

                    </tr>


                    <tr>
                      <td>d) The Laboratory is clean and tidy</td>
                      <td class="form-group has-feedback">
                        {{ Form::label('storage_management_10d', '', ['class' => 'col-md-3 control-label hidden']) }}
                        {{ Form::text('storage_management_10d',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
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
                  {{ Form::hidden('storage_management_10_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}

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
                          {{ Form::text('storage_management_11a',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                          <div class="help-block with-errors"></div>
                        </td>

                        <td rowspan="5">
                          {{ Form::textarea('storage_management_11_comments',null,['class' => 'form-control','rows'=>'10', 'placeholder' => 'Comments']) }}
                        </td>
                      </tr>

                      <tr>
                        <td>b)   Is the hand washing area separate from the staining area?</td>
                        <td class="form-group has-feedback">
                          {{ Form::label('storage_management_11b', '', ['class' => 'col-md-3 control-label hidden']) }}
                          {{ Form::text('storage_management_11b',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                          <div class="help-block with-errors"></div>
                        </td>

                      </tr>


                      <tr>
                        <td>c)   Is hand washing facilities accessible, conveniently located, hygienic and functioning?</td>
                        <td class="form-group has-feedback">
                          {{ Form::label('storage_management_11c', '', ['class' => 'col-md-3 control-label hidden']) }}
                          {{ Form::text('storage_management_11c',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                          <div class="help-block with-errors"></div>
                        </td>

                      </tr>


                      <tr>
                        <td>d)   Is the drainage system of suitable standards?</td>
                        <td class="form-group has-feedback">
                          {{ Form::label('storage_management_11d', '', ['class' => 'col-md-3 control-label hidden']) }}
                          {{ Form::text('storage_management_11d',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                          <div class="help-block with-errors"></div>
                        </td>

                      </tr>

                      <tr>
                        <td>e)  Is there soap for hand washing?</td>
                        <td class="form-group has-feedback">
                          {{ Form::label('storage_management_11e', '', ['class' => 'col-md-3 control-label hidden']) }}
                          {{ Form::text('storage_management_11e',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
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
                    {{ Form::hidden('storage_management_11_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}
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
                            {{ Form::text('storage_management_12a1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                            <div class="help-block with-errors"></div>
                          </td>
                          <td class="form-group has-feedback">
                            {{ Form::label('storage_management_12a2', '', ['class' => 'col-md-3 control-label hidden']) }}
                            {{ Form::text('storage_management_12a2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                            <div class="help-block with-errors"></div>
                          </td>
                          <td rowspan="5">
                            {{ Form::textarea('storage_management_12_comments',null,['class' => 'form-control','rows'=>'10', 'placeholder' => 'Comments']) }}
                          </td>
                        </tr>

                        <tr>
                          <td>b) Are reagents stored on shelves and /or in cupboards?</td>
                          <td class="form-group has-feedback">
                            {{ Form::label('storage_management_12b1', '', ['class' => 'col-md-3 control-label hidden']) }}
                            {{ Form::text('storage_management_12b1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                            <div class="help-block with-errors"></div>
                          </td>
                          <td class="form-group has-feedback">
                            {{ Form::label('storage_management_12b2', '', ['class' => 'col-md-3 control-label hidden']) }}
                            {{ Form::text('storage_management_12b2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                            <div class="help-block with-errors"></div>
                          </td>

                        </tr>


                        <tr>
                          <td>c) Are the stock cards kept next to the reagents on the shelves or in a file?</td>
                          <td class="form-group has-feedback">
                            {{ Form::label('storage_management_12c1', '', ['class' => 'col-md-3 control-label hidden']) }}
                            {{ Form::text('storage_management_12c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                            <div class="help-block with-errors"></div>
                          </td>
                          <td class="form-group has-feedback">
                            {{ Form::label('storage_management_12c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                            {{ Form::text('storage_management_12c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                            <div class="help-block with-errors"></div>
                          </td>

                        </tr>


                        <tr>
                          <td>d)  Are lab reagents stored on shelves or in cupboards stored in a systematic manner (alphabetic, usage form etc.)?</td>
                          <td class="form-group has-feedback">
                            {{ Form::label('storage_management_12d1', '', ['class' => 'col-md-3 control-label hidden']) }}
                            {{ Form::text('storage_management_12d1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                            <div class="help-block with-errors"></div>
                          </td>
                          <td class="form-group has-feedback">
                            {{ Form::label('storage_management_12d2', '', ['class' => 'col-md-3 control-label hidden']) }}
                            {{ Form::text('storage_management_12d2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                            <div class="help-block with-errors"></div>
                          </td>

                        </tr>

                        <tr>
                          <td>e)  Are the shelves labelled?</td>
                          <td class="form-group has-feedback">
                            {{ Form::label('storage_management_12e1', '', ['class' => 'col-md-3 control-label hidden']) }}
                            {{ Form::text('storage_management_12e1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                            <div class="help-block with-errors"></div>
                          </td>
                          <td class="form-group has-feedback">
                            {{ Form::label('storage_management_12e2', '', ['class' => 'col-md-3 control-label hidden']) }}
                            {{ Form::text('storage_management_12e2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
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
                      {{ Form::hidden('storage_management_12_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}
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
                              {{ Form::text('storage_management_13a1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13a2', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13a2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>

                            <td rowspan="12">
                              {{ Form::textarea('storage_management_13_comments',null,['class' => 'form-control','rows'=>'30', 'placeholder' => 'Comments']) }}
                            </td>
                          </tr>

                          <tr>
                            <td> b) Are the supplies protected from direct sunlight (Painted glass, curtains or blinds – or no windows)?</td>

                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13b1', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13b1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13b2', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13b2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>

                          </tr>


                          <tr>
                            <td>c)  Is the temperature of the storage room monitored?</td>

                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13c1', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>

                          </tr>


                          <tr>
                            <td>d)  Can the temperature of the storeroom be regulated (Ventilation, , air-condition, windows)?</td>

                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13d1', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13d1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13d2', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13d2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>

                          </tr>

                          <tr>
                            <td>e) Roof is maintained in good condition to avoid water penetration?</td>

                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13e1', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13e1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13e2', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13e2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>

                          </tr>

                          <tr>
                            <td>f)  Is storage space sufficient and adequate?</td>

                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13f1', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13f1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13f2', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13f2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>

                          </tr>

                          <tr>
                            <td>g)  Is the store room lockable and access limited to authorised personnel?</td>

                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13g1', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13g1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13g2', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13g2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                          </tr>

                          <tr>
                            <td>h)  Fire safety equipment is available and accessible (any items for promotion of fire safety should be considered)</td>

                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13h1', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13h1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13h2', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13h2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>

                          </tr>


                          <tr>
                            <td>i)  Is there a functioning system for cold storage (Refrigerator)?</td>

                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13i1', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13i1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13i2', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13i2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>

                          </tr>

                          <tr>
                            <td>j)  If yes, are only reagents stored in the refrigerator – no food or beverage?</td>

                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13j1', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13j1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13j2', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13j2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>

                          </tr>

                          <tr>
                            <td>k)  Is the temperature of the refrigerator recorded daily?</td>

                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13k1', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13k1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13k2', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13k2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>

                          </tr>

                          <tr>
                            <td>l)   Boxes are not directly on the floor in the store</td>

                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13l1', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13l1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                              <div class="help-block with-errors"></div>
                            </td>
                            <td class="form-group has-feedback">
                              {{ Form::label('storage_management_13l2', '', ['class' => 'col-md-3 control-label hidden']) }}
                              {{ Form::text('storage_management_13l2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
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
                        {{ Form::hidden('storage_management_13_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}
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
                                {{ Form::text('storage_management_14a1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14a2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14a2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>

                              <td rowspan="8">
                                {{ Form::textarea('storage_management_14_comments',null,['class' => 'form-control','rows'=>'18', 'placeholder' => 'Comments']) }}
                              </td>
                            </tr>

                            <tr>
                              <td>b) Is there a place to store expired reagents separately?</td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14b1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14b1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14b2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14b2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>

                            </tr>


                            <tr>
                              <td>c) Is FEFO adhered to? (Check 5 randomly selected reagents)</td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14c1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>

                            </tr>


                            <tr>
                              <td>d) Are reagent bottles/kits  labelled with the date of opening ( enter date when the bottle was first opened)?</td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14d1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14d1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14d2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14d2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>

                            </tr>

                            <tr>
                              <td>e) Do all bottles that have been opened have a lid on?</td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14e1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14e1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14e2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14e2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>

                            </tr>

                            <tr>
                              <td>f) Are chemicals labelled with the chemical’s name and with hazard markings?</td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14f1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14f1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14f2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14f2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>

                            </tr>

                            <tr>
                              <td>g) Are flammable chemicals stored out of sunlight and below their flashpoint, preferably in a steel cabinet in a well-ventilated area?</td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14g1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14g1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14g2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14g2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>

                            </tr>
                            <tr>
                              <td>h) Are flammable and corrosive agents stored separate from one another?</td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14h1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14h1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                <div class="help-block with-errors"></div>
                              </td>
                              <td class="form-group has-feedback">
                                {{ Form::label('storage_management_14h2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('storage_management_14h2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
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
                          {{ Form::hidden('storage_management_14_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}
                        </p>
                      </div>
                    </div>

                  </section>

                  <h2>Ordering, receipt and reporting</h2>
                  <section data-step="3">

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
                                      {{ Form::label('ordering_15a1', '', ['class' => 'col-md-3 control-label hidden']) }}                                                {{ Form::text('ordering_15a1',null,['class' => 'form-control input-sm custom-input-md']) }}
                                    </div>
                                    <div class="col-md-3">
                                      Issued out
                                      {{ Form::label('ordering_15a2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                      {{ Form::text('ordering_15a2',null,['class' => 'form-control input-sm custom-input-md','maxlength'=>'6']) }}
                                    </div>
                                    <div class="col-md-3">
                                      {{ Form::label('ordering_15a3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                      AMC{{ Form::text('ordering_15a3',null,['class' => 'form-control input-sm custom-input-md','maxlength'=>'6']) }}
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-3">
                                      Maximum quantity
                                      {{ Form::label('ordering_15a4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                      {{ Form::text('ordering_15a4',null,['class' => 'form-control input-sm custom-input-md','maxlength'=>'6']) }}
                                    </div>
                                    <div class="col-md-3">
                                      {{ Form::label('ordering_15a5', '', ['class' => 'col-md-3 control-label hidden']) }}
                                      Quantity to order{{ Form::text('ordering_15a5',null,['class' => 'form-control input-sm custom-input-md','maxlength'=>'6']) }}
                                    </div>
                                  </div>

                                  <br><br>
                                  Score 1 if quantity to order is correct otherwise 0 or NR for missing order forms

                                </td>
                                <td class="form-group has-feedback">
                                  {{ Form::label('ordering_15a', '', ['class' => 'col-md-3 control-label hidden']) }}
                                  {{ Form::text('ordering_15a',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)$','maxlength'=>'2','required'=>'required']) }}
                                  <div class="help-block with-errors"></div>
                                </td>
                                <td rowspan="3">
                                  {{ Form::textarea('ordering_15_comments',null,['class' => 'form-control','rows'=>'7', 'placeholder' => 'Comments']) }}
                                </td>
                              </tr>

                              <tr>
                                <td>b) Is there a TEST MENU at laboratory facility on the day of visit?  </td>
                                <td class="form-group has-feedback">
                                  {{ Form::label('ordering_15b', '', ['class' => 'col-md-3 control-label hidden']) }}
                                  {{ Form::text('ordering_15b',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)$','maxlength'=>'2','required'=>'required']) }}
                                  <div class="help-block with-errors"></div>
                                </td>

                              </tr>

                              <tr>
                                <td>c) Review 3 previous orders and identify any 5 commodities that appear in all the orders.
                                </br>Score  1 if all items that are vital else 0 (refer to  EMHS LIST for Uganda by level)
                              </td>
                              <td class="form-group has-feedback">
                                {{ Form::label('ordering_15c', '', ['class' => 'col-md-3 control-label hidden']) }}
                                {{ Form::text('ordering_15c',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)$','maxlength'=>'2','required'=>'required']) }}
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
                        {{ Form::hidden('ordering_15_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}
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
                                  {{ Form::text('ordering_16a',null,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                </td>

                                <td rowspan="6">
                                  {{ Form::textarea('ordering_16_comments',null,['class' => 'form-control','rows'=>'14', 'placeholder' => 'Comments']) }}
                                </td>
                              </tr>

                              <tr>
                                <td>b) Actual date of ordering by facility (write date stamped by in-charge) </td>
                                <td>
                                  {{ Form::label('ordering_16b', '', ['class' => 'col-md-3 control-label hidden']) }}
                                  {{ Form::text('ordering_16b',null,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                </td>

                              </tr>

                              <tr>
                                <td>c) Was ordering timely (Y=1/N=0)? </td>
                                <td class="form-group has-feedback">
                                  {{ Form::label('ordering_16c', '', ['class' => 'col-md-3 control-label hidden']) }}
                                  {{ Form::text('ordering_16c',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)$','maxlength'=>'2','required'=>'required']) }}
                                  <div class="help-block with-errors"></div>
                                </td>
                              </tr>

                              <tr>
                                <td>d) Delivery schedule date </td>
                                <td>{{ Form::label('ordering_16d', '', ['class' => 'col-md-3 control-label hidden']) }}
                                  {{ Form::text('ordering_16d',null,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                </td>

                              </tr>

                              <tr>
                                <td>e) Date of delivery from warehouse </td>
                                <td>{{ Form::label('ordering_16e', '', ['class' => 'col-md-3 control-label hidden']) }}
                                  {{ Form::text('ordering_16e',null,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                </td>

                              </tr>

                              <tr>
                                <td>f) Was delivery on schedule (timely) (Y=1/N=0)? </td>
                                <td class="form-group has-feedback">
                                  {{ Form::label('ordering_16f', '', ['class' => 'col-md-3 control-label hidden']) }}
                                  {{ Form::text('ordering_16f',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NR permitted','pattern'=>'^[0-1]|(NR)$','maxlength'=>'2','required'=>'required']) }}
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
                          {{ Form::hidden('ordering_16_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}
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
                                    {{ Form::text('ordering_17a',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                    <div class="help-block with-errors"></div>
                                  </td>

                                  <td>
                                    {{ Form::textarea('ordering_17_comments',null,['class' => 'form-control','rows'=>'3', 'placeholder' => 'Comments']) }}
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
                            {{ Form::hidden('ordering_17_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}
                          </div>
                        </div>

                      </section>

                      <h2>Laboratory equipment</h2>
                      <section data-step="4">
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
                                      {{ Form::text('lab_equipment_18a',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                      <div class="help-block with-errors"></div>
                                    </td>

                                    <td rowspan="4">
                                      {{ Form::textarea('lab_equipment_18_comments',null,['class' => 'form-control','rows'=>'8', 'placeholder' => 'Comments']) }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>b) Does the facility have an equipment inventory(yes= 1, No=0) </td>
                                    <td class="form-group has-feedback">
                                      {{ Form::label('lab_equipment_18b', '', ['class' => 'col-md-3 control-label hidden']) }}
                                      {{ Form::text('lab_equipment_18b',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                      <div class="help-block with-errors"></div>
                                    </td>

                                  </tr>
                                  <tr>
                                    <td>c) Has the inventory been updated  in the last 1 year see a copy of the form last updated in the last 1 year  (yes= 1, No=0) </td>
                                    <td class="form-group has-feedback">
                                      {{ Form::label('lab_equipment_18c', '', ['class' => 'col-md-3 control-label hidden']) }}
                                      {{ Form::text('lab_equipment_18c',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                      <div class="help-block with-errors"></div>
                                    </td>

                                  </tr>
                                  <tr>
                                    <td>d) Is equipment standardization guideline available at the facility? (see a copy of the form and (yes= 1, No=0) </td>
                                    <td class="form-group has-feedback">
                                      {{ Form::label('lab_equipment_18d', '', ['class' => 'col-md-3 control-label hidden']) }}
                                      {{ Form::text('lab_equipment_18d',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
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
                              {{ Form::hidden('lab_equipment_18_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}
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
                                      {{ Form::text('lab_equipment_19a',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[(0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                      <div class="help-block with-errors"></div>
                                    </td>

                                    <td rowspan="4">
                                      {{ Form::textarea('lab_equipment_19_comments',null,['class' => 'form-control','rows'=>'12', 'placeholder' => 'Comments']) }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>b) Is major equipment routinely serviced according to schedule and documented in the service logs? (check records and any available platform need to be a yes to score a 1) </td>
                                    <td class="form-group has-feedback">
                                      {{ Form::label('lab_equipment_19b', '', ['class' => 'col-md-3 control-label hidden']) }}
                                      {{ Form::text('lab_equipment_19b',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[(0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                      <div class="help-block with-errors"></div>
                                    </td>

                                  </tr>
                                  <tr>
                                    <td>c) Is internal quality control (IQC) performed for CD4, heamatology and clinical chemistry/colorimeter equipment, documented, and reviewed prior to release of patient results? (Review the last 5 days the test were done (look in the lab register) check records and any available platform need to be a yes to score a 1) </td>
                                    <td class="form-group has-feedback">
                                      {{ Form::label('lab_equipment_19c', '', ['class' => 'col-md-3 control-label hidden']) }}
                                      {{ Form::text('lab_equipment_19c',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[(0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                      <div class="help-block with-errors"></div>
                                    </td>

                                  </tr>
                                  <tr>
                                    <td>d) Are the manufacturers’ operator manuals for major equipment (CD4, heamatology and clinical chemistry/calorimeter) readily available? (check records and any available platform need to be a yes to score a 1) </td>
                                    <td class="form-group has-feedback">
                                      {{ Form::label('lab_equipment_19d', '', ['class' => 'col-md-3 control-label hidden']) }}
                                      {{ Form::text('lab_equipment_19d',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[(0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
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
                              {{ Form::hidden('lab_equipment_19_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}

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
                                        {{ Form::text('lab_equipment_20a1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20a2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20a2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0-12 permitted','pattern'=>'^([0-9]|[1-9][0-2])|(NA)$','maxlength'=>'2']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20a3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20a3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20a4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20a4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20a5', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20a5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20a6', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20a6',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>

                                      <td rowspan="6">
                                        {{ Form::textarea('lab_equipment_20_comments',null,['class' => 'form-control','rows'=>'15', 'placeholder' => 'Comments']) }}
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>b) Hematology </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20b1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20b1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20b2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20b2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0-12 permitted','pattern'=>'^([0-9]|[1-9][0-2])|(NA)$','maxlength'=>'2']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20b3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20b3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20b4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20b4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20b5', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20b5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20b6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                                                                      {{ Form::text('lab_equipment_20b6',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>

                                    </tr>
                                    <tr>
                                      <td>c) Microscope </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20c1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20c1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20c2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 1-12 permitted','pattern'=>'^([0-9]|[1-9][0-2])|(NA)$','maxlength'=>'2']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20c3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20c4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20c4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20c5', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20c5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20c6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                                                                      {{ Form::text('lab_equipment_20c6',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>


                                    </tr>
                                    <tr>
                                      <td>d) Centrifuge </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20d1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20d1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20d2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20d2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 1-12 permitted','pattern'=>'^([0-9]|[1-9][0-2])|(NA)$','maxlength'=>'2']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20d3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20d3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20d4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20d4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20d5', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20d5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20d6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                                                                      {{ Form::text('lab_equipment_20d6',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td>e) HB meter </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20e1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20e1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20e2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20e2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 1-12 permitted','pattern'=>'^([0-9]|[1-9][0-2])|(NA)$','maxlength'=>'2']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20e3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20e3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20e4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20e4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20e5', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20e5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20e6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                                                                      {{ Form::text('lab_equipment_20e6',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>

                                    </tr>

                                    <tr>
                                      <td>f) Chemistry </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20f1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20f1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20f2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20f2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 1-12 permitted','pattern'=>'^([0-9]|[1-9][0-2])|(NA)$','maxlength'=>'2']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20f3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20f3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20f4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20f4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20f5', '', ['class' => 'col-md-3 control-label hidden']) }}
                                        {{ Form::text('lab_equipment_20f5',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                      </td>
                                      <td class="form-group has-feedback">
                                        {{ Form::label('lab_equipment_20f6', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                                                                      {{ Form::text('lab_equipment_20f6',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                {{ Form::hidden('lab_equipment_20_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}
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
                                          {{ Form::text('cd4_facs_presto_21e2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('cd4_facs_presto_21e3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('cd4_facs_presto_21e3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="cd4_facs_presto_21e4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="cd4_facs_presto_21e5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="cd4_facs_presto_21e6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('cd4_facs_presto_21e7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('cd4_facs_presto_21e7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('cd4_facs_calibre_21a2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('cd4_facs_calibre_21a3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('cd4_facs_calibre_21a3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="cd4_facs_calibre_21a4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="cd4_facs_calibre_21a5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="cd4_facs_calibre_21a6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('cd4_facs_calibre_21a7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('cd4_facs_calibre_21a7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('cd4_facs_count_21b2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('cd4_facs_count_21b3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('cd4_facs_count_21b3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="cd4_facs_count_21b4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="cd4_facs_count_21b5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="cd4_facs_count_21b6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('cd4_facs_count_21b7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('cd4_facs_count_21b7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('cd4_partec_count_21c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('cd4_partec_count_21c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('cd4_partec_count_21c3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="cd4_partec_count_21c4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="cd4_partec_count_21c5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="cd4_partec_count_21c6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('cd4_partec_count_21c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('cd4_partec_count_21c7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('cd4_pima_21d2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('cd4_pima_21d3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('cd4_pima_21d3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="cd4_pima_21d4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="cd4_pima_21d5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="cd4_pima_21d6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('cd4_pima_21d7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('cd4_pima_21d7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('chemistry_c311_21a2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('chemistry_c311_21a3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('chemistry_c311_21a3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="chemistry_c311_21a4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="chemistry_c311_21a5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="chemistry_c311_21a6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('chemistry_c311_21a7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('chemistry_c311_21a7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('chemistry_c111_21b2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('chemistry_c111_21b3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('chemistry_c111_21b3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="chemistry_c111_21b4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="chemistry_c111_21b5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="chemistry_c111_21b6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('chemistry_c111_21b7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('chemistry_c111_21b7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('haematology_huma600_21a2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_huma600_21a3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_huma600_21a3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="haematology_huma600_21a4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_huma600_21a5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_huma600_21a6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_huma600_21a7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_huma600_21a7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('haematology_huma30TS_21b2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_huma30TS_21b3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_huma30TS_21b3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="haematology_huma30TS_21b4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_huma30TS_21b5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_huma30TS_21b6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_huma30TS_21b7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_huma30TS_21b7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('haematology_huma60TS_21c2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_huma60TS_21c3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_huma60TS_21c3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="haematology_huma60TS_21c4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_huma60TS_21c5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_huma60TS_21c6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_huma60TS_21c7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_huma60TS_21c7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('haematology_mind3200_21e2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_mind3200_21e3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_mind3200_21e3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="haematology_mind3200_21e4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_mind3200_21e5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_mind3200_21e6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_mind3200_21e7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_mind3200_21e7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('haematology_mind3000_21f2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_mind3000_21f3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_mind3000_21f3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="haematology_mind3000_21f4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_mind3000_21f5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_mind3000_21f6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_mind3000_21f7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_mind3000_21f7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('haematology_mind2800_21j2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_mind2800_21j3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_mind2800_21j3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="haematology_mind2800_21j4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_mind2800_21j5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_mind2800_21j6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_mind2800_21j7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_mind2800_21j7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('haematology_mind2300_21i2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_mind2300_21i3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_mind2300_21i3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="haematology_mind2300_21i4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_mind2300_21i5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_mind2300_21i6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_mind2300_21i7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_mind2300_21i7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('haematology_medonic_21k2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_medonic_21k3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_medonic_21k3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="haematology_medonic_21k4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_medonic_21k5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_medonic_21k6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_medonic_21k7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_medonic_21k7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('haematology_sysmex100_21g2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_sysmex100_21g3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_sysmex100_21g3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="haematology_sysmex100_21g4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_sysmex100_21g5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_sysmex100_21g6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_sysmex100_21g7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_sysmex100_21g7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                          {{ Form::text('haematology_sysmex300_21h2',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only NA or 0-31 permitted','pattern'=>'^([0-9]|[1-2][0-9]|[3][0-1])|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_sysmex300_21h3', '', ['class' => 'col-md-3 control-label hidden']) }}{{ Form::text('haematology_sysmex300_21h3',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
                                          <div class="help-block with-errors"></div>
                                        </td>
                                        <td><p class="form-control-static text-center"><span id="haematology_sysmex300_21h4"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_sysmex300_21h5"></span></p></td>
                                        <td><p class="form-control-static text-center"><span id="haematology_sysmex300_21h6"></span></p></td>
                                        <td class="form-group has-feedback">
                                          {{ Form::label('haematology_sysmex300_21h7', '', ['class' => 'col-md-3 control-label hidden']) }}
                                          {{ Form::text('haematology_sysmex300_21h7',null,['class' => 'form-control input-sm custom-input-sm','pattern'=>'^(\d+)|(NA)$','data-error'=>'Only NA or digits permitted','required'=>'required']) }}
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
                                  {{ Form::hidden('lab_equipment_21_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}

                                </div>
                              </div>
                            </section>


                            <h2>Laboratory information system</h2>
                            <section data-step="5">

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
                                            {{ Form::text('lab_info_system_22a',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>

                                          <td rowspan="14">
                                            {{ Form::textarea('lab_info_system_22_comments',null,['class' => 'form-control','rows'=>'40', 'placeholder' => 'Comments']) }}
                                          </td>
                                        </tr>

                                        <tr>
                                          <td>b) HC IV daily activity Register HMIS form 055a2? </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22b', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22b',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>

                                        </tr>

                                        <tr>
                                          <td>c) General hospital daily activity register HMIS form 055a3
                                          </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22c', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22c',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td>d) Daily activity log for HIV test kits (HMIS form 055a4) </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22d', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22d',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>

                                        </tr>

                                        <tr>
                                          <td>e) TB Register (HMIS form 089)
                                          </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22e', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22e',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>f) Clinical Chemistry Register (HMIS form 090)? </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22f', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22f',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>

                                        </tr>

                                        <tr>
                                          <td>g) Blood Transfusion Record (HMIS form 091B
                                          </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22g', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22g',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td>h) CD 4 Register (HMIS form 095) </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22h', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22h',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>

                                        </tr>

                                        <tr>
                                          <td>i) Haematological Indices  HMIS form 094
                                          </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22i', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22i',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>j) Microbiology & Serology Lab Register (HMIS form 093) </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22j', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22j',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>

                                        </tr>

                                        <tr>
                                          <td>k) Facility Monthly Summary report (HMIS 105 (stock status report (section 6 page 8)
                                          </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22k', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22k',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>
                                        </tr>


                                        <tr>
                                          <td>l) Facility Monthly Summary report (HMIS 105-Section 7 page 9)
                                          </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22l', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22l',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td>m) Laboratory reagents & consumable order form HMIS form 018b </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22m', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22m',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                            <div class="help-block with-errors"></div>
                                          </td>

                                        </tr>

                                        <tr>
                                          <td>n) Bi-Monthly report & order calculation form for HIV test kits HMIS form 018b2
                                          </td>
                                          <td class="form-group has-feedback">
                                            {{ Form::label('lab_info_system_22n', '', ['class' => 'col-md-3 control-label hidden']) }}
                                            {{ Form::text('lab_info_system_22n',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
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
                                    {{ Form::hidden('lab_info_system_22_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required']) }}
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
                                              {{ Form::text('lab_info_system_23a',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                              <div class="help-block with-errors"></div>
                                            </td>

                                            <td rowspan="2">
                                              {{ Form::textarea('lab_info_system_23_comments',null,['class' => 'form-control','rows'=>'4', 'placeholder' => 'Comments']) }}
                                            </td>
                                          </tr>

                                          <tr>
                                            <td>b) Does the facility have HMIS reports for all the previous 2 months(verify , if all Score 1 otherwise 0)? </td>
                                            <td class="form-group has-feedback">
                                              {{ Form::label('lab_info_system_23b', '', ['class' => 'col-md-3 control-label hidden']) }}
                                              {{ Form::text('lab_info_system_23b',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
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
                                      {{ Form::hidden('lab_info_system_23_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required'])  }}
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
                                                {{ Form::text('lab_info_system_24a',null,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                              </td>

                                              <td rowspan="3">
                                                {{ Form::textarea('lab_info_system_24_comments',null,['class' => 'form-control','rows'=>'6', 'placeholder' => 'Comments']) }}
                                              </td>
                                            </tr>

                                            <tr>
                                              <td>b) Date HMIS 105 Section 7 page 9 report was submitted to the district </td>
                                              <td>
                                                {{ Form::label('lab_info_system_24b', '', ['class' => 'col-md-3 control-label hidden']) }}                                                             {{ Form::text('lab_info_system_24b',null,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>c) Was the HMIS 105 Section 7 page 9 report submitted to the health sub district on time (Yes=1/No=0) </td>
                                              <td class="form-group has-feedback">
                                                {{ Form::label('lab_info_system_24c', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                {{ Form::text('lab_info_system_24c',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required','readonly'=>'readonly']) }}
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
                                        {{ Form::hidden('lab_info_system_24_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required'])   }}
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
                                                  {{ Form::text('lab_info_system_25a',null,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                                </td>

                                                <td rowspan="3">
                                                  {{ Form::textarea('lab_info_system_25_comments',null,['class' => 'form-control','rows'=>'6', 'placeholder' => 'Comments']) }}
                                                </td>
                                              </tr>

                                              <tr>
                                                <td>b) HMIS 105 report section 6 is completely filled (No blanks left) then score 1 ELSE 0 </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25b', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25b',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>c) HMIS 105 report section 7 is completely filled (No blanks left) then score 1 ELSE 0 </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25c', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25c',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
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
                                                <td>a) Date report was filled
                                                </td>
                                                <td>
                                                  {{ Form::label('lab_info_system_25a', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25a',null,['class' => 'form-control date', 'data-provide' => 'datepicker',   'data-date-format' => 'dd MM yyyy']) }}
                                                </td>

                                                <td rowspan="3">
                                                  {{ Form::label('lab_info_system_25_comments', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::textarea('lab_info_system_25_comments',null,['class' => 'form-control','rows'=>'6', 'placeholder' => 'Comments']) }}
                                                </td>
                                              </tr>

                                              <tr>
                                                <td>b) HMIS 105 report section 6 is completely filled (No blanks left) then score 1 ELSE 0 </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25b', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25b',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>c) HMIS 105 report section 7 is completely filled (No blanks left) then score 1 ELSE 0 </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25c', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25c',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
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
                                                  {{ Form::text('lab_info_system_25ca1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25ca2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25ca2',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25ca3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25ca3',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25ca4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25ca4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>

                                              </tr>

                                              <tr>
                                                <td>b) Urinalysis </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cb1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cb1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cb2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cb2',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cb3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cb3',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cb4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cb4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>

                                              </tr>

                                              <tr>
                                                <td>c) Stool Microscopy </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cc1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cc1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cc2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cc2',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cc3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cc3',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cc4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cc4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>

                                              </tr>

                                              <tr>
                                                <td>d) HIV </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cd1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cd1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cd2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cd2',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cd3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cd3',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cd4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cd4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>

                                              </tr>

                                              <tr>
                                                <td>e) Syphilis (TPHA) test </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25ce1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25ce1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25ce2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25ce2',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25ce3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25ce3',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25ce4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25ce4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>

                                              </tr>

                                              <tr>
                                                <td>f) Pregnancy test </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cf1', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cf1',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cf2', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cf2',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cf3', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cf3',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required', 'data-error'=>'Only digits or NA permitted','pattern'=>'^(\d+)|(NA)$']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_25cf4', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_25cf4',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0,1 or NA permitted','pattern'=>'^[0-1]|(NA)$','maxlength'=>'2','readonly'=>'readonly']) }}
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
                                          {{ Form::hidden('lab_info_system_25_score',null,['class' => 'form-control input-sm custom-input-sm hidden','required'=>'required'])
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
                                                  {{ Form::text('lab_info_system_26a',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                                <td rowspan="2">
                                                  {{ Form::textarea('lab_info_system_26_comments',null,['class' => 'form-control','rows'=>'4', 'placeholder' => 'Comments']) }}
                                                </td>
                                              </tr>

                                              <tr>
                                                <td>b) Updated in last quarter
                                                </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_26b', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_26b',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
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
                                          {{ Form::hidden('lab_info_system_26_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required'])
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
                                                  {{ Form::text('lab_info_system_27a',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>

                                                <td rowspan="6">
                                                  {{ Form::textarea('lab_info_system_27_comments',null,['class' => 'form-control','rows'=>'10', 'placeholder' => 'Comments']) }}
                                                </td>
                                              </tr>

                                              <tr>
                                                <td>b) Bi-Monthly report & HIV test kit order calculation form </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_27b', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_27b',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>

                                              </tr>

                                              <tr>
                                                <td>c) HMIS 018 </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_27c', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_27c',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
                                                  <div class="help-block with-errors"></div>
                                                </td>
                                              </tr>


                                              <tr>
                                                <td>d) Requisition & issue vouchers </td>
                                                <td class="form-group has-feedback">
                                                  {{ Form::label('lab_info_system_27d', '', ['class' => 'col-md-3 control-label hidden']) }}
                                                  {{ Form::text('lab_info_system_27d',null,['class' => 'form-control input-sm custom-input-sm', 'data-error'=>'Only 0 or 1 permitted','pattern'=>'^[0-1]$','maxlength'=>'2','required'=>'required']) }}
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
                                          {{ Form::hidden('lab_info_system_27_score',null,['class' => 'form-control input-sm custom-input-sm','required'=>'required'])
                                        }}
                                      </div>
                                    </div>
                                  </section>
                                  {{ Form::close() }}


                                </div>
                              </div>


                              @endsection

                              @section('page-js-script')


                              <script type="text/javascript">

                                $(document).ready(function() {


                                  $('#profileForm')
                                  .steps({
                                    headerTag: 'h2',
                                    bodyTag: 'section',
                                    onStepChanged: function(e, currentIndex, priorIndex) {
                                      // You don't need to care about it
                                      // It is for the specific demo
                                      //adjustIframeHeight();
                                    },
                                    // Triggered when clicking the Previous/Next buttons
                                    onStepChanging: function(e, currentIndex, newIndex) {
                                      var fv         = $('#profileForm').data('formValidation'), // FormValidation instance
                                      // The current step container
                                      $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

                                      // Validate the container
                                      fv.validateContainer($container);

                                      var isValidStep = fv.isValidContainer($container);

                                      // Allways allow previous action even if the current form is not valid!
                                      if ( (currentIndex > newIndex) && (isValidStep === false || isValidStep === null) )
                                      {
                                        return true;
                                      }

                                      // Do not jump to the next step
                                      if (isValidStep === false || isValidStep === null) {

                                        return false;
                                      }


                                      if(currentIndex==0)
                                      {

                                        $("#section-0").LoadingOverlay("show",
                                        {
                                          image       : "",
                                          fontawesome : "fa fa-spinner fa-spin"
                                        });

                                        var d2 = new Array();
                                        d2 = $("#general_d2").val();

                                        var d4 = new Array();
                                        d4 = $("#general_d4").val();


                                        var supervisedList = new Array();
                                        for(i=0; i< $('#supervised_counter').val(); i++)
                                        {
                                          supervisedList.push( {name: $('#name'+i).val(),  gender:  $('#gender'+i).val(),  cadre:$('#profession'+i).val(),  telephone:  $('#mobile'+i).val()} );
                                        }


                                        var supervisorList = new Array();
                                        for(i=0; i< $('#supervised_counter').val(); i++)
                                        {
                                          supervisorList.push( { supervisor_id: $('#supervisor_name'+i).val() } );
                                        }

                                        var data = {
                                          facility_id: $('#facility_id').val(),
                                          visit_date: $('#visit_date').val(),
                                          next_visit_date: $('#next_visit_date').val(),
                                          visit_number: $('#visit_number').val(),

                                          d1:$('#general_d1').val(),
                                          d2:d2,
                                          d2comment:$('#general_d2_comment').val(),
                                          d3:$('#general_d3').val(),
                                          d3comment:$('#general_d3_comment').val(),
                                          d4:d4,
                                          d4comment:$('#general_d4_comment').val(),
                                          d5:$('#general_d5').val(),
                                          supervisedList:supervisedList,
                                          supervisorList:supervisorList,

                                          responsible_lss:$('#responsible_lss').val(),
                                          in_charge_name:$('#in_charge_name').val(),
                                          in_charge_telephone:$('#in_charge_telephone').val(),

                                          "_token": "{{ csrf_token() }}"
                                        };


                                        $.ajax({
                                          type: 'POST',
                                          url: '/save_survey_summary',
                                          data: data
                                        }).done(function(response) {

                                          $("#form_id").val(response.form_id);

                                          toastr.success("1/6");
                                          $("#section-0").LoadingOverlay("hide", true);


                                        }).fail(function (jqXHR, textStatus, errorThrown) {
                                          //TODO handle fails on note post backs.
                                          console.log(textStatus + ' : ' + errorThrown);
                                        });

                                      }

                                      if(currentIndex==1)
                                      {

                                        $("#section-0").LoadingOverlay("show",
                                        {
                                          image       : "",
                                          fontawesome : "fa fa-spinner fa-spin"
                                        });


                                        var data = {
                                          facility_id: $('#facility_id').val(),
                                          form_id: $('#form_id').val(),
                                          visit_date:$('#visit_date').val(),
                                          stock_management_comments:$('#stock_management_comments').val(),

                                          indicator1_score : $('#stock_management_1_score').val(),
                                          indicator2_score : $('#stock_management_2_score').val(),
                                          indicator3_score : $('#stock_management_3_score').val(),
                                          indicator4_score : $('#stock_management_4_score').val(),
                                          indicator5_score : $('#stock_management_5_score').val(),
                                          indicator6_score : $('#stock_management_6_score').val(),
                                          indicator7_score : $('#stock_management_7_score').val(),
                                          indicator8_score : $('#stock_management_8_score').val(),
                                          indicator9_score : $('#stock_management_9_score').val(),

                                          r1_c1:$('#r1_c1').val(),
                                          r1_c2:$('#r1_c2').val(),
                                          r1_c3:$('#r1_c3').val(),
                                          r1_c4:$('#r1_c4').val(),
                                          r1_c5:$('#r1_c5').val(),
                                          r1_c6:$('#r1_c6').val(),
                                          r1_c7:$('#r1_c7').val(),
                                          r1_c8:$('#r1_c8').val(),
                                          r1_c9:$('#r1_c9').val(),
                                          r1_c10:$('#r1_c10').val(),
                                          r1_c11:$('#r1_c11').val(),
                                          r1_c12:$('#r1_c12').val(),
                                          r1_c13:$('#r1_c13').val(),
                                          r1_c14:$('#r1_c14').val(),
                                          r1_c15:$('#r1_c15').val(),
                                          r1_c16:$('#r1_c16').val(),
                                          r1_c17:$('#r1_c17').val(),
                                          r1_c18:$('#r1_c18').val(),
                                          r1_c19:$('#r1_c19').val(),
                                          r1_c20:$('#r1_c20').val(),
                                          r1_c21:$('#r1_c21').val(),
                                          r1_c22:$('#r1_c22').val(),
                                          cd4_testing:$('#cd4_testing').val(),

                                          r2_c1:$('#r2_c1').val(),
                                          r2_c2:$('#r2_c2').val(),
                                          r2_c3:$('#r2_c3').val(),
                                          r2_c4:$('#r2_c4').val(),
                                          r2_c5:$('#r2_c5').val(),
                                          r2_c6:$('#r2_c6').val(),
                                          r2_c7:$('#r2_c7').val(),
                                          r2_c8:$('#r2_c8').val(),
                                          r2_c9:$('#r2_c9').val(),
                                          r2_c10:$('#r2_c10').val(),
                                          r2_c11:$('#r2_c11').val(),
                                          r2_c12:$('#r2_c12').val(),
                                          r2_c13:$('#r2_c13').val(),
                                          r2_c14:$('#r2_c14').val(),
                                          r2_c15:$('#r2_c15').val(),
                                          r2_c16:$('#r2_c16').val(),
                                          r2_c17:$('#r2_c17').val(),
                                          r2_c18:$('#r2_c18').val(),
                                          r2_c19:$('#r2_c19').val(),
                                          r2_c20:$('#r2_c20').val(),
                                          r2_c21:$('#r2_c21').val(),
                                          r2_c22:$('#r2_c22').val(),

                                          r3_c1:$('#r3_c1').val(),
                                          r3_c2:$('#r3_c2').val(),
                                          r3_c3:$('#r3_c3').val(),
                                          r3_c4:$('#r3_c4').val(),
                                          r3_c5:$('#r3_c5').val(),
                                          r3_c6:$('#r3_c6').val(),
                                          r3_c7:$('#r3_c7').val(),
                                          r3_c8:$('#r3_c8').val(),
                                          r3_c9:$('#r3_c9').val(),
                                          r3_c10:$('#r3_c10').val(),
                                          r3_c11:$('#r3_c11').val(),
                                          r3_c12:$('#r3_c12').val(),
                                          r3_c13:$('#r3_c13').val(),
                                          r3_c14:$('#r3_c14').val(),
                                          r3_c15:$('#r3_c15').val(),
                                          r3_c16:$('#r3_c16').val(),
                                          r3_c17:$('#r3_c17').val(),
                                          r3_c18:$('#r3_c18').val(),
                                          r3_c19:$('#r3_c19').val(),
                                          r3_c20:$('#r3_c20').val(),
                                          r3_c21:$('#r3_c21').val(),
                                          r3_c22:$('#r3_c22').val(),

                                          r4_c1:$('#r4_c1').val(),
                                          r4_c2:$('#r4_c2').val(),
                                          r4_c3:$('#r4_c3').val(),
                                          r4_c4:$('#r4_c4').val(),
                                          r4_c5:$('#r4_c5').val(),
                                          r4_c6:$('#r4_c6').val(),
                                          r4_c7:$('#r4_c7').val(),
                                          r4_c8:$('#r4_c8').val(),
                                          r4_c9:$('#r4_c9').val(),
                                          r4_c10:$('#r4_c10').val(),
                                          r4_c11:$('#r4_c11').val(),
                                          r4_c12:$('#r4_c12').val(),
                                          r4_c13:$('#r4_c13').val(),
                                          r4_c14:$('#r4_c14').val(),
                                          r4_c15:$('#r4_c15').val(),
                                          r4_c16:$('#r4_c16').val(),
                                          r4_c17:$('#r4_c17').val(),
                                          r4_c18:$('#r4_c18').val(),
                                          r4_c19:$('#r4_c19').val(),
                                          r4_c20:$('#r4_c20').val(),
                                          r4_c21:$('#r4_c21').val(),
                                          r4_c22:$('#r4_c22').val(),

                                          r5_c1:$('#r5_c1').val(),
                                          r5_c2:$('#r5_c2').val(),
                                          r5_c3:$('#r5_c3').val(),
                                          r5_c4:$('#r5_c4').val(),
                                          r5_c5:$('#r5_c5').val(),
                                          r5_c6:$('#r5_c6').val(),
                                          r5_c7:$('#r5_c7').val(),
                                          r5_c8:$('#r5_c8').val(),
                                          r5_c9:$('#r5_c9').val(),
                                          r5_c10:$('#r5_c10').val(),
                                          r5_c11:$('#r5_c11').val(),
                                          r5_c12:$('#r5_c12').val(),
                                          r5_c13:$('#r5_c13').val(),
                                          r5_c14:$('#r5_c14').val(),
                                          r5_c15:$('#r5_c15').val(),
                                          r5_c16:$('#r5_c16').val(),
                                          r5_c17:$('#r5_c17').val(),
                                          r5_c18:$('#r5_c18').val(),
                                          r5_c19:$('#r5_c19').val(),
                                          r5_c20:$('#r5_c20').val(),
                                          r5_c21:$('#r5_c21').val(),
                                          r5_c22:$('#r5_c22').val(),

                                          r6_c1:$('#r6_c1').val(),
                                          r6_c2:$('#r6_c2').val(),
                                          r6_c3:$('#r6_c3').val(),
                                          r6_c4:$('#r6_c4').val(),
                                          r6_c5:$('#r6_c5').val(),
                                          r6_c6:$('#r6_c6').val(),
                                          r6_c7:$('#r6_c7').val(),
                                          r6_c8:$('#r6_c8').val(),
                                          r6_c9:$('#r6_c9').val(),
                                          r6_c10:$('#r6_c10').val(),
                                          r6_c11:$('#r6_c11').val(),
                                          r6_c12:$('#r6_c12').val(),
                                          r6_c13:$('#r6_c13').val(),
                                          r6_c14:$('#r6_c14').val(),
                                          r6_c15:$('#r6_c15').val(),
                                          r6_c16:$('#r6_c16').val(),
                                          r6_c17:$('#r6_c17').val(),
                                          r6_c18:$('#r6_c18').val(),
                                          r6_c19:$('#r6_c19').val(),
                                          r6_c20:$('#r6_c20').val(),
                                          r6_c21:$('#r6_c21').val(),
                                          r6_c22:$('#r6_c22').val(),

                                          r7_c1:$('#r7_c1').val(),
                                          r7_c2:$('#r7_c2').val(),
                                          r7_c3:$('#r7_c3').val(),
                                          r7_c4:$('#r7_c4').val(),
                                          r7_c5:$('#r7_c5').val(),
                                          r7_c6:$('#r7_c6').val(),
                                          r7_c7:$('#r7_c7').val(),
                                          r7_c8:$('#r7_c8').val(),
                                          r7_c9:$('#r7_c9').val(),
                                          r7_c10:$('#r7_c10').val(),
                                          r7_c11:$('#r7_c11').val(),
                                          r7_c12:$('#r7_c12').val(),
                                          r7_c13:$('#r7_c13').val(),
                                          r7_c14:$('#r7_c14').val(),
                                          r7_c15:$('#r7_c15').val(),
                                          r7_c16:$('#r7_c16').val(),
                                          r7_c17:$('#r7_c17').val(),
                                          r7_c18:$('#r7_c18').val(),
                                          r7_c19:$('#r7_c19').val(),
                                          r7_c20:$('#r7_c20').val(),
                                          r7_c21:$('#r7_c21').val(),
                                          r7_c22:$('#r7_c22').val(),

                                          r8_c1:$('#r8_c1').val(),
                                          r8_c2:$('#r8_c2').val(),
                                          r8_c3:$('#r8_c3').val(),
                                          r8_c4:$('#r8_c4').val(),
                                          r8_c5:$('#r8_c5').val(),
                                          r8_c6:$('#r8_c6').val(),
                                          r8_c7:$('#r8_c7').val(),
                                          r8_c8:$('#r8_c8').val(),
                                          r8_c9:$('#r8_c9').val(),
                                          r8_c10:$('#r8_c10').val(),
                                          r8_c11:$('#r8_c11').val(),
                                          r8_c12:$('#r8_c12').val(),
                                          r8_c13:$('#r8_c13').val(),
                                          r8_c14:$('#r8_c14').val(),
                                          r8_c15:$('#r8_c15').val(),
                                          r8_c16:$('#r8_c16').val(),
                                          r8_c17:$('#r8_c17').val(),
                                          r8_c18:$('#r8_c18').val(),
                                          r8_c19:$('#r8_c19').val(),
                                          r8_c20:$('#r8_c20').val(),
                                          r8_c21:$('#r8_c21').val(),
                                          r8_c22:$('#r8_c22').val(),

                                          r9_c1:$('#r9_c1').val(),
                                          r9_c2:$('#r9_c2').val(),
                                          r9_c3:$('#r9_c3').val(),
                                          r9_c4:$('#r9_c4').val(),
                                          r9_c5:$('#r9_c5').val(),
                                          r9_c6:$('#r9_c6').val(),
                                          r9_c7:$('#r9_c7').val(),
                                          r9_c8:$('#r9_c8').val(),
                                          r9_c9:$('#r9_c9').val(),
                                          r9_c10:$('#r9_c10').val(),
                                          r9_c11:$('#r9_c11').val(),
                                          r9_c12:$('#r9_c12').val(),
                                          r9_c13:$('#r9_c13').val(),
                                          r9_c14:$('#r9_c14').val(),
                                          r9_c15:$('#r9_c15').val(),
                                          r9_c16:$('#r9_c16').val(),
                                          r9_c17:$('#r9_c17').val(),
                                          r9_c18:$('#r9_c18').val(),
                                          r9_c19:$('#r9_c19').val(),
                                          r9_c20:$('#r9_c20').val(),
                                          r9_c21:$('#r9_c21').val(),
                                          r9_c22:$('#r9_c22').val(),

                                          r3b_c1:$('#r3b_c1').val(),
                                          r3b_c2:$('#r3b_c2').val(),
                                          r3b_c3:$('#r3b_c3').val(),
                                          r3b_c4:$('#r3b_c4').val(),
                                          r3b_c5:$('#r3b_c5').val(),
                                          r3b_c6:$('#r3b_c6').val(),
                                          r3b_c7:$('#r3b_c7').val(),
                                          r3b_c8:$('#r3b_c8').val(),
                                          r3b_c9:$('#r3b_c9').val(),
                                          r3b_c10:$('#r3b_c10').val(),
                                          r3b_c11:$('#r3b_c11').val(),
                                          r3b_c12:$('#r3b_c12').val(),
                                          r3b_c13:$('#r3b_c13').val(),
                                          r3b_c14:$('#r3b_c14').val(),
                                          r3b_c15:$('#r3b_c15').val(),
                                          r3b_c16:$('#r3b_c16').val(),
                                          r3b_c17:$('#r3b_c17').val(),
                                          r3b_c18:$('#r3b_c18').val(),
                                          r3b_c19:$('#r3b_c19').val(),
                                          r3b_c20:$('#r3b_c20').val(),
                                          r3b_c21:$('#r3b_c21').val(),
                                          r3b_c22:$('#r3b_c22').val(),

                                          r4b_c1:$('#r4b_c1').val(),
                                          r4b_c2:$('#r4b_c2').val(),
                                          r4b_c3:$('#r4b_c3').val(),
                                          r4b_c4:$('#r4b_c4').val(),
                                          r4b_c5:$('#r4b_c5').val(),
                                          r4b_c6:$('#r4b_c6').val(),
                                          r4b_c7:$('#r4b_c7').val(),
                                          r4b_c8:$('#r4b_c8').val(),
                                          r4b_c9:$('#r4b_c9').val(),
                                          r4b_c10:$('#r4b_c10').val(),
                                          r4b_c11:$('#r4b_c11').val(),
                                          r4b_c12:$('#r4b_c12').val(),
                                          r4b_c13:$('#r4b_c13').val(),
                                          r4b_c14:$('#r4b_c14').val(),
                                          r4b_c15:$('#r4b_c15').val(),
                                          r4b_c16:$('#r4b_c16').val(),
                                          r4b_c17:$('#r4b_c17').val(),
                                          r4b_c18:$('#r4b_c18').val(),
                                          r4b_c19:$('#r4b_c19').val(),
                                          r4b_c20:$('#r4b_c20').val(),
                                          r4b_c21:$('#r4b_c21').val(),
                                          r4b_c22:$('#r4b_c22').val(),

                                          "_token": "{{ csrf_token() }}"
                                        };


                                        $.ajax({
                                          type: 'POST',
                                          url: '/save_stock_management',
                                          data: data
                                        }).done(function(response) {

                                          toastr.success("2/6");
                                          $("#section-0").LoadingOverlay("hide", true);

                                        }).fail(function (jqXHR, textStatus, errorThrown) {
                                          //TODO handle fails on note post backs.
                                          console.log(textStatus + ' : ' + errorThrown);
                                        });

                                      }

                                      if(currentIndex==2)
                                      {

                                        $("#section-0").LoadingOverlay("show",
                                        {
                                          image       : "",
                                          fontawesome : "fa fa-spinner fa-spin"
                                        });


                                        var data = {
                                          facility_id: $('#facility_id').val(),
                                          form_id: $('#form_id').val(),
                                          visit_date:$('#visit_date').val(),

                                          indicator10_score : $('#storage_management_10_score').val(),
                                          indicator11_score : $('#storage_management_11_score').val(),
                                          indicator12_score : $('#storage_management_12_score').val(),
                                          indicator13_score : $('#storage_management_13_score').val(),
                                          indicator14_score : $('#storage_management_14_score').val(),

                                          storage_management_10_comments:$('#storage_management_10_comments').val(),
                                          storage_management_11_comments:$('#storage_management_11_comments').val(),
                                          storage_management_12_comments:$('#storage_management_12_comments').val(),
                                          storage_management_13_comments:$('#storage_management_13_comments').val(),
                                          storage_management_14_comments:$('#storage_management_14_comments').val(),

                                          storage_management_10a:$('#storage_management_10a').val(),
                                          storage_management_10b:$('#storage_management_10b').val(),
                                          storage_management_10c:$('#storage_management_10c').val(),
                                          storage_management_10d:$('#storage_management_10d').val(),

                                          storage_management_11a:$('#storage_management_11a').val(),
                                          storage_management_11b:$('#storage_management_11b').val(),
                                          storage_management_11c:$('#storage_management_11c').val(),
                                          storage_management_11d:$('#storage_management_11d').val(),
                                          storage_management_11e:$('#storage_management_11e').val(),

                                          storage_management_12a1:$('#storage_management_12a1').val(),
                                          storage_management_12b1:$('#storage_management_12b1').val(),
                                          storage_management_12c1:$('#storage_management_12c1').val(),
                                          storage_management_12d1:$('#storage_management_12d1').val(),
                                          storage_management_12e1:$('#storage_management_12e1').val(),

                                          storage_management_12a2:$('#storage_management_12a2').val(),
                                          storage_management_12b2:$('#storage_management_12b2').val(),
                                          storage_management_12c2:$('#storage_management_12c2').val(),
                                          storage_management_12d2:$('#storage_management_12d2').val(),
                                          storage_management_12e2:$('#storage_management_12e2').val(),

                                          storage_management_13a1:$('#storage_management_13a1').val(),
                                          storage_management_13b1:$('#storage_management_13b1').val(),
                                          storage_management_13c1:$('#storage_management_13c1').val(),
                                          storage_management_13d1:$('#storage_management_13d1').val(),
                                          storage_management_13e1:$('#storage_management_13e1').val(),
                                          storage_management_13f1:$('#storage_management_13f1').val(),
                                          storage_management_13g1:$('#storage_management_13g1').val(),
                                          storage_management_13h1:$('#storage_management_13h1').val(),
                                          storage_management_13i1:$('#storage_management_13i1').val(),
                                          storage_management_13j1:$('#storage_management_13j1').val(),
                                          storage_management_13k1:$('#storage_management_13k1').val(),
                                          storage_management_13l1:$('#storage_management_13l1').val(),

                                          storage_management_13a2:$('#storage_management_13a2').val(),
                                          storage_management_13b2:$('#storage_management_13b2').val(),
                                          storage_management_13c2:$('#storage_management_13c2').val(),
                                          storage_management_13d2:$('#storage_management_13d2').val(),
                                          storage_management_13e2:$('#storage_management_13e2').val(),
                                          storage_management_13f2:$('#storage_management_13f2').val(),
                                          storage_management_13g2:$('#storage_management_13g2').val(),
                                          storage_management_13h2:$('#storage_management_13h2').val(),
                                          storage_management_13i2:$('#storage_management_13i2').val(),
                                          storage_management_13j2:$('#storage_management_13j2').val(),
                                          storage_management_13k2:$('#storage_management_13k2').val(),
                                          storage_management_13l2:$('#storage_management_13l2').val(),

                                          storage_management_14a1:$('#storage_management_14a1').val(),
                                          storage_management_14b1:$('#storage_management_14b1').val(),
                                          storage_management_14c1:$('#storage_management_14c1').val(),
                                          storage_management_14d1:$('#storage_management_14d1').val(),
                                          storage_management_14e1:$('#storage_management_14e1').val(),
                                          storage_management_14f1:$('#storage_management_14f1').val(),
                                          storage_management_14g1:$('#storage_management_14g1').val(),
                                          storage_management_14h1:$('#storage_management_14h1').val(),

                                          storage_management_14a2:$('#storage_management_14a2').val(),
                                          storage_management_14b2:$('#storage_management_14b2').val(),
                                          storage_management_14c2:$('#storage_management_14c2').val(),
                                          storage_management_14d2:$('#storage_management_14d2').val(),
                                          storage_management_14e2:$('#storage_management_14e2').val(),
                                          storage_management_14f2:$('#storage_management_14f2').val(),
                                          storage_management_14g2:$('#storage_management_14g2').val(),
                                          storage_management_14h2:$('#storage_management_14h2').val(),

                                          "_token": "{{ csrf_token() }}"

                                        };


                                        $.ajax({
                                          type: 'POST',
                                          url: '/save_storage_management',
                                          data: data
                                        }).done(function(response) {

                                          toastr.success("3/6");
                                          $("#section-0").LoadingOverlay("hide", true);

                                        }).fail(function (jqXHR, textStatus, errorThrown) {
                                          //TODO handle fails on note post backs.
                                          console.log(textStatus + ' : ' + errorThrown);
                                        });

                                      }

                                      if(currentIndex==3)
                                      {

                                        $("#section-0").LoadingOverlay("show",
                                        {
                                          image       : "",
                                          fontawesome : "fa fa-spinner fa-spin"
                                        });


                                        var data = {
                                          facility_id: $('#facility_id').val(),
                                          form_id: $('#form_id').val(),
                                          visit_date:$('#visit_date').val(),

                                          indicator15_score : $('#ordering_15_score').val(),
                                          indicator16_score : $('#ordering_16_score').val(),
                                          indicator17_score : $('#ordering_17_score').val(),

                                          ordering_15_comments:$('#ordering_15_comments').val(),
                                          ordering_16_comments:$('#ordering_16_comments').val(),
                                          ordering_17_comments:$('#ordering_17_comments').val(),

                                          ordering_15a:$('#ordering_15a').val(),
                                          ordering_15a1:$('#ordering_15a1').val(),
                                          ordering_15a2:$('#ordering_15a2').val(),
                                          ordering_15a3:$('#ordering_15a3').val(),
                                          ordering_15b:$('#ordering_15b').val(),
                                          ordering_15c:$('#ordering_15c').val(),

                                          ordering_16a:$('#ordering_16a').val(),
                                          ordering_16b:$('#ordering_16b').val(),
                                          ordering_16c:$('#ordering_16c').val(),
                                          ordering_16d:$('#ordering_16d').val(),
                                          ordering_16e:$('#ordering_16e').val(),
                                          ordering_16f:$('#ordering_16f').val(),

                                          ordering_17a:$('#ordering_17a').val(),

                                          "_token": "{{ csrf_token() }}"

                                        };


                                        $.ajax({
                                          type: 'POST',
                                          url: '/save_ordering',
                                          data: data
                                        }).done(function(response) {

                                          toastr.success("4/6");
                                          $("#section-0").LoadingOverlay("hide", true);

                                        }).fail(function (jqXHR, textStatus, errorThrown) {
                                          //TODO handle fails on note post backs.
                                          console.log(textStatus + ' : ' + errorThrown);
                                        });

                                      }

                                      if(currentIndex==4)
                                      {

                                        $("#section-0").LoadingOverlay("show",
                                        {
                                          image       : "",
                                          fontawesome : "fa fa-spinner fa-spin"
                                        });


                                        var data = {
                                          facility_id: $('#facility_id').val(),
                                          form_id: $('#form_id').val(),
                                          visit_date:$('#visit_date').val(),

                                          indicator18_score : $('#lab_equipment_18_score').val(),
                                          indicator19_score : $('#lab_equipment_19_score').val(),
                                          indicator20_score : $('#lab_equipment_20_score').val(),
                                          indicator21_score : $('#lab_equipment_21_score').val(),

                                          lab_equipment_18_comments:$('#lab_equipment_18_comments').val(),
                                          lab_equipment_19_comments:$('#lab_equipment_19_comments').val(),
                                          lab_equipment_20_comments:$('#lab_equipment_20_comments').val(),
                                          //lab_equipment_21_comments:$('#lab_equipment_21_comments').val(),

                                          lab_equipment_18a:$('#lab_equipment_18a').val(),
                                          lab_equipment_18b:$('#lab_equipment_18b').val(),
                                          lab_equipment_18c:$('#lab_equipment_18c').val(),
                                          lab_equipment_18d:$('#lab_equipment_18d').val(),

                                          lab_equipment_19a:$('#lab_equipment_19a').val(),
                                          lab_equipment_19b:$('#lab_equipment_19b').val(),
                                          lab_equipment_19c:$('#lab_equipment_19c').val(),
                                          lab_equipment_19d:$('#lab_equipment_19d').val(),

                                          lab_equipment_20_cd4:$('#lab_equipment_20_cd4').val(),
                                          lab_equipment_20_hematology:$('#lab_equipment_20_hematology').val(),
                                          lab_equipment_20_chemistry:$('#lab_equipment_20_chemistry').val(),

                                          lab_equipment_20a1:$('#lab_equipment_20a1').val(),
                                          lab_equipment_20a2:$('#lab_equipment_20a2').val(),
                                          lab_equipment_20a3:$('#lab_equipment_20a3').val(),
                                          lab_equipment_20a4:$('#lab_equipment_20a4').val(),
                                          lab_equipment_20a5:$('#lab_equipment_20a5').val(),
                                          lab_equipment_20a6:$('#lab_equipment_20a6').val(),

                                          lab_equipment_20b1:$('#lab_equipment_20b1').val(),
                                          lab_equipment_20b2:$('#lab_equipment_20b2').val(),
                                          lab_equipment_20b3:$('#lab_equipment_20b3').val(),
                                          lab_equipment_20b4:$('#lab_equipment_20b4').val(),
                                          lab_equipment_20b5:$('#lab_equipment_20b5').val(),
                                          lab_equipment_20b6:$('#lab_equipment_20b6').val(),

                                          lab_equipment_20c1:$('#lab_equipment_20c1').val(),
                                          lab_equipment_20c2:$('#lab_equipment_20c2').val(),
                                          lab_equipment_20c3:$('#lab_equipment_20c3').val(),
                                          lab_equipment_20c4:$('#lab_equipment_20c4').val(),
                                          lab_equipment_20c5:$('#lab_equipment_20c5').val(),
                                          lab_equipment_20c6:$('#lab_equipment_20c6').val(),

                                          lab_equipment_20d1:$('#lab_equipment_20d1').val(),
                                          lab_equipment_20d2:$('#lab_equipment_20d2').val(),
                                          lab_equipment_20d3:$('#lab_equipment_20d3').val(),
                                          lab_equipment_20d4:$('#lab_equipment_20d4').val(),
                                          lab_equipment_20d5:$('#lab_equipment_20d5').val(),
                                          lab_equipment_20d6:$('#lab_equipment_20d6').val(),

                                          lab_equipment_20e1:$('#lab_equipment_20e1').val(),
                                          lab_equipment_20e2:$('#lab_equipment_20e2').val(),
                                          lab_equipment_20e3:$('#lab_equipment_20e3').val(),
                                          lab_equipment_20e4:$('#lab_equipment_20e4').val(),
                                          lab_equipment_20e5:$('#lab_equipment_20e5').val(),
                                          lab_equipment_20e6:$('#lab_equipment_20e6').val(),

                                          lab_equipment_20f1:$('#lab_equipment_20f1').val(),
                                          lab_equipment_20f2:$('#lab_equipment_20f2').val(),
                                          lab_equipment_20f3:$('#lab_equipment_20f3').val(),
                                          lab_equipment_20f4:$('#lab_equipment_20f4').val(),
                                          lab_equipment_20f5:$('#lab_equipment_20f5').val(),
                                          lab_equipment_20f6:$('#lab_equipment_20f6').val(),

                                          cd4_facs_presto_21e2:$('#cd4_facs_presto_21e2').val(),
                                          cd4_facs_presto_21e3:$('#cd4_facs_presto_21e3').val(),
                                          cd4_facs_presto_21e7:$('#cd4_facs_presto_21e7').val(),

                                          cd4_facs_calibre_21a2:$('#cd4_facs_calibre_21a2').val(),
                                          cd4_facs_calibre_21a3:$('#cd4_facs_calibre_21a3').val(),
                                          cd4_facs_calibre_21a7:$('#cd4_facs_calibre_21a7').val(),

                                          cd4_facs_count_21b2:$('#cd4_facs_count_21b2').val(),
                                          cd4_facs_count_21b3:$('#cd4_facs_count_21b3').val(),
                                          cd4_facs_count_21b7:$('#cd4_facs_count_21b7').val(),

                                          cd4_partec_count_21c2:$('#cd4_partec_count_21c2').val(),
                                          cd4_partec_count_21c3:$('#cd4_partec_count_21c3').val(),
                                          cd4_partec_count_21c7:$('#cd4_partec_count_21c7').val(),

                                          cd4_pima_21d2:$('#cd4_pima_21d2').val(),
                                          cd4_pima_21d3:$('#cd4_pima_21d3').val(),
                                          cd4_pima_21d7:$('#cd4_pima_21d7').val(),

                                          chemistry_c311_21a2:$('#chemistry_c311_21a2').val(),
                                          chemistry_c311_21a3:$('#chemistry_c311_21a3').val(),
                                          chemistry_c311_21a7:$('#chemistry_c311_21a7').val(),

                                          chemistry_c111_21b2:$('#chemistry_c111_21b2').val(),
                                          chemistry_c111_21b3:$('#chemistry_c111_21b3').val(),
                                          chemistry_c111_21b7:$('#chemistry_c111_21b7').val(),

                                          haematology_huma600_21a2:$('#haematology_huma600_21a2').val(),
                                          haematology_huma600_21a3:$('#haematology_huma600_21a3').val(),
                                          haematology_huma600_21a7:$('#haematology_huma600_21a7').val(),

                                          haematology_huma30TS_21b2:$('#haematology_huma30TS_21b2').val(),
                                          haematology_huma30TS_21b3:$('#haematology_huma30TS_21b3').val(),
                                          haematology_huma30TS_21b7:$('#haematology_huma30TS_21b7').val(),

                                          haematology_huma60TS_21c2:$('#haematology_huma60TS_21c2').val(),
                                          haematology_huma60TS_21c3:$('#haematology_huma60TS_21c3').val(),
                                          haematology_huma60TS_21c7:$('#haematology_huma60TS_21c7').val(),

                                          haematology_mind3200_21e2:$('#haematology_mind3200_21e2').val(),
                                          haematology_mind3200_21e3:$('#haematology_mind3200_21e3').val(),
                                          haematology_mind3200_21e7:$('#haematology_mind3200_21e7').val(),

                                          haematology_mind3000_21f2:$('#haematology_mind3000_21f2').val(),
                                          haematology_mind3000_21f3:$('#haematology_mind3000_21f3').val(),
                                          haematology_mind3000_21f7:$('#haematology_mind3000_21f7').val(),

                                          haematology_mind2800_21j2:$('#haematology_mind2800_21j2').val(),
                                          haematology_mind2800_21j3:$('#haematology_mind2800_21j3').val(),
                                          haematology_mind2800_21j7:$('#haematology_mind2800_21j7').val(),

                                          haematology_mind2300_21i2:$('#haematology_mind2300_21i2').val(),
                                          haematology_mind2300_21i3:$('#haematology_mind2300_21i3').val(),
                                          haematology_mind2300_21i7:$('#haematology_mind2300_21i7').val(),

                                          haematology_medonic_21k2:$('#haematology_medonic_21k2').val(),
                                          haematology_medonic_21k3:$('#haematology_medonic_21k3').val(),
                                          haematology_medonic_21k7:$('#haematology_medonic_21k7').val(),

                                          haematology_sysmex100_21g2:$('#haematology_sysmex100_21g2').val(),
                                          haematology_sysmex100_21g3:$('#haematology_sysmex100_21g3').val(),
                                          haematology_sysmex100_21g7:$('#haematology_sysmex100_21g7').val(),

                                          haematology_sysmex300_21h2:$('#haematology_sysmex300_21h2').val(),
                                          haematology_sysmex300_21h3:$('#haematology_sysmex300_21h3').val(),
                                          haematology_sysmex300_21h7:$('#haematology_sysmex300_21h7').val(),

                                          "_token": "{{ csrf_token() }}"

                                        };


                                        $.ajax({
                                          type: 'POST',
                                          url: '/save_equipment',
                                          data: data
                                        }).done(function(response) {

                                          toastr.success("6/6");
                                          $("#section-0").LoadingOverlay("hide", true);

                                        }).fail(function (jqXHR, textStatus, errorThrown) {
                                          //TODO handle fails on note post backs.
                                          console.log(textStatus + ' : ' + errorThrown);
                                        });

                                      }

                                      return true;
                                    },
                                    // Triggered when clicking the Finish button
                                    onFinishing: function(e, currentIndex) {
                                      var fv         = $('#profileForm').data('formValidation'),
                                      $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

                                      // Validate the last step container
                                      fv.validateContainer($container);

                                      var isValidStep = fv.isValidContainer($container);
                                      if (isValidStep === false || isValidStep === null) {
                                        return false;
                                      }

                                      if(currentIndex==5)
                                      {

                                        $("#section-0").LoadingOverlay("show",
                                        {
                                          image       : "",
                                          fontawesome : "fa fa-spinner fa-spin"
                                        });


                                        var data = {
                                          facility_id: $('#facility_id').val(),
                                          form_id: $('#form_id').val(),
                                          visit_date:$('#visit_date').val(),

                                          indicator22_score : $('#lab_info_system_22_score').val(),
                                          indicator23_score : $('#lab_info_system_23_score').val(),
                                          indicator24_score : $('#lab_info_system_24_score').val(),
                                          indicator25_score : $('#lab_info_system_25_score').val(),
                                          indicator26_score : $('#lab_info_system_26_score').val(),
                                          indicator27_score : $('#lab_info_system_27_score').val(),

                                          lab_info_system_22_comments:$('#lab_info_system_22_comments').val(),
                                          lab_info_system_23_comments:$('#lab_info_system_23_comments').val(),
                                          lab_info_system_24_comments:$('#lab_info_system_24_comments').val(),
                                          lab_info_system_25_comments:$('#lab_info_system_25_comments').val(),
                                          lab_info_system_26_comments:$('#lab_info_system_26_comments').val(),
                                          lab_info_system_27_comments:$('#lab_info_system_27_comments').val(),

                                          lab_info_system_22a:$('#lab_info_system_22a').val(),
                                          lab_info_system_22b:$('#lab_info_system_22b').val(),
                                          lab_info_system_22c:$('#lab_info_system_22c').val(),
                                          lab_info_system_22d:$('#lab_info_system_22d').val(),
                                          lab_info_system_22e:$('#lab_info_system_22e').val(),
                                          lab_info_system_22f:$('#lab_info_system_22f').val(),
                                          lab_info_system_22g:$('#lab_info_system_22g').val(),
                                          lab_info_system_22h:$('#lab_info_system_22h').val(),
                                          lab_info_system_22i:$('#lab_info_system_22i').val(),
                                          lab_info_system_22j:$('#lab_info_system_22j').val(),
                                          lab_info_system_22k:$('#lab_info_system_22k').val(),
                                          lab_info_system_22l:$('#lab_info_system_22l').val(),
                                          lab_info_system_22m:$('#lab_info_system_22m').val(),
                                          lab_info_system_22n:$('#lab_info_system_22n').val(),

                                          lab_info_system_23a:$('#lab_info_system_23a').val(),
                                          lab_info_system_23b:$('#lab_info_system_23b').val(),

                                          lab_info_system_24a:$('#lab_info_system_24a').val(),
                                          lab_info_system_24b:$('#lab_info_system_24b').val(),
                                          lab_info_system_24c:$('#lab_info_system_24c').val(),


                                          lab_info_system_25a:$('#lab_info_system_25a').val(),
                                          lab_info_system_25b:$('#lab_info_system_25b').val(),
                                          lab_info_system_25c:$('#lab_info_system_25c').val(),

                                          lab_info_system_25ba1:$('#lab_info_system_25ba1').val(),
                                          lab_info_system_25ba2:$('#lab_info_system_25ba2').val(),
                                          lab_info_system_25ba3:$('#lab_info_system_25ba3').val(),
                                          lab_info_system_25ba4:$('#lab_info_system_25ba4').val(),
                                          lab_info_system_25ba5:$('#lab_info_system_25ba5').val(),
                                          lab_info_system_25ba6:$('#lab_info_system_25ba6').val(),
                                          lab_info_system_25ba7:$('#lab_info_system_25ba7').val(),
                                          lab_info_system_25ba8:$('#lab_info_system_25ba8').val(),

                                          lab_info_system_25bb1:$('#lab_info_system_25bb1').val(),
                                          lab_info_system_25bb2:$('#lab_info_system_25bb2').val(),
                                          lab_info_system_25bb3:$('#lab_info_system_25bb3').val(),
                                          lab_info_system_25bb4:$('#lab_info_system_25bb4').val(),
                                          lab_info_system_25bb5:$('#lab_info_system_25bb5').val(),
                                          lab_info_system_25bb6:$('#lab_info_system_25bb6').val(),
                                          lab_info_system_25bb7:$('#lab_info_system_25bb7').val(),
                                          lab_info_system_25bb8:$('#lab_info_system_25bb8').val(),


                                          lab_info_system_25bc1:$('#lab_info_system_25bc1').val(),
                                          lab_info_system_25bc2:$('#lab_info_system_25bc2').val(),
                                          lab_info_system_25bc3:$('#lab_info_system_25bc3').val(),
                                          lab_info_system_25bc4:$('#lab_info_system_25bc4').val(),
                                          lab_info_system_25bc5:$('#lab_info_system_25bc5').val(),
                                          lab_info_system_25bc6:$('#lab_info_system_25bc6').val(),
                                          lab_info_system_25bc7:$('#lab_info_system_25bc7').val(),
                                          lab_info_system_25bc8:$('#lab_info_system_25bc8').val(),

                                          lab_info_system_25bd1:$('#lab_info_system_25bd1').val(),
                                          lab_info_system_25bd2:$('#lab_info_system_25bd2').val(),
                                          lab_info_system_25bd3:$('#lab_info_system_25bd3').val(),
                                          lab_info_system_25bd4:$('#lab_info_system_25bd4').val(),
                                          lab_info_system_25bd5:$('#lab_info_system_25bd5').val(),
                                          lab_info_system_25bd6:$('#lab_info_system_25bd6').val(),
                                          lab_info_system_25bd7:$('#lab_info_system_25bd7').val(),
                                          lab_info_system_25bd8:$('#lab_info_system_25bd8').val(),

                                          lab_info_system_25be1:$('#lab_info_system_25be1').val(),
                                          lab_info_system_25be2:$('#lab_info_system_25be2').val(),
                                          lab_info_system_25be3:$('#lab_info_system_25be3').val(),
                                          lab_info_system_25be4:$('#lab_info_system_25be4').val(),
                                          lab_info_system_25be5:$('#lab_info_system_25be5').val(),
                                          lab_info_system_25be6:$('#lab_info_system_25be6').val(),
                                          lab_info_system_25be7:$('#lab_info_system_25be7').val(),
                                          lab_info_system_25be8:$('#lab_info_system_25be8').val(),

                                          lab_info_system_25bf1:$('#lab_info_system_25bf1').val(),
                                          lab_info_system_25bf2:$('#lab_info_system_25bf2').val(),
                                          lab_info_system_25bf3:$('#lab_info_system_25bf3').val(),
                                          lab_info_system_25bf4:$('#lab_info_system_25bf4').val(),
                                          lab_info_system_25bf5:$('#lab_info_system_25bf5').val(),
                                          lab_info_system_25bf6:$('#lab_info_system_25bf6').val(),
                                          lab_info_system_25bf7:$('#lab_info_system_25bf7').val(),
                                          lab_info_system_25bf8:$('#lab_info_system_25bf8').val(),

                                          lab_info_system_25bg1:$('#lab_info_system_25bg1').val(),
                                          lab_info_system_25bg2:$('#lab_info_system_25bg2').val(),
                                          lab_info_system_25bg3:$('#lab_info_system_25bg3').val(),
                                          lab_info_system_25bg4:$('#lab_info_system_25bg4').val(),
                                          lab_info_system_25bg5:$('#lab_info_system_25bg5').val(),
                                          lab_info_system_25bg6:$('#lab_info_system_25bg6').val(),
                                          lab_info_system_25bg7:$('#lab_info_system_25bg7').val(),
                                          lab_info_system_25bg8:$('#lab_info_system_25bg8').val(),

                                          lab_info_system_25ca1:$('#lab_info_system_25ca1').val(),
                                          lab_info_system_25ca2:$('#lab_info_system_25ca2').val(),
                                          lab_info_system_25ca3:$('#lab_info_system_25ca3').val(),
                                          lab_info_system_25ca4:$('#lab_info_system_25ca4').val(),

                                          lab_info_system_25cb1:$('#lab_info_system_25cb1').val(),
                                          lab_info_system_25cb2:$('#lab_info_system_25cb2').val(),
                                          lab_info_system_25cb3:$('#lab_info_system_25cb3').val(),
                                          lab_info_system_25cb4:$('#lab_info_system_25cb4').val(),

                                          lab_info_system_25cc1:$('#lab_info_system_25cc1').val(),
                                          lab_info_system_25cc2:$('#lab_info_system_25cc2').val(),
                                          lab_info_system_25cc3:$('#lab_info_system_25cc3').val(),
                                          lab_info_system_25cc4:$('#lab_info_system_25cc4').val(),

                                          lab_info_system_25cd1:$('#lab_info_system_25cd1').val(),
                                          lab_info_system_25cd2:$('#lab_info_system_25cd2').val(),
                                          lab_info_system_25cd3:$('#lab_info_system_25cd3').val(),
                                          lab_info_system_25cd4:$('#lab_info_system_25cd4').val(),

                                          lab_info_system_25ce1:$('#lab_info_system_25ce1').val(),
                                          lab_info_system_25ce2:$('#lab_info_system_25ce2').val(),
                                          lab_info_system_25ce3:$('#lab_info_system_25ce3').val(),
                                          lab_info_system_25ce4:$('#lab_info_system_25ce4').val(),

                                          lab_info_system_25cf1:$('#lab_info_system_25cf1').val(),
                                          lab_info_system_25cf2:$('#lab_info_system_25cf2').val(),
                                          lab_info_system_25cf3:$('#lab_info_system_25cf3').val(),
                                          lab_info_system_25cf4:$('#lab_info_system_25cf4').val(),

                                          lab_info_system_26a:$('#lab_info_system_26a').val(),
                                          lab_info_system_26b:$('#lab_info_system_26b').val(),

                                          lab_info_system_27a:$('#lab_info_system_27a').val(),
                                          lab_info_system_27b:$('#lab_info_system_27b').val(),
                                          lab_info_system_27c:$('#lab_info_system_27c').val(),
                                          lab_info_system_27d:$('#lab_info_system_27d').val(),

                                          "_token": "{{ csrf_token() }}"

                                        };


                                        $.ajax({
                                          type: 'POST',
                                          url: '/save_info_system',
                                          data: data
                                        }).done(function(response) {

                                          toastr.success("6/6");
                                          $("#section-0").LoadingOverlay("hide", true);

                                        }).fail(function (jqXHR, textStatus, errorThrown) {
                                          //TODO handle fails on note post backs.
                                          console.log(textStatus + ' : ' + errorThrown);
                                        });

                                      }

                                      return true;
                                    },
                                    onFinished: function(e, currentIndex) {


                                      $("#section-0").LoadingOverlay("show",
                                      {
                                        image       : "",
                                        fontawesome : "fa fa-spinner fa-spin"
                                      });


                                      var data = {
                                        facility_id: $('#facility_id').val(),
                                        form_id: $('#form_id').val(),
                                        visit_date:$('#visit_date').val(),


                                        "_token": "{{ csrf_token() }}"

                                      };

                                      $.ajax({
                                        type: 'POST',
                                        url: '/end_wizard',
                                        data: data
                                      }).done(function(response) {

                                        toastr.success("6/6");
                                        $("#section-0").LoadingOverlay("hide", true);

                                      }).fail(function (jqXHR, textStatus, errorThrown) {
                                        //TODO handle fails on note post backs.
                                        console.log(textStatus + ' : ' + errorThrown);
                                      });


                                    }
                                  })
                                  .formValidation({
                                    framework: 'bootstrap',
                                    icon: {
                                      valid: 'glyphicon glyphicon-ok',
                                      invalid: 'glyphicon glyphicon-remove',
                                      validating: 'glyphicon glyphicon-refresh'
                                    },
                                    // This option will not ignore invisible fields which belong to inactive panels
                                    excluded: [':disabled',':hidden'],
                                    fields: {
                                      district_id: {
                                        validators: {
                                          notEmpty: {
                                            message: 'The district is required'
                                          }
                                        }
                                      },
                                      sub_district_id: {
                                        validators: {
                                          notEmpty: {
                                            message: 'The sub district is required'
                                          }
                                        }
                                      },
                                      facility_id: {
                                        validators: {
                                          notEmpty: {
                                            message: 'The facility is required'
                                          }
                                        }
                                      },
                                      visit_date: {
                                        validators: {
                                          notEmpty: {
                                            message: 'The visit date is required'
                                          }
                                        }
                                      },
                                      next_visit_date: {
                                        validators: {
                                          notEmpty: {
                                            message: 'The next visit date is required'
                                          }
                                        }
                                      },
                                      responsible_lss: {
                                        validators: {
                                          notEmpty: {
                                            message: 'The responsible LSS is required'
                                          }
                                        }
                                      }

                                    }




                                  });


                                });

                              </script>


                              <script>
                                $(function() {

                                  $('#district_id').select2({
                                    placeholder: 'Select district',
                                    width: '100%'
                                  });


                                  var i=1;
                                  $("#add_supervised_row").click(function(){
                                    $('#supervised'+i).html("<td>"+ (i+1) +"</td><td><input name='name"+i+"' id='name"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><select placeholder='Select gender' name='gender"+i+"' id='gender"+i+"' class='form-control input-sm js-example-basic-single'><option value='M'>Male</option><option value='F'>Female</option></select></td><td><select placeholder='Select profession' name='profession"+i+"' id='profession"+i+"' class='form-control js-example-basic-single'></select> </td><td><input id='mobile"+i+"' name='mobile"+i+"' class='form-control' placeholder='Telephone' pattern='^(07\d{8})$' type='number'></td>");

                                    $('#tab_supervised').append('<tr id="supervised'+(i+1)+'"></tr>');

                                    var k = parseInt( $('#supervised_counter').val()) + 1 ;
                                    $('#supervised_counter').val(k);

                                    $.ajax({
                                      type: 'GET',
                                      url: '/get_cadre_list',
                                    }).done(function(response) {
                                      $("select[name=profession"+(i-1)+"]").empty();

                                      $.each(response, function(key, value) {
                                        $("select[name=profession"+(i-1)+"]").append($("<option/>", {
                                          value: key,
                                          text: value
                                        }));
                                      });

                                    });

                                    //activate select2
                                    $('select').select2({
                                      allowClear: false,
                                      placeholder: function(){
                                        $(this).data('placeholder');
                                      }
                                    });


                                    i++;
                                  });

                                  $("#delete_supervised_row").click(function(){
                                    if(i>1){
                                      $("#supervised"+(i-1)).html('');
                                      i--;
                                      var k = parseInt( $('#supervised_counter').val()) - 1 ;
                                      $('#supervised_counter').val(k);

                                    }
                                  });

                                  var j=1;

                                  $("#add_supervisor_row").click(function(){
                                    $('#supervisor'+j).html("<td>"+ (j+1) +"</td><td><select placeholder='Select supervisor' name='supervisor_name"+j+"' id='supervisor_name"+j+"' class='form-control supervisor_dl input-sm js-example-basic-single'></select></td></td><td><input  name='telephone"+j+"'  pattern='^(07\d{8})$' type='number' placeholder='Telephone'  class='form-control input-sm'></td><td><input  name='title"+j+"' type='text' placeholder='Title'  class='form-control input-sm'></td>");
                                    $('#tab_supervisor').append('<tr id="supervisor'+(j+1)+'"></tr>');

                                    var k = parseInt( $('#supervisor_counter').val()) + 1 ;
                                    $('#supervisor_counter').val(k);

                                    $.ajax({
                                      type: 'GET',
                                      url: '/get_personnel_list',
                                    }).done(function(response) {
                                      $("select[name=supervisor_name"+(j)+"]").empty();

                                      $.each(response, function(key, value) {
                                        $("select[name=supervisor_name"+(j)+"]").append($("<option/>", {
                                          value: key,
                                          text: value
                                        }));

                                      });

                                      //activate select2
                                      $('select').select2({
                                        allowClear: false,
                                        placeholder: function(){
                                          $(this).data('placeholder');
                                        }
                                      });

                                      j++;

                                    });

                                  });

                                  $("#delete_supervisor_row").click(function(){
                                    if(j>1){
                                      $("#supervisor"+(j-1)).html('');
                                      j--;

                                      var k = parseInt( $('#supervisor_counter').val()) - 1 ;
                                      $('#supervisor_counter').val(k);

                                    }
                                  });


                                  //set next visit date to 2 months later
                                  $('#visit_date').change(function(e){

                                    var m = moment(e.target.value, 'DD MMMM YYYY');

                                    $('#next_visit_date').val(m.add(60,'d').format('DD MMMM YYYY'));


                                    var x = moment($('#visit_date').val(), 'DD MMMM YYYY');

                                    /*    $("#ordering_16a").datepicker({
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
                                    });*/

                                  });


                                  //set check for order and delivery dates
                                  $('#ordering_16b').change(function(e){

                                    var m = moment(e.target.value, 'DD MMMM YYYY');

                                    $("#ordering_16e").datepicker({
                                      startDate: m.add(0,'d').format( 'DD MMMM YYYY'),

                                    });

                                  });


                                  $('#sub_district_id').select2({
                                    placeholder: 'Select sub district',
                                    width: '100%'
                                  });


                                  $('#facility_id').select2({
                                    placeholder: 'Select facility',
                                    width: '100%'
                                  });


                                  $('select').select2({
                                    placeholder: 'Select',
                                    width: '100%'
                                  });

                                  $('#district_id').on('change',function(){

                                    var data = {
                                      district: $('#district_id').val(),
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



                                  $('#general_d1').change(function(e){

                                    $("#general_d2").html("");

                                    $("#general_d2").append('<option value="1">Main Store</option>');
                                    $("#general_d2").append('<option value="2">Laboratory Store</option>');
                                    $("#general_d2").append('<option value="3">Pharmacy Store</option>');
                                    $("#general_d2").append('<option value="4">Wards Store</option>');
                                    $("#general_d2").append('<option value="5">Cupboards in laboratory</option>');
                                    $("#general_d2").append('<option value="6">Others</option>');

                                    $("#general_d2 option[value="+ $('#general_d1').val() +"]").remove();

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

                                      $('#facility_level').val(json.facility.level);
                                      $('#ownership').val(json.facility.ownership);
                                      $('#in_charge_name').val(json.facility.in_charge_fname.concat(" ").concat(json.in_charge_lname));
                                      $('#in_charge_telephone').val(json.facility.in_charge_contact);
                                      $('#responsible_lss').val(json.facility.lss_fname.concat(" ").concat(json.lss_lname));
                                      $('#dhis_region').val(json.facility.region);
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

                                  $('#r1_c1,#r1_c3,#r1_c4,#r1_c5,#r1_c8,#r1_c13,#r1_c14,#r1_c15,#r1_c18,#r1_c20,#r2_c1,#r2_c3,#r2_c4,#r2_c5,#r2_c8,#r2_c13,#r2_c14,#r2_c15,#r2_c18,#r2_c20,#r3_c1,#r3_c3,#r3_c4,#r3_c5,#r3_c8,#r3_c13,#r3_c14,#r3_c15,#r3_c18,#r3_c20,#r3b_c1,#r3b_c3,#r3b_c4,#r3b_c5,#r3b_c8,#r3b_c13,#r3b_c14,#r3b_c15,#r3b_c18,#r3b_c20,#r4_c1,#r4_c3,#r4_c4,#r4_c5,#r4_c8,#r4_c13,#r4_c14,#r4_c15,#r4_c18,#r4_c20,#r4b_c1,#r4b_c3,#r4b_c4,#r4b_c5,#r4b_c8,#r4b_c13,#r4b_c14,#r4b_c15,#r4b_c18,#r4b_c20,#r5_c1,#r5_c3,#r5_c4,#r5_c5,#r5_c8,#r5_c13,#r5_c14,#r5_c15,#r5_c18,#r5_c20,#r6_c1,#r6_c3,#r6_c4,#r6_c5,#r6_c8,#r6_c13,#r6_c14,#r6_c15,#r6_c18,#r6_c20,#r7_c1,#r7_c3,#r7_c4,#r7_c5,#r7_c8,#r7_c13,#r7_c14,#r7_c15,#r7_c18,#r7_c20,#r8_c1,#r8_c3,#r8_c4,#r8_c5,#r8_c8,#r8_c13,#r8_c14,#r8_c15,#r8_c18,#r8_c20,#r9_c1,#r9_c3,#r9_c4,#r9_c5,#r9_c8,#r9_c13,#r9_c14,#r9_c15,#r9_c18,#r9_c20,#r1_c21,#r2_c21,#r3_c21,#r3b_c21,#r4_c21,#r4b_c21,#r5_c21,#r6_c21,#r7_c21,#r8_c21,#r9_c21,#lab_equipment_18a,#lab_equipment_18b,#lab_equipment_18c,#lab_equipment_18d,#lab_equipment_19a,#lab_equipment_19b,#lab_equipment_19c,#lab_equipment_19d,#lab_equipment_20a3,#lab_equipment_20b3,#lab_equipment_20c3,#lab_equipment_20d3,#lab_equipment_20e3,#lab_equipment_20f3,#lab_equipment_20a4,#lab_equipment_20b4,#lab_equipment_20c4,#lab_equipment_20d4,#lab_equipment_20e4,#lab_equipment_20f4,#lab_equipment_20a5,#lab_equipment_20b5,#lab_equipment_20c5,#lab_equipment_20d5,#lab_equipment_20e5,#lab_equipment_20f5,#lab_info_system_23a,#lab_info_system_23b,#lab_info_system_24c,#lab_info_system_25a,#lab_info_system_25b,#lab_info_system_25c,#lab_info_system_25b,#lab_info_system_25ba1,#lab_info_system_25bb1,#lab_info_system_25bc1,#lab_info_system_25bd1,#lab_info_system_25be1,#lab_info_system_25bf1,#lab_info_system_25bg1,#lab_info_system_25ca1,#lab_info_system_25cb1,#lab_info_system_25cc1,#lab_info_system_25cd1,#lab_info_system_25ce1,#lab_info_system_25cf1,#lab_info_system_26a,#lab_info_system_26b,#lab_info_system_27a,#lab_info_system_27b,#lab_info_system_27c,#lab_info_system_27d').keyup(function(e){


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



                                  $('#r1_c2,#r2_c2,#r3_c2,#r4_c2,#r5_c2,#r6_c2,#r7_c2,#r8_c2,#r9_c2,#r3b_c2,#r4b_c2').keyup(function(e){

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



                                  $('#r3b_c14').change(function(e){

                                    var value = $(this).val();


                                    if( value!=1 )
                                    {
                                      $('#r3b_c18,#r3b_c15,#r3b_c16,#r3b_c17').val('0').prop("readonly",true);
                                    }
                                    else
                                    {
                                      $('#r3b_c18,#r3b_c15,#r3b_c16,#r3b_c17').val('').prop("readonly",false);
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


                                  $('#r4b_c14').change(function(e){

                                    var value = $(this).val();


                                    if( value!=1 )
                                    {
                                      $('#r4b_c18,#r4b_c15,#r4b_c16,#r4b_c17').val('0').prop("readonly",true);
                                    }
                                    else
                                    {
                                      $('#r4b_c18,#r4b_c15,#r4b_c16,#r4b_c17').val('').prop("readonly",false);
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


                                  $('#lab_info_system_24a,#lab_info_system_24b').change(function(e){


                                    var m = moment( $('#lab_info_system_24a').val(), 'DD MMMM YYYY');
                                    var n = moment( $('#lab_info_system_24b').val(), 'DD MMMM YYYY');


                                    if( $('#lab_info_system_24a').val()!=null && $('#lab_info_system_24b').val()!=null  )
                                    {

                                      if(n<=m)
                                      {
                                        $('#lab_info_system_24c').val('1');
                                      }
                                      else
                                      {
                                        $('#lab_info_system_24c').val('0');
                                      }

                                    }

                                  });

                                  /*
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
                                  */

                                  $('#cd4_facs_calibre_21a2,#cd4_facs_count_21b2,#cd4_partec_count_21c2,#cd4_pima_21d2,cd4_facs_presto_21e2,#chemistry_c311_21a2,#chemistry_c111_21b2,#haematology_huma600_21a2,#haematology_huma30TS_21b2,#haematology_huma60TS_21c2,#haematology_huma5L_21d2,#haematology_mind3200_21e2,#haematology_mind3000_21f2,#haematology_sysmex100_21g2,#haematology_sysmex300_21h2,#lab_info_system_25ba3,#lab_info_system_25bb3,#lab_info_system_25bc3,#lab_info_system_25bd3,#lab_info_system_25be3,#lab_info_system_25bf3,#lab_info_system_25bg3,#lab_info_system_25ba6,#lab_info_system_25bb6,#lab_info_system_25bc6,#lab_info_system_25bd6,#lab_info_system_25be6,#lab_info_system_25bf6,#lab_info_system_25bg6').keyup(function(e){

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
                                });
                              </script>
                              @stop
