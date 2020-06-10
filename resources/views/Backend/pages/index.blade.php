@extends('Backend.layouts.master')

@section('content')
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <h5 class="card-header">Hello Admin</h5>
              <div class="card-body">
                <h5 class="card-title">Welcome to your Dashboard</h5>
                <p class="card-text">You are successfully logged in</p>
                <a href="{{ route('index') }}" class="btn btn-primary">Visit Main Site</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="container-fluid clearfix">
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2020 <a href="http://dev-ahmedsabbir.pantheonsite.io/" target="_blank">Ahmed Sabbir</a>. All rights reserved.</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i>
          </span>
        </div>
      </footer>
      <!-- partial -->
    </div>
@endsection
