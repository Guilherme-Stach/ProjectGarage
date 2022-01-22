$(document).ready(function () {
    
    fetchParts();

    printInvoice();
  
  });


  function printInvoice(){
  
    $('#invoice').html("<div class=\"example-loading vertical-align text-center\""+ 
      "style=\"transform: translateZ(+/- value px);\">"+
      "<div class=\"loader vertical-align-middle loader-rotate-plane\"></div></div>");
  
    var status = $("#booking_status").val().trim();
    var booking_id = $("#booking_id").val().trim();

    if(status != '3') {
        return;
    }
  
    $(document.body).css({'cursor' : 'Wait'});
    $.ajax({
      url: "../endpoint/fetch_invoice.php",
      type: "POST",
      data: {
        booking_id:booking_id
    },
        success: function(data){
          var parsedResponse = JSON.parse(data);
          if(parsedResponse.response_code==1){
         
         $('#invoice').html(parsedResponse.data);
         
        }else{
              swal("", parsedResponse.response_message, "error");
          }
          $(document.body).css({'cursor' : 'default'});
        }
    });
  }
  
  
  function fetchParts(){
  
    $('#parts_table').html("<div class=\"example-loading vertical-align text-center\""+ 
      "style=\"transform: translateZ(+/- value px);\">"+
      "<div class=\"loader vertical-align-middle loader-rotate-plane\"></div></div>");
  
    var booking_id = $("#booking_id").val().trim();
  
    $(document.body).css({'cursor' : 'Wait'});
    $.ajax({
      url: "../endpoint/fetch_parts.php",
      type: "POST",
      data: {
        booking_id:booking_id
    },
        success: function(data){
          var parsedResponse = JSON.parse(data);
          if(parsedResponse.response_code==1){
         
         $('#parts_table').html(parsedResponse.data);
         $('#parts-table').DataTable( {pageLength:5, dom: 'Bfrtip', buttons: [ {extend:'csv',filename: 'parts_table'},'print' ] });
         
        }else{
              swal("", parsedResponse.response_message, "error");
          }
          $(document.body).css({'cursor' : 'default'});
        }
    });
  }


function fetchMechanics(){
    
    $("#mechanic-list").html("<div class=\"example-loading vertical-align text-center\""+ 
      "style=\"transform: translateZ(+/- value px);\">"+
      "<div class=\"loader vertical-align-middle loader-rotate-plane\"></div></div>");       
    
    $.ajax({
      url: "../endpoint/fetch_mechanic_list.php",
        type: "POST",
        data: {
      },
        success: function(data){
            var parsedResponse = JSON.parse(data);
            if(parsedResponse.response_code==1){
              $("#mechanic-list").html(parsedResponse.data);

            }else if (parsedResponse.response_code==2){
              swal(parsedResponse.response_message, {
                      icon: "error",closeOnEsc: false,closeOnClickOutside: false,
                  }).then((value) => {
                      window.location='../index.php';
                  });
            }else{
                swal("", parsedResponse.response_message, "error");
            }
            $(document.body).css({'cursor' : 'default'});
            
        }
    });
}

function assignMechanic(booking_id) {
  
    fetchMechanics();
    $('#addMechanicModal').modal('show');
  
  
}


function addMechanic() {

    var form_data = new FormData();
  
    var booking_id =$('#booking_id').val().trim();
    if(booking_id =="" ){
        swal("", 'Booking ID cannot be empty', "error");
        return false;
  
    }
  
    var mechanic_id  = $('#select-mechanic').val().trim();
    if(mechanic_id==""||mechanic_id=="-1"){
      swal("",'Please select mechanic',"error");
      return false;
    }
  
    form_data.append("booking_id",booking_id);
    form_data.append("mechanic_id",mechanic_id);
  
    $('#btn_addmechanic').html('Please Wait...');
    $("#btn_addmechanic").prop('disabled', true);
  
    $.ajax({
      url: "../endpoint/assign_mechanic.php",
        method:"POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data){
            var parsedResponse = JSON.parse(data);
            if(parsedResponse.response_code==1){     
  
                swal("", parsedResponse.response_message, "success");
                location.reload();
          
                           
            }else{
                swal("", parsedResponse.response_message, "error");
            }
            $(document.body).css({'cursor' : 'default'});
            $('#btn_addmechanic').html('Asign');
            $("#btn_addmechanic").prop('disabled', false);
            
        }
    });
  }



