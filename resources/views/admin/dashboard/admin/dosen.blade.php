@extends('admin.default')
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Tambah Akun Dosen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <input value="{{old('name')}}" placeholder="Nama Dosen" type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input value="{{old('email')}}" placeholder="Email Valid" type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input value="{{old('identity_number')}}" placeholder="NIP" type="text" name="identity_number" class="form-control">
                        </div>
                        <div class="form-group">
                            <input value="{{old('phone')}}" placeholder="Nomor Telp." type="text" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <input value="{{old('position')}}" placeholder="Jabatan" type="text" name="position" class="form-control">
                        </div>
                        <div class="form-group input-group">
                            <input type="password" name="password" class="form-control" id="password">
                            <div class="input-group-append">
                                <button type="button" id="password-show" class="btn btn-default"><i class="ti-eye"></i></button>
                            </div>
                        </div> 
                        <div class="form-group">
                        <label for="privileges">Jenis Akun</label>
                            <select class="form-control" name="privileges" id="privileges">
                                <option value="K">Kaprodi</option>
                                <option value="D">Dosen</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="picture">Foto</label>
                            <input type="file" name="picture" class="form-control-file">
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="p-20 bd bgc-white">
    <h4>Akun Dosen</h4>
    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#create">
      <i class="ti-plus"></i></button>
      <div class="clearfix"></div>
        <div class="table-responsive mT-10">
            <table class="table" id="dataTable">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($lecturers as $lecturer)
                    <tr>
                        <td>{{$lecturer->name}}</td>
                        <td>{{$lecturer->identity_number}}</td>
                        <td>{{$lecturer->email}}</td>
                        <td>
                            <div class="btn-group">
                            
                                <button type="button" id="btn-delete" data-id="{{$lecturer->id}}" class="btn btn-danger"><i class="ti-trash"></i></button>
                                <a href="{{route('lecturer.edit',$lecturer->lecturer->id)}}" class="btn btn-primary"><i class="ti-pencil"></i></a>
                                <button type="button" id="btn-activate" data-id="{{$lecturer->id}}" class="btn {{$lecturer->status == 'A' ? 'btn-success' : 'btn-default'}}"><i class="{{$lecturer->status == 'A' ? 'ti-face-smile' : 'ti-face-sad'}}"></i></button>
                            </div>
                            <form method="POST" id="activate-{{$lecturer->id}}" action="{{route('lecturer.activate',$lecturer->lecturer->id)}}">@csrf</form>
                            <form method="POST" id="delete-{{$lecturer->id}}" action="{{route('lecturer.delete',$lecturer->lecturer->id)}}">@csrf</form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection