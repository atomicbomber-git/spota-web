@extends('admin.default')
@section('content')
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelTitleId">Tambah Jurusan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                @csrf
                    <div class="form-group">
                      <label for="">Nama Jurusan</label>
                      <input type="text" class="form-control" name="name" placeholder="Nama Jurusan">
                    </div>
                    <div class="form-group">
                      <label for="faculty">Fakultas</label>
                      <select class="form-control" name="faculty_id" id="faculty">
                        @foreach($faculties as $key => $faculty)
                            <option value="{{$faculty->id}}">{{$faculty->name}}</option>
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

<!-- Modal Edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelTitleId">Edit Jurusan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-department" action="" method="post">
                @csrf
                    <div class="form-group">
                      <label for="">Nama Jurusan</label>
                      <input id="edit-name" type="text" class="form-control" name="name" placeholder="Nama Jurusan">
                    </div>
                    <div class="form-group">
                      <label for="faculty">Fakultas</label>
                      <select class="form-control" name="faculty_id" id="edit-faculty">
                        @foreach($faculties as $key => $faculty)
                            <option value="{{$faculty->id}}">{{$faculty->name}}</option>
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


<div class="bgc-white p-20 bd">
    
    <h4 class="">Data Fakultas</h4>
    <div class="float-right">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
            <i class="c-white-500 ti-plus"></i>
        </button>
    </div>
    <div class="clearfix"></div>

    

    <div class="mT-30">
        <table id="datatable" class="table dataTable">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Fakultas</th>
                <th>Nama Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($departments as $key => $department)
            <tr>
                <td>{{$department->faculty->code}}</td>
                <td>{{$department->faculty->name}}</td>
                <td>{{$department->name}}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" id="btn-delete" data-id="{{$department->id}}" class="btn btn-danger"><i class="ti-trash c-white-500"></i></button>
                        <button type="button" data-toggle="modal" data-target="#modal-edit" id="btn-edit" data-url="{{route('department.edit',$department->id)}}" class="btn btn-primary"><i class="ti-pencil-alt c-white-500"></i></button>
                    </div>
                    <form method="post" action="{{route('department.delete',$department->id)}}" id="delete-{{$department->id}}">
                            @csrf
                    </form>
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
        $('button#btn-edit').click(function(){
            url = $(this).data('url');
            $('form#edit-department').attr('action',url);
            $.get(url,function(data){
                $('#edit-name').val(data.name);
                $('#edit-faculty').val(data.faculty_id);
            });
        })
    </script>
@endsection