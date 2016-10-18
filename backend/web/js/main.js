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

function showViewModalByType(id,type){
      $('#modal').modal('show')
      .find('#modalContent')
      .load($('#viewModalButton_'+type+'_'+id).attr('value'));
}

function showUpdateModalByType(id,type){
      $('#modal').modal('show')
      .find('#modalContent')
      .load($('#updateModalButton_'+type+'_'+id).attr('value'));
}


function showDeliveryAreasModal(id){
      $('#modal').modal('show')
      .find('#modalContent')
      .load($('#deliveryAreasModalButton'+id).attr('value'));
      
}

function showUserShopsModal(id){
      $('#modal').modal('show')
      .find('#modalContent')
      .load($('#userShopsModalButton'+id).attr('value'));
      
}

function showUserPermModal(id){
      $('#modal').modal('show')
      .find('#modalContent')
      .load($('#userPermModalButton'+id).attr('value'));
      
}

$('#modal').on('hidden.bs.modal', function() {
    $('#modalContent').empty(); //to clear the modal content after hide
})

function activeWorkStatus(status,type) {
    $.ajax({ 
            type: "POST",
            url: "index.php?r=user/updatestatus",             
            dataType: "text",   //expect html to be returned    
            data:{'status':status,'type':type},            
            success: function (response) {
              if(response ==='OK'){
                    window.location.reload();
              }             
           }
         });
}
