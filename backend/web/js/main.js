$(function(){
  $('#modalButton').click(function(){
      jQuery('#modal').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
  });

  $(document).on('click','.language',function(){
        var lang = $(this).attr('id');
        $.post('index.php?r=site/language',{'lang':lang},function(data){
              location.reload();
        })
  });
/*
if($('#salesreport-from_date').length ){
      $('#salesreport-from_date').parent().datepicker({"autoclose":true,"format":"yyyy-mm-dd"});
      $('#salesreport-to_date').parent().datepicker({"autoclose":true,"format":"yyyy-mm-dd"});

      var kvGridInit=function(){
      $('#w1 .export-html').gridexport(kvGridExp_7aa7ed08);
      $('#w1 .export-csv').gridexport(kvGridExp_a1a7af77);
      $('#w1 .export-txt').gridexport(kvGridExp_c797b039);
      $('#w1 .export-xls').gridexport(kvGridExp_96267274);
      $('#w1 .export-json').gridexport(kvGridExp_446e7371);
      $('#w1-container').resizableColumns('destroy').resizableColumns({"store":null,"resizeFromBody":false});$('#w1-togdata-page').on('pjax:click',function(e){
            if(!window.confirm('There are 48 records. Are you sure you want to display them all?')){e.preventDefault();}
               });
      };
      kvGridInit();
      jQuery("#w1-pjax").on('pjax:timeout', function(e){e.preventDefault()}).on('pjax:send', function(){jQuery("#w1-container").addClass('kv-grid-loading')}).off('pjax:complete.a3d68b28').on('pjax:complete.a3d68b28', function(){setTimeout(kvGridInit_2ec688fe, 2500);jQuery("#w1-container").removeClass('kv-grid-loading');});
      
}*/
  
});

function showUpdateModal(id){
      $('#modal').modal('show')
      .find('#modalContent')
      .load($('#updateModalButton'+id).attr('value'));
}


function showViewModal(id){
      $('#modal').modal('show')
      .find('#modalContent')
      .load($('#viewModalButton'+id).attr('value'));
}

function showDeliveryAreasModal(id){
      $('#modal').modal('show')
      .find('#modalContent')
      .load($('#deliveryAreasModalButton'+id).attr('value'));
      
}

$('#modal').on('hidden.bs.modal', function() {
    $('#modalContent').empty(); //to clear the modal content after hide
})
