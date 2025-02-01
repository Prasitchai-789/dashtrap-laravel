@extends('layouts.root')

@section('content')
@include('layouts.root/page-title', ['subtitle' => 'Admin', 'title' => 'Edit User'])
<div class="">
    <div class="my-2 page-header">
        <div class="mb-0 page-block card">

            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="pb-4">
                    <h4 class="text-xl font-semibold">
                        <a href="{{ url('users') }}"
                            class="float-right px-3 py-1 text-white bg-red-500 rounded-md">Back</a>
                    </h4>
                </div>
                <form action="{{ url('users/'.$user->id)}}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="inline-block mb-2 text-sm font-medium text-default-800">Name</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}"
                            class="border rounded-md form-input focus:ring focus:ring-blue-100">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="email" class="inline-block mb-2 text-sm font-medium text-default-800">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                            class="border rounded-md form-input focus:ring focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="emp_id" class="inline-block mb-2 text-sm font-medium text-default-800">Employee
                            Name</label>
                        <select class="form-select" id="emp_id" name="emp_id" wire:model="emp_id" required>
                            <option selected="" value="">
                                เลือกชื่อ...</option>
                            @foreach($emps as $emp)
                            <option value="{{ $emp->EmpID }}"
                                {{ $emp->EmpID == $emp_id ? 'selected' : '' }}>
                                {{ $emp->EmpName }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="password"
                            class="inline-block mb-2 text-sm font-medium text-default-800">Password</label>
                        <input type="password" id="password" name="password" class="border rounded-md form-input focus:ring focus:ring-blue-100">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="example-multiselect" class="inline-block mb-2 text-sm font-medium text-default-800">
                            Role
                        </label>
                        <select name="roles[]" id="example-multiselect" multiple
                            class="border rounded-md form-input focus:ring focus:ring-blue-100">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                            @endforeach
                            @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
                        </select>
                    </div>
                    <div>
                        <button type="submit"
                            class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
