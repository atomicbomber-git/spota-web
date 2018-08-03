@extends('admin.default')

@section('content')
    <div class="masonry-item width-100">
        <div class="col-md-12">
            <div class="layers bd bgc-white p-20">
                <h4>Profil {{$lecturer->user->name}}</h4>
                <form method="POST" action="" enctype="multipart/form-data">
                <div class="row">
                @csrf
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="identity_number">Nomor Identitas</label>
                        <input value="{{$lecturer->user->identity_number}}" name="identity_number" class="form-control" type="text" id="identity_number">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input value="{{$lecturer->user->name}}" type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail Valid</label>
                        <input value="{{$lecturer->user->email}}" type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">No Telp.</label>
                        <input value="{{$lecturer->phone}}" type="text" name="phone" id="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="position">Jabatan</label>
                        <input value="{{$lecturer->position}}" type="text" name="position" id="position" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input id="password" placeholder="Kosongkan bila tidak ingin mengganti." type="password" class="form-control">
                            <div class="input-group-append">
                                <button id="password-show" type="button" class="btn-default btn"><i class="ti-eye"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="privileges">Hak akses</label>
                        <select name="privileges" id="privileges" class="form-control">
                            <option value="D">Dosen</option>
                            <option value="K">Kaprodi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <img src="{{asset('storage/lecturers/'.$lecturer->user->major_id.'/'.$lecturer->picture)}}" alt="" class="img img-fluid">
                    </div>
                    <div class="form-group">
                        <input name="picture" type="file" class="form-control-file">
                    </div>
                </div>

                <div class="clearfix"></div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
                </form>
            </div>
        </div>
    </div>
    
@endsection
