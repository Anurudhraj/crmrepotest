<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/css/all.min.css') }}">

    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/css/simple-line-icons.css') }}">

    <!-- Template CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('css/main.css') }}">

    <!-- Google Fonts for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <title>@lang($pageTitle)</title>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ $company->favicon_url }}">
    <meta name="theme-color" content="#6366f1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $company->favicon_url }}">

    @include('sections.theme_css', ['company' => $company])

    @isset($activeSettingMenu)
        <style>
            .preloader-container {
                margin-left: 510px;
                width: calc(100% - 510px)
            }
        </style>
    @endisset

    @stack('styles')

    <style>
        :root {
            --fc-border-color: #E8EEF3;
            --fc-button-text-color: #99A5B5;
            --fc-button-border-color: #99A5B5;
            --fc-button-bg-color: #ffffff;
            --fc-button-active-bg-color: #171f29;
            --fc-today-bg-color: #f2f4f7;
            
            /* Modern color palette */
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-gradient: linear-gradient(135deg, #434343 0%, #000000 100%);
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.18);
            --shadow-soft: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            --shadow-card: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            /*background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);*/
            min-height: 100vh;
            margin: 0;
            padding: 0;
            /*color: var(--text-primary);*/
            font-weight: 400;
            line-height: 1.6;
        }

        .preloader-container {
            height: 100vh;
            width: 100%;
            margin-left: 0;
            margin-top: 0;
            background: var(--primary-gradient);
        }

        .preloader-container .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: 0.3em;
            border-color: rgba(255, 255, 255, 0.3);
            border-top-color: white;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .fc a[data-navlink] {
            color: #99a5b5;
        }
        
        
        /* Beautiful Banner Section */
        .banner-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgb(210 195 226 / 70%) 100%);
            backdrop-filter: blur(20px);
            border-radius: 24px 24px 0 0;
            padding: 3rem 3rem 1rem;
            position: relative;
            overflow: hidden;
            border: none
            margin-bottom: 0;
        }

        .banner-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--accent-gradient);
            animation: gradientShift 8s ease-in-out infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background: var(--accent-gradient); }
            33% { background: var(--primary-gradient); }
            66% { background: var(--secondary-gradient); }
        }

        .banner-graphics {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .banner-graphics svg {
            position: absolute;
            opacity: 0.1;
            animation: floatSvg 15s ease-in-out infinite;
        }

        .banner-shape-1 {
            top: 10%;
            right: 10%;
            width: 120px;
            height: 120px;
            animation-delay: 0s;
        }

        .banner-shape-2 {
            top: 60%;
            right: 5%;
            width: 80px;
            height: 80px;
            animation-delay: -5s;
        }

        .banner-shape-3 {
            top: 20%;
            right: 30%;
            width: 60px;
            height: 60px;
            animation-delay: -10s;
        }

        @keyframes floatSvg {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-15px) rotate(5deg); }
            66% { transform: translateY(-10px) rotate(-3deg); }
        }

        #logo {
            height: 70px;
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.15));
            transition: all 0.3s ease;
        }

        #logo:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 12px 24px rgba(0, 0, 0, 0.2));
        }

        .logo {
            height: 60px;
            filter: drop-shadow(0 6px 12px rgba(0, 0, 0, 0.1));
        }

                .signature_wrap {
            position: relative;
            height: 150px;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            width: 400px;
            border-radius: 16px;
            overflow: hidden;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
        }

        .signature-pad {
            position: absolute;
            left: 0;
            top: 0;
            width: 400px;
            height: 150px;
            border-radius: 16px;
        }

        .body-wrapper {
            min-height: 100vh;
            padding: 2rem 1rem;
            position: relative;
        }

        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Ultra Modern Glass Card Design */
        .card.invoice {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 28px;
            box-shadow: var(--shadow-intense);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .card.invoice::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            pointer-events: none;
            z-index: 0;
        }

        .card.invoice > * {
            position: relative;
            z-index: 1;
        }

        .card.invoice:hover {
            transform: translateY(-4px);
            box-shadow: 0 40px 80px -12px rgba(0, 0, 0, 0.4);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .card-body {
            padding: 0;
            position: relative;
        }

        /* Estimate Title with Epic Styling */
        .estimate-title {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: clamp(2.5rem, 5vw, 4rem);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
            text-transform: uppercase;
            position: relative;
            text-shadow: 0 0 30px rgba(102, 126, 234, 0.3);
            animation: textGlow 4s ease-in-out infinite;
        }

        @keyframes textGlow {
            0%, 100% { text-shadow: 0 0 30px rgba(102, 126, 234, 0.3); }
            50% { text-shadow: 0 0 50px rgba(139, 92, 246, 0.5); }
        }

        .company-info {
            /*background: rgba(255, 255, 255, 0.9);*/
            backdrop-filter: blur(15px);
            transition: all 0.3s ease;
        }


        /* Status badge with neon effects */
        .unpaid {
            padding: 1rem 2rem !important;
            border-radius: 60px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border: 2px solid;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .unpaid::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s;
        }

        .unpaid:hover::before {
            left: 100%;
        }

        .unpaid.text-primary {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(99, 102, 241, 0.15));
            border-color: #3b82f6;
            color: #1d4ed8 !important;
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
        }

        .unpaid.text-success {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(16, 185, 129, 0.15));
            border-color: #22c55e;
            color: #15803d !important;
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.3);
        }

        /* Content Section with Glass Effect */
        .content-section {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            padding: 3rem;
            border-radius: 0 0 28px 28px;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
        }

        #logo {
            height: 60px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        }

        .logo {
            height: 50px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        }

        .signature_wrap {
            position: relative;
            height: 150px;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            width: 400px;
            border-radius: 12px;
            overflow: hidden;
        }

        .signature-pad {
            position: absolute;
            left: 0;
            top: 0;
            width: 400px;
            height: 150px;
            border-radius: 12px;
        }

        .body-wrapper {
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Modern Glass Card Design */
        .card.invoice {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 20px;
            box-shadow: var(--shadow-card);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card.invoice:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .card-body {
            padding: 3rem;
            position: relative;
        }

        /* Header styling with gradient */
        .inv-logo-heading td:last-child {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            font-size: 2.5rem !important;
            letter-spacing: -0.025em;
        }

       

        /* Status badge with modern design */
        .unpaid {
            padding: 0.75rem 1.5rem !important;
            border-radius: 50px !important;
            font-weight: 600 !important;
            font-size: 0.875rem !important;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: 2px solid;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .unpaid.text-primary {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(99, 102, 241, 0.1));
            border-color: #3b82f6;
            color: #1d4ed8 !important;
        }

        .unpaid.text-success {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(16, 185, 129, 0.1));
            border-color: #22c55e;
            color: #15803d !important;
        }

        /* Modern table design */
        .inv-detail {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .inv-detail tr.i-d-heading {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.8), rgba(139, 92, 246, 0.8)) !important;
            color: white !important;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .inv-detail tr.i-d-heading td {
            padding: 1rem !important;
            border: none !important;
        }

        .inv-detail tr:not(.i-d-heading) td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: background-color 0.2s ease;
        }

        .inv-detail tr:not(.i-d-heading):hover td {
            background-color: rgba(99, 102, 241, 0.05);
        }

        /* Total section with gradient background */
        .total-section {
           
            border-radius: 12px;
            padding: 1.5rem;
            margin: 1rem 0;
        }

        /* Modern button styles */
        .btn, .btn-primary, .btn-secondary, .btn-cancel {
            padding: 0.875rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.6);
            color: white;
            text-decoration: none;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.9);
            color: var(--text-primary);
            border: 2px solid rgba(99, 102, 241, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: rgba(99, 102, 241, 0.1);
            border-color: rgba(99, 102, 241, 0.6);
            transform: translateY(-2px);
            color: var(--text-primary);
            text-decoration: none;
        }

        .btn-cancel {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 2px solid rgba(239, 68, 68, 0.3);
        }

        .btn-cancel:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.6);
            transform: translateY(-2px);
            color: #dc2626;
            text-decoration: none;
        }

        /* Card footer with glass effect */
        .card-footer {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.3) !important;
            padding: 2rem 3rem !important;
        }

        /* Modal styling */
        .modal-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            box-shadow: var(--shadow-card);
        }

        .modal-header {
            background: var(--primary-gradient);
            color: white;
            border-radius: 20px 20px 0 0;
            padding: 1.5rem 2rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-footer {
            padding: 1.5rem 2rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 0 0 20px 20px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }
            
            .card-footer {
                padding: 1.5rem !important;
            }
            
            .body-wrapper {
                padding: 1rem 0.5rem;
            }
            
            .btn {
                padding: 0.75rem 1.5rem;
                font-size: 0.8rem;
            }
        }

        /* Signature section */
        .signature-section {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 16px;
            padding: 2rem;
            margin: 2rem 0;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Note and terms section */
        .inv-note {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 16px;
            padding: 2rem;
            margin: 2rem 0;
            backdrop-filter: blur(10px);
        }

        /* Description section */
        .ql-editor {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            padding: 1.5rem;
            margin: 1rem 0;
        }

        /* Mobile table styling */
        .inv-desc-mob {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 16px;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .inv-desc-mob th {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.8), rgba(139, 92, 246, 0.8)) !important;
            color: white !important;
            padding: 1rem;
            font-weight: 600;
        }

        .inv-desc-mob td {
            padding: 1rem;
            background: rgba(255, 255, 255, 0.9);
        }

        /* Image lightbox styling */
        .img-thumbnail {
            border-radius: 8px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
            border-color: rgba(99, 102, 241, 0.6);
        }

        /* Enhanced form elements */
        input, textarea, select {
            background: rgba(255, 255, 255, 0.9) !important;
            border: 2px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: 12px !important;
            padding: 0.875rem 1rem !important;
            transition: all 0.3s ease !important;
        }

        input:focus, textarea:focus, select:focus {
            background: rgba(255, 255, 255, 1) !important;
            border-color: rgba(99, 102, 241, 0.6) !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1) !important;
            outline: none !important;
        }

        /* Animation for page load */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card.invoice {
            animation: fadeInUp 0.8s ease-out;
        }
    </style>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/modernizr.min.js') }}"></script>

    <script>
        var checkMiniSidebar = localStorage.getItem("mini-sidebar");
    </script>

