@extends('layouts.app', [
    'class' => ''
])

@section('title')
Customer
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Crew List</h4>
                    @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{session()->get('success')}}
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable">
                            <thead class="text-white bg-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Nomor Telepon</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->phone_number }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>
                                            <div class="row">
                                                {{-- <a href="{{ route('superadmin.customer.show', $customer->id) }}" class="btn btn-info" ><i class="fa fa-eye"></i></a> --}}
                                                <a href="{{ route('superadmin.customer.edit', $customer->id) }}" class="btn btn-warning" ><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('superadmin.customer.destroy', $customer->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" style="background-color: red;" type="submit">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
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
</div>
@endsection

{{-- @push('scripts')
<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script>
    ;
    $('#dataTable').DataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{!! route('superadmin.product.data') !!}",
            type: 'GET'
        },
        columns:[
            {
                data: 'banner',
                name: 'banner'
            },

        ]
    });
</script>
@endpush --}}


