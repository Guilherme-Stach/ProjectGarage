$(document).ready(function () {
	  
	fetchMechanics();

});


function fetchMechanics(){

  $('#users_table').html("<div class=\"example-loading vertical-align text-center\""+ 
    "style=\"transform: translateZ(+/- value px);\">"+
    "<div class=\"loader vertical-align-middle loader-rotate-plane\"></div></div>");

  $(document.body).css({'cursor' : 'Wait'});
  $.ajax({
    url: "../endpoint/fetch_mechanics.php",
    type: "POST",
    data: {
      mode:1
  },
      success: function(data){
        var parsedResponse = JSON.parse(data);
        if(parsedResponse.response_code==1){
       
       $('#users_table').html(parsedResponse.data);
       $('#users-table').DataTable( { dom: 'Bfrtip', buttons: [ 'copy', 'csv','print' ] });
       
      }else{
            swal("", parsedResponse.response_message, "error");
        }
        $(document.body).css({'cursor' : 'default'});
      }
  });
}
