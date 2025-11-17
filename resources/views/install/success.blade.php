@extends('install.index')
   
@section('content')
<div class="row ins-two">
  <div class="col-md-8 col-md-offset-2">
    <div class="card">
      <div class="card-body">
        <div class="panel panel-default ins-three" data-collapsed="0">
    			<!-- panel body -->
    			<div class="panel-body ins-four">
            <h3>Success!!</h3>
            <br>
            <p class="ins-four">
              <strong>Installation was successfull. Please login to continue..</strong>
            </p>
            <br>
            <table>
              <tbody>
                <tr>
                  <td class="ins-eight"><strong>Administrator Email|</strong></td>
                  <td class="ins-eight">{{ $admin_email }}</td>
                </tr>
                <tr>
                  <td class="ins-eight"><strong>Password |</strong></td>
                  <td class="ins-eight">Your chosen password</td>
                </tr>
              </tbody>
            </table>
            <br>
            <p>
              <a href="{{ route('login') }}" class="btn btn-info">
                <i class="entypo-login"></i> &nbsp; Log In
              </a>
            </p>
    			</div>
    		</div>
      </div>
    </div>
  </div>
</div>
@endsection