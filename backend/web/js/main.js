$(document).ready(function(){
  $('#modalButton').click(function(){
      jQuery('#modal').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
  })
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
