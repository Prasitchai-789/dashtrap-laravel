@extends('layouts.root')

@section('content')
@include('layouts.root/page-title', ['subtitle' => 'Admin', 'title' => 'Role'])
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
                        <a href="{{ url('roles/create') }}" class="float-right px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 float-end">Create Role</a>
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
                            @foreach ($roles as $role)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4">{{ $role->id }}</td>
                                <td class="p-4 text-center">{{ $role->name }}</td>
                                <td class="p-4 space-x-2 text-center">
                                    <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-success text-white">Add / Edit Role Permission</a>
                                    @can('update role')
                                    <a href="{{ url('roles/'.$role->id.'/edit') }}" class="text-yellow-600 hover:text-yellow-700">
                                        <i class="text-xl material-symbols-rounded">toggle_on</i>
                                    </a>
                                    @endcan
                                    @can('delete role')
                                    <a href="#" onclick="confirmDeleteRole('{{ url('roles/'.$role->id.'/delete') }}')" class="text-red-600 hover:text-red-700">
                                        <i class="text-xl bi bi-trash">1</i>
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
    function confirmDeleteRole(url) {
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
