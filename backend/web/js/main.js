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
