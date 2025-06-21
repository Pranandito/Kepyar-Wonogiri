<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Akun Admin') }}
        </h2>
    </x-slot>

    {{-- Form for create account with field Nama, Email, Password, Confirm Password, and Role --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('logakun.index') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama -->
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>

                            <input id="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" type="text" name="name" value="{{ old('name') }}" required autofocus />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>

                            <input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" type="email" name="email" value="{{ old('email') }}" required />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>

                            <input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" type="password" name="password" required />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Password</label>

                            <input id="password_confirmation" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" type="password" name="password_confirmation" required />
                        </div>

                        <!-- Role -->
                        <div class="mt-4">
                            <label for="role" class="block font-medium text-sm text-gray-700">Role</label>

                            <select id="role" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="super_admin">Superadmin</option>
                            </select>
                        </div>

                        <!-- Button Register -->
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                                {{ __('Daftar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
