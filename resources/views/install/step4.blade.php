@extends('install.index')
   
@section('content')
<?php if(isset($error)) { ?>
  <div class="row ins-seven">
    <div class="col-md-8 col-md-offset-2">
      <div class="alert alert-danger">
        <strong>{{ $error }}</strong>
      </div>
    </div>
  </div>
<?php } ?>
<div class="row ins-two">
  <div class="col-md-8 col-md-offset-2">
    <div class="card">
      <div class="card-body">
        <div class="panel panel-default ins-three" data-collapsed="0">
          <!-- panel body -->
          <div class="panel-body ins-four">
            <p class="ins-four">
              <strong>Your database is successfully connected</strong>. All you need to do now is
              <strong>hit the 'Import' button</strong>.
              The auto installer will run a sql file, will do all the tiresome works and set up your application automatically.
            </p>
            <br>
            <div class="row">
              <div class="col-md-12">
                <button type="button" id="install_button" class="btn btn-info">
                    <i class="entypo-check"></i> &nbsp; Import
                </button>
                <div id="loader ins-seven">
                  &nbsp; Importing database....
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  "use strict";

  $(document).ready(function() {
    $('#loader').hide();
    $('#install_button').click(function() {
      $('#loader').fadeIn();
      setTimeout(
      function()
      {
        window.location.href = "{{ route('step4.confirm_import', ['confirm_import' => 'confirm_install']) }}";
      }, 5000);
    });
  });
</script>
@endsection