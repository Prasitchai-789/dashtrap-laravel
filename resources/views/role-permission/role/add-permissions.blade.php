@extends('layouts.root')

@section('content')
@include('layouts.root/page-title', ['subtitle' => 'Admin', 'title' => 'Role Permission'])
<div class="">
    <div class="w-full p-4 bg-white rounded-lg shadow">
        <div class="pb-2 mb-4">
            @if (session('status'))
            <div class="p-2 mb-2 text-sm text-green-700 bg-green-100 rounded">
                {{ session('status') }}
            </div>
            @endif
            <h4 class="text-lg font-semibold">Role: {{ $role->name }}
                <a href="{{ url('roles') }}" class="px-3 py-1 ml-2 text-white bg-red-500 rounded hover:bg-red-600 float-end">Back</a>
            </h4>
        </div>
        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                @error('permission')
                <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
                <label class="block mb-4 text-sm font-semibold">Permissions</label>
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                    @foreach ($permissions as $permission)
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="permission[]" value="{{ $permission->name }}" class="border-gray-300 rounded focus:ring-blue-500"
                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                        <label class="text-sm">{{ $permission->name }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div>
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>

</div>



@endsection