function showAddPartModel() {
  
    $('#addPartsModal').modal('show');
  
  
}


function addPart() {

    var form_data = new FormData();
  
    var booking_id =$('#booking_id').val().trim();
    if(booking_id =="" ){
        swal("", 'Booking ID cannot be empty', "error");
        return false;
  
    }
  
    var part_id  = $('#select-part').val().trim();
    if(part_id==""||part_id=="-1"){
      swal("",'Please select part',"error");
      return false;
    }
  
    form_data.append("booking_id",booking_id);
    form_data.append("part_id",part_id);
  
    $('#btn_addpart').html('Please Wait...');
    $("#btn_addpart").prop('disabled', true);
  
    $.ajax({
      url: "../endpoint/add_part.php",
        method:"POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data){
            var parsedResponse = JSON.parse(data);
            if(parsedResponse.response_code==1){     
  
                swal("", parsedResponse.response_message, "success");
                fetchParts();
                $('#addPartsModal').modal('hide');
          
                           
            }else{
                swal("", parsedResponse.response_message, "error");
            }
            $(document.body).css({'cursor' : 'default'});
            $('#btn_addpart').html('Add');
            $("#btn_addpart").prop('disabled', false);
            
        }
    });
  }


  function deletePart(booking_id,part_id) {
    swal({
      title:'',
      text:"Are you sure you want to remove this Part!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      buttons: ['No', 'Yes']
    })
    .then((willDelete) => {
      $('#btn_delete_'+booking_id+part_id).prop('disabled', true);
      if (willDelete) {
        $.ajax({
          url: "../endpoint/delete_part.php",
          type: "POST",
          data: {
            booking_id:booking_id,
            part_id:part_id
          },
          success: function(data){
            var parsedResponse = JSON.parse(data);
            if(parsedResponse.response_code==1){
              swal("", parsedResponse.response_message, "success");
              fetchParts();
            }else if (parsedResponse.response_code==2){
              swal(parsedResponse.response_message, {
                icon: "error",closeOnEsc: false,closeOnClickOutside: false,
              }).then((value) => {
                window.location='../index.php';
              });
            }else{
              swal("", parsedResponse.response_message, "error");
            }
            
          }
        });
      }
      $('#btn_delete_'+booking_id+part_id).prop('disabled', false);
      $(document.body).css({'cursor' : 'default'});
    });
  }


  function markCompleted(type_cost) {

    var booking_id =$('#booking_id').val().trim();
    if(booking_id =="" ){
        swal("", 'Booking ID cannot be empty', "error");
        return false;
  
    }

    swal({
      title:'',
      text:"Are you sure you want to mark this booking completed!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      buttons: ['No', 'Yes']
    })
    .then((willDelete) => {
      $('#mark_completed').prop('disabled', true);
      if (willDelete) {
        $.ajax({
          url: "../endpoint/mark_completed.php",
          type: "POST",
          data: {
            booking_id:booking_id,
            type_cost:type_cost
          },
          success: function(data){
            var parsedResponse = JSON.parse(data);
            if(parsedResponse.response_code==1){
              swal("", parsedResponse.response_message, "success");
              location.reload();
            }else if (parsedResponse.response_code==2){
              swal(parsedResponse.response_message, {
                icon: "error",closeOnEsc: false,closeOnClickOutside: false,
              }).then((value) => {
                window.location='../index.php';
              });
            }else{
              swal("", parsedResponse.response_message, "error");
            }
            
          }
        });
      }
      $('#mark_completed').prop('disabled', false);
      $(document.body).css({'cursor' : 'default'});
    });
  }