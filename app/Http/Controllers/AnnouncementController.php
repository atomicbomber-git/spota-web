<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Announcement;


class AnnouncementController extends Controller
{
    public function index(){
        return view('admin.dashboard.admin.pengumuman',['announcements'=>Announcement::where('major_id',Auth::user()->major_id)->get()]);
    }

    public function create(){
        return view('admin.dashboard.admin.buat-pengumuman');
    }

    public function store(Request $request){
        $request->validate([
            'title'     => 'required|string',
            'content'   => 'required|string',
            'target'    => Rule::in(['A','M','D']),
            'status'    => ['nullable',Rule::in(['draft'])]
        ]);

        $announcement = new Announcement;
        $announcement->fill($request->all());
        $announcement->user_id      = Auth::id();
        $announcement->major_id     = Auth::user()->major_id;
        $announcement->save();
        return redirect()->route('announcement.index')->with('success','Pengumuman berhasil ditambahkan .');
    }

    public function edit($id){
        $announcement = Announcement::findOrFail($id);
        $this->authorize('manage-announcement',$announcement);
        return view('admin.dashboard.admin.edit-pengumuman',['announcement'=>$announcement]);
    }

    public function update(Request $request, $id){
        $announcement = Announcement::findOrFail($id);
        
        $request->validate([
            'title'     => 'required|string',
            'content'   => 'required|string',
            'target'    => Rule::in(['A','M','D']),
            'status'    => ['nullable',Rule::in(['draft'])]
        ]);
        $announcement->update([
            'title'     => $request->title,
            'content'   => $request->content,
            'status'    => empty($request->status) ? 'announced' : 'draft',
            'target'    => $request->target,
        ]);

        return redirect()->route('announcement.index')->with('success','Pengumuman berhasil diperbaharui .');
    }

    public function announce($id){
        $announcement = Announcement::findOrFail($id);
        $this->authorize('update-announcement',$announcement);
        $announcement->announce();
        return redirect()->route('announcement.index')->with('Pengumuman berhasil diumumkan .');
    }

    public function destroy($id){
        $announcement = Announcement::findOrFail($id);
        $this->authorize('destroy-announcement',$announcement);
        $announcement->delete();
        return redirect()->route('announcement.index')->with('success','Pengumuman Berhasil dihapus.');
    }

}
