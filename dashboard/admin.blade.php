@extends('layouts.app')

@push('datatable-styles')
    @include('sections.daterange_css')
@endpush

@push('styles')
    <style>
        /* --- GLOBAL LAYOUT --- */
        .admin-dashboard {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden; /* Prevent scroll on body */
        }

        /* Background Mesh/Gradient Overlay */
        .admin-dashboard::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background:
                radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(236, 72, 153, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(59, 130, 246, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        /* --- SIDEBAR STYLES --- */
        .dashboard-sidebar {
            width: 280px;
            background: white;
            padding: 2rem 1.5rem;
            border-right: 1px solid rgba(0,0,0,0.05);
            box-shadow: 4px 0 20px rgba(0,0,0,0.03);
            display: flex;
            flex-direction: column;
            flex-shrink: 0; /* Prevent shrinking */
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
        }

        .sidebar-title {
            color: #94a3b8;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-left: 1rem;
        }

        /* Sidebar Menu Items (Vertical) */
        .project-menu {
            display: flex;
            flex-direction: column; /* Stack vertically */
            gap: 0.75rem;
            width: 100%;
        }

        .p-sub-menu {
            display: flex;
            align-items: center;
            width: 100%;
            background: transparent;
            color: #64748b;
            border: none;
            border-radius: 12px;
            padding: 1rem 1.25rem; /* Larger click area */
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: capitalize;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            text-decoration: none;
        }

        .p-sub-menu:hover {
            color: #6366f1;
            background: rgba(99, 102, 241, 0.05);
            transform: translateX(5px); /* Move right on hover */
        }

        .p-sub-menu.active {
            color: white;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.25);
            transform: translateX(5px);
        }

        /* Icons in menu (Optional: Add icons via CSS or HTML if available) */
        .p-sub-menu::after {
            content: '→'; /* Arrow indicator */
            position: absolute;
            right: 15px;
            opacity: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .p-sub-menu.active::after {
            opacity: 1;
            transform: translateX(3px);
        }

        /* --- MAIN CONTENT AREA --- */
        .dashboard-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0; /* Prevent flex overflow */
        }

        /* Top Header (Right Side) */
        .dashboard-topbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            margin: 1.5rem 1.5rem 0 1.5rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            display: flex;
            justify-content: space-between; /* Space between title and filters */
            align-items: center;
        }

        /* Content Wrapper */
        #dashboard-content-area {
            padding: 1.5rem;
            flex-grow: 1;
        }

        /* --- PRESERVED COMPONENTS --- */
        /* Date Range Picker */
        #datatableRange2 {
            background: white;
            border-radius: 12px;
            padding: 0.6rem 1rem;
            font-weight: 600;
            color: #334155;
            border: 1px solid #e2e8f0;
            min-width: 240px;
        }
        
        /* Settings Icon */
        .admin-dash-settings .dropdown-toggle {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: white;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .admin-dash-settings .dropdown-toggle:hover {
            background: #6366f1;
            color: white;
            border-color: #6366f1;
        }

        /* Dropdown Styles (Preserved) */
        .dashboard-settings {
            width: 650px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            border: none;
        }

        /* Helper */
        .h-100 { height: 100%; }
        .w-100 { width: 100%; }
        .d-none { display: none !important; }
        
        /* Responsive */
        @media (max-width: 992px) {
            .dashboard-container { flex-direction: column; }
            .dashboard-sidebar { 
                width: 100%; 
                height: auto; 
                position: relative;
                padding: 1rem;
                flex-direction: row;
                overflow-x: auto;
                white-space: nowrap;
                border-bottom: 1px solid #eee;
            }
            .project-menu { flex-direction: row; }
            .p-sub-menu { width: auto; margin-right: 0.5rem; }
            .dashboard-topbar { margin: 1rem 1rem 0 1rem; flex-direction: column; gap: 1rem; }
        }
        
      
    </style>
@endpush

@section('filter-section')
    @endsection

@section('content')

<div class="admin-dashboard">
    <div class="dashboard-container">

        <aside class="dashboard-sidebar">
            
            <div class="sidebar-title">Dashboard Menu</div>

            <div class="project-menu" id="mob-client-detail">
                @if ($viewOverviewDashboard == 'all')
                    <x-tab :href="route('dashboard.advanced').'?tab=overview'" :text="__('modules.projects.overview')"
                           class="overview p-sub-menu" ajax="false"/>
                @endif

                @if (in_array('projects', user_modules()) && $viewProjectDashboard == 'all')
                    <x-tab :href="route('dashboard.advanced').'?tab=project'" :text="__('app.project')" 
                           class="project p-sub-menu" ajax="false"/>
                @endif

                @if (in_array('clients', user_modules()) && $viewClientDashboard == 'all')
                    <x-tab :href="route('dashboard.advanced').'?tab=client'" :text="__('app.client')" 
                           class="client p-sub-menu" ajax="false"/>
                @endif

                @if ($viewHRDashboard == 'all' && (in_array('employees', user_modules()) || in_array('leaves', user_modules()) || in_array('attendance', user_modules())))
                    <x-tab :href="route('dashboard.advanced').'?tab=hr'" :text="__('app.menu.hr')" 
                           class="hr p-sub-menu" ajax="false"/>
                @endif

                @if (in_array('tickets', user_modules()) && $viewTicketDashboard == 'all')
                    <x-tab :href="route('dashboard.advanced').'?tab=ticket'" :text="__('app.menu.ticket')" 
                           class="ticket p-sub-menu" ajax="false"/>
                @endif

                @if ($viewFinanceDashboard == 'all' && (in_array('invoices', user_modules()) || in_array('estimates', user_modules()) || in_array('leads', user_modules())))
                    <x-tab :href="route('dashboard.advanced').'?tab=finance'" :text="__('app.menu.finance')" 
                           class="finance p-sub-menu" ajax="false"/>
                @endif
                    <a href="{{ route('dashboard') }}" class="p-sub-menu">
                        {{ __('app.menu.privateDashboard') }}
                    </a>
            
            </div>
        </aside>
        <main class="dashboard-body">
            
            <div class="dashboard-topbar">
                
                <div>
                   <h4 class="mb-0 f-18 f-w-600 text-dark">
                       @if(request('tab') == 'project') @lang('app.project') 
                       @elseif(request('tab') == 'client') @lang('app.client')
                       @elseif(request('tab') == 'hr') @lang('app.menu.hr')
                       @elseif(request('tab') == 'finance') @lang('app.menu.finance')
                       @else @lang('modules.projects.overview')
                       @endif
                       Dashboard
                   </h4>
                </div>

                <div class="d-flex align-items-center">
                    <div class="{{ request('tab') == 'overview' || request('tab') == '' ? 'd-none' : 'd-flex' }} align-items-center">
                        <div class="input-group bg-white rounded shadow-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-transparent"><i class="fa fa-calendar-alt text-primary"></i></span>
                            </div>
                            <input type="text" class="form-control border-0" id="datatableRange2" placeholder="@lang('placeholders.dateRange')">
                        </div>
                    </div>

                    @if (isset($widgets) && in_array('admin', user_roles()))
                    <div class="admin-dash-settings ml-3">
                        <x-form id="dashboardWidgetForm" method="POST">
                            <div class="dropdown keep-open">
                                <a class="dropdown-toggle" type="link" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-sliders-h text-secondary"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right dashboard-settings" aria-labelledby="dropdownMenuLink">
                                    <li class="border-bottom pb-3 mb-3">
                                        <h4 class="heading-h3">@lang('modules.dashboard.dashboardWidgets')</h4>
                                    </li>
                                    @foreach ($widgets as $widget)
                                        @php $wname = \Illuminate\Support\Str::camel($widget->widget_name); @endphp
                                        <li class="mb-2 float-left w-50">
                                            <div class="checkbox checkbox-info">
                                                <input id="{{ $widget->widget_name }}" name="{{ $widget->widget_name }}" value="true" @if ($widget->status) checked @endif type="checkbox">
                                                <label for="{{ $widget->widget_name }}">@lang('modules.dashboard.' . $wname)</label>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li class="float-none w-100 pt-3 clearfix">
                                        <x-forms.button-primary id="save-dashboard-widget" icon="check">@lang('app.save')</x-forms.button-primary>
                                    </li>
                                </ul>
                            </div>
                        </x-form>
                    </div>
                    @endif
                </div>
            </div>

            <div id="dashboard-content-area">
                @include($view)
            </div>

        </main>
        </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/jquery/daterangepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var format = '{{ company()->moment_date_format }}';
            var startDate = "{{ $startDate->format(company()->date_format) }}";
            var endDate = "{{ $endDate->format(company()->date_format) }}";
            var start = moment(startDate, format);
            var end = moment(endDate, format);

            $('#datatableRange2').daterangepicker({
                locale: daterangeLocale,
                linkedCalendars: false,
                startDate: start,
                endDate: end,
                ranges: daterangeConfig,
                opens: 'left',
                parentEl: '.dashboard-container' // Changed parent
            }, cb);

            $('#datatableRange2').on('apply.daterangepicker', function (ev, picker) {
                showTable();
            });
        });
    </script>

    <script>
        // SIDEBAR CLICK HANDLER
        $(".project-menu").on("click", ".ajax-tab", function (event) {
            event.preventDefault();

            $('.project-menu .p-sub-menu').removeClass('active');
            $(this).addClass('active');

            const dateRangePicker = $('#datatableRange2').data('daterangepicker');
            let startDate = $('#datatableRange').val(); // Note: Check if this ID exists, might be datatableRange2
            let endDate;

            if (startDate === '' || typeof startDate === 'undefined') {
                startDate = null;
                endDate = null;
            } else {
                startDate = dateRangePicker.startDate.format('{{ company()->moment_date_format }}');
                endDate = dateRangePicker.endDate.format('{{ company()->moment_date_format }}');
            }

            const requestUrl = this.href;

            $.easyAjax({
                url: requestUrl,
                blockUI: true,
                container: "#dashboard-content-area", // IMPORTANT: Changed to target only the content area
                historyPush: true,
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                success: function (response) {
                    if (response.status === "success") {
                        $('#dashboard-content-area').html(response.html);
                        init('#dashboard-content-area');
                    }
                }
            });
        });

        $('.keep-open .dropdown-menu').on({
            "click": function (e) {
                e.stopPropagation();
            }
        });

        function showTable() {
            const dateRangePicker = $('#datatableRange2').data('daterangepicker');
            // Ensure we are getting value from the correct input
            let startDateVal = $('#datatableRange2').val(); 

            let startDate, endDate;

            if (startDateVal === '') {
                startDate = null;
                endDate = null;
            } else {
                startDate = dateRangePicker.startDate.format('{{ company()->moment_date_format }}');
                endDate = dateRangePicker.endDate.format('{{ company()->moment_date_format }}');
            }

            // Get current active tab URL
            const activeUrl = $('.project-menu .active').attr('href');

            $.easyAjax({
                url: activeUrl,
                blockUI: true,
                container: "#dashboard-content-area", // IMPORTANT: Target content only
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                success: function (response) {
                    if (response.status === "success") {
                        $('#dashboard-content-area').html(response.html);
                        init('#dashboard-content-area');
                    }
                }
            });
        }
    </script>
    <script>
        const activeTab = "{{ $activeTab }}";
        $('.project-menu .' + activeTab).addClass('active');
    </script>
@endpush