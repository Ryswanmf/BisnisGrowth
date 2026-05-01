@extends('layouts.admin')

@section('title', isset($user) ? 'Edit User' : 'Tambah User')
@section('header', isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna Baru')

@section('content')
<div class="max-w-2xl">
    <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST" class="space-y-8">
        @csrf
        @if(isset($user)) @method('PUT') @endif

        <div class="bg-white p-8 rounded-lg border border-gray-100 shadow-sm space-y-6">
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500" required>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500" required>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Password {{ isset($user) ? '(Kosongkan jika tidak ingin ganti)' : '' }}</label>
                <input type="password" name="password" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500" {{ isset($user) ? '' : 'required' }}>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Role / Hak Akses</label>
                <select name="role" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500 appearance-none">
                    <option value="user" {{ old('role', $user->role ?? '') === 'user' ? 'selected' : '' }}>User (Akses Terbatas)</option>
                    <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>Admin (Akses Penuh)</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.users.index') }}" class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-slate-900 transition-all">Batal</a>
            <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-lg text-[10px] font-black uppercase tracking-[0.2em] hover:bg-slate-800 transition-all shadow-lg">
                {{ isset($user) ? 'Simpan Perubahan' : 'Tambah Pengguna' }}
            </button>
        </div>
    </form>
</div>
@endsection
