<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>

<script type="text/javascript" src="js/sweetalert2.min.js"></script>


<script>
  $('#subscribeBtn').on('click', function(event) {

    // Swal.fire('OK','done','success')

    let email = $('#email_value').val();

    // $.ajaxSetup({

    //   headers: {
    //     'X-CSRF-TOKEN': "{{ csrf_token() }}"
    //   }
    // });

    let myform = document.getElementById("subscribeForm");
        let form_data = new FormData(myform);

        
    $.ajax({
      method: "POST",
      url: '/subscribe',
      data: form_data,
      contentType: false,
      processData: false,
      success: function(data) {
        console.log(data);
        if (data.trim() == '1') {
          Swal.fire({
            title: 'Subscribed!',
            text: 'you have subscribed this site.',
            icon: 'success',
            confirmButtonText: 'OK'
          })

        } else {
          Swal.fire('Error', 'Please Login.', 'error');
        }
      }

    })

  });
</script>