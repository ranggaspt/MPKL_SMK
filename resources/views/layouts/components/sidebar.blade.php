<ul class="navbar-nav bg-gradient-red sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        {{-- <div class="sidebar-brand-icon">
        <!-- <i class="fas fa-laugh-wink"></i> -->
            <img src="{{asset('images/logo.png')}}" style="height: 40px;" alt="Image">
        </div> --}}
        <div class="sidebar-brand-text mx-3">Monitoring PKL</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::current()->getName()=='home' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Menu') }}
    </div>

    @if(auth()->user()->role == 'super')
    <!-- Nav Item -->
    <li class="nav-item {{ Route::current()->getName()=='admin.study.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.study.index') }}">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>{{ __('Jurusan') }}</span>
        </a>
    </li>
    
    <li class="nav-item {{ Route::current()->getName()=='admin.classroom.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.classroom.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>{{ __('Kelas') }}</span>
        </a>
    </li>

    <!-- Nav Item -->
    <li class="nav-item {{ Route::current()->getName()=='admin.teacher.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.teacher.index') }}">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>{{ __('Guru') }}</span>
        </a>
    </li>

    <!-- Nav Item -->
    <li class="nav-item {{ Route::current()->getName()=='admin.instance.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.instance.index') }}">
            <i class="fas fa-fw fa-building"></i>
            <span>{{ __('Instansi') }}</span>
        </a>
    </li>

    <!-- Nav Item -->
    <li class="nav-item {{ Route::current()->getName()=='admin.student.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.student.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>{{ __('Siswa') }}</span>
        </a>
    </li>

    {{-- <!-- Nav Item - Profile -->
    <li class="nav-item {{ Route::current()->getName()=='admin.profile' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li> --}}

    {{-- TEACHER SIDE BAR--}}
    @elseif(auth()->user()->role == 'teacher')
    <li class="nav-item {{ Route::current()->getName()=='teacher.profile' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('teacher.profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li>

    {{-- INSTANCE SIDE BAR--}}
    @elseif(auth()->user()->role == 'instance')


    {{-- PARTICIPANT SIDE BAR--}}

    @elseif(auth()->user()->role == 'participant')
    <!-- Nav Item -->
    <li class="nav-item {{ request()->is('profile.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('profile.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li>
    
    <!-- Nav Item -->
    <li class="nav-item {{ request()->is('package.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('package.index') }}">
            <i class="fas fa-fw fa-cubes"></i>
            <span>{{ __('Paket Ujian') }}</span>
        </a>
    </li>
    
    <li class="nav-item {{ request()->is('exam.show', Crypt::encrypt(auth()->user()->participant->id)) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('exam.show',  Crypt::encrypt(auth()->user()->participant->id)) }}">
            <i class="fas fa-fw fa-book"></i>
            <span>{{ __('Ujian') }}</span>
        </a>
    </li>
    
    <li class="nav-item {{ request()->is('result.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('result.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>{{ __('Hasil Ujian') }}</span>
        </a>
    </li>
    {{--  <li class="nav-item {{ request()->is('report.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('report.index') }}">
            <i class="fas fa-fw fa-cubes"></i>
            <span>{{ __('Hasil Ujian') }}</span>
        </a>
    </li>
    <!-- Nav Item - Profile -->
    <li class="nav-item {{ request()->is('participant.profile') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('participant.profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li> --}}
    @else
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>