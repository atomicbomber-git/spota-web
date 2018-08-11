@extends('admin.default')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="bgc-white bd p-20">
                <h4>Laman Konfigurasi</h4>
                <hr>
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="current_semester">Semester Berjalan</label>
                        <input type="text" placeholder="mis : GENAP-2018" value="{{$configuration->current_semester}}" name="current_semester" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="semesters_year">Tahun Ajaran</label>
                        <input type="text" value="{{$configuration->semesters_year}}" name="semesters_year" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="approved_count">Jumlah Diperlukan untuk Penutupan Draft</label>
                        <input type="number" value="{{$configuration->approved_count}}" min="1" max="10" name="approved_count" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="bgc-white bd p-20">
                <h4>Pengaturan Akun dengan Akses Kaprodi</h4>
                <hr>
                <form action="{{route('configuration.update-major')}}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="major_leaders[]">Perbarui Akun Kaprodi</label>
                        <select name="major_leaders[]" class="select2 form-control" multiple="multiple">
                        @foreach($lecturers as $lecturer)
                            <option value="{{$lecturer->lecturer_id}}">{{$lecturer->name}}</option>
                        @endforeach
                            <option value="99">asdsd</option>
                        </select>
                    </div>
                    <button class="btn btn-primary btn-sm">Perbarui</button>
                </form>
                <hr>
                <div class="mB-10 Bold"><strong>Akun dengan Akses Kaprodi</strong></div>
                <ul class="list-group">
                    @foreach($major_leaders as $major_leader)
                        <li class="list-group-item">{{$major_leader->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection