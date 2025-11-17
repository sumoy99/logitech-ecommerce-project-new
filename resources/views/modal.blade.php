<div class="offcanvas offcanvas-end eOffcanvas" data-bs-scroll="true" tabindex="-1" id="offcanvasScrollingRightBS" aria-labelledby="offcanvasScrollingRightLabel">
    <div class="offcanvas-header">
      <div class="eDisplay-5" id="offcanvasRightLabel">Loading...</div>
      <a href="#" class="offcanvas-btn"
        data-bs-dismiss="offcanvas" aria-label="Close">
        <svg xmlns='http://www.w3.org/2000/svg'
          viewBox='0 0 16 16'>
          <path
            d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z' />
        </svg>
      </a>
    </div>
    <div class="offcanvas-body" id="offcanvasScrollingRightLabel">
        Loading...
    </div>
  </div>
  <script type="text/javascript">
  
    "use strict";
  
    function rightModal(url, title) {
  var myOffcanvas = document.getElementById('offcanvasScrollingRightBS');
  var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
  bsOffcanvas.show();
  $('#offcanvasRightLabel').html(title);

  $.ajax({
    type: "get",
    url: url,
    success: function(response) {
      $("#offcanvasScrollingRightLabel").html(response);

      // ✅ Now that content is added, initialize the color preview
      initColorPreview();
    }
  });
}

  </script>
  
  <div class="modal fade" id="confirmModal" aria-hidden="true" aria-labelledby="confirmModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
      <div class="modal-content py-4">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title w-100 text-center">Heads up</h5>
        </div>
        <div class="modal-body text-center">Are you sure?</div>
        <div class="modal-footer d-block border-top-0 text-center">
          <button type="button" class="btn btn-secondary modal-btn-close" data-bs-dismiss="modal" aria-label="Close">Back</button>
          <a href="javascript:;" id="continue_btn" class="btn btn-danger">Continue</a>
        </div>
      </div>
    </div>
  </div>
  
  
  <div class="modal eModal fade" id="confirmSweetAlerts" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div
      class="modal-dialog modal-dialog-centered sweet-alerts text-sweet-alerts">
      <div class="modal-content">
        <div class="modal-body">
          <div class="icon icon-confirm">
            <svg xmlns="http://www.w3.org/2000/svg" height="48"
              width="48">
              <path
                d="M22.5 29V10H25.5V29ZM22.5 38V35H25.5V38Z" />
            </svg>
          </div>
          <p>Are you sure?</p>
          <p class="focus-text">You won't able to revert this!</p>
          <div class="confirmBtn">
            <a href="javascript:;" id="confirmBtn" class="eBtn eBtn-green">
              <button type="button" id="confirmBtn" class="eBtn eBtn-green">Yes</button>
            </a>
            <button type="button" class="eBtn eBtn-red"
              data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script type="text/javascript">
  
    "use strict";
  
    function confirmModal(deleteUrl, callBackFunction){
      var confirmModal = new bootstrap.Modal(document.getElementById('confirmSweetAlerts'), {
        keyboard: false
      });
      confirmModal.show();
  
      if(callBackFunction == 'undefined')
      {
        $('#confirmBtn').attr('href', deleteUrl);
      }
      else if(callBackFunction == 'ajax_delete')
      {
          $('#confirmBtn').attr('onclick',deleteUrl);
      }
      else{
        $('#confirmBtn').attr('onclick', "deleteDataUsingAjax('"+deleteUrl+"', "+callBackFunction+");");
      }
    }
  
    function deleteDataUsingAjax(url, callBackFunction){
      
      $.ajax({
        type:"POST",
        url: url,
        success: function(response){
          callBackFunction();
  
          if(response){
            var jsonResponse = JSON.parse(response);
            if(jsonResponse.status == 'error'){
                error_message(jsonResponse.message);
            }else{
              if(jsonResponse.redirect){
                  window.location.replace(jsonResponse.redirect);
              }else{
                  success_message(jsonResponse.message);
              }
            }
          }
        }
      });
    }
  


    $(document).on('click', '.revert-btn', function () {
    const url = $(this).data('url');
    const token = $('meta[name="csrf-token"]').attr('content');

    swal({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        buttons: ["Cancel", "Yes, delete!"],
        dangerMode: true,
    }).then(confirmed => {
        if (confirmed) {
            $.get(url, { _token: token })
                .done(() => {
                    swal("Deleted!", "Removed Successfully.", "success").then(() => location.reload());
                })
                .fail(() => {
                    swal("Error!", "Something went wrong.", "error");
                });
        }
    });
});


  // Place this in your blade or main JS
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
tooltipTriggerList.forEach(function (tooltipTriggerEl) {
  new bootstrap.Tooltip(tooltipTriggerEl)
})



  </script>
  
  
  
  <script type="text/javascript">
  
    "use strict";
  
  var callBackFunction;
  var callBackFunctionForGenericConfirmationModal;
  function largeModal(url, header)
  {
    jQuery('#large-modal').modal('show', {backdrop: 'true'});
    // SHOW AJAX RESPONSE ON REQUEST SUCCESS
    $.ajax({
      type: 'get',
      url: url,
      success: function(response)
      {
        jQuery('#large-modal .modal-body').html(response);
        jQuery('#large-modal .modal-title').html(header);
      }
    });
  }
  </script>
  
  
  <!--  Large Modal -->
  <div class="modal fade" id="large-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header d-print-none">
          <h4 class="modal-title" id="myLargeModalLabel"></h4>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
  
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  
  <script>
    function showAjaxModal(url, header)
    {
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#scrollable-modal .modal-body').html('<div style="text-align:center;margin-top:200px;"><img style="width: 100px; opacity: 0.4; " src="{{ asset('assets/images/straight-loader.gif') }}" /></div>');
        jQuery('#scrollable-modal .modal-title').html('...');
        // LOADING THE AJAX MODAL
        jQuery('#scrollable-modal').modal('show', {backdrop: 'true'});
  
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                jQuery('#scrollable-modal .modal-body').html(response);
                jQuery('#scrollable-modal .modal-title').html(header);
            }
        });
    }
  </script>
  <!-- Scrollable modal -->
  <div class="modal fade" id="scrollable-modal" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableModalTitle">Modal title</h5>
                <a href="#" class="offcanvas-btn"
                  data-bs-dismiss="modal" aria-label="Close">
                  <svg xmlns='http://www.w3.org/2000/svg'
                    viewBox='0 0 16 16'>
                    <path
                      d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z' />
                  </svg>
                </a>
            </div>
            <div class="modal-body ml-2 mr-2">
  
            </div>
            <div class="modal-footer">
                <button class="eBtn eBtn-red" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  


  <!-- Sweet Alert Modal for Status Update -->
{{-- <div class="modal eModal fade" id="confirmStatusAlert" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered sweet-alerts text-sweet-alerts">
    <div class="modal-content">
      <div class="modal-body">
        <div class="icon icon-confirm">
          <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48">
            <path d="M22.5 29V10H25.5V29ZM22.5 38V35H25.5V38Z" />
          </svg>
        </div>
        <p>Are you sure you want to update this status?</p>
        <p class="focus-text">This action will change the current status!</p>
        <div class="confirmBtn">
          <button type="button" id="confirmStatusBtn" class="eBtn eBtn-green">Yes, Update</button>
          <button type="button" class="eBtn eBtn-red" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div> --}}

