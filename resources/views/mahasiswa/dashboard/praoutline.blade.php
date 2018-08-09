@extends('mahasiswa.default')
@section('content')
    <div class="p-20 bgc-yellow-50 bd mB-20">
        <h4><u>Harap diperhatikan</u></h4>
        <ul>
            <li>File yang diupload berupa Draft berkestensi PDF</li>
            <li>Draft sudah melewati persetujuan dosen PA ataupun KK</li>
            <li>Bila terdapat kesalahan harap menghubungi operator SPOTA</li>
        </ul>
    </div>
    <div class="p-20 bd bgc-white">
        <h4>Upload Draft Praoutline</h4>
        <hr>
        <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input placeholder="Judul Praoutline" type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <textarea name="description" id="ckeditor" cols="30" rows="10" class="form-control"></textarea>        
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Dosen yang memberikan Rekomendasi Judul</label>
                    <select class="form-control w-75 select2" name="suggestor" id="suggestor">
                        <option value="">--Tidak ada</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Pilih Dosen Pembimbing</label>
                    <div class="clearfix"></div>
                    <select class="form-control w-75 select2 search-select" name="supervisor1">
                        <option value=""></option>
                    </select>
                    <select class="form-control w-75 select2 search-select" name="supervisor2">
                        <option value=""></option>
                    </select>
                    <select class="form-control w-75 select2 search-select" name="supervisor3">
                        <option value=""></option>
                    </select>
                    <select class="form-control w-75 select2 search-select" name="supervisor4">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Dosen Pembimbing Akademik</label>
                    <div class="clearfix"></div>
                    <select class="form-control w-75 select2" name="counselor">
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kelompok Keahlian</label>
                    <div class="clearfix"></div>
                    <select class="form-control select2" name="expertise_id" id="expertise_id">
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Berkas Draft</label>
                    <input type="file" name="" id="" class="form-control-file">
                </div>
            </div>
            <button class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>
@endsection
@section('js')
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function(){
            CKEDITOR.replace('ckeditor')
        });
    </script>
@endsection