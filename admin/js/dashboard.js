$(document).ready(function () {
  fetchData();
});



function fetchData() {

  $(document.body).css({'cursor' : 'Wait'});
  $.ajax({
    url: "../endpoint/fetch_dashboard_data.php",
    type: "POST",
    data: {
      mode:1,
  },
      success: function(data){
        var parsedResponse = JSON.parse(data);
        if(parsedResponse.response_code==1){

          $('#total_users').html(parsedResponse.total_users);
          $('#total_bookings').html(parsedResponse.total_bookings);
      
        }else{
            swal("", parsedResponse.response_message, "error");
        }
        $(document.body).css({'cursor' : 'default'});
      }
  });
}
