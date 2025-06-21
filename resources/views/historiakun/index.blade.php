{{-- @extends('layouts.app')

@section('content') --}}
<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Histori Akun Admin') }}
        </h2>
    </x-slot>

    {{-- Display all admin accounts with edit and delete buttons --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Welcome to Histori Akun Admin
                    </div>
                    <div class="mt-6 text-gray-500">
                        <p>Here you can see all admin accounts and add a new admin account by clicking the button below</p>
                    </div>
                    
                </div>
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Histori Akun
                    </div>
                    <div class="mt-6 text-gray-500">
                        <p>Here you can see all Histori accounts</p>
                    </div>
                    <div class="mt-6">
                        <form action="{{ route('historiakun.destroyAll') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua histori akun?');">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit">Hapus Histori</x-danger-button>
                        </form>
                    </div>
                    <div class="mt-6 rounded-md border-solid border-2 border-stone-950">
                        <table class="table-auto w-full ">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-solid border-2 border-stone-950 py-3">Nama Akun</th>
                                    <th scope="col" class="border-solid border-2 border-stone-950 py-3">Role</th>
                                    <th scope="col" class="border-solid border-2 border-stone-950 py-3">Waktu Login</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($historiAkuns as $historiAkun)
                                    <tr>
                                        <td class="border-solid border-2 border-stone-950 py-3">{{ $historiAkun->nama_akun }}</td>
                                        <td class="border-solid border-2 border-stone-950 py-3">{{ $historiAkun->role }}</td>
                                        <td class="border-solid border-2 border-stone-950 py-3">{{ $historiAkun->waktu_login }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
{{-- @endsection --}}
