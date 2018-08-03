@extends('admin.default')
@section('content')


<!-- Modal Create -->
<div class="modal fade" id="create-faculty" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelTitleId">Tambah Fakultas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                @csrf
                    <div class="form-group">
                      <label for=""></label>
                      <input type="text" class="form-control" name="code" placeholder="Kode Fakultas">
                    </div>
                    <div class="form-group">
                      <label for=""></label>
                      <input type="text" class="form-control" name="name" placeholder="Nama Fakultas">
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
            <h4 class="modal-title" id="modelTitleId">Edit Fakultas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
            <form id='edit-faculty' action="" method="post">
                @csrf
                    <div class="form-group">
                      <label for=""></label>
                      <input id="edit-code" type="text" class="form-control" name="code" placeholder="Kode Fakultas">
                    </div>
                    <div class="form-group">
                      <label for=""></label>
                      <input id="edit-name" type="text" class="form-control" name="name" placeholder="Nama Fakultas">
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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-faculty">
            <i class="c-white-500 ti-plus"></i>
        </button>
    </div>
    <div class="clearfix"></div>

    

    <div class="mT-30 table-responsive">
        <table id="datatable" class="table dataTable">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Fakultas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($faculties as $key => $faculty)
            <tr>
                <td>{{$faculty->code}}</td>
                <td>{{$faculty->name}}</td>
                <td>
                    <div class="btn-group">
                        <button id="btn-delete" data-id="{{$faculty->id}}" class="btn btn-danger"><i class="ti-trash c-white-500"></i></button>
                        <button data-toggle="modal" data-target="#modal-edit" id="btn-edit" data-url="{{route('faculty.edit',$faculty->id)}}" class="btn btn-primary"><i class="ti-pencil-alt c-white-500"></i></button>
                    </div>
                    <form method="post" action="{{route('faculty.delete',$faculty->id)}}" id="delete-{{$faculty->id}}">
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
            $('form#edit-faculty').attr('action',url);
            $.get(url,function(data){
                $('#edit-name').val(data.name);
                $('#edit-code').val(data.code);
            });
        })

       
    </script>
@endsection