<x-app-layout>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ccc;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ccc;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    table a, #headerBtn {
        text-decoration: none;
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border-radius: 4px;
    }

    table a:hover, #headerBtn {
        background-color: #0056b3;
    }
    #delBtn {
        background-color: red;
    }
</style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div>
                    <section>
                        <header>
                            <div style="display: inline-block;float: left; ">
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Users Listing') }}
                                </h2>
    
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Are users are listed here what have been created by you.') }}
                                </p>
                            </div>
                            <div style="display: inline-block; float: right;">
                                <a style="margin:10px" id="headerBtn" href="/create-user">Invite New User</a>
                            </div>
                        </header>
                        
                        <table>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                            @foreach($users as $key => $user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->type}}</td>
                                <td>
                                    <!-- <a>Edit</a> -->
                                    <a href="/user-delete/{{$user->id}}" id="delBtn" style="margin-left: 5px;">Delete</a></td>
                            </tr>
                            @endforeach
                        </table>
                    </section>
                </div>
            </div>
        </div>
</x-app-layout>
