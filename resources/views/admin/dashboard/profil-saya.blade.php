@extends('admin.default')

@section('content')
    <div class="masonry-item width-100">
        <div class="col-md-12">
            <div class="layers bd bgc-white p-20">
                <h4>Profil Saya</h4>
                <div class="col-md-8">
                <form method="POST" action="">
                @csrf
                    <div class="form-group">
                        <label for="identity_number">Nomor Identitas</label>
                        <input value="{{$user->identity_number}}" class="form-control" type="text" id="identity_number" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input value="{{$user->name}}" type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail Valid</label>
                        <input value="{{$user->email}}" type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">No Telp.</label>
                        <input value="{{$user->phone()}}" type="text" name="phone" id="phone" class="form-control">
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
