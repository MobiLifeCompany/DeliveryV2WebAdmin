$(document).ready(function(){
  $('#modalButton').click(function(){
      jQuery('#modal').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
  })
});


function showUpdateCountryModal(id){
      $('#updateModalButton'+id).click(function(){
      $('#modal').modal('show')
        .find('#modalContent')
      .load($(this).attr('value'));
  });
}


function showViewCountryModal(id){
      $('#viewModalButton'+id).click(function(){
      $('#modal').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
  });
}
