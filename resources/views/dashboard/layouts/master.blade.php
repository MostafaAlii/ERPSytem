@include('dashboard.common.includes._tpl_start')

<div class="page">
    @include('dashboard.common.includes._header')
    @include('dashboard.common.includes._aside')
    <!-- Start::app-content -->
    <div class="main-content app-content">
{{--        @include('dashboard.common._partials.messages')--}}
        @yield('content')
    </div>
    @include('dashboard.common.includes._footer')
</div>

@include('dashboard.common.includes._tpl_end')