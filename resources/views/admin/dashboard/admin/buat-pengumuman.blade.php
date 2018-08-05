@extends('admin.default')

@section('content')
    <div class="bgc-white bd p-20">
        <h4>Buat Pengumuman</h4>
            <form method="POST" action="">
            @csrf
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="content" id="ckeditor" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="target">Tujuan</label>
                    <select style="max-width:250px" class="form-control" name="target" id="target">
                        <option value="A">Semua</option>
                        <option value="M">Mahasiswa</option>
                        <option value="D">Dosen</option>
                    </select>
                </div>
                <div class="form-group">
                    <input value="draft" type="checkbox" name="status" id="draft">
                    <span>Simpan sebagai <i>draft</i></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function(){
            CKEDITOR.replace('ckeditor');
        });
        

    </script>
@endsection