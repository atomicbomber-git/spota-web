@can('manage-superadmin')
<li class="nav-item">
    <a class='sidebar-link' href="" default>
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">Dashboard</span>
    </a>
</li>

<li class="nav-item dropdown">
    <a class="dropdown-toggle" href="javascript:void(0);">
        <span class="icon-holder">
            <i class="c-orange-500 ti-layout-list-thumb"></i> 
        </span>
        <span class="title">Manajemen Data</span> 
        <span class="arrow">
            <i class="ti-angle-right"></i>
        </span>
    </a>
    <ul class="dropdown-menu" style="display: none;">
        <li>
            <a class="sidebar-link" href="{{route('faculty.index')}}">Data Fakultas</a>
        </li>
        <li>
            <a class="sidebar-link" href="{{route('department.index')}}">Data Jurusan</a>
        </li>
        <li>
            <a class="sidebar-link" href="{{route('major.index')}}">Data Prodi</a>
        </li>
    </ul>
</li>

<li class="nav-item dropdown">
    <a class="dropdown-toggle" href="javascript:void(0);">
        <span class="icon-holder">
            <i class="c-black-500 ti-user"></i> 
        </span>
        <span class="title">User</span> 
        <span class="arrow">
            <i class="ti-angle-right"></i>
        </span>
    </a>
    <ul class="dropdown-menu" style="display: none;">
        <li>
            <a class="sidebar-link" href="{{route('admin.edit')}}">Profil Saya</a>
        </li>
        <li>
            <a class="sidebar-link" href="{{route('admin.create')}}">Manajemen Admin</a>
        </li>
    </ul>
</li>
@endcan

@can('manage-admin')
<li class="nav-item dropdown">
    <a class="dropdown-toggle" href="javascript:void(0);">
        <span class="icon-holder">
            <i class="c-orange-500 ti-layout-list-thumb"></i> 
        </span>
        <span class="title">Manajemen Data</span> 
        <span class="arrow">
            <i class="ti-angle-right"></i>
        </span>
    </a>
    <ul class="dropdown-menu" style="display: none;">
        <li>
            <a class="sidebar-link" href="{{route('student.index')}}">Data Mahasiswa</a>
        </li>
        <li>
            <a class="sidebar-link" href="{{route('lecturer.index')}}">Data Dosen</a>
        </li>
    </ul>
</li>


@endcan