@extends('install.index')
   
@section('content')
<div class="row ins-two">
  <div class="col-md-8 col-md-offset-2">
    <div class="card">
      <div class="card-body">
        <div class="panel panel-default ins-three" data-collapsed="0">
    			<!-- panel body -->
    			<div class="panel-body ins-four">
            <p class="ins-four">
              Welcome to Digital Agency Installation. You will need to know the following items before proceeding.
            </p>
            <ol>
              {{-- <li>{{ phrase('Codecanyon purchase code') }}</li> --}}
              <li>Database Name</li>
              <li>Database Username</li>
              <li>Database Password</li>
              <li>Database Hostname</li>
            </ol>
            <p class="ins-four">
              We are going to use the above information to write database.php file which will connect the application to your database. During the installation process, we will check if the files that are needed to be written
              (<strong>config/database.php</strong>) have
              <strong>write permission</strong>. We will also check if<strong>curl</strong> and  <strong>php mail functions</strong>
              are enabled on your server or not.
            </p>
            <p class="ins-four">
              Gather the information mentioned above before hitting the start installation button. If you are ready....'
            </p>
            <br>
            <p>
              <a href="{{ route('step1') }}" class="btn btn-info">
                Start Installation Process
              </a>
            </p>
    			</div>
    		</div>
      </div>
  </div>
</div>
@endsection
