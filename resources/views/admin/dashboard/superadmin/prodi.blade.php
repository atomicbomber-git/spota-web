@extends('admin.default')
@section('content')
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelTitleId">Tambah Prodi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                @csrf
                    <div class="form-group">
                      <label for=""></label>
                      <input type="text" class="form-control" name="name" placeholder="Nama Prodi">
                    </div>
                    <div class="form-group">
                      <label for="faculty">Fakultas</label>
                      <select class="form-control" name="faculty_id" id="faculty">
                        @foreach($faculties as $key => $faculty)
                            <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="department">Jurusan</label>
                      <select class="form-control" name="department_id" id="department">
                      <option value="">Kosong</option>
                        @foreach($faculties->first()->department as $key => $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
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
                <h4 class="modal-title" id="modelTitleId">Edit Prodi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-major" action="" method="post">
                @csrf
                    <div class="form-group">
                      <label for=""></label>
                      <input id="edit-name" type="text" class="form-control" name="name" placeholder="Nama Prodi">
                    </div>
                    <div class="form-group">
                      <label for="faculty">Fakultas</label>
                      <select class="form-control" name="faculty_id" id="faculty edit-faculty">
                        @foreach($faculties as $key => $faculty)
                            <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="department">Jurusan</label>
                      <select class="form-control" name="department_id" id="department">
                      <option value="">Kosong</option>
                        @foreach($faculties->first()->department as $key => $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
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
    
    <h4 class="">Data Prodi</h4>
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
                <th>Nama Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($majors as $key => $major)
            <tr>
                <td>{{$major->faculty->code}}</td>
                <td>{{$major->faculty->name}}</td>
                <td>{{$major->department->name}}</td>
                <td>{{$major->name}}</td>
                <td>
                    <div class="btn-group">
                        <button id="btn-delete" data-id="{{$major->id}}" class="btn btn-danger"><i class="ti-trash c-white-500"></i></button>
                        <button data-toggle="modal" data-target="#modal-edit" id="btn-edit" data-url="{{route('major.edit',$major->id)}}" class="btn btn-primary"><i class="ti-pencil-alt c-white-500"></i></button>
                    </div>
                    <form method="post" action="{{route('major.delete',$major->id)}}" id="delete-{{$major->id}}">
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
    $(document).ready(function(){


        $('select#faculty').on('change',function(){
            $('select#department').find('option').remove();
            $('select#department').append('<option value="">Kosong</option>');
            url = "{{url('admin/data/fakultas-jurusan')}}"+'/'+$(this).val();
            $.get(url,function(data){
                $.each(data,function(i,item){
                    $('select#department').append('<option value='+item.id+'>'+item.name+'</option>');
                })
            });
        });

        $('button#btn-edit').click(function(){
            url = $(this).data('url');
            $('form#edit-major').attr('action',url);
            $.get(url,function(data){
                $('#edit-name').val(data.name);
            });
        })


    });
</script>

@endsection