<script>
  "use strict";

// // Show confirm modal for status update
// function confirmStatusModal(updateUrl, callbackFunction) {
//   var modal = new bootstrap.Modal(document.getElementById('confirmStatusAlert'), {
//     keyboard: false
//   });
//   modal.show();

//   // Remove any previous click events first to prevent stacking
//   $('#confirmStatusBtn').off('click');

//   // When "Yes" button clicked
//   $('#confirmStatusBtn').on('click', function() {
//     modal.hide(); // close modal before calling ajax
//     updateStatusUsingAjax(updateUrl, callbackFunction);
//   });
// }

// // Perform AJAX call
// function updateStatusUsingAjax(url, callbackFunction) {
//   $.ajax({
//     type: "POST",
//     url: url,
//     data: { _token: $('meta[name="csrf-token"]').attr('content') },
//     success: function(response) {
//       try {
//         var jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;

//         if (jsonResponse.status === 'error') {
//           error_message(jsonResponse.message);
//         } else {
//           success_message(jsonResponse.message || 'Status updated successfully!');
//           if (jsonResponse.redirect) {
//             window.location.replace(jsonResponse.redirect);
//           } else {
//             if (typeof callbackFunction === 'function') callbackFunction();
//             else location.reload();
//           }
//         }
//       } catch (e) {
//         console.error('Invalid JSON:', response);
//         error_message('Unexpected server response.');
//       }
//     },
//     error: function() {
//       error_message('Something went wrong while updating status!');
//     }
//   });
// }

// // Example: Button click listener
// $(document).on('click', '.status-update-btn', function() {
//   const url = $(this).data('url');
//   confirmStatusModal(url);
// });

// </script>





<script type="text/javascript">
"use strict";

function confirmStatusModal(updateUrl, callBackFunction){
  const confirmModal = new bootstrap.Modal(document.getElementById('confirmSweetAlerts'), {
    keyboard: false
  });
  confirmModal.show();

  // Set modal texts
  $('#confirmSweetAlerts .focus-text').text("You won't be able to revert this!");
  $('#confirmSweetAlerts p:first').text("Are you sure?");

  // Remove old click event (important!)
  $('#confirmBtn').off('click');

  // When user clicks "Yes"
  $('#confirmBtn').on('click', function () {
    confirmModal.hide();

    // run given callback function if provided
    if (typeof window[callBackFunction] === 'function') {
      window[callBackFunction](updateUrl);
    } else {
      // fallback: just go to the URL and reload after done
      updateStatus(updateUrl);
    }
  });
}

// This function runs after clicking OK
function updateStatus(url){
  // Example: hit the route (GET request)
  window.location.href = url;

  // or, if the route just updates and you want to reload after function done:
  // $.get(url).done(() => location.reload());
  // but since you said no ajax, we just redirect.
}
</script>


