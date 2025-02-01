@extends('layouts.root')

@section('content')
@include('layouts.root/page-title', ['subtitle' => 'Admin', 'title' => 'User'])

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
                        <a href="{{ url('users/create') }}" class="float-right px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 float-end">Create User</a>
                    </h4>
                </div>

                <div class="mt-4 overflow-x-auto">
                    <table class="w-full bg-white border-collapse rounded-lg shadow-md font-anuphan">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="p-4 text-center border">ID</th>
                                <th class="p-4 text-center border">Name</th>
                                <th class="p-4 text-center border">Email</th>
                                <th class="p-4 text-center border">Role</th>
                                <th class="p-4 text-center border">Epm_Name</th>
                                <th class="p-4 text-center border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-center border">{{$user->id}}</td>
                                <td class="px-4 py-2 border ">{{ $user->name }}</td>
                                <td class="px-4 py-2 border">{{ $user->email }}</td>
                                <td class="px-4 py-2 border">
                                    @if (!empty($user->getRoleNames()))
                                    @foreach ( $user->getRoleNames() as $rolename )
                                    <label class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-primary text-white">{{ $rolename }}</label>
                                    @endforeach
                                    @endif
                                </td>
                                <td class="px-4 py-2 border font-anuphan">{{$user->emp->EmpName ?? 'N/A'}}</td>
                                <td class="px-4 py-2 text-center border">
                                    <a href="{{ url('users/'.$user->id.'/edit') }}" class="text-yellow-500 hover:text-yellow-600">
                                        <i class="i-tabler-brand-blender" style="font-size: 18px;"></i>
                                    </a>
                                    @can('delete permission')
                                        <a href="#" onclick="confirmDeletePermission('{{ url('users/'.$user->id.'/delete') }}')" class="ml-3 text-red-500 hover:text-red-600">
                                            <i class="i-tabler-brand-blender" style="font-size: 18px;"></i>
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
        function confirmDeleteUser(url) {
        Swal.fire({
            title: 'คุณต้องการลบชื่อผู้ใช้ ?',
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

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>
        Pusher.logToConsole = true;

    // Initialize Pusher
    var pusher = new Pusher('23e8425d99d03c43460a', {
        cluster: 'ap1'
    });

    // Subscribe to the channel
    var channel = pusher.subscribe('notification');

    // Bind to the event
    channel.bind('test.notification', function(data) {
        // console.log('Received data:', data); // Debugging line

        let timerInterval;
        Swal.fire({
            title: "แจ้งเตือนการขออนุญาต!",
            html: "I will close in <b></b> milliseconds.",
            timer: 2000,
            timerProgressBar: true,
            customClass: {
                title: 'custom-title',
                htmlContainer: 'custom-html'
                },
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                    timer.textContent = `${Swal.getTimerLeft()}`;
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log("I was closed by the timer");
                // Reload the page after Swal closes
                window.location.reload(); // รีโหลดหน้าหลังจากที่ Swal ปิด

            }
});


    });
    // Debugging line
    pusher.connection.bind('connected', function() {
        // console.log('Pusher connected');
    });
    </script>




    @endsection
