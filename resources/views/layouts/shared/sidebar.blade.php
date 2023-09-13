<aside class="main-sidebar sidebar-dark-primary elevation-1">
    <a href="#" class="brand-link" style="background-color: #007bff">
        <img src="{{ asset(getSetting()->logo_sistem) }}" alt="Logo Sistem" class="brand-image img-rounded">
        <span class="brand-text font-weight-light">&nbsp;</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/images/profile-default.png') }}" class="img-rounded elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block">{{ Str::limit(Auth::user()->name, 25, '...') }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link ">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>



                @can('MasterData')
                    <li class="nav-item {{ request()->segment(1) == 'masterdata' ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->segment(1) == 'masterdata' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-server"></i>
                            <p>
                                Master Data
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('masterdata.penduduk.home') }}"
                                    class="nav-link  {{ request()->segment(2) == 'ahli' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Penduduk
                                    </p>
                                </a>
                            </li>

                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('masterdata.perangkatdesa.home') }}"
                                    class="nav-link  {{ request()->segment(2) == 'ahli' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Perangkat Desa
                                    </p>
                                </a>
                            </li>

                        </ul>
                    @endcan


                    @can('MasterPengajuan')
                    <li class="nav-item {{ request()->segment(1) == 'masterpengajuan' ? 'active' : '' }}">
                        <a href="{{ route('masterpengajuan.home') }}" class="nav-link ">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Layanan Surat
                            </p>
                        </a>
                    </li>
                @endcan

                @can('DesaCerdas')
                    <li class="nav-item {{ request()->segment(1) == 'desacerdas' ? 'active' : '' }}">
                        <a href="{{ route('desacerdas.home') }}" class="nav-link ">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Desa Cerdas
                            </p>
                        </a>
                    </li>
                @endcan

                @can('LayananKesehatan')
                    <li class="nav-item {{ request()->segment(1) == 'layanankesehatan' ? 'active' : '' }}">
                        <a href="{{ route('layanankesehatan.home') }}" class="nav-link ">
                            <i class="nav-icon fas fa-hospital"></i>
                            <p>
                                Layanan Kesehatan
                            </p>
                        </a>
                    </li>
                @endcan

                @can('Penduduk')
                    <li class="nav-item {{ request()->segment(1) == 'penduduk' ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->segment(1) == 'penduduk' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-server"></i>
                            <p>
                                Pengajuan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('penduduk.pengajuan.home') }}"
                                    class="nav-link  {{ request()->segment(2) == 'ahli' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Pengajuan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('penduduk.pengajuan.permohonan') }}"
                                    class="nav-link  {{ request()->segment(2) == 'ahli' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Permohonan
                                    </p>
                                </a>
                            </li>

                        </ul>
                    @endcan
                </li>







            </ul>
        </nav>
    </div>
</aside>
