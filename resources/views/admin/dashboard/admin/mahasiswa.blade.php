@extends('admin.default')
@section('content')
    <div class="bgc-white bd p-20">
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Akun Mahasiswa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <input value="{{old('name')}}" placeholder="Nama" type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <input value="{{old('email')}}" placeholder="E-mail Valid" type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <input value="{{old('identity_number')}}" placeholder="Nomor Identitas Mahasiswa" type="text" name="identity_number" id="identity_number" class="form-control">
                            </div>
                            <div class="form-group input-group">
                                <input placeholder="Password" type="password" name="password" id="password" class="form-control">
                                <div class="input-group-append">
                                    <button type="button" id="password-show" class="btn btn-default"><i class="ti-eye"></i></button>
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="batch">Angkatan</label>
                                <select name="batch" id="create" class="batch form-control">
                                    @for($i = 2004 ; $i <= date('Y') ; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="picture">Foto</label>
                                <input type="file" name="picture" id="picture" class="form-control-file">
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <h4>Akun Mahasiswa</h4>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-create">
          <i class="ti-plus"></i>
        </button>
        <div class="clearfix"></div>
            <form action="">
                <div class="input-group form-group mT-10">
                    <input placeholder="Cari . ." type="text" name="search" class="form-control-sm">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default btn-sm"><i class="ti-search"></i></button>
                    </div>
                </div>
            </form>
        <div class="clearfix"></div>
        <div class="table-responsive bd mT-10">
            <table class="table table-hover thead-light">
                <thead style="font-weight:bold">
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>Angkatan</td>
                        <td>NIM</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{$student->name}}</td>
                        <td>{{$student->batch}}</td>
                        <td>{{$student->identity_number}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" data-id="{{$student->student_id}}" id="btn-delete" class="btn-danger btn"><i class="ti-trash"></i></button>
                                <a class="btn btn-primary" href="{{route('student.edit',$student->student_id)}}"><i class="ti-pencil"></i></a>
                                <button id="btn-activate" data-id="{{$student->student_id}}" type="button" class="btn {{$student->status == 'A' ? 'btn-success' : 'btn-default'}}" title="{{$student->status == 'A' ? 'Nonaktifkan' : 'Aktifkan'}}"><i class="{{$student->status == 'A' ? 'ti-face-smile' : 'ti-face-sad'}}"></i></button>
                            </div>
                            <form id="delete-{{$student->student_id}}" method="POST" action="{{route('student.delete',$student->student_id)}}">@csrf</form>
                            <form id="activate-{{$student->student_id}}" method="POST" action="{{route('student.activate',$student->student_id)}}">@csrf</form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$students->links()}}
        </div>
        
    </div>
@endsection