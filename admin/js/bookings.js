$(document).ready(function () {
	  
	fetchBookings();

});


function fetchBookings(){

  $('#bookings_table').html("<div class=\"example-loading vertical-align text-center\""+ 
    "style=\"transform: translateZ(+/- value px);\">"+
    "<div class=\"loader vertical-align-middle loader-rotate-plane\"></div></div>");

  $(document.body).css({'cursor' : 'Wait'});
  $.ajax({
    url: "../endpoint/fetch_bookings.php",
    type: "POST",
    data: {
      mode:1
  },
      success: function(data){
        var parsedResponse = JSON.parse(data);
        if(parsedResponse.response_code==1){
       
       $('#bookings_table').html(parsedResponse.data);
       $('#exampleTableTools').DataTable( { dom: 'Bfrtip', buttons: [ 'copy', 'csv','print' ] });
       
      }else{
            swal("", parsedResponse.response_message, "error");
        }
        $(document.body).css({'cursor' : 'default'});
      }
  });
}
