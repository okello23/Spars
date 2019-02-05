// Shorthand for $( document ).ready()
$(function() {

    $('.custom-data-table').DataTable( {
  
      "scrollX": true,

      "columnDefs": [
        {"className": "text-center", "targets": "_all"}
      ],

    } );


    $('.audit-data-table').DataTable( {
  
      "scrollX": true,

      "columnDefs": [
        {"className": "text-left", "targets": "_all"}
      ],

    } );




    $('.score-data-table').DataTable( {
  
      "scrollX": true,

      "columnDefs": [
        {"className": "text-right", "targets": [4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31] },{"className": "col-md-2", "targets": [2] }
      ],

    } );

$('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
    e.preventDefault();
    var $form=$(this);
    $('#confirm').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            $form.submit();
        });
});


    $('.panel-heading span.clickable').click();
    $('.panel div.clickable').click();


    var i=1;
     $("#add_supervised_row").click(function(){
      $('#supervised'+i).html("<td>"+ (i+1) +"</td><td><input name='name"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><select placeholder='Select gender' name='sex"+i+"' class='form-control input-sm js-example-basic-single'><option value='M'>Male</option><option value='F'>Female</option></select></td><td><select placeholder='Select profession' name='profession"+i+"' class='form-control js-example-basic-single'></select> </td><td><input name='mobile"+i+"' class='form-control' placeholder='Telephone' pattern='^(07\d{8})$' type='number'></td>");

      $('#tab_supervised').append('<tr id="supervised'+(i+1)+'"></tr>');

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
         }
     });

      var j=1;

      $("#add_supervisor_row").click(function(){
        $('#supervisor'+j).html("<td>"+ (j+1) +"</td><td><select placeholder='Select supervisor' name='supervisor_name"+j+"' class='form-control supervisor_dl input-sm js-example-basic-single'></select></td></td><td><input  name='telephone"+j+"'  pattern='^(07\d{8})$' type='number' placeholder='Telephone'  class='form-control input-sm'></td><td><input  name='title"+j+"' type='text' placeholder='Title'  class='form-control input-sm'></td>");
        $('#tab_supervisor').append('<tr id="supervisor'+(j+1)+'"></tr>');

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
         }
     });


});

    $('.report-data-table').DataTable( {
      
            "scrollX": true
    } );

$(document).on('click', '.panel-heading span.clickable', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '.panel div.clickable', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});