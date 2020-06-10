
        <nav class="sidebar sidebar-offcanvas pb-5" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="{{ asset('/assets/images/faces/face8.jpg') }}" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">Allen Moreno</p>
                  <p class="designation">Premium user</p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">Main Menu</li>

            <!-- dashboard start-->
            <li class="nav-item">
              <a class="nav-link" href="{{ route( 'admin.index' ) }}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <!-- dashboard end -->

            <!-- Products management start-->
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.product.index') }}"> Manage Products </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.product.create') }}"> Create Products </a>
                  </li>
                </ul>
              </div>
            </li>
            <!-- product management end -->

            <!-- Order management start-->
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Orders</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="orders">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.order.index') }}"> Manage Orders </a>
                  </li>
                </ul>
              </div>
            </li>
            <!-- Order management end -->

            <!-- Catoegory management start-->
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#categories" aria-expanded="false" aria-controls="categories">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Categories</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="categories">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.category.index') }}"> Manage Categories </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.category.create') }}"> Create Categories </a>
                  </li>
                </ul>
              </div>
            </li>
            <!-- Catoegory management end -->

            <!-- Brand management start-->
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#brands" aria-expanded="false" aria-controls="brands">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Brands</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="brands">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.brand.index') }}"> Manage Brands </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.brand.create') }}"> Create Brands </a>
                  </li>
                </ul>
              </div>
            </li>
            <!-- Brand management end -->

            <!-- Division management start-->
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#divisions" aria-expanded="false" aria-controls="divisions">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Divisions</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="divisions">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.division.index') }}"> Manage Divisions </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.division.create') }}"> Create Divisions </a>
                  </li>
                </ul>
              </div>
            </li>
            <!-- Division management end -->

            <!-- District management start-->
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#district" aria-expanded="false" aria-controls="district">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Districts</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="district">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.district.index') }}"> Manage Districts </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.district.create') }}"> Create Districts </a>
                  </li>
                </ul>
              </div>
            </li>
            <!-- District management end -->

            <!-- SLider management start-->
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#slider" aria-expanded="false" aria-controls="slider">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Sliders</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="slider">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.slider.index') }}"> Manage Sliders </a>
                  </li>
                </ul>
              </div>
            </li>
            <!-- SLider management end -->




                    

          </ul>
        </nav>