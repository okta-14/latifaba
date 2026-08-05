<style>.main-sidebar {
    height: auto !important;
    min-height: 100%;
}

.content-wrapper {
    min-height: auto !important;
}</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">

        <span class="brand-text font-weight-light">
            Admin Panel
        </span>

    </a>

    <div class="sidebar">

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

                  <li class="nav-item logout-menu">

                        <a href="{{ route('logout') }}"
                              class="nav-link"
                              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">

                              <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                              <p>Logout</p>

                        </a>

                        <form id="logout-form"
                              action="{{ route('logout') }}"
                              method="POST"
                              style="display:none;">
                              @csrf
                        </form>

                        </li>

                <li class="nav-item">

                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>User</p>
                    </a>
                </li>
                 <li class="nav-item">
                        <a href="{{ route('pengaturan.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-cog"></i>
                              <p>Pengaturan</p>
                        </a>
                   </li>

                  <li class="nav-item">
                        <a href="{{ route('groupcompanies.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-building"></i>
                              <p>Group Companies</p>
                        </a>
                   </li>

                   <li class="nav-item">
                        <a href="{{ route('media.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-tv"></i>
                              <p>Media</p>
                        </a>
                   </li>

                    <li class="nav-item">
                        <a href="{{ route('video.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-play-circle"></i>
                              <p>Video</p>
                        </a>
                   </li>

                   <li class="nav-item">
                        <a href="{{ route('albumadmin.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-images"></i>
                              <p>Album</p>
                        </a>
                   </li>
                  
                  <li class="nav-item">
                        <a href="{{ route('foto.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-image "></i>
                              <p>Foto</p>
                        </a>
                   </li>

                   <li class="nav-item">
                        <a href="{{ route('kategori.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-folder"></i>
                              <p>Kategori</p>
                        </a>
                   </li>

                    <li class="nav-item">
                        <a href="{{ route('kategoriProject.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-sitemap"></i>
                              <p>Kategori Project</p>
                        </a>
                   </li>

                   <li class="nav-item">
                        <a href="{{ route('client.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-handshake"></i>
                              <p>Client</p>
                        </a>
                   </li>

                     <li class="nav-item">
                        <a href="{{ route('kontakkami.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-address-book"></i>
                              <p>Kontak</p>
                        </a>
                   </li>

                   <li class="nav-item">
                        <a href="{{ route('service.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-briefcase"></i>
                              <p>Service</p>
                        </a>
                   </li>

                   <li class="nav-item">
                        <a href="{{ route('tags.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-tags "></i>
                              <p>Tags</p>
                        </a>
                   </li>

                   <li class="nav-item">
                        <a href="{{ route('blogadmin.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-newspaper "></i>
                              <p>Blog</p>
                        </a>
                   </li>
                  
                    <li class="nav-item">
                        <a href="{{ route('programadmin.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-laptop-code "></i>
                              <p>Program</p>
                        </a>
                   </li>

                   <li class="nav-item">
                        <a href="{{ route('projectfoto.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-camera-retro "></i>
                              <p>Foto Project</p>
                        </a>
                   </li>
                   
                   <li class="nav-item">
                        <a href="{{ route('reviewadmin.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-photo-video "></i>
                              <p>Review</p>
                        </a>
                   </li>

                  
            </ul>

        </nav>

    </div>

</aside>
