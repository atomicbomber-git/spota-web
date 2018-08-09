@extends('admin.default')
@section('content')

    <!-- Modal Create -->
    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kelompok Keahlian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    @csrf
                        <div class="form-group">
                        <label for="name">Nama Kelompok</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Ubah Data Kelompok Keahlian <strong id="expertise-name"></strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" action="" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="edit-name">Nama</label>
                            <input class="form-control" type="text" name="name" id="edit-name">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="bgc-white bd p-20">
        <h4>Kelompok Keahlian</h4>
        <hr>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-create"><i class="ti-plus"></i></button>
        <div class="clearfix"></div>
        <div class="table-responsive mT-10">
            <table id="dataTable" class="table">
                <thead>
                    <tr>
                        <th>Kelompok Keahlian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($expertises as $expertise)
                    <tr>
                        <td>{{$expertise->name}}</td>
                        <td>
                            <div class="btn-group">
                                <button id="btn-delete" data-id="{{$expertise->id}}" type="button" class="btn btn-danger"><i class="ti-trash"></i></button>
                                <button data-url="{{route('expertise.update',$expertise->id)}}" data-toggle="modal" data-target="#modal-edit" type="button" class="btn btn-primary btn-edit"><i class="ti-pencil"></i></button>
                            </div>
                            <form id="delete-{{$expertise->id}}" action="{{route('expertise.delete',$expertise->id)}}" method="POST">@csrf</form>
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
        $('button.btn-edit').click(function(){
            url = $(this).data('url');
            $('form#form-edit').attr('action',url);
            $.get(url,function(data){
                $('input#edit-name').val(data.name);
                $('#expertise-name').html(data.name);
            });
        })
    </script>
@endsection