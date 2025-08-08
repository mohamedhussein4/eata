@extends('layouts.dashboard')

@section('page-title', 'إدارة المتطوعين')

@section('content')
    <!-- Page header start -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">المتطوعين</li>
            <li class="breadcrumb-item active">عرض المتطوعين</li>
        </ol>

        <ul class="app-actions">
            <li>
                <a href="#" id="reportrange">
                    <span class="range-text"></span>
                    <i class="icon-chevron-down"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print">
                    <i class="icon-print"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="tooltip" data-placement="top" title=""
                    data-original-title="Download CSV">
                    <i class="icon-cloud_download"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- Page header end -->


    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row gutters">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-container">
                    <div class="t-header">No Search Field</div>
                    <div class="table-responsive">
                        <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid"
                                aria-describedby="copy-print-csv_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="users-table" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="ID: activate to sort column descending" style="width: 249.562px;">
                                            الرقم التعريفي</th>
                                        <th class="sorting" tabindex="0" aria-controls="users-table" rowspan="1"
                                            colspan="1" aria-label="Name: activate to sort column ascending"
                                            style="width: 389.656px;">اسم المستخدم</th>
                                        <th class="sorting" tabindex="0" aria-controls="users-table" rowspan="1"
                                            colspan="1" aria-label="Email: activate to sort column ascending"
                                            style="width: 189.203px;">البريد الالكتروني</th>
                                        <th class="sorting" tabindex="0" aria-controls="users-table" rowspan="1"
                                            colspan="1" aria-label="Type: activate to sort column ascending"
                                            style="width: 100.344px;">صلاحيات المستخدم</th>
                                        <th class="sorting" tabindex="0" aria-controls="users-table" rowspan="1"
                                            colspan="1" aria-label="Actions: activate to sort column ascending"
                                            style="width: 199.906px;">الإجراءات </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->type }}</td>

                                            <td>
                                                @if ($user->is_active)
                                                    <!-- زر لتعطيل المستخدم -->
                                                    <form action="{{ route('admin.users.deactivate', $user->id) }}" method="POST"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-warning">تعطيل</button>
                                                    </form>
                                                @else
                                                    <!-- زر لتفعيل المستخدم -->
                                                    <form action="{{ route('admin.users.activate', $user->id) }}" method="POST"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success">تفعيل</button>
                                                    </form>
                                                @endif

                                                <!-- زر الحذف -->
                                                <form action="{{ route('admin.e-wallets.destroy', $user->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                </form>
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
        <!-- Row end -->

    </div>
    <!-- Content wrapper end -->
@endsection
