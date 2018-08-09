@extends('admin.default')
@section('content')
    <div class="bgc-white bd p-20">
        <form action="" method="POST">
            <div class="form-group">
                <label for="student">Nama Mahasiswa</label>
                <select name="student_id" id="student" class="form-group">
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="preoutline" >
            </div>
        </form>
    </div>
@endsection