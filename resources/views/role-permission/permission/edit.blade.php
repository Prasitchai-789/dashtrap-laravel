@extends('layouts.root')

@section('content')

@include('layouts.root/page-title', ['subtitle' => 'Apps', 'title' => 'Edit Permission'])

    <div class="">
        <div class="my-2 page-header">
            <div class="mb-0 page-block card">
                <div class="card-body">

                    <div class="">
                        <div class="pb-4 mb-4">
                            <h4 class="text-xl font-semibold">
                                <a href="{{ url('permissions') }}"
                                    class="float-right px-3 py-1 text-white bg-red-500 rounded-md">Back</a>
                            </h4>
                        </div>
                        <form action="{{ url('permissions/'.$permission->id)}}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="name" class="inline-block mb-2 text-sm font-medium text-default-800">Name</label>
                                <input type="text" id="name" name="name"
                                    class="border rounded-md form-input focus:ring focus:ring-blue-100" value="{{ $permission->name }}">
                            </div>
                            <div>
                                <button type="submit"
                                    class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>



@endsection
