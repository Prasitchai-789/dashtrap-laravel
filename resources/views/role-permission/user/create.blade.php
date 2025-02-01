@extends('layouts.root')

@section('content')

@include('layouts.root/page-title', ['subtitle' => 'Admin', 'title' => 'Create User'])

    <div>
        <div class="page-header">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="pb-4">
                    <h4 class="text-xl font-semibold">
                        <a href="{{ url('users') }}" class="float-right px-3 py-1 text-white bg-red-500 rounded-md">Back</a>
                    </h4>
                </div>
                <form action="{{ url('users') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="inline-block mb-2 text-sm font-medium text-default-800">Name</label>
                        <input type="text" id="name" name="name" class="border rounded-md form-input focus:ring focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="email" class="inline-block mb-2 text-sm font-medium text-default-800">Email</label>
                        <input type="email" id="email" name="email" class="border rounded-md form-input focus:ring focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="password" class="inline-block mb-2 text-sm font-medium text-default-800">Password</label>
                        <input type="password" id="password" name="password" class="border rounded-md form-input focus:ring focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="example-multiselect" class="inline-block mb-2 text-sm font-medium text-default-800">
                            Role
                        </label>
                        <select name="roles[]" id="example-multiselect" multiple class="border rounded-md form-input focus:ring focus:ring-blue-100">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
