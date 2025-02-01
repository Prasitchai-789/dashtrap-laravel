@extends('layouts.root')

@section('content')

@include('layouts.root/page-title', ['subtitle' => 'Apps', 'title' => 'Permission'])

<div class="">
    <div class="page-header">
        <div class="p-6 mb-0 bg-white rounded-lg shadow-lg page-block">
            <div class="flex flex-col">
                @if (session('status'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
                    {{ session('status') }}
                </div>
                @endif

                <div class="">
                    <h4 class="text-xl font-semibold">
                        <a href="{{ url('permissions/create') }}" class="float-right px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 float-end">
                            Create Permission
                        </a>
                    </h4>
                </div>

                <div class="mt-4 overflow-x-auto">
                    <table class="w-full bg-white border-collapse rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="p-4 text-left">ID</th>
                                <th class="p-4 text-center">Name</th>
                                <th class="p-4 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-center border">{{ $permission->id }}</td>
                                <td class="px-4 py-2 border">{{ $permission->name }}</td>
                                <td class="px-4 py-2 text-center border">
                                    <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="text-yellow-500 hover:text-yellow-600">
                                        <i class="text-2xl material-symbols-rounded">toggle_on</i>
                                    </a>
                                    @can('delete permission')
                                        <a href="#" onclick="confirmDeletePermission('{{ url('permissions/'.$permission->id.'/delete') }}')" class="ml-3 text-red-500 hover:text-red-600">
                                            <i class="text-2xl material-symbols-rounded">delete</i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDeletePermission(url) {
        Swal.fire({
            title: 'คุณต้องการลบใช่หรือไม่ ?',
            text: "เพราะไม่สามารถกู้คืนได้ !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ต้องการลบ !'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url; // เมื่อยืนยันการลบ เปลี่ยนเส้นทางไปยัง URL ที่ตั้งไว้
            }
        })
    }
</script>

@endsection
