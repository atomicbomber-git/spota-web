@extends('admin.default')

@section('content')
    <div class="masonry-item width-100">
        <div class="col-md-12">
            <div class="layers bd bgc-white p-20">
                <h4>Profil {{$student->user->name}}</h4>
                <form method="POST" action="" enctype="multipart/form-data">
                <div class="row">
                @csrf
                <div class="col-md-8">
                
                    <div class="form-group">
                        <label for="identity_number">Nomor Identitas</label>
                        <input value="{{$student->user->identity_number}}" class="form-control" type="text" id="identity_number" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input value="{{$student->user->name}}" type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail Valid</label>
                        <input value="{{$student->user->email}}" type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="batch">Angkatan</label>
                            <select name="batch" id="default" class="batch form-control">
                                @for($i = 2004 ; $i <= date('Y') ; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
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
                        <img src="{{asset('storage/students/'.$student->user->major_id.'/'.$student->picture)}}" alt="" class="img img-fluid">
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
