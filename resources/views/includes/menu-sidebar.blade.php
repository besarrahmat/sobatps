<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->roles->code == 'admin')
            <li class="nav-item">
                <a class="nav-link collapsed" href={{ url('user') }}>
                    <i class="bi bi-person"></i>
                    <span>User</span>
                </a>
            </li><!-- End Users Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href={{ url('program') }}>
                    <i class="bx bxs-hdd"></i>
                    <span>Program</span>
                </a>
            </li><!-- End Program Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href={{ url('extra') }}>
                    <i class="bx bxs-server"></i>
                    <span>Master Jenis Asistensi</span>
                </a>
            </li><!-- End Master Jenis Asistensi Page Nav -->
        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" href={{ url('lembaga-ps') }}>
                <i class="bx bxs-book-alt"></i>
                <span>Lembaga PS</span>
            </a>
        </li><!-- End Lembaga PS Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href={{ url('lembaga-kups') }}>
                <i class="bx bxs-book-bookmark"></i>
                <span>Lembaga KUPS</span>
            </a>
            <ul id="kups-nav" class="nav-content" @if (Auth::user()->roles->code != 'admin') style="display:none" @endif>
                <li>
                    <a href="{{ url('lembaga-kups/' . Auth::user()->id . '/pendampingan') }}">
                        <i class="bi bi-circle"></i>
                        <span>Tambah Pendampingan KUPS</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('lembaga-kups/' . Auth::user()->id . '/user') }}">
                        <i class="bi bi-circle"></i>
                        <span>Tambah User KUPS</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Lembaga KUPS Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href={{ url('list-sk') }}>
                <i class="bx bxs-notepad"></i>
                <span>SK Penerima Bantuan</span>
            </a>
        </li><!-- End SK Penerima Bantuan Page Nav -->

        <li class="nav-item" @if (Auth::user()->roles->code != 'admin' && Auth::user()->roles->code != 'helper') style="display:none" @endif>
            <a class="nav-link collapsed" href={{ url('draft-hibah') }}>
                <i class="bx bx-note"></i>
                <span>Draft Penerima Hibah</span>
            </a>
        </li><!-- End Draft Penerima Hibah Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href={{ url('usulan') }}>
                <i class="bx bx-folder"></i>
                <span>Usulan Bantuan</span>
            </a>
        </li><!-- End Usulan Bantuan Page Nav -->
    </ul>

</aside>
