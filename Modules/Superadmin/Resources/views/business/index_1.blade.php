@extends('dashboard.layouts.master')
@section('title', __('superadmin::lang.superadmin') . ' | Business')
@section('css')

    <link rel="stylesheet" href="{{asset('dashboard/assets/sweetalert2.min.css')}}">
    <script src="{{asset('dashboard/assets/sweetalert2.all.min.js')}}"></script>
@endsection



@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header" style='justify-content: end !important;'>
{{--                        <div class="card-title">--}}
                            <div class='row'>
                                <div class='col'>
                                    <a href="{{action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'create'])}}"
                                       class="btn btn-block btn-primary">
                                        <i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
                                </div>
                            </div>

{{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        @can('superadmin')
                        <div class='table-responsive'>

                            <table id="file-export_wrapper" class="superadmin_business_table dataTables_wrapper dt-bootstrap5 no-footer">
                                <thead>
                                <tr>
                                    <th>
                                        @lang('superadmin::lang.registered_on')
                                    </th>
                                    <th>@lang( 'superadmin::lang.business_name' )</th>
                                    <th>@lang('business.owner')</th>
                                    <th>@lang('business.email')</th>
                                    <th>@lang('superadmin::lang.owner_number')</th>
                                    <th>@lang( 'superadmin::lang.business_contact_number' )</th>
                                    <th>@lang('business.address')</th>
                                    <th>@lang( 'sale.status' )</th>
                                    <th>@lang( 'superadmin::lang.current_subscription' )</th>
                                    <th>@lang( 'business.created_by' )</th>
                                    <th>@lang( 'superadmin::lang.action' )</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!--End::row-1 -->
        <!-- End::row-1 -->
    </div>

@endsection

@section('js')

    <script type="text/javascript">
        $(document).ready(function() {

            superadmin_business_table = $('.superadmin_business_table').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Blfrtip',
                lengthMenu :[
                    [10, 25, 50, 100, 500, 750, -1],
                    ['10', '25 ', '50 ', '100 ', '500 ', '750',"All"]
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                ajax: {
                    url: "{{action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'index'])}}",
                    data: function(d) {
                        d.package_id = $('#package_id').val();
                        d.subscription_status = $('#subscription_status').val();
                        d.is_active = $('#is_active').val();
                        d.last_transaction_date = $('#last_transaction_date').val();
                        d.no_transaction_since = $('#no_transaction_since').val();
                    },
                },
                aaSorting: [[0, 'desc']],
                columns: [
                    { data: 'created_at', name: 'business.created_at' },
                    { data: 'name', name: 'business.name' },
                    { data: 'owner_name', name: 'owner_name', searchable: false },
                    { data: 'owner_email', name: 'u.email' },
                    { data: 'contact_number', name: 'u.contact_number' },
                    { data: 'business_contact_number', name: 'business_contact_number' },
                    { data: 'address', name: 'address' },
                    { data: 'is_active', name: 'is_active', searchable: false },
                    { data: 'current_subscription', name: 'p.name' },
                    { data: 'biz_creator', name: 'biz_creator', searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });

            $('#package_id, #subscription_status, #is_active, #last_transaction_date, #no_transaction_since').change(function() {
                superadmin_business_table.ajax.reload();
            });
        });
        $(document).on('click', 'a.delete_business_confirmation', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                text: 'Once deleted, you will not be able to recover this business!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    window.location.href = $(this).attr('href');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            // استهداف العنصر الذي يحمل الفئة .dt-buttons
            var dtButtonsContainer = $('.dt-buttons');

            // استهداف جميع الأزرار داخل العنصر
            var buttons = dtButtonsContainer.find('button');

            // إضافة الفئة .btn-primary إلى جميع الأزرار
            buttons.addClass('btn-info');
        });


    </script>

@endsection