<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile"
            style="background: url({{ url('/') }}/assets/images/background/user-info.jpg) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{ url('/') }}/assets/images/users/profile.png" alt="user" />
            </div>
            <!-- User profile text-->
            <div class="profile-text"> <a href="#" role="button" aria-haspopup="true"
                    aria-expanded="true">{{ Auth()->user()->name }}</a>

            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark" href="{{ url('/dashboard') }}" aria-expanded="false"><i
                            class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="{{ url('/artikel') }}" aria-expanded="false"><i
                            class="fa fa-book"></i><span class="hide-menu">Artikel</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="{{ url('/note') }}" aria-expanded="false"><i
                            class="mdi mdi-widgets"></i><span class="hide-menu">Catatan Pengguna</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="{{ url('/expert') }}" aria-expanded="false"><i
                            class="mdi mdi-account-box"></i><span class="hide-menu">Expert</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="{{ url('/kuesioner') }}" aria-expanded="false"><i
                            class="fa fa-book"></i><span class="hide-menu">Kuesioner</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>

</aside>
