@extends('admin.default')

@section('content')
<!-- Modal Create -->
<div class="modal fade" id="modal-create" role="dialog" aria-hidden="true" tab-index="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Akun Pengelola</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="" method="POST">
            @csrf
                <div class="form-group">
                    <input value="{{old('name')}}" type="text" name="name" id="name" class="form-control" placeholder="Nama">
                </div>
                <div class="form-group">
                    <input value="{{old('email')}}" type="email" name="email" id="email" class="form-control" placeholder="Email Valid">
                </div>
                <div class="form-group">
                    <label for="major">Program Studi</label>
                    <select name="major_id" id="create" class="select2 form-control major">
                        @foreach($faculties as $faculty)
                            <optgroup label="{{$faculty->name}}">
                                @foreach($faculty->majors as $major)
                                    <option value="{{$major->id}}">{{$major->name}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input value="{{old('identity_number')}}" type="text" name="identity_number" id="identity_number" class="form-control" placeholder="Nomor Identitas">
                </div>
                <div class="form-group">
                    <input value="{{old('position')}}" type="text" name="position" id="position" class="form-control" placeholder="Jabatan">
                </div>
                <div class="form-group">
                    <input value="{{old('phone')}}" type="text" name="phone" id="phone" class="form-control" placeholder="Nomor Telp.">
                </div>
                <div class="form-group input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-default" id="password-show">
                            <i class="ti-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Update -->
<div class="modal fade" id="modal-update" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Akun Pengelola</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="update" action="" method="POST">
            @csrf
                <div class="form-group">
                    <input type="text" name="name" id="edit-name" class="form-control" placeholder="Nama">
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="edit-email" class="form-control" placeholder="Email Valid">
                </div>
                <div class="form-group">
                    <input type="text" name="identity_number" id="edit-identity_number" class="form-control" placeholder="Nomor Identitas">
                </div>
                <div class="form-group">
                    <input type="text" name="position" id="edit-position" class="form-control" placeholder="Jabatan">
                </div>
                <div class="form-group">
                    <input type="text" name="phone" id="edit-phone" class="form-control" placeholder="Nomor Telp.">
                </div>
                <div class="form-group input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-default" id="password-show">
                            <i class="ti-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="major">Program Studi</label>
                    <select name="major_id" id="edit" class="select2 form-control edit-major">
                        @foreach($faculties as $faculty)
                            <optgroup label="{{$faculty->name}}">
                                @foreach($faculty->majors as $major)
                                    <option value="{{$major->id}}">{{$major->name}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            </div>
        </div>
    </div>
</div>


    <div class="bgc-white bd p-20">
        <h4>Manajemen Akun Pengelola</h4>
        <div class="float-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                <i class="ti-plus c-white-500"></i>
            </button>
        </div>
        <div class="clearfix"></div>
        <div class="mT-30 table-responsive">
            <table id="datatable" class="table datatable">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Program Studi</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->user->identity_number}}</td>
                        <td>{{$user->user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->user->major['name']}}</td>
                        <td>{{$user->position}}</td>
                        <td>
                            <div class="btn-group btn-outline-secondary">
                                <button type="button" data-id="{{$user->id}}" class="btn btn-danger" id="btn-delete"><i class="ti-trash c-white-50"></i></button>
                                <button type="button" class="btn btn-primary" id="btn-edit" data-url="{{route('akun.edit',$user->id)}}" data-toggle="modal" data-target="#modal-update"><i class="ti-pencil c-white-500"></i></button>
                                <button type="button" data-id="{{$user->id}}" class="btn {{$user->user->status == 'A' ? 'btn-success' : 'btn-default'}}" title="{{$user->user->status == 'A' ? 'Nonaktifkan' : 'Aktifkan'}}" id="btn-activate"><i class="{{$user->user->status == 'A' ? 'ti-face-smile' : 'ti-face-sad'}}"></i></button>
                            </div>
                            <form method="POST" id="activate-{{$user->id}}" action="{{route('admin.activate',$user->id)}}">@csrf</form>
                            <form method="POST" id="delete-{{$user->id}}" action="{{route('admin.delete',$user->id)}}">@csrf</form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('button#btn-edit').click(function(){
                var url = $(this).data('url');
                $.get(url,function(data){
                    $('input#edit-name').val(data.name);
                    $('input#edit-email').val(data.email);
                    $('input#edit-identity_number').val(data.identity_number);
                    $('input#edit-position').val(data.position);
                    $('input#edit-phone').val(data.phone);
                    $('form#update').attr('action',url);
                });
            })
        })
    </script>
@endsection
