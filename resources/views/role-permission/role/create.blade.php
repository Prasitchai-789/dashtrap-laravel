@extends('layouts.root')

@section('content')
@include('layouts.root/page-title', ['subtitle' => 'Admin', 'title' => 'Create Role'])
<div>
    <div class="page-header">
        <div class="p-6 bg-white rounded-lg shadow-md">
            <div class="pb-4 mb-4">
                <h4 class="text-xl font-semibold">
                    <a href="{{ url('roles') }}" class="float-right px-3 py-1 text-white bg-red-500 rounded-md">Back</a>
                </h4>
            </div>
            <form action="{{ url('roles') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="inline-block mb-2 text-sm font-medium text-default-800">Role Name</label>
                    <input type="text" id="name" name="name" class="border rounded-md form-input focus:ring focus:ring-blue-100">
                </div>
                <div>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
