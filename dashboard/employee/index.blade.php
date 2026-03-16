@extends('layouts.app')

@push('styles')
    @if ((!is_null($viewEventPermission) && $viewEventPermission != 'none')
        || (!is_null($viewHolidayPermission) && $viewHolidayPermission != 'none')
        || (!is_null($viewTaskPermission) && $viewTaskPermission != 'none')
        || (!is_null($viewTicketsPermission) && $viewTicketsPermission != 'none')
        || (!is_null($viewLeavePermission) && $viewLeavePermission != 'none')
        )
        <link rel="stylesheet" href="{{ asset('vendor/full-calendar/main.min.css') }}" defer="defer">
    @endif
    <style>
        /* Modern Dashboard Styles */
        .emp-dashboard {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            min-height: 100vh;
        }

        .modern-welcome-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .modern-welcome-section h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .time-display {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .time-display .time {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .time-display .date {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-top: 0.25rem;
        }

        .clock-status {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: inline-block;
        }

        .modern-btn-clock {
            background: white;
            color: #667eea;
            border: none;
            border-radius: 12px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .modern-btn-clock:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            color: #667eea;
        }

        .modern-btn-clock.clock-out {
            background: #ff6b6b;
            color: white;
        }

        .modern-btn-clock.clock-out:hover {
            background: #ee5a52;
            color: white;
        }

        .settings-trigger {
            background: rgba(255, 255, 255, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .settings-trigger:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        /* Alert Banners */
        .modern-alert {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 15px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
            color: white;
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
        }

        .modern-alert a {
            color: white;
            font-weight: 600;
            text-decoration: none;
            border-bottom: 2px solid white;
            transition: all 0.3s ease;
        }

        .modern-alert a:hover {
            border-bottom-color: transparent;
        }

        /* Profile Card */
        .profile-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: none;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        .profile-card .card-img {
            width: 100px;
            height: 100px;
            border-radius: 20px;
            overflow: hidden;
            margin: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .profile-card .card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-card .card-body {
            padding: 1.5rem;
        }

        .profile-card .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
        }

        .profile-stats {
            background: linear-gradient(135deg, #f6f8fb 0%, #ffffff 100%);
            padding: 1.5rem;
            border-top: 1px solid #e8ecf1;
        }

        .stat-item {
            text-align: center;
            padding: 0.5rem;
        }

        .stat-item label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #718096;
            font-weight: 600;
        }

        .stat-item .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2d3748;
            margin-top: 0.25rem;
        }

        .stat-item a {
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .stat-item a:hover .stat-value {
            color: #667eea;
        }

        /* Widget Cards */
        .widget-card {
            background: white;
            border-radius: 20px;
            padding: 1.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: none;
            transition: all 0.3s ease;
            height: 100%;
        }

        .widget-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .widget-card .widget-title {
            font-size: 1rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Metric Cards */
        .metric-card {
            background: white;
            border-radius: 18px;
            padding: 1.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .metric-card:hover {
            border-color: #667eea;
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.15);
        }

        .metric-card .metric-content .metric-label {
            font-size: 0.875rem;
            color: #718096;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .metric-card .metric-content .metric-numbers {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
        }

        .metric-card .metric-content .metric-number {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
        }

        .metric-card .metric-content .metric-sublabel {
            font-size: 0.75rem;
            color: #a0aec0;
            margin-top: 0.25rem;
            text-transform: uppercase;
        }

        .metric-card .metric-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .metric-card.tasks .metric-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .metric-card.projects .metric-icon {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        /* Active Timer */
        .active-timer-card {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            border-radius: 20px;
            padding: 1.75rem;
            color: white;
            box-shadow: 0 8px 30px rgba(250, 112, 154, 0.3);
        }

        .active-timer-card .timer-info {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1rem;
            margin: 1rem 0;
        }

        .timer-controls {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 1rem;
        }

        .timer-btn {
            background: white;
            color: #fa709a;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .timer-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Lists */
        .modern-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .modern-list-item {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .modern-list-item:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        /* Calendar Overrides */
        .fc {
            border-radius: 15px;
            overflow: hidden;
        }

        /* Scrollbar */
        .h-200::-webkit-scrollbar {
            width: 6px;
        }

        .h-200::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .h-200::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 10px;
        }

        .h-200::-webkit-scrollbar-thumb:hover {
            background: #764ba2;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .modern-welcome-section h3 {
                font-size: 1.5rem;
            }
            
            .time-display .time {
                font-size: 2rem;
            }

            .dashboard-settings {
                width: 300px;
            }
        }

        /* Week pagination */
        .week-pagination li {
            margin-right: 5px;
        }
        
        .week-pagination li a {
            border-radius: 50%;
            padding: 6px 12px !important;
            font-size: 11px !important;
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .week-pagination li a:hover {
            background: #667eea;
            color: white;
            transform: scale(1.1);
        }

        .dashboard-settings {
            width: 600px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }
    </style>
@endpush

@section('content')
    <!-- CONTENT WRAPPER START -->
    <div class="px-4 py-4 emp-dashboard">
        
        <!-- ALERT MESSAGES START -->
        @if (!is_null($checkTodayLeave))
            <div class="row">
                <div class="col-md-12">
                    <div class="modern-alert">
                        <i class="fa fa-info-circle mr-2"></i>
                        <a href="{{ route('leaves.show', $checkTodayLeave->id) }}" class="openRightModal">
                            @lang('messages.youAreOnLeave')
                        </a>
                    </div>
                </div>
            </div>
        @elseif (!is_null($checkTodayHoliday))
            <div class="row">
                <div class="col-md-12">
                    <div class="modern-alert">
                        <i class="fa fa-calendar-day mr-2"></i>
                        <a href="{{ route('holidays.show', $checkTodayHoliday->id) }}" class="openRightModal">
                            @lang('messages.holidayToday')
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if(in_array('admin', user_roles()))
            <div class="row">
                @include('dashboard.update-message-dashboard')
                @includeIf('dashboard.update-message-module-dashboard')
                <x-cron-message :modal="true"></x-cron-message>
            </div>
        @endif
        <!-- ALERT MESSAGES END -->

        <!-- WELCOME SECTION START -->
        <div class="modern-welcome-section">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <h3>Hello, {{ $user->name }}! 👋</h3>
                    <p class="mb-0 opacity-90">Ready to make today productive?</p>
                </div>
                
                <div class="col-lg-6 col-md-6 mt-4 mt-md-0">
                    <div class="d-flex align-items-center justify-content-md-end">
                        <div class="time-display flex-grow-1 mr-3">
                            <input type="hidden" id="current-latitude" name="current_latitude">
                            <input type="hidden" id="current-longitude" name="current_longitude">
                            
                            <div class="time" id="dashboard-clock">
                                {!! now()->timezone(company()->timezone)->translatedFormat(company()->time_format) !!}
                            </div>
                            <div class="date">
                                {!! now()->timezone(company()->timezone)->translatedFormat('l, F d, Y') !!}
                            </div>
                            
                            @if (!is_null($currentClockIn))
                                <div class="clock-status">
                                    <i class="fa fa-clock mr-1"></i>
                                    Started at {{ $currentClockIn->clock_in_time->timezone(company()->timezone)->translatedFormat(company()->time_format) }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="d-flex flex-column gap-2">
                            @if (in_array('attendance', user_modules()) && $cannotLogin == false)
                                @if (is_null($currentClockIn) && is_null($checkTodayLeave) && is_null($checkTodayHoliday) && $checkJoiningDate == true)
                                    <button type="button" class="modern-btn-clock" id="clock-in">
                                        <i class="fa fa-sign-in-alt mr-2"></i>Clock In
                                    </button>
                                @endif
                            @endif

                            @if (!is_null($currentClockIn) && is_null($currentClockIn->clock_out_time))
                                <button type="button" class="modern-btn-clock clock-out" id="clock-out">
                                    <i class="fa fa-sign-out-alt mr-2"></i>Clock Out
                                </button>
                            @endif

                            @if (in_array('admin', user_roles()))
                                <x-form id="privateDashboardWidgetForm" method="POST">
                                    <div class="dropdown keep-open">
                                        <div class="settings-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            data-original-title="Dashboard Settings" data-toggle="tooltip">
                                            <i class="fa fa-cog"></i>
                                        </div>
                                        <ul class="dropdown-menu dropdown-menu-right dashboard-settings p-20" aria-labelledby="dropdownMenuLink">
                                            <li class="border-bottom mb-3 pb-3">
                                                <h4 class="heading-h4 mb-0">@lang('modules.dashboard.dashboardWidgets')</h4>
                                            </li>
                                            @foreach ($widgets as $widget)
                                                @php
                                                    $wname = \Illuminate\Support\Str::camel($widget->widget_name);
                                                @endphp
                                                <li class="mb-2 float-left w-50">
                                                    <div class="checkbox checkbox-info">
                                                        <input id="{{ $widget->widget_name }}" name="{{ $widget->widget_name }}"
                                                            value="true" @if ($widget->status) checked @endif type="checkbox">
                                                        <label for="{{ $widget->widget_name }}">@lang('modules.dashboard.' . $wname)</label>
                                                    </div>
                                                </li>
                                            @endforeach
                                            @if (count($widgets) % 2 != 0)
                                                <li class="mb-2 float-left w-50 height-35"></li>
                                            @endif
                                            <li class="float-none w-100">
                                                <x-forms.button-primary id="save-dashboard-widget" icon="check">@lang('app.save')</x-forms.button-primary>
                                            </li>
                                        </ul>
                                    </div>
                                </x-form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- WELCOME SECTION END -->

        <!-- DASHBOARD CONTENT START -->
        <div class="row">
            <!-- LEFT COLUMN START -->
            @if(count(array_intersect(['profile', 'shift_schedule', 'birthday', 'notices'], $activeWidgets)) > 0)
                <div class="col-xl-5 col-lg-12 col-md-12 mb-4" >
                    <div class="row">
                        @if (in_array('profile', $activeWidgets))
                        <!-- PROFILE CARD START -->
                        <div class="col-md-12 mb-4" >
                            <div class="profile-card">
                                <a @if(!in_array('client', user_roles())) href="{{ route('employees.show', user()->id) }}" @endif>
                                    <div class="card-horizontal align-items-center d-flex">
                                        <div class="card-img">
                                            <img src="{{ $user->image_url }}" alt="Profile">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title mb-1">{{ $user->name }}</h4>
                                            <p class="text-muted mb-1 f-15">{{ $user->employeeDetails->designation->name ?? 'Team Member' }}</p>
                                            <p class="text-secondary f-13 mb-0">
                                                <i class="fa fa-id-badge mr-1"></i>
                                                ID: {{ $user->employeeDetails->employee_id }}
                                            </p>
                                        </div>
                                    </div>
                                </a>

                                <div class="profile-stats">
                                    <div class="row">
                                        @if(in_array('tasks', user_modules()))
                                            <div class="col stat-item">
                                                <label>Active Tasks</label>
                                                <a href="{{ route('tasks.index') . '?assignee=me' }}">
                                                    <div class="stat-value">{{ $inProcessTasks }}</div>
                                                </a>
                                            </div>
                                        @endif
                                        @if(in_array('projects', user_modules()))
                                            <div class="col stat-item">
                                                <label>Projects</label>
                                                <a href="{{ route('projects.index') . '?assignee=me&status=all' }}">
                                                    <div class="stat-value">{{ $totalProjects }}</div>
                                                </a>
                                            </div>
                                        @endif
                                        @if (isset($totalOpenTickets) && in_array('tickets', user_modules()))
                                            <div class="col stat-item">
                                                <label>Open Tickets</label>
                                                <a href="{{ route('tickets.index') . '?agent=me&status=open' }}">
                                                    <div class="stat-value">{{ $totalOpenTickets }}</div>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PROFILE CARD END -->
                        @endif

                        @if (!is_null($myActiveTimer) && in_array('tasks', user_modules()))
                            <div class="col-sm-12 mb-4" id="myActiveTimerSection">
                                <div class="active-timer-card">
                                    <h5 class="mb-3 font-weight-bold">
                                        <i class="fa fa-hourglass-half mr-2"></i>Active Timer
                                    </h5>
                                    
                                    <div class="timer-info">
                                        <div class="mb-2">
                                            <i class="fa fa-calendar-alt mr-2"></i>
                                            {{ $myActiveTimer->start_time->timezone(company()->timezone)->translatedFormat('M d, Y') }}
                                        </div>
                                        <div class="mb-2">
                                            <i class="fa fa-clock mr-2"></i>
                                            Started: {{ $myActiveTimer->start_time->timezone(company()->timezone)->translatedFormat(company()->time_format) }}
                                        </div>
                                        <div class="mb-2">
                                            <i class="fa fa-hourglass mr-2"></i>
                                            Duration: {{ \Carbon\CarbonInterval::formatHuman(now()->diffInMinutes($myActiveTimer->start_time) - $myActiveTimer->breaks->sum('total_minutes')) }}
                                        </div>
                                        <div>
                                            <i class="fa fa-tasks mr-2"></i>
                                            <a href="{{ route('tasks.show', $myActiveTimer->task->id) }}" class="text-white font-weight-bold openRightModal">
                                                {{ $myActiveTimer->task->heading }}
                                            </a>
                                        </div>
                                    </div>

                                    @if (!empty($myActiveTimer->breaks))
                                        <ul class="modern-list mt-3">
                                            @foreach ($myActiveTimer->breaks as $item)
                                                <li class="modern-list-item">
                                                    <span>
                                                        <i class="fa fa-coffee mr-2"></i>Break
                                                        @if (!is_null($item->end_time))
                                                            ({{ \Carbon\CarbonInterval::formatHuman($item->end_time->diffInMinutes($item->start_time)) }})
                                                        @endif
                                                    </span>
                                                    <span>
                                                        {{ $item->start_time->timezone(company()->timezone)->translatedFormat(company()->time_format) }}
                                                        @if (!is_null($item->end_time))
                                                            - {{ $item->end_time->timezone(company()->timezone)->translatedFormat(company()->time_format) }}
                                                        @endif
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if ($editTimelogPermission == 'all' || ($editTimelogPermission == 'added' && $myActiveTimer->added_by == user()->id) || ($editTimelogPermission == 'owned' && (($myActiveTimer->project && $myActiveTimer->project->client_id == user()->id) || $myActiveTimer->user_id == user()->id)) || ($editTimelogPermission == 'both' && (($myActiveTimer->project && $myActiveTimer->project->client_id == user()->id) || $myActiveTimer->user_id == user()->id || $myActiveTimer->added_by == user()->id)))
                                        <div class="timer-controls">
                                            @if (is_null($myActiveTimer->activeBreak))
                                                <button class="timer-btn" data-time-id="{{ $myActiveTimer->id }}" id="pause-timer-btn" data-url="{{ url()->current() }}">
                                                    <i class="fa fa-pause mr-2"></i>Pause
                                                </button>
                                                <button class="timer-btn stop-active-timer" data-url="{{ url()->current() }}" data-time-id="{{ $myActiveTimer->id }}">
                                                    <i class="fa fa-stop mr-2"></i>Stop
                                                </button>
                                            @else
                                                <button class="timer-btn" id="resume-timer-btn" data-url="{{ url()->current() }}" data-time-id="{{ $myActiveTimer->activeBreak->id }}">
                                                    <i class="fa fa-play mr-2"></i>Resume
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @include('dashboard.employee.widgets.shift_schedule')
                        @include('dashboard.employee.widgets.birthday')
                        @include('dashboard.employee.widgets.appreciation')
                        @include('dashboard.employee.widgets.leave')
                        @include('dashboard.employee.widgets.work_from_home')
                        @include('dashboard.employee.widgets.work_anniversary')
                        @include('dashboard.employee.widgets.notice-period')
                        @include('dashboard.employee.widgets.probation')
                        @include('dashboard.employee.widgets.internship')
                        @include('dashboard.employee.widgets.contract')
                    </div>
                </div>
            @endif
            <!-- LEFT COLUMN END -->

            <!-- RIGHT COLUMN START -->
            <div class="col-xl-7 col-lg-12 col-md-12">
                <!-- METRICS ROW START -->
                <div class="row mb-4">
                    @if (in_array('tasks', $activeWidgets) && (!is_null($viewTaskPermission) && $viewTaskPermission != 'none') && in_array('tasks', user_modules()))
                        <div class="col-md-6 mb-4">
                            <div class="metric-card tasks">
                                <div class="metric-content">
                                    <div class="metric-label">My Tasks</div>
                                    <div class="metric-numbers">
                                        <a href="{{ route('tasks.index') . '?assignee=me' }}">
                                            <div class="metric-number text-info">{{ $inProcessTasks }}</div>
                                            <div class="metric-sublabel">In Progress</div>
                                        </a>
                                        <a href="{{ route('tasks.index') . '?assignee=me&overdue=yes' }}">
                                            <div class="metric-number text-danger">{{ $dueTasks }}</div>
                                            <div class="metric-sublabel">Overdue</div>
                                        </a>
                                    </div>
                                </div>
                                <div class="metric-icon">
                                    <i class="fa fa-tasks"></i>
                                </div>
                            </div>
                        </div>
                    @endif

                    @include('dashboard.employee.widgets.projects')
                    @include('dashboard.employee.widgets.lead')
                    @include('dashboard.employee.widgets.week_timelog')
                </div>
                <!-- METRICS ROW END -->

                @include('dashboard.employee.widgets.my_tasks')
                @include('dashboard.employee.widgets.tickets')
                @include('dashboard.employee.widgets.my_calendar')
                @include('dashboard.employee.widgets.notices')
            </div>
            <!-- RIGHT COLUMN END -->
        </div>
        <!-- DASHBOARD CONTENT END -->
    </div>
    <!-- CONTENT WRAPPER END -->
@endsection

@push('scripts')
    @if ((!is_null($viewEventPermission) && $viewEventPermission != 'none')
        || (!is_null($viewHolidayPermission) && $viewHolidayPermission != 'none')
        || (!is_null($viewTaskPermission) && $viewTaskPermission != 'none')
        || (!is_null($viewTicketsPermission) && $viewTicketsPermission != 'none')
        || (!is_null($viewLeavePermission) && $viewLeavePermission != 'none')
        )
        <script src="{{ asset('vendor/full-calendar/main.min.js') }}" defer="defer"></script>
        <script src="{{ asset('vendor/full-calendar/locales-all.min.js') }}" defer="defer"></script>
        <script>
            $(document).ready(function () {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: initialLocaleCode,
                    timeZone: '{{ company()->timezone }}',
                    firstDay: parseInt("{{ attendance_setting()?->week_start_from }}"),
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    navLinks: true,
                    selectable: false,
                    initialView: 'listWeek',
                    selectMirror: true,
                    select: function(arg) {
                        addEventModal(arg.start, arg.end, arg.allDay);
                        calendar.unselect()
                    },
                    eventClick: function(arg) {
                        getEventDetail(arg.event.id, arg.event.extendedProps.event_type);
                    },
                    editable: false,
                    dayMaxEvents: true,
                    events: {
                        url: "{{ route('dashboard.private_calendar') }}",
                    },
                    eventDidMount: function(info) {
                        $(info.el).css('background-color', info.event.extendedProps.bg_color);
                        $(info.el).css('color', info.event.extendedProps.color);
                        $(info.el).find('td.fc-list-event-title').prepend('<i class="fa '+info.event.extendedProps.icon+'"></i>&nbsp;&nbsp;');
                        
                        if(info.event.extendedProps.event_type == 'leave'){
                            $(info.el).find('td.fc-list-event-title > a').css('cursor','default');
                            $(info.el).css('cursor','default')
                            $(info.el).tooltip({
                                title: info.event.extendedProps.name,
                                container: 'body',
                                delay: { "show": 50, "hide": 50 }
                            });
                        }
                    },
                    eventTimeFormat: {
                        hour: company.time_format == 'H:i' ? '2-digit' : 'numeric',
                        minute: '2-digit',
                        meridiem: company.time_format == 'H:i' ? false : true
                    }
                });

                if (calendarEl != null) {
                    calendar.render();
                }

                $('.cal-filter').on('click', function() {
                    var filter = [];
                    
                    $('.filter-check:checked').each(function() {
                        filter.push($(this).val());
                    });

                    if(filter.length < 1){
                        filter.push('None');
                    }

                    calendar.removeAllEventSources();
                    calendar.addEventSource({
                        url: "{{ route('dashboard.private_calendar') }}",
                        extraParams: {
                            filter: filter
                        }
                    });

                    filter = null;
                });
            })
        </script>
        <script>
            var initialLocaleCode = '{{ user()->locale }}';

            var getEventDetail = function(id, type) {
                if(type == 'ticket') {
                    var url = "{{ route('tickets.show', ':id') }}";
                    url = url.replace(':id', id);
                    window.location = url;
                    return true;
                }

                if(type == 'leave') {
                    return true;
                }

                openTaskDetail();

                switch (type) {
                    case 'task':
                        var url = "{{ route('tasks.show', ':id') }}";
                        break;
                    case 'event':
                        var url = "{{ route('events.show', ':id') }}";
                        break;
                    case 'holiday':
                        var url = "{{ route('holidays.show', ':id') }}";
                        break;
                    case 'leave':
                        var url = "{{ route('leaves.show', ':id') }}";
                        break;
                    default:
                        return 0;
                        break;
                }

                url = url.replace(':id', id);

                $.easyAjax({
                    url: url,
                    blockUI: true,
                    container: RIGHT_MODAL,
                    historyPush: true,
                    success: function(response) {
                        if (response.status == "success") {
                            $(RIGHT_MODAL_CONTENT).html(response.html);
                            $(RIGHT_MODAL_TITLE).html(response.title);
                        }
                    },
                    error: function(request, status, error) {
                        if (request.status == 403) {
                            $(RIGHT_MODAL_CONTENT).html(
                                '<div class="align-content-between d-flex justify-content-center mt-105 f-21">403 | Permission Denied</div>'
                            );
                        } else if (request.status == 404) {
                            $(RIGHT_MODAL_CONTENT).html(
                                '<div class="align-content-between d-flex justify-content-center mt-105 f-21">404 | Not Found</div>'
                            );
                        } else if (request.status == 500) {
                            $(RIGHT_MODAL_CONTENT).html(
                                '<div class="align-content-between d-flex justify-content-center mt-105 f-21">500 | Something Went Wrong</div>'
                            );
                        }
                    }
                });
            };

            var hideDropdown = false;

            $('#event-btn').click(function(){
                if(hideDropdown == true) {
                    $('#cal-drop').hide();
                    hideDropdown = false;
                } else {
                    $('#cal-drop').toggle();
                    hideDropdown = true;
                }
            });

            $(document).mouseup(e => {
                const $menu = $('.calendar-action');
                if (!$menu.is(e.target) && $menu.has(e.target).length === 0) {
                    hideDropdown = false;
                    $('#cal-drop').hide();
                }
            });
        </script>
    @endif

    <script>
        window.setInterval(function () {
            let date = new Date();
            $('#dashboard-clock').html(moment.tz(date, "{{ company()->timezone }}").format(MOMENTJS_TIME_FORMAT))
        }, 1000);

        $('#save-dashboard-widget').click(function() {
            $.easyAjax({
                url: "{{ route('dashboard.widget', 'private-dashboard') }}",
                container: '#privateDashboardWidgetForm',
                blockUI: true,
                type: "POST",
                redirect: true,
                data: $('#privateDashboardWidgetForm').serialize(),
                success: function() {
                    window.location.reload();
                }
            })
        });

        $('#clock-in').click(function() {
            const url = "{{ route('attendances.clock_in_modal') }}";
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $('.request-shift-change').click(function() {
            var id = $(this).data('shift-schedule-id');
            var date = $(this).data('shift-schedule-date');
            var shiftId = $(this).data('shift-id');
            var url = "{{ route('shifts-change.edit', ':id') }}?date="+date+"&shift_id="+shiftId;
            url = url.replace(':id', id);

            $(MODAL_DEFAULT + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_DEFAULT, url);
        });

        $('#view-shifts').click(function() {
            const url = "{{ route('employee-shifts.index') }}";
            $(MODAL_XL + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_XL, url);
        });

        @if (!is_null($currentClockIn))
            $('#clock-out').click(function() {
                var token = "{{ csrf_token() }}";
                var currentLatitude = document.getElementById("current-latitude").value;
                var currentLongitude = document.getElementById("current-longitude").value;

                $.easyAjax({
                    url: "{{ route('attendances.update_clock_in') }}",
                    type: "GET",
                    data: {
                        currentLatitude: currentLatitude,
                        currentLongitude: currentLongitude,
                        _token: token,
                        id: '{{ $currentClockIn->id }}'
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.reload();
                        }
                    }
                });
            });
        @endif

        $('.keep-open .dropdown-menu').on({
            "click": function(e) {
                e.stopPropagation();
            }
        });

        $('#weekly-timelogs').on('click', '.week-timelog-day', function() {
            var date = $(this).data('date');

            $.easyAjax({
                url: "{{ route('dashboard.week_timelog') }}",
                container: '#weekly-timelogs',
                blockUI: true,
                type: "POST",
                redirect: true,
                data: {
                    'date': date,
                    '_token': "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#weekly-timelogs').html(response.html)
                }
            })
        });
    </script>

    @if (attendance_setting()->radius_check == 'yes' || attendance_setting()->save_current_location)
    <script>
        function setCurrentLocation() {
            const currentLatitude = document.getElementById("current-latitude");
            const currentLongitude = document.getElementById("current-longitude");

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                }
            }

            function showPosition(position) {
                currentLatitude.value = position.coords.latitude;
                currentLongitude.value = position.coords.longitude;
            }
            getLocation();
        }

        setCurrentLocation();
    </script>
    @endif
@endpush