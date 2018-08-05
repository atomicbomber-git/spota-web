@extends('admin.default')

@section('content')
    <div class="bgc-white bd p-20">
        <h4>Pengumuman</h4>
        <div class="table-responsive">
            <table id="dataTable" class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kepada</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($announcements as $announcement)
                    <tr>
                        <td>{{$announcement->title}}</td>
                        <td>{{$announcement->target()}}</td>
                        <td>{{$announcement->date()}}</td>
                        <td>
                        @if($announcement->user_id == Auth::id())
                            <div class="btn-group">
                                <a href="{{route('announcement.edit',$announcement->id)}}" class="btn btn-primary"><i class="ti-pencil"></i></a>
                                <button data-id="{{$announcement->id}}" id="btn-delete" type="button" class="btn btn-danger"><i class="ti-trash"></i></button>
                                @if($announcement->status == 'draft')
                                    <button data-id="{{$announcement->id}}" type="button" class="btn btn-info announce"><i class="ti-announcement"></i></button>
                                @endif
                            </div>
                            @if($announcement->status == 'draft')
                                <form id="announce-{{$announcement->id}}" action="{{route('announcement.announce',$announcement->id)}}" method='POST'>@csrf</form>
                            @endif
                            <form id="delete-{{$announcement->id}}" action="{{route('announcement.delete',$announcement->id)}}" method="POST">@csrf</form>
                        </td>
                        @endif
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
            $('button.announce').click(function(){
                var id = $(this).data('id');
                $('form#announce-'+id).submit();
            });
        })
    </script>
@endsection