</head>

<body id="body" class="h-100 bg-additional-grey geometric-bg">

    <!-- BODY WRAPPER START -->
    <div class="body-wrapper clearfix">

        <!-- MAIN CONTAINER START -->
        <section class="bg-additional-grey" id="fullscreen">

            <div class="preloader-container d-flex justify-content-center align-items-center">
                <div class="spinner-border" role="status" aria-hidden="true"></div>
            </div>

            <x-app-title class="d-block d-lg-none" :pageTitle="__($pageTitle)"></x-app-title>

            <div class="content-wrapper container">

                <!-- INVOICE CARD START -->
                <div class="card border-0 invoice">
                    
                    <!-- BEAUTIFUL BANNER SECTION -->
                    <div class="banner-section">
                        <div class="banner-graphics">
                            <svg class="banner-shape-1" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="50" cy="50" r="50" fill="url(#gradient1)"/>
                                <defs>
                                    <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#667eea"/>
                                        <stop offset="100%" style="stop-color:#764ba2"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                            
                            <svg class="banner-shape-2" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <polygon points="50,0 100,50 50,100 0,50" fill="url(#gradient2)"/>
                                <defs>
                                    <linearGradient id="gradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#f093fb"/>
                                        <stop offset="100%" style="stop-color:#f5576c"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                            
                            <svg class="banner-shape-3" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="25" y="25" width="50" height="50" rx="10" fill="url(#gradient3)"/>
                                <defs>
                                    <linearGradient id="gradient3" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#4facfe"/>
                                        <stop offset="100%" style="stop-color:#00f2fe"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        
                        <div class="invoice-table-wrapper">
                            <table width="100%" class="">
                                <tr class="inv-logo-heading">
                                    <td><img src="{{ $invoiceSetting->logo_url }}"
                                            alt="{{ $company->company_name }}" id="logo" /></td>
                                    <td align="right" class="mt-4 mt-lg-0 mt-md-0">
                                        <div class="estimate-title">@lang('app.estimate')</div>
                                    </td>
                                </tr>
                                <tr class="inv-num">
                                    <td class="f-14 text-dark">
                                        <div class="company-info">
                                            <p class="mt-0 mb-0">
                                                <strong style="font-size: 1.2rem; color: var(--text-primary);">{{ $company->company_name }}</strong><br><br>
                                                @if (!is_null($company))
                                                    <span style="color: var(--text-secondary);">{!! nl2br($defaultAddress->address) !!}</span><br>
                                                    <span style="color: var(--text-secondary);">{{ $company->company_phone }}</span>
                                                @endif
                                                @if ($invoiceSetting->show_gst == 'yes' && !is_null($invoiceSetting->gst_number))
                                                    <br><span style="color: var(--text-secondary);">@lang('app.gstIn'): {{ $invoiceSetting->gst_number }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td align="right">
                                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                            <div class="number-detail-card">
                                                <div style="font-weight: 600; color: var(--text-secondary); text-transform: uppercase; font-size: 0.8rem; margin-bottom: 0.25rem;">
                                                    @lang('modules.estimates.estimatesNumber')
                                                </div>
                                                <div style="font-weight: 700; color: var(--text-primary); font-size: 1.1rem;">
                                                    {{ $estimate->estimate_number }}
                                                </div>
                                            </div>
                                            
                                            <div class="number-detail-card">
                                                <div style="font-weight: 600; color: var(--text-secondary); text-transform: uppercase; font-size: 0.8rem; margin-bottom: 0.25rem;">
                                                    @lang('modules.estimates.validTill')
                                                </div>
                                                <div style="font-weight: 700; color: var(--text-primary); font-size: 1.1rem;">
                                                    {{ $estimate->valid_till->translatedFormat($company->date_format) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <!-- MAIN CONTENT SECTION -->
                    <div class="content-section">
                        <div class="invoice-table-wrapper">
                            <table width="100%" style="border-bottom:2px solid black">
                                <tr class="inv-unpaid">
                                    <td class="f-14 text-dark">
                                        @if (($estimate->client || $estimate->clientDetails) && ($estimate->client->name || $estimate->client->email || $estimate->client->mobile || $estimate->clientDetails->company_name || $estimate->clientDetails->address) && ($invoiceSetting->show_client_name == 'yes' || $invoiceSetting->show_client_email == 'yes' || $invoiceSetting->show_client_phone == 'yes' || $invoiceSetting->show_client_company_name == 'yes' || $invoiceSetting->show_client_company_address == 'yes'))
                                        <div class="company-info">
                                            <p class="mb-0 text-left">
                                                <span style="font-weight: 700; font-size: 1.1rem; background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; text-transform: uppercase; letter-spacing: 0.05em;">
                                                    @lang("modules.invoices.billedTo")
                                                </span><br><br>

                                                @if ($estimate->client && $estimate->client->name && $invoiceSetting->show_client_name == 'yes')
                                                    <strong style="font-size: 1.1rem;">{{ $estimate->client->name }}</strong><br>
                                                @endif
                                                @if ($estimate->client && $estimate->client->email && $invoiceSetting->show_client_email == 'yes')
                                                    <span style="color: var(--text-secondary);">{{ $estimate->client->email }}</span><br>
                                                @endif
                                                @if ($estimate->client && $estimate->client->mobile && $invoiceSetting->show_client_phone == 'yes')
                                                   <span style="color: var(--text-secondary);">+{{$estimate->clientdetails->user->country->phonecode}} {{ $estimate->client->mobile }}</span><br>
                                                @endif
                                                @if ($estimate->clientDetails && $estimate->clientDetails->company_name && $invoiceSetting->show_client_company_name == 'yes')
                                                    <strong>{{ $estimate->clientDetails->company_name }}</strong><br>
                                                @endif
                                                @if ($estimate->clientDetails && $estimate->clientDetails->address && $invoiceSetting->show_client_company_address == 'yes')
                                                    <span style="color: var(--text-secondary);">{!! nl2br($estimate->clientDetails->address) !!}</span>
                                                @endif
                                            </p>
                                        </div>
                                        @endif
                                    </td>

                                    <td align="right" class="mt-4 mt-lg-0 mt-md-0">
                                        @if ($estimate->clientDetails->company_logo)
                                            <img src="{{ $estimate->clientDetails->image_url }}"
                                            alt="{{ $estimate->clientDetails->company_name }}" class="logo" style="margin-bottom: 2rem;" />
                                        @endif
                                        <div>
                                            <span class="unpaid {{ $estimate->status == 'draft' ? 'text-primary border-primary' : '' }} {{ $estimate->status == 'accepted' ? 'text-success border-success' : '' }} rounded f-15">
                                                @lang('modules.estimates.'.$estimate->status)
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="30" colspan="2"></td>
                                </tr>
                            </table>
                            
                            @if($estimate->description)
                            <div class="row">
                                <div class="col-sm-12 ql-editor">
                                    {!! $estimate->description !!}
                                </div>
                            </div>
                            @endif
                            <table width="100%" class="inv-desc d-none d-lg-table d-md-table">
                                <tr>
                                    <td colspan="2">
                                        <table class="inv-detail f-14 table-responsive-sm" width="100%">
                                            <tr class="i-d-heading bg-light-grey text-dark-grey font-weight-bold">
                                                <td class="border-right-0">@lang('app.description')</td>
                                                @if ($invoiceSetting->hsn_sac_code_show)
                                                    <td class="border-right-0 border-left-0" align="right">
                                                        @lang("app.hsnSac")</td>
                                                @endif
                                                <td class="border-right-0 border-left-0" align="right">@lang('modules.invoices.qty')</td>
                                                <td class="border-right-0 border-left-0" align="right">
                                                    @lang("modules.invoices.unitPrice")
                                                    ({{ $estimate->currency->currency_code }})
                                                </td>
                                                <td class="border-left-0" align="right">@lang("modules.invoices.tax")</td>
                                                <td class="border-left-0" align="right">
                                                    @lang("modules.invoices.amount")
                                                    ({{ $estimate->currency->currency_code }})</td>
                                            </tr>
                                            @foreach ($estimate->items as $item)
                                                @if ($item->type == 'item')
                                                    <tr class="text-dark font-weight-semibold f-13">
                                                        <td>{{ $item->item_name }}</td>
                                                        @if ($invoiceSetting->hsn_sac_code_show)
                                                            <td align="right">{{ $item->hsn_sac_code }}</td>
                                                        @endif
                                                        <td align="right">{{ $item->quantity }}@if($item->unit)<br><span class="f-11 text-dark-grey">{{ $item->unit->unit_type }}</span>@endif</td>
                                                        <td align="right">
                                                            {{ currency_format($item->unit_price, $estimate->currency_id, false) }}
                                                        </td>
                                                        <td align="right">{{ $item->tax_list }}</td>
                                                        <td align="right">
                                                            {{ currency_format($item->amount, $estimate->currency_id, false) }}
                                                        </td>
                                                    </tr>

                                                    @if ($item->item_summary || $item->estimateItemImage)
                                                        <tr class="text-dark f-12">
                                                            <td colspan="{{ $invoiceSetting->hsn_sac_code_show ? '6' : '5' }}" class="border-bottom-0">
                                                                {!! nl2br(strip_tags($item->item_summary)) !!}
                                                                @if ($item->estimateItemImage)
                                                                    <p class="mt-2">
                                                                        <a href="javascript:;" class="img-lightbox" data-image-url="{{ $item->estimateItemImage->file_url }}">
                                                                            <img src="{{ $item->estimateItemImage->file_url }}" width="80" height="80" class="img-thumbnail">
                                                                        </a>
                                                                    </p>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach

                                            <tr>
                                                <td colspan="3"
                                                    class="blank-td border-bottom-0 border-left-0 border-right-0" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));" ></td>
                                                <td colspan="{{ $invoiceSetting->hsn_sac_code_show ? 4 : 3 }}"
                                                    class="p-0 " style=" background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1)); ">
                                                    <div class="total-section">
                                                        <table width="100%">
                                                            <tr class="text-dark-grey" align="right">
                                                                <td class="border-top-0 border-left-0" style="padding: 0.5rem; font-weight: 500;">
                                                                    @lang("modules.invoices.subTotal")</td>
                                                                <td class="border-top-0 border-right-0" style="padding: 0.5rem; font-weight: 600;">
                                                                    {{ currency_format($estimate->sub_total, $estimate->currency_id, false) }}
                                                                </td>
                                                            </tr>
                                                            @if ($discount != 0 && $discount != '')
                                                                <tr class="text-dark-grey" align="right">
                                                                    <td class="border-top-0 border-left-0" style="padding: 0.5rem; font-weight: 500;">
                                                                        @lang("modules.invoices.discount")</td>
                                                                    <td class="border-top-0 border-right-0" style="padding: 0.5rem; font-weight: 600;">
                                                                        {{ currency_format($discount, $estimate->currency_id, false) }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            @foreach ($taxes as $key => $tax)
                                                                <tr class="text-dark-grey" align="right">
                                                                    <td class="border-top-0 border-left-0" style="padding: 0.5rem; font-weight: 500;">
                                                                        {{ $key }}</td>
                                                                    <td class="border-top-0 border-right-0" style="padding: 0.5rem; font-weight: 600;">
                                                                        {{ currency_format($tax, $estimate->currency_id, false) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr class=" text-dark-grey font-weight-bold" align="right" style="border-top: 2px solid rgba(99, 102, 241, 0.3);">
                                                                <td class="border-bottom-0 border-left-0" style="padding: 1rem; font-weight: 700; font-size: 1.1rem;">
                                                                    @lang("modules.invoices.total")</td>
                                                                <td class="border-bottom-0 border-right-0" style="padding: 1rem; font-weight: 700; font-size: 1.1rem; background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                                                    {{ currency_format($estimate->total, $estimate->currency_id, false) }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>
                            <table width="100%" class="inv-desc-mob d-block d-lg-none d-md-none">

                                @foreach ($estimate->items as $item)
                                    @if ($item->type == 'item')

                                        <tr>
                                            <th width="50%" class="bg-light-grey text-dark-grey font-weight-bold">
                                                @lang('app.description')</th>
                                            <td class="p-0 ">
                                                <table>
                                                    <tr width="100%" class="font-weight-semibold f-13">
                                                        <td class="border-left-0 border-right-0 border-top-0">
                                                            {{ $item->item_name }}</td>
                                                    </tr>
                                                    @if ($item->item_summary != '' || $item->estimateItemImage)
                                                        <tr>
                                                            <td class="border-left-0 border-right-0 border-bottom-0 f-12">
                                                                {!! nl2br(strip_tags($item->item_summary)) !!}
                                                                @if ($item->estimateItemImage)
                                                                    <p class="mt-2">
                                                                        <a href="javascript:;" class="img-lightbox" data-image-url="{{ $item->estimateItemImage->file_url }}">
                                                                            <img src="{{ $item->estimateItemImage->file_url }}" width="80" height="80" class="img-thumbnail">
                                                                        </a>
                                                                    </p>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="50%" class="bg-light-grey text-dark-grey font-weight-bold">
                                                @lang('modules.invoices.qty')</th>
                                            <td width="50%">{{ $item->quantity }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%" class="bg-light-grey text-dark-grey font-weight-bold">
                                                @lang("modules.invoices.unitPrice")
                                                ({{ $estimate->currency->currency_code }})</th>
                                            <td width="50%">
                                                {{ currency_format($item->unit_price, $estimate->currency_id, false) }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%" class="bg-light-grey text-dark-grey font-weight-bold">
                                                @lang("modules.invoices.amount")
                                                ({{ $estimate->currency->currency_code }})</th>
                                            <td width="50%">{{ currency_format($item->amount, $estimate->currency_id, false) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="3" class="p-0 " colspan="2"></td>
                                        </tr>
                                    @endif
                                @endforeach

                                <tr>
                                    <th width="50%" class="text-dark-grey font-weight-normal">
                                        @lang("modules.invoices.subTotal")
                                    </th>
                                    <td width="50%" class="text-dark-grey font-weight-normal">
                                        {{ currency_format($estimate->sub_total, $estimate->currency_id, false) }}</td>
                                </tr>
                                @if ($discount != 0 && $discount != '')
                                    <tr>
                                        <th width="50%" class="text-dark-grey font-weight-normal">
                                            @lang("modules.invoices.discount")
                                        </th>
                                        <td width="50%" class="text-dark-grey font-weight-normal">
                                            {{ currency_format($discount, $estimate->currency_id, false) }}</td>
                                    </tr>
                                @endif

                                @foreach ($taxes as $key => $tax)
                                    <tr>
                                        <th width="50%" class="text-dark-grey font-weight-normal">
                                            {{ $key }}</th>
                                        <td width="50%" class="text-dark-grey font-weight-normal">
                                            {{ currency_format($tax, $estimate->currency_id, false) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th width="50%" class="text-dark-grey font-weight-bold">
                                        @lang("modules.invoices.total")</th>
                                    <td width="50%" class="text-dark-grey font-weight-bold">
                                        {{ currency_format($estimate->total, $estimate->currency_id, false) }}</td>
                                </tr>
                            </table>
                            <table class="inv-note">
                                <tr>
                                    <td height="30" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: text-top">
                                        <table>
                                            <tr>
                                                <td style="padding: 1rem; background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1)); border-radius: 8px; font-weight: 600; margin-bottom: 0.5rem;">
                                                    @lang('app.note')
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 1rem;">
                                                    <p class="text-dark-grey">{!! $estimate->note ?? '--' !!}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="right">
                                        <table>
                                            <tr>
                                                <td style="padding: 1rem; background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1)); border-radius: 8px; font-weight: 600; margin-bottom: 0.5rem;">
                                                    @lang('modules.invoiceSettings.invoiceTerms')
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 1rem;">
                                                    <p class="text-dark-grey">{!! nl2br($invoiceSetting->invoice_terms) !!}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @if (isset($invoiceSetting->other_info))
                                    <tr>
                                        <td align="vertical-align: text-top">
                                            <table>
                                                <tr>
                                                    <td style="padding: 1rem;">
                                                        <p class="text-dark-grey">{!! nl2br($invoiceSetting->other_info) !!}
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @endif
                                @if (isset($taxes) && $invoiceSetting->tax_calculation_msg == 1)
                                <tr>
                                    <td>
                                        <p class="text-dark-grey">
                                            @if ($estimate->calculate_tax == 'after_discount')
                                                @lang('messages.calculateTaxAfterDiscount')
                                            @else
                                                @lang('messages.calculateTaxBeforeDiscount')
                                            @endif
                                        </p>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>

                        @if ($estimate->sign)
                            <div class="row">
                                <div class="col-sm-12 mt-4">
                                    <div class="signature-section">
                                        <h6 style="font-weight: 600; color: var(--text-primary); margin-bottom: 1rem;">@lang('modules.estimates.signature')</h6>
                                        <img src="{{ $estimate->sign->signature }}" style="width: 200px; border-radius: 8px; border: 2px solid rgba(99, 102, 241, 0.3);">
                                        <p style="margin-top: 0.5rem; font-weight: 600;">({{ $estimate->sign->full_name }})</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    <!-- CARD BODY END -->
                    <!-- CARD FOOTER START -->
                    <div class="card-footer bg-white border-0 d-flex justify-content-end py-0 py-lg-4 py-md-4 mb-4 mb-lg-3 mb-md-3 ">

                        <div class="d-flex flex-wrap gap-3">

                            <a href="{{ route('estimates.index') }}" class="btn btn-cancel">
                                <i class="fas fa-times"></i>
                                @lang('app.cancel')
                            </a>

                            <a href="{{ route('front.estimate.download', [$estimate->hash]) }}" class="btn btn-secondary">
                                <i class="fas fa-download"></i>
                                @lang('app.download')
                            </a>

                            @if ($estimate->status == 'waiting')
                                <button type="button" class="btn btn-cancel" id="decline-estimate">
                                    <i class="fas fa-times"></i>
                                    @lang('app.decline')
                                </button>

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signature-modal">
                                    <i class="fas fa-check"></i>
                                    @lang('app.accept')
                                </button>
                            @endif

                        </div>
                    </div>
                    <!-- CARD FOOTER END -->
                </div>
                <!-- INVOICE CARD END -->

                <div id="signature-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog d-flex justify-content-center align-items-center modal-xl">
                        <div class="modal-content">
                            @include('estimates.ajax.accept-estimate')
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- also the modal itself -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog d-flex justify-content-center align-items-center modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    {{__('app.loading')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel rounded mr-3" data-dismiss="modal">Close</button>
                    <button type="button" class="btn-primary rounded">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Global Required Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        document.loading = '@lang('app.loading')';
        const MODAL_LG = '#myModal';
        const MODAL_HEADING = '#modelHeading';
        const dropifyMessages = {
            default: '@lang("app.dragDrop")',
            replace: '@lang("app.dragDropReplace")',
            remove: '@lang("app.remove")',
            error: '@lang("app.largeFile")'
        };

        $(window).on('load', function() {
            // Animate loader off screen
            init();
            $(".preloader-container").fadeOut("slow", function() {
                $(this).removeClass("d-flex");
            });
        });

        $(document).on('click', '#download-invoice', function() {
            window.location.href = "{{ route('invoices.download', [$estimate->id]) }}";
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script>
        var canvas = document.getElementById('signature-pad');

        // Check if canvas exists before initializing
        if (canvas) {
            var signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
            });

            document.getElementById('clear-signature')?.addEventListener('click', function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            document.getElementById('undo-signature')?.addEventListener('click', function(e) {
                e.preventDefault();
                var data = signaturePad.toData();
                if (data) {
                    data.pop(); // remove the last dot or line
                    signaturePad.fromData(data);
                }
            });
        }

        $('#decline-estimate').click(function() {
            $.easyAjax({
                type: 'POST',
                url: "{{ route('front.estimate.decline', $estimate->id) }}",
                blockUI: true,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    }
                }
            })
        });

        $('#toggle-pad-uploader').click(function() {
            var text = $('.signature').hasClass('d-none') ? '{{ __("modules.estimates.uploadSignature") }}' : '{{ __("app.sign") }}';

            $(this).html(text);

            $('.signature').toggleClass('d-none');
            $('.upload-image').toggleClass('d-none');
        });

        $('#save-signature').click(function() {
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var email = $('#email').val();
            var signature = signaturePad ? signaturePad.toDataURL('image/png') : '';

            var image = $('#image').val();

            // this parameter is used for type of signature used and will be used on validation and upload signature image
            var signature_type = !$('.signature').hasClass('d-none') ? 'signature' : 'upload';

            if (signaturePad && signaturePad.isEmpty() && !$('.signature').hasClass('d-none')) {
                Swal.fire({
                    icon: 'error',
                    text: '{{ __('messages.signatureRequired') }}',

                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    showClass: {
                        popup: 'swal2-noanimation',
                        backdrop: 'swal2-noanimation'
                    },
                    buttonsStyling: false
                });
                return false;
            }

            $.easyAjax({
                url: "{{ route('front.estimate.accept', $estimate->id) }}",
                container: '#acceptEstimate',
                type: "POST",
                blockUI: true,
                file: true,
                disableButton: true,
                buttonSelector : '#save-signature',
                data: {
                    first_name: first_name,
                    last_name: last_name,
                    email: email,
                    signature: signature,
                    image: image,
                    signature_type: signature_type,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    }
                }
            })
        });

        $('body').on('click', '.img-lightbox', function () {
            var imageUrl = $(this).data('image-url');
            const url = "{{ route('front.public.show_image').'?image_url=' }}"+imageUrl;
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });
    </script>

</body>

</html>