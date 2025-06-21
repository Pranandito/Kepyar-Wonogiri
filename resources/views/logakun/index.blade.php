{{-- @extends('layouts.app')

@section('content') --}}
<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Akun Admin') }}
        </h2>
    </x-slot>

    {{-- Display all admin accounts with edit and delete buttons --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Selamat Datang di Daftar Akun Admin
                    </div>
                    <div class="mt-6 text-gray-500">
                        <p>Anda dapat melihat semua akun admin dan menambahkan akun admin baru dengan mengklik tombol di bawah</p>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('logakun.create') }}">
                            <x-primary-button>Tambah Akun Baru</x-primary-button>
                        </a>
                    </div>
                </div>
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Daftar Akun Admin
                    </div>
                    <div class="mt-6 text-gray-500">
                        <p>Di sini Anda dapat melihat semua akun admin</p>
                    </div>
                    <div class="mt-6 rounded-md border-solid border-2 border-stone-950">
                        <table class="table-auto w-full ">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-solid border-2 border-stone-950 py-3">Nama Akun</th>
                                    <th scope="col" class="border-solid border-2 border-stone-950 py-3">Role</th>
                                    <th scope="col" class="border-solid border-2 border-stone-950 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->isEmpty())
                                    <tr>
                                        <td colspan="3" class="border-solid border-2 border-stone-950 p-3">No users found</td>
                                    </tr>
                                @else
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="border-solid border-2 border-stone-950 p-3">{{ $user->name }}</td>
                                            <td class="text-center border-solid border-2 border-stone-950 p-3">{{ $user->role }}</td>
                                            <td class="text-center border-solid border-2 border-stone-950 p-3">
                                                <div>
                                                    <a href="{{ route('logakun.edit', $user->id) }}">
                                                        <x-secondary-button>
                                                            <i class="fas fa-edit"></i>
                                                        </x-secondary-button>
                                                    </a>
                                                    <form action="{{ route('logakun.destroy', $user->id) }}" method="post" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                                        @csrf
                                                        @method('delete')
                                                        <x-danger-button type="submit">
                                                            <i class="fas fa-trash"></i>
                                                        </x-danger-button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
{{-- @endsection --}}
