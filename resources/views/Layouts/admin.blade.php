<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - CJ's Minimart</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        /* Skeleton Loading Global Styles */
        .skeleton-overlay {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            height: 100%;
            background: var(--bg-color);
            z-index: 1000;
            display: none;
            overflow-y: auto;
        }
        
        .skeleton-overlay.active {
            display: block;
        }
        
        @media (max-width: 991.98px) {
            .skeleton-overlay {
                left: 0;
                width: 100%;
            }
        }
        
        .skeleton-content {
            width: 100%;
            max-width: 100%;
            padding: 0;
            min-height: 100vh;
            animation: skeletonFadeIn 0.3s ease-out forwards;
        }
        
        /* Skeleton Templates - Different layouts for different pages */
        .skeleton-template {
            display: none;
        }
        
        .skeleton-template.active {
            display: block;
        }
        
        /* Skeleton Navbar */
        .skeleton-navbar {
            background: var(--content-bg);
            padding: 1rem 1.5rem;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 999;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .skeleton-navbar-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 10px;
            flex-shrink: 0;
        }
        
        .skeleton-navbar-text {
            flex: 1;
        }
        
        .skeleton-navbar-line {
            height: 24px;
            width: 200px;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 6px;
        }
        
        .skeleton-navbar-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 10px;
            margin-left: auto;
        }
        
        .skeleton-page-content {
            padding: 0;
            width: 100%;
        }
        
        /* Page Header Skeleton */
        .skeleton-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin: 1.5rem 1.5rem 1.5rem 1.5rem;
            padding: 1.25rem 1.5rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.02);
            flex-wrap: wrap;
        }
        
        @media (max-width: 768px) {
            .skeleton-header {
                margin: 1rem;
                padding: 1rem;
            }
        }
        
        .skeleton-header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
            min-width: 0;
        }
        
        .skeleton-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            opacity: 0.15;
            border-radius: 12px;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }
        
        .skeleton-icon::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            100% { left: 100%; }
        }
        
        .skeleton-icon.primary { background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%); }
        .skeleton-icon.success { background: linear-gradient(135deg, #10B981 0%, #059669 100%); }
        .skeleton-icon.warning { background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); }
        .skeleton-icon.danger { background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); }
        .skeleton-icon.info { background: linear-gradient(135deg, #06B6D4 0%, #0891B2 100%); }
        
        .skeleton-text {
            flex: 1;
            min-width: 0;
        }
        
        .skeleton-line {
            height: 18px;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 6px;
            margin-bottom: 0.5rem;
        }
        
        .skeleton-line.title {
            height: 24px;
            width: 200px;
            margin-bottom: 0.25rem;
        }
        
        .skeleton-line.subtitle {
            height: 14px;
            width: 300px;
        }
        
        .skeleton-line.short {
            width: 40%;
        }
        
        .skeleton-line.medium {
            width: 60%;
        }
        
        .skeleton-line.long {
            width: 80%;
        }
        
        .skeleton-header-actions {
            display: flex;
            gap: 0.75rem;
            flex-shrink: 0;
        }
        
        @media (max-width: 575px) {
            .skeleton-header-actions {
                width: 100%;
                justify-content: flex-end;
            }
        }
        
        .skeleton-button {
            height: 40px;
            width: 140px;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 12px;
        }
        
        @media (max-width: 768px) {
            .skeleton-button {
                width: 100px;
            }
        }
        
        @media (max-width: 575px) {
            .skeleton-button {
                width: 80px;
                height: 36px;
            }
        }
        
        /* Stats Cards Skeleton */
        .skeleton-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.75rem;
            margin: 0 1.5rem 1.5rem 1.5rem;
            padding: 0;
        }
        
        @media (max-width: 1199px) {
            .skeleton-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 575px) {
            .skeleton-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.5rem;
                margin: 0 1rem 1rem 1rem;
            }
        }
        
        .skeleton-stat-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            border: 1px solid rgba(102,126,234,0.1);
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-height: 90px;
            transition: all 0.3s ease;
        }
        
        .skeleton-stat-card:hover {
            box-shadow: 0 8px 20px rgba(102,126,234,0.12);
            transform: translateY(-2px);
        }
        
        @media (max-width: 575px) {
            .skeleton-stat-card {
                padding: 0.75rem;
                min-height: 80px;
                gap: 0.5rem;
            }
        }
        
        .skeleton-stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
        }
        
        @media (max-width: 575px) {
            .skeleton-stat-icon {
                width: 44px;
                height: 44px;
            }
        }
        
        .skeleton-stat-content {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .skeleton-stat-label {
            height: 10px;
            width: 70%;
            max-width: 80px;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 4px;
        }
        
        .skeleton-stat-value {
            height: 24px;
            width: 85%;
            max-width: 100px;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 6px;
        }
        
        @media (max-width: 575px) {
            .skeleton-stat-value {
                height: 20px;
            }
        }
        
        /* Filter Card Skeleton */
        .skeleton-filter {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.02);
            margin: 0 1.5rem 1.5rem 1.5rem;
        }
        
        @media (max-width: 768px) {
            .skeleton-filter {
                margin: 0 1rem 1rem 1rem;
                padding: 1rem;
            }
        }
        
        .skeleton-filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .skeleton-filter-toggle {
            width: 24px;
            height: 24px;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 6px;
        }
        
        .skeleton-filter-inputs {
            display: grid;
            grid-template-columns: 2fr 1.5fr 1.5fr 1fr;
            gap: 0.75rem;
        }
        
        @media (max-width: 991px) {
            .skeleton-filter-inputs {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 575px) {
            .skeleton-filter-inputs {
                grid-template-columns: 1fr;
            }
        }
        
        .skeleton-input {
            height: 42px;
            background: linear-gradient(90deg, #f8f9fa 25%, #ffffff 50%, #f8f9fa 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }
        
        /* Table Skeleton */
        .skeleton-table {
            background: white;
            border-radius: 20px;
            padding: 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.02);
            overflow: hidden;
            margin: 0 1.5rem 1.5rem 1.5rem;
        }
        
        @media (max-width: 768px) {
            .skeleton-table {
                margin: 0 1rem 1rem 1rem;
            }
        }
        
        .skeleton-table-header {
            height: 60px;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-bottom: 2px solid #edf2f7;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        @media (max-width: 768px) {
            .skeleton-table-header {
                padding: 0 1rem;
                height: 50px;
            }
        }
        
        .skeleton-table-title {
            height: 20px;
            width: 180px;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 6px;
        }
        
        @media (max-width: 768px) {
            .skeleton-table-title {
                width: 120px;
            }
        }
        
        .skeleton-table-select {
            height: 36px;
            width: 120px;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 8px;
        }
        
        @media (max-width: 768px) {
            .skeleton-table-select {
                width: 80px;
                height: 32px;
            }
        }
        
        .skeleton-table-body {
            padding: 1rem 1.5rem;
        }
        
        @media (max-width: 768px) {
            .skeleton-table-body {
                padding: 0.75rem 1rem;
            }
        }
        
        .skeleton-table-row {
            height: 72px;
            background: linear-gradient(90deg, #f8f9fa 25%, #ffffff 50%, #f8f9fa 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 12px;
            margin-bottom: 0.75rem;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .skeleton-table-row:hover {
            box-shadow: 0 4px 12px rgba(102,126,234,0.08);
        }
        
        .skeleton-table-row:last-child {
            margin-bottom: 0;
        }
        
        @media (max-width: 768px) {
            .skeleton-table-row {
                height: 60px;
            }
        }
        
        /* Grid Cards Skeleton (for categories, products, etc.) */
        .skeleton-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .skeleton-grid-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.02);
            overflow: hidden;
        }
        
        .skeleton-grid-card-header {
            height: 80px;
            background: linear-gradient(90deg, #f8f9fa 25%, #e9ecef 50%, #f8f9fa 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .skeleton-grid-card-icon {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.5);
            border-radius: 12px;
        }
        
        .skeleton-grid-card-body {
            padding: 1.25rem;
        }
        
        .skeleton-grid-card-line {
            height: 14px;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 4px;
            margin-bottom: 0.75rem;
        }
        
        .skeleton-grid-card-footer {
            padding: 1rem 1.25rem;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }
        
        .skeleton-action-btn {
            width: 38px;
            height: 38px;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 10px;
        }
        
        @keyframes skeleton-loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }
        
        @keyframes shimmer {
            100% { left: 100%; }
        }
        
        @keyframes skeletonFadeIn {
            from { 
                opacity: 0;
                transform: translateY(10px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes skeletonPulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }
        
        [data-theme="dark"] .skeleton-overlay {
            background: var(--bg-color);
        }
        
        [data-theme="dark"] .skeleton-navbar,
        [data-theme="dark"] .skeleton-header,
        [data-theme="dark"] .skeleton-card,
        [data-theme="dark"] .skeleton-table {
            background: #1e293b;
            border-color: #334155;
        }
        
        [data-theme="dark"] .skeleton-navbar-icon,
        [data-theme="dark"] .skeleton-navbar-line,
        [data-theme="dark"] .skeleton-icon,
        [data-theme="dark"] .skeleton-line,
        [data-theme="dark"] .skeleton-card-line {
            background: linear-gradient(90deg, #334155 25%, #475569 50%, #334155 75%);
            background-size: 200% 100%;
        }
        
        [data-theme="dark"] .skeleton-table-header,
        [data-theme="dark"] .skeleton-table-row {
            background: linear-gradient(90deg, #0f172a 25%, #1e293b 50%, #0f172a 75%);
            background-size: 200% 100%;
        }

        :root {
            --primary-blue: #3B82F6;
            --primary-orange: #F97316;
            --sidebar-bg: #0F172A; /* Professional Dark Blue */
            --sidebar-text: #94A3B8;
            --sidebar-hover: #1E293B;
            --sidebar-active: #1E293B;
            --sidebar-active-text: #F8FAFC;
            --bg-color: #F8FAFC;
            --content-bg: #FFFFFF;
            --text-color: #0F172A;
            --card-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.03);
            --smooth-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            --sidebar-width: 280px;
        }

        [data-theme="dark"] {
            --sidebar-bg: #030712;
            --sidebar-text: #64748B;
            --sidebar-hover: #111827;
            --sidebar-active: #111827;
            --sidebar-active-text: #F97316;
            --bg-color: #020617;
            --content-bg: #0F172A;
            --text-color: #F8FAFC;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            --smooth-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.4);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
            width: 100%;
            overflow-x: hidden;
            transition: background 0.3s ease;
        }

        #wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        #sidebar-wrapper {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: var(--smooth-shadow);
            overflow-y: auto;
            border-right: none;
            transition: transform 0.3s ease;
            z-index: 1050;
            padding: 24px 16px;
        }


        .sidebar-header { padding: 0 8px 32px 8px; }

        .brand-logo {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: 700;
            margin-right: 12px;
        }

        .brand-title { font-size: 1.1rem; font-weight: 700; color: #F8FAFC; }
        .brand-subtitle { font-size: 0.75rem; color: #94A3B8; font-weight: 500; }

        .search-container { padding: 0 8px 24px 8px; }
        .search-box {
            background: var(--sidebar-hover);
            border: 1px solid transparent;
            border-radius: 12px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .search-box:focus-within {
            border-color: var(--primary-blue);
            background: var(--sidebar-bg);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .search-box input { background: none; border: none; color: var(--sidebar-text); outline: none; width: 100%; font-size: 0.85rem; }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            border-radius: 12px;
            margin-bottom: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border: 1px solid transparent;
        }

        .nav-link:hover { 
            background: rgba(255, 255, 255, 0.05); 
            color: #F8FAFC; 
            border-color: rgba(255, 255, 255, 0.05);
            transform: translateX(4px);
        }
        .nav-link.active { 
            background: var(--primary-blue); 
            color: #FFFFFF; 
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .nav-link i { font-size: 1.1rem; margin-right: 12px; width: 24px; text-align: center; }

        .theme-toggle-btn {
            background: var(--sidebar-hover);
            color: var(--sidebar-text);
            border-radius: 10px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            border: 1px solid transparent;
        }
        .theme-toggle-btn:hover { background: var(--sidebar-bg); border-color: var(--sidebar-hover); color: var(--primary-orange); }

        .user-info { display: none; } /* Superseded by Navbar profile */


        /* Navigation Menu Reset */
        .nav-menu, .nav-menu ul, .nav-menu li {
            list-style: none !important;
            padding: 0;
            margin: 0;
            text-decoration: none !important;
        }
        .nav-menu { padding: 8px 0; }
        .nav-item { list-style: none; margin-bottom: 2px; }

        .arrow { margin-left: auto; font-size: 0.75rem; transition: transform 0.3s ease; opacity: 0.5; }
        .arrow.rotated { transform: rotate(90deg); }

        .badge-count {
            background: var(--primary-orange);
            color: white;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 0.65rem;
            font-weight: 700;
            margin-left: auto;
            margin-right: 8px;
            box-shadow: 0 2px 4px rgba(249, 115, 22, 0.2);
        }

        .submenu {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 0;
            overflow: hidden;
            transition: var(--transition);
            position: relative;
        }

        .submenu.show { 
            max-height: 1000px; 
            margin-bottom: 8px; 
            padding-top: 4px;
            padding-bottom: 8px;
        }

        .submenu li {
            position: relative;
        }

        .submenu li::before {
            content: "";
            position: absolute;
            left: 27.5px;
            top: -100px;
            bottom: 50%;
            width: 14px;
            border-left: 1.5px solid rgba(226, 232, 240, 0.15);
            border-bottom: 1.5px solid rgba(226, 232, 240, 0.15);
            border-bottom-left-radius: 8px;
            z-index: 1;
        }

        .submenu li a {
            display: flex;
            align-items: center;
            padding: 10px 16px 10px 52px;
            color: #94A3B8;
            text-decoration: none !important;
            font-size: 0.88rem;
            font-weight: 500;
            border-radius: 10px;
            margin-bottom: 3px;
            transition: all 0.25s ease;
            position: relative;
            z-index: 2;
        }

        .submenu li a i {
            width: 20px;
            text-align: center;
            margin-right: 12px;
            font-size: 1rem;
        }

        .submenu li a:hover {
            color: var(--primary-blue);
            padding-left: 56px;
        }

        .submenu li a.active {
            color: var(--primary-blue);
            background: rgba(59, 130, 246, 0.08);
            font-weight: 600;
        }


        /* Global Content Dark Mode Compatibility */
        [data-theme="dark"] .dashboard-header-container,
        [data-theme="dark"] .metric-card-glass,
        [data-theme="dark"] .chart-container-glass,
        [data-theme="dark"] .dashboard-card-glass,
        [data-theme="dark"] .page-header-premium,
        [data-theme="dark"] .filter-card,
        [data-theme="dark"] .table-card,
        [data-theme="dark"] .chart-card,
        [data-theme="dark"] .modal-content {
            background: #1e293b !important;
            border-color: #334155 !important;
        }

        /* --- PROFILE MODAL PREMIUM --- */
        .profile-header {
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
            padding: 2.5rem 1.5rem;
            border-radius: 12px 12px 0 0;
            position: relative;
            margin-bottom: 2.5rem;
        }
        .profile-avatar-wrapper {
            position: absolute;
            bottom: -35px;
            left: 50%;
            transform: translateX(-50%);
            width: 110px;
            height: 110px;
            border-radius: 20px;
            border: 5px solid #fff;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            overflow: hidden;
            cursor: pointer;
        }
        [data-theme="dark"] .profile-avatar-wrapper {
            border-color: #1e293b;
            background: #1e293b;
        }
        .profile-avatar-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s;
        }
        .profile-avatar-wrapper:hover img {
            filter: brightness(0.7);
        }
        .avatar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
            opacity: 0;
            transition: all 0.3s;
            background: rgba(0,0,0,0.2);
        }
        .profile-avatar-wrapper:hover .avatar-overlay {
            opacity: 1;
        }
        .profile-form-container {
            padding: 1rem 1.5rem 2rem;
        }
        .nav-pills-premium {
            background: #f1f5f9;
            padding: 0.4rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }
        [data-theme="dark"] .nav-pills-premium {
            background: #0f172a;
        }
        .nav-pills-premium .nav-link {
            border-radius: 10px;
            font-weight: 700;
            color: #64748b;
            transition: all 0.2s;
            border: none !important;
        }
        .nav-pills-premium .nav-link.active {
            background: #fff;
            color: #4f46e5;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        [data-theme="dark"] .nav-pills-premium .nav-link.active {
            background: #1e293b;
            color: #60a5fa;
        }
        .form-label-premium {
            font-weight: 700;
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 0.5rem;
        }
        [data-theme="dark"] .form-label-premium {
            color: #94a3b8;
        }
        .user-dropdown-premium {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .user-dropdown-premium:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }
        [data-theme="dark"] .user-dropdown-premium {
            background: #1e293b;
            border-color: #334155;
        }
        [data-theme="dark"] .user-dropdown-premium:hover {
            background: #0f172a;
        }
        .dropdown-avatar-box {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.9rem;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2);
        }
        .dropdown-user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }
        .dropdown-user-name {
            font-size: 0.9rem;
            font-weight: 800;
            color: #1e293b;
        }
        [data-theme="dark"] .dropdown-user-name {
            color: #f8fafc;
        }
        .dropdown-user-role {
            font-size: 0.72rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .role-badge-mini {
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 0.65rem;
            font-weight: 800;
            margin-top: 2px;
            display: inline-block;
        }
        .role-admin { background: #fee2e2; color: #dc2626; }
        .role-supervisor { background: #fef3c7; color: #d97706; }
        .role-cashier { background: #dcfce7; color: #16a34a; }
        [data-theme="dark"] .role-admin { background: rgba(220, 38, 38, 0.15); color: #f87171; }
        [data-theme="dark"] .role-supervisor { background: rgba(217, 119, 6, 0.15); color: #fbbf24; }
        [data-theme="dark"] .role-cashier { background: rgba(22, 163, 74, 0.15); color: #4ade80; }

        [data-theme="dark"] .welcome-text,
        [data-theme="dark"] .page-title,
        [data-theme="dark"] .card-info h2,
        [data-theme="dark"] .title-box h3,
        [data-theme="dark"] .card-header-premium h3 {
            color: #F8FAFC !important;
        }

        [data-theme="dark"] .premium-dashboard-table thead th {
            background: rgba(15, 23, 42, 0.8);
            border-bottom-color: rgba(255, 255, 255, 0.1);
            color: #cbd5e1;
        }

        [data-theme="dark"] .premium-dashboard-table td {
            border-bottom-color: rgba(255, 255, 255, 0.05);
            color: #cbd5e1;
        }

        [data-theme="dark"] .search-box input {
            color: var(--sidebar-text);
        }
        
        [data-theme="dark"] #sidebar-wrapper {
            --sidebar-bg: #0F172A;
            --sidebar-text: #94A3B8;
            --sidebar-hover: #1E293B;
            --sidebar-active: #1E293B;
        }


        /* Page Content */
        #page-content-wrapper {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            min-width: 0;
            background: var(--bg-color);
            transition: margin-left 0.3s ease;
            width: 100%;
        }

        /* Responsive Sidebar Toggling */
        body.toggled-sidebar #sidebar-wrapper {
            transform: translateX(-100%);
        }

        body.toggled-sidebar #page-content-wrapper {
            margin-left: 0;
        }

        @media (max-width: 991.98px) {
            #sidebar-wrapper {
                transform: translateX(-100%);
            }
            #page-content-wrapper {
                margin-left: 0 !important;
            }
            body.show-sidebar #sidebar-wrapper {
                transform: translateX(0);
            }
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                backdrop-filter: blur(4px);
                z-index: 1040;
                display: none;
            }
            body.show-sidebar .sidebar-overlay {
                display: block;
            }
        }


        .navbar-top {
            background: var(--content-bg);
            padding: 1rem 1.5rem;
            box-shadow: var(--card-shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 999;
            transition: var(--transition);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            min-width: 0;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-shrink: 0;
        }

        .page-title {
            font-size: clamp(1rem, 2.5vw, 1.25rem);
            font-weight: 700;
            color: var(--text-color);
            margin: 0;
            letter-spacing: -0.5px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .navbar-top {
                padding: 0.75rem 1rem;
            }
            .navbar-right .user-details {
                display: none !important;
            }
            .user-dropdown img {
                width: 36px;
                height: 36px;
            }
        }

        .menu-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--content-bg);
            border: 1px solid rgba(0,0,0,0.05);
            color: var(--text-color);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: var(--card-shadow);
            flex-shrink: 0;
        }
        .menu-toggle:hover {
            background: var(--sidebar-bg);
            color: #F8FAFC;
            transform: translateY(-2px);
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .user-dropdown img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid var(--bg-color);
            box-shadow: var(--card-shadow);
        }

        .page-content {
            padding: clamp(1rem, 3vw, 2rem);
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        /* Responsive - zoom and mobile */
        @media (max-width: 576px) {
            .page-content {
                padding: 0.75rem;
            }
            .navbar-top {
                gap: 0.5rem;
            }
        }
        
        /* Zoom protection & Text safety */
        * {
            overflow-wrap: break-word;
            word-wrap: break-word;
            hyphens: auto;
        }
        
        a, button, span, p, h1, h2, h3, h4, h5, h6 {
            min-width: 0;
        }
        
        .table-responsive {
            border-radius: 12px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            width: 100%;
            margin-bottom: 1rem;
        }

        /* Prevent image overflow */
        img {
            max-width: 100%;
            height: auto;
        }

        /* Custom scrollbar for better zoom experience */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.05);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.2);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0,0,0,0.3);
        }

        /* Breakpoint helpers */
        @media (max-width: 576px) {
            .btn span.d-none.d-sm-inline {
                display: none !important;
            }
        }

        /* Brand Colors for Blue Sidebar */
        .brand-logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: var(--transition);
        }
        
        .brand-logo-container:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .brand-box {
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.1);
            transition: var(--transition);
        }

        .brand-logo-container:hover .brand-box {
            transform: scale(1.05) rotate(-2deg);
        }

        .brand-box img {
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }

        .brand-text-wrapper {
            display: flex;
            flex-direction: column;
        }

        .brand-name {
            font-size: 1.25rem;
            font-weight: 900;
            color: #F8FAFC;
            letter-spacing: -1px;
            line-height: 0.9;
            text-transform: uppercase;
        }

        .brand-tagline {
            font-size: 0.7rem;
            color: var(--primary-orange);
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        /* --- UNIFIED PREMIUM HEADER DESIGN --- */
        .page-header-premium {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            padding: 1.25rem 1.5rem;
            border-radius: 16px;
            border: 1px solid #edf2f7;
            margin-bottom: 1.25rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        [data-theme="dark"] .page-header-premium {
            background: #1e293b;
            border-color: #334155;
        }


        .header-left { display: flex; align-items: center; gap: 1rem; }
        .header-icon-box {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.25rem;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        .pending-header-icon { background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); }
        .roles-header-icon { background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%); }
        .users-header-icon { background: linear-gradient(135deg, #10B981 0%, #059669 100%); }

        .header-text { display: flex; flex-direction: column; }
        .header-text .page-title { font-size: 1.3rem; font-weight: 800; color: #1e293b; margin: 0; line-height: 1.2; }
        .header-text .page-subtitle { font-size: 0.85rem; color: #64748b; margin: 0; }
        
        [data-theme="dark"] .header-text .page-title { color: #f8fafc; }
        [data-theme="dark"] .header-text .page-subtitle { color: #94a3b8; }

        .header-actions { display: flex; align-items: center; gap: 1rem; }

        .status-indicator-glass {
            background: #F0F9FF;
            border: 1px solid #E0F2FE;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            color: #0369A1;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .pending-indicator { background: #FFFBEB; border-color: #FEF3C7; color: #92400E; }

        .pulse-dot {
            width: 8px; height: 8px;
            background: currentColor;
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.2); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(0, 0, 0, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(0, 0, 0, 0); }
        }

        .btn-header-action {
            padding: 0.6rem 1.2rem;
            border-radius: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            font-size: 0.85rem;
            text-decoration: none;
        }

        .btn-header-primary { background: #3B82F6; color: #fff; border: none; }
        .btn-header-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); color: #fff; }
        
        .btn-header-secondary { background: #F8FAFC; color: #64748B; border: 1px solid #E2E8F0; }
        .btn-header-secondary:hover { background: #F1F5F9; color: #1E293B; }

        /* Unified Submenu UI (Supplier-Style Reference) */
        .page-header-premium {
            background: #fff !important;
            border: 1px solid #eaf0f6 !important;
            border-radius: 20px !important;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04) !important;
            padding: 1rem 1.25rem !important;
            margin-bottom: 1rem !important;
        }

        .header-icon-box {
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2) !important;
        }

        .filter-card,
        .chart-card,
        .table-card,
        .detail-card,
        .details-card,
        .kpi-card,
        .stat-card {
            background: #fff !important;
            border: 1px solid #eaf0f6 !important;
            border-radius: 18px !important;
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.03) !important;
        }

        .table-card,
        .detail-card,
        .details-card {
            overflow: hidden;
        }

        .table th {
            background: #f8fafc !important;
            border-bottom: 1px solid #edf2f7 !important;
            color: #475569 !important;
            font-weight: 700 !important;
            letter-spacing: 0.04em;
        }

        .table td {
            border-bottom: 1px solid #f1f5f9 !important;
        }

        .table tbody tr:hover {
            background: #f8fbff !important;
        }

        .search-input-group input,
        .form-control,
        .form-select {
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 12px !important;
        }

        .search-input-group input:focus,
        .form-control:focus,
        .form-select:focus {
            background: #fff !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12) !important;
        }

        .btn-filter,
        .btn-add {
            border-radius: 12px !important;
            font-weight: 700 !important;
            border: none !important;
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.18);
        }

        /* Premium CRUD Action Buttons */
        .btn-view,
        .btn-edit,
        .btn-del,
        .btn-process,
        .btn-cancel-r {
            width: 38px !important;
            height: 38px !important;
            border-radius: 10px !important;
            border: 1.5px solid #e2e8f0 !important;
            background: #fff !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05) !important;
            color: #64748b !important;
        }

        .btn-view { border-color: #0dcaf0 !important; color: #0dcaf0 !important; }
        .btn-view:hover { 
            background: #0dcaf0 !important; 
            color: #fff !important; 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(13, 202, 240, 0.3) !important;
        }

        .btn-edit, .btn-process { border-color: #0d6efd !important; color: #0d6efd !important; }
        .btn-edit:hover, .btn-process:hover { 
            background: #0d6efd !important; 
            color: #fff !important; 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3) !important;
        }

        .btn-del, .btn-cancel-r { border-color: #dc3545 !important; color: #dc3545 !important; }
        .btn-del:hover, .btn-cancel-r:hover { 
            background: #dc3545 !important; 
            color: #fff !important; 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3) !important;
        }

        [data-theme="dark"] .btn-view,
        [data-theme="dark"] .btn-edit,
        [data-theme="dark"] .btn-del,
        [data-theme="dark"] .btn-process,
        [data-theme="dark"] .btn-cancel-r {
            background: #1e293b !important;
        }

        .kpi-card:hover,
        .stat-card:hover,
        .chart-card:hover {
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08) !important;
        }

        [data-theme="dark"] .page-header-premium,
        [data-theme="dark"] .filter-card,
        [data-theme="dark"] .table-card,
        [data-theme="dark"] .chart-card,
        [data-theme="dark"] .detail-card,
        [data-theme="dark"] .details-card,
        [data-theme="dark"] .kpi-card,
        [data-theme="dark"] .stat-card {
            background: rgba(15, 23, 42, 0.9) !important;
            border-color: rgba(148, 163, 184, 0.2) !important;
        }

        [data-theme="dark"] .table th {
            background: rgba(30, 41, 59, 0.9) !important;
            color: #cbd5e1 !important;
        }

        [data-theme="dark"] .search-input-group input,
        [data-theme="dark"] .form-control,
        [data-theme="dark"] .form-select {
            background: #0b1220 !important;
            border-color: #334155 !important;
            color: #e2e8f0 !important;
        }

        /* --- LOGOUT PREMIUM UI --- */
        .sidebar-footer {
            padding: 0 8px 24px 8px;
        }

        .sidebar-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
            width: 100%;
        }

        .logout-wrapper {
            padding: 4px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: var(--transition);
        }

        .logout-wrapper:hover {
            background: rgba(239, 68, 68, 0.05);
            border-color: rgba(239, 68, 68, 0.2);
        }

        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            background: transparent;
            border: none;
            border-radius: 12px;
            color: #94A3B8;
            text-decoration: none;
            transition: var(--transition);
            text-align: left;
        }

        .logout-icon-box {
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #EF4444;
            transition: var(--transition);
        }

        .logout-btn:hover .logout-icon-box {
            background: #EF4444;
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            transform: scale(1.05);
        }

        .logout-text-wrapper {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .logout-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: #F8FAFC;
            transition: var(--transition);
        }

        .logout-subtitle {
            font-size: 0.7rem;
            color: #64748B;
            font-weight: 500;
        }

        /* ==========================================================================
           ELITE PREMIUM UI UTILITIES
           ========================================================================== */
        :root {
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.4);
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
            --elite-gradient-primary: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            --elite-gradient-success: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --elite-gradient-warning: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --elite-gradient-danger: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            --elite-gradient-info: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            --elite-radius: 18px;
            --transition-premium: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        [data-theme="dark"] {
            --glass-bg: rgba(15, 23, 42, 0.7);
            --glass-border: rgba(255, 255, 255, 0.05);
            --glass-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            border-radius: var(--elite-radius);
            transition: var(--transition-premium);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.12);
        }

        .text-gradient-primary {
            background: var(--elite-gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-elite-primary {
            background: var(--elite-gradient-primary);
            color: white !important;
            border: none;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: var(--transition-premium);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-elite-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        .elite-table {
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .elite-table thead th {
            border: none;
            background: transparent;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 12px 20px;
        }

        .elite-table tbody tr {
            background: var(--glass-bg);
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            border-radius: 12px;
            transition: var(--transition-premium);
        }

        .elite-table tbody tr td {
            border: none;
            padding: 16px 20px;
            vertical-align: middle;
        }

        .elite-table tbody tr td:first-child { border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
        .elite-table tbody tr td:last-child { border-top-right-radius: 12px; border-bottom-right-radius: 12px; }

        .elite-table tbody tr:hover {
            transform: scale(1.01) translateX(5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            z-index: 10;
            position: relative;
        }

        .stat-icon-elite {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 0;
            flex-shrink: 0;
        }

        .badge-elite {
            padding: 5px 12px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* --- Animations --- */
        @keyframes fadeInUpElite {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in-up {
            animation: fadeInUpElite 0.6s ease-out forwards;
        }
    </style>

    @stack('styles')
    <script>
        // Apply theme before page renders to prevent flash
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>
</head>
<body>
    <!-- Global Skeleton Loading Overlay -->
    <div class="skeleton-overlay" id="globalSkeletonLoader">
        <div class="skeleton-content">
            <!-- Skeleton Navbar -->
            <div class="skeleton-navbar">
                <div class="skeleton-navbar-icon"></div>
                <div class="skeleton-navbar-text">
                    <div class="skeleton-navbar-line"></div>
                </div>
                <div class="skeleton-navbar-avatar"></div>
            </div>
            
            <!-- Skeleton Page Content -->
            <div class="skeleton-page-content">
                <!-- Page Header -->
                <div class="skeleton-header">
                    <div class="skeleton-header-left">
                        <div class="skeleton-icon primary"></div>
                        <div class="skeleton-text">
                            <div class="skeleton-line title"></div>
                            <div class="skeleton-line subtitle"></div>
                        </div>
                    </div>
                    <div class="skeleton-header-actions">
                        <div class="skeleton-button"></div>
                        <div class="skeleton-button"></div>
                    </div>
                </div>
                
                <!-- 4 Stat Boxes -->
                <div class="skeleton-stats">
                    <div class="skeleton-stat-card">
                        <div class="skeleton-stat-icon indigo"></div>
                        <div class="skeleton-stat-content">
                            <div class="skeleton-stat-label"></div>
                            <div class="skeleton-stat-value"></div>
                        </div>
                    </div>
                    <div class="skeleton-stat-card">
                        <div class="skeleton-stat-icon orange"></div>
                        <div class="skeleton-stat-content">
                            <div class="skeleton-stat-label"></div>
                            <div class="skeleton-stat-value"></div>
                        </div>
                    </div>
                    <div class="skeleton-stat-card">
                        <div class="skeleton-stat-icon yellow"></div>
                        <div class="skeleton-stat-content">
                            <div class="skeleton-stat-label"></div>
                            <div class="skeleton-stat-value"></div>
                        </div>
                    </div>
                    <div class="skeleton-stat-card">
                        <div class="skeleton-stat-icon purple"></div>
                        <div class="skeleton-stat-content">
                            <div class="skeleton-stat-label"></div>
                            <div class="skeleton-stat-value"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Filter Section -->
                <div class="skeleton-filter">
                    <div class="skeleton-filter-header">
                        <div class="skeleton-line" style="width: 140px; height: 20px;"></div>
                        <div class="skeleton-filter-toggle"></div>
                    </div>
                    <div class="skeleton-filter-inputs">
                        <div class="skeleton-input"></div>
                        <div class="skeleton-input"></div>
                        <div class="skeleton-input"></div>
                        <div class="skeleton-input"></div>
                    </div>
                </div>
                
                <!-- Data Grid/Table -->
                <div class="skeleton-table">
                    <div class="skeleton-table-header">
                        <div class="skeleton-table-title"></div>
                        <div class="skeleton-table-select"></div>
                    </div>
                    <div class="skeleton-table-body">
                        <div class="skeleton-table-row"></div>
                        <div class="skeleton-table-row"></div>
                        <div class="skeleton-table-row"></div>
                        <div class="skeleton-table-row"></div>
                        <div class="skeleton-table-row"></div>
                        <div class="skeleton-table-row"></div>
                        <div class="skeleton-table-row"></div>
                        <div class="skeleton-table-row"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-header">
                <div class="brand-logo-container">
                    <div class="brand-box">
                        <img src="{{ asset('images/logo-cjs.png') }}" alt="Logo">
                    </div>
                    <div class="brand-text-wrapper">
                        <span class="brand-name">CJ'S</span>
                        <span class="brand-tagline">Minimart</span>
                    </div>
                </div>
            </div>

            <!-- Compact Actions -->
            <div class="search-container">
                <div class="d-flex gap-2">
                    <div class="search-box flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Filter..." id="menuSearch">
                    </div>
                    <div class="theme-toggle-btn" id="themeToggle" title="Toggle Mode">
                        <i class="fas fa-moon"></i>
                    </div>
                </div>
            </div>

            @php
                $currentUser = Auth::user();
                $isSupervisorLayout = $currentUser && $currentUser->isSupervisor() && !$currentUser->isAdmin();
                $canViewDashboard = $currentUser && $currentUser->hasPermission('view-dashboard');
                $canManageUsers = $currentUser && $currentUser->hasPermission('manage-users');
                $canManageProducts = $currentUser && $currentUser->hasPermission('manage-products');
                $canManageSuppliers = $currentUser && $currentUser->hasPermission('manage-suppliers');
                $canManageInventory = $currentUser && $currentUser->hasPermission('manage-inventory');
                $canManageSales = $currentUser && $currentUser->hasPermission('manage-sales');
                $canViewReports = $currentUser && $currentUser->hasPermission('view-reports');
                $canManageSystem = $currentUser && $currentUser->hasPermission('manage-system');
            @endphp

            <!-- Navigation Menu -->
            <div class="nav-menu">
                @if ($isSupervisorLayout)
                    @if ($canViewDashboard)
                    <ul class="nav-item">
                        <li>
                            <a href="{{ route('supervisor.dashboard') }}" class="nav-link {{ request()->routeIs('supervisor.dashboard') || request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-chart-pie"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                    @endif

                    @if ($canManageProducts)
                    <ul class="nav-item">
                        <li>
                            <div class="nav-link {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.brands.*') || request()->routeIs('admin.uom.*') || request()->routeIs('admin.variations.*') ? 'active' : '' }}" onclick="toggleSubmenu('productSubmenu', this)">
                                <i class="fas fa-boxes"></i>
                                <span>Product Maintenance</span>
                                <i class="fas fa-chevron-right arrow" id="productArrow"></i>
                            </div>
                            <ul class="submenu" id="productSubmenu">
                                <li>
                                    <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                                        <i class="fas fa-list me-2"></i> Product List
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.products.create') }}" class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                                        <i class="fas fa-plus me-2"></i> Add Product
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                                        <i class="fas fa-tags me-2"></i> Categories
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.brands.index') }}" class="{{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                                        <i class="fas fa-trademark me-2"></i> Brands
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endif

                    @if ($canManageSuppliers)
                    <ul class="nav-item">
                        <li>
                            <div class="nav-link {{ request()->routeIs('admin.suppliers.*') || request()->routeIs('admin.purchase-history.*') || request()->routeIs('admin.supplier-returns.*') || request()->routeIs('admin.payment-terms.*') ? 'active' : '' }}" onclick="toggleSubmenu('supplierSubmenu', this)">
                                <i class="fas fa-truck"></i>
                                <span>Supplier Maintenance</span>
                                <i class="fas fa-chevron-right arrow" id="supplierArrow"></i>
                            </div>
                            <ul class="submenu" id="supplierSubmenu">
                                <li>
                                    <a href="{{ route('admin.suppliers.index') }}" class="{{ request()->routeIs('admin.suppliers.*') ? 'active' : '' }}">
                                        <i class="fas fa-users me-2"></i> Supplier List
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.suppliers.create') }}" class="{{ request()->routeIs('admin.suppliers.create') ? 'active' : '' }}">
                                        <i class="fas fa-plus me-2"></i> Add Supplier
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.purchase-history.index') }}" class="{{ request()->routeIs('admin.purchase-history.*') ? 'active' : '' }}">
                                        <i class="fas fa-history me-2"></i> Purchase History
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.supplier-returns.index') }}" class="{{ request()->routeIs('admin.supplier-returns.*') ? 'active' : '' }}">
                                        <i class="fas fa-undo me-2"></i> Supplier Returns
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endif

                    @if ($canManageInventory)
                    <ul class="nav-item">
                        <li>
                            <div class="nav-link {{ request()->routeIs('admin.inventory.*') ? 'active' : '' }}" onclick="toggleSubmenu('inventorySubmenu', this)">
                                <i class="fas fa-warehouse"></i>
                                <span>Inventory</span>
                                <i class="fas fa-chevron-right arrow" id="inventoryArrow"></i>
                            </div>
                            <ul class="submenu" id="inventorySubmenu">
                                <li>
                                    <a href="{{ route('admin.inventory.stock-in') }}" class="{{ request()->routeIs('admin.inventory.stock-in') ? 'active' : '' }}">
                                        <i class="fas fa-arrow-down me-2"></i> Stock In
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.inventory.stock-out') }}" class="{{ request()->routeIs('admin.inventory.stock-out') ? 'active' : '' }}">
                                        <i class="fas fa-arrow-up me-2"></i> Stock Out
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.inventory.alerts') }}" class="{{ request()->routeIs('admin.inventory.alerts') ? 'active' : '' }}">
                                        <i class="fas fa-exclamation-triangle me-2"></i> Alerts
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.inventory.all-history') }}" class="{{ request()->routeIs('admin.inventory.all-history') || request()->routeIs('admin.inventory.history') ? 'active' : '' }}">
                                        <i class="fas fa-history me-2"></i> Stock History
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endif

                    @if ($canManageSales)
                    <ul class="nav-item">
                        <li>
                            <div class="nav-link {{ request()->routeIs('supervisor.sales.*') || request()->routeIs('supervisor.transactions.*') || request()->routeIs('supervisor.returns.*') || request()->routeIs('supervisor.customers.*') || request()->routeIs('cashier.pos.*') ? 'active' : '' }}" onclick="toggleSubmenu('salesSubmenu', this)">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Sales</span>
                                <i class="fas fa-chevron-right arrow" id="salesArrow"></i>
                            </div>
                            <ul class="submenu" id="salesSubmenu">
                                <li>
                                    <a href="{{ route('supervisor.transactions.index') }}" class="{{ request()->routeIs('supervisor.transactions.*') ? 'active' : '' }}">
                                        <i class="fas fa-receipt me-2"></i> Transactions
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.returns.index') }}" class="{{ request()->routeIs('supervisor.returns.*') ? 'active' : '' }}">
                                        <i class="fas fa-undo-alt me-2"></i> Returns & Refunds
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.sales.index', ['status' => 'pending_void']) }}" class="{{ request()->input('status') === 'pending_void' ? 'active' : '' }}">
                                        <i class="fas fa-ban me-2"></i> Pending Voids
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.sales.index', ['status' => 'pending_refund']) }}" class="{{ request()->input('status') === 'pending_refund' ? 'active' : '' }}">
                                        <i class="fas fa-undo-alt me-2"></i> Pending Refunds
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cashier.pos.index') }}" class="{{ request()->routeIs('cashier.pos.*') ? 'active' : '' }}">
                                        <i class="fas fa-cash-register me-2"></i> Point of Sale
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endif

                    @if ($canViewReports)
                    <ul class="nav-item">
                        <li>
                            <div class="nav-link {{ request()->routeIs('supervisor.reports.*') ? 'active' : '' }}" onclick="toggleSubmenu('reportsSubmenu', this)">
                                <i class="fas fa-chart-bar"></i>
                                <span>Reports</span>
                                <i class="fas fa-chevron-right arrow" id="reportsArrow"></i>
                            </div>
                            <ul class="submenu" id="reportsSubmenu">
                                <li>
                                    <a href="{{ route('supervisor.reports.sales') }}" class="{{ request()->routeIs('supervisor.reports.sales') ? 'active' : '' }}">
                                        <i class="fas fa-chart-line me-2"></i> Sales Report
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.reports.inventory') }}" class="{{ request()->routeIs('supervisor.reports.inventory') ? 'active' : '' }}">
                                        <i class="fas fa-boxes me-2"></i> Inventory Report
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.reports.profit-loss') }}" class="{{ request()->routeIs('supervisor.reports.profit-loss') ? 'active' : '' }}">
                                        <i class="fas fa-coins me-2"></i> Profit & Loss
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                @else
                <!-- DASHBOARD -->
                @if ($canViewDashboard)
                <ul class="nav-item">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-chart-pie"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
                @endif

                <!-- USER MANAGEMENT -->
                @if ($canManageUsers)
                <ul class="nav-item">
                    <li>
                        <div class="nav-link {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}" onclick="toggleSubmenu('userSubmenu', this)">
                            <i class="fas fa-users"></i>
                            <span>User Maintenance</span>
                            @php $pendingCount = \App\Models\User::where('approval_status', 'pending')->count(); @endphp
                            @if ($pendingCount > 0)
                                <span class="badge-count">{{ $pendingCount }}</span>
                            @endif
                            <i class="fas fa-chevron-right arrow" id="userArrow"></i>
                        </div>
                        <ul class="submenu" id="userSubmenu">
                            <li>
                                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                    <i class="fas fa-list me-2"></i> User list
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.create') }}" class="{{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                                    <i class="fas fa-plus me-2"></i> Add User
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.pending') }}" class="{{ request()->routeIs('admin.users.pending') ? 'active' : '' }}">
                                    <i class="fas fa-clock me-2"></i> Pending Approvals
                                    @if ($pendingCount > 0)
                                        <span class="badge bg-warning text-dark ms-2">{{ $pendingCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.roles.index') }}" class="{{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                    <i class="fas fa-shield-alt me-2"></i> Roles & Permissions
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.activity-logs.index') }}" class="{{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                                    <i class="fas fa-history me-2"></i> Activity Logs
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif

                <!-- PRODUCT MAINTENANCE -->
                @if ($canManageProducts)
                <ul class="nav-item">
                    <li>
                        <div class="nav-link {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.brands.*') ? 'active' : '' }}" onclick="toggleSubmenu('productSubmenu', this)">
                            <i class="fas fa-boxes"></i>
                            <span>Product Maintenance</span>
                            <i class="fas fa-chevron-right arrow" id="productArrow"></i>
                        </div>
                        <ul class="submenu" id="productSubmenu">
                            <li>
                                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                                    <i class="fas fa-list me-2"></i> Product list
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.products.create') }}" class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                                    <i class="fas fa-plus me-2"></i> Add Product
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                                    <i class="fas fa-tags me-2"></i> Categories
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.brands.index') }}" class="{{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                                    <i class="fas fa-trademark me-2"></i> Brands
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif

                <!-- SUPPLIER MAINTENANCE -->
                @if ($canManageSuppliers)
                <ul class="nav-item">
                    <li>
                        <div class="nav-link {{ request()->routeIs('admin.suppliers.*') || request()->routeIs('admin.purchase-history.*') || request()->routeIs('admin.supplier-returns.*') || request()->routeIs('admin.payment-terms.*') ? 'active' : '' }}" onclick="toggleSubmenu('supplierSubmenu', this)">
                            <i class="fas fa-truck"></i>
                            <span>Supplier Maintenance</span>
                            <i class="fas fa-chevron-right arrow" id="supplierArrow"></i>
                        </div>
                        <ul class="submenu" id="supplierSubmenu">
                            <li>
                                <a href="{{ route('admin.suppliers.index') }}" class="{{ request()->routeIs('admin.suppliers.index') ? 'active' : '' }}">
                                    <i class="fas fa-users me-2"></i> Supplier list
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.suppliers.create') }}" class="{{ request()->routeIs('admin.suppliers.create') ? 'active' : '' }}">
                                    <i class="fas fa-plus me-2"></i> Add Supplier
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.purchase-history.index') }}" class="{{ request()->routeIs('admin.purchase-history.*') ? 'active' : '' }}">
                                    <i class="fas fa-history me-2"></i> Purchase History
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.supplier-returns.index') }}" class="{{ request()->routeIs('admin.supplier-returns.*') ? 'active' : '' }}">
                                    <i class="fas fa-undo me-2"></i> Supplier Returns
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif

                <!-- INVENTORY -->
                @if ($canManageInventory)
                <ul class="nav-item">
                    <li>
                        <div class="nav-link {{ request()->routeIs('admin.inventory.*') ? 'active' : '' }}" onclick="toggleSubmenu('inventorySubmenu', this)">
                            <i class="fas fa-warehouse"></i>
                            <span>Inventory</span>
                            @php 
                                $lowStockInventory = \App\Models\Stock::whereRaw('quantity <= min_quantity')->count();
                                $expiredCount = \App\Models\Product::where('has_expiry', true)
                                                 ->where('expiry_date', '<', now())->count();
                                $nearExpiryCount = \App\Models\Product::where('has_expiry', true)
                                                  ->where('expiry_date', '>', now())
                                                  ->where('expiry_date', '<=', now()->addDays(30))->count();
                                $totalAlerts = $lowStockInventory + $expiredCount + $nearExpiryCount;
                            @endphp
                            @if ($totalAlerts > 0)
                                <span class="badge-count">{{ $totalAlerts }}</span>
                            @endif
                            <i class="fas fa-chevron-right arrow" id="inventoryArrow"></i>
                        </div>
                        <ul class="submenu" id="inventorySubmenu">
                            <li>
                                <a href="{{ route('admin.inventory.stock-in') }}" class="{{ request()->routeIs('admin.inventory.stock-in') ? 'active' : '' }}">
                                    <i class="fas fa-arrow-down me-2"></i> Stock In
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.inventory.stock-out') }}" class="{{ request()->routeIs('admin.inventory.stock-out') ? 'active' : '' }}">
                                    <i class="fas fa-arrow-up me-2"></i> Stock Out
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.inventory.alerts') }}" class="{{ request()->routeIs('admin.inventory.alerts') ? 'active' : '' }}">
                                    <i class="fas fa-exclamation-triangle me-2"></i> Low Stock Alerts
                                    @if ($totalAlerts > 0)
                                        <span class="badge bg-warning text-dark ms-2">{{ $totalAlerts }}</span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.inventory.all-history') }}" class="{{ request()->routeIs('admin.inventory.all-history') || request()->routeIs('admin.inventory.history') ? 'active' : '' }}">
                                    <i class="fas fa-history me-2"></i> Stock History
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif

                <!-- SALES -->
                @if ($canManageSales)
                <ul class="nav-item">
                    <li>
                        <div class="nav-link {{ request()->routeIs('cashier.pos.*') || request()->routeIs('cashier.sales.*') || request()->routeIs('supervisor.transactions.*') || request()->routeIs('supervisor.returns.*') || request()->routeIs('supervisor.customers.*') ? 'active' : '' }}" onclick="toggleSubmenu('salesSubmenu', this)">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Sales</span>
                            <i class="fas fa-chevron-right arrow" id="salesArrow"></i>
                        </div>
                        <ul class="submenu" id="salesSubmenu">
                            <li>
                                <a href="{{ route('cashier.pos.index') }}" class="{{ request()->routeIs('cashier.pos.index') ? 'active' : '' }}">
                                    <i class="fas fa-shopping-cart me-2"></i> Point of Sale
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('supervisor.transactions.index') }}" class="{{ request()->routeIs('supervisor.transactions.*') ? 'active' : '' }}">
                                    <i class="fas fa-receipt me-2"></i> Transactions
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('supervisor.returns.index') }}" class="{{ request()->routeIs('supervisor.returns.*') ? 'active' : '' }}">
                                    <i class="fas fa-undo-alt me-2"></i> Returns & Refunds
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif

                <!-- REPORTS -->
                @if ($canViewReports)
                <ul class="nav-item">
                    <li>
                        <div class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" onclick="toggleSubmenu('reportsSubmenu', this)">
                            <i class="fas fa-chart-bar"></i>
                            <span>Reports</span>
                            <i class="fas fa-chevron-right arrow" id="reportsArrow"></i>
                        </div>
                        <ul class="submenu" id="reportsSubmenu">
                            <li>
                                <a href="{{ route('admin.reports.sales') }}" class="{{ request()->routeIs('admin.reports.sales') ? 'active' : '' }}">
                                    <i class="fas fa-chart-line me-2"></i> Sales Report
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.reports.inventory') }}" class="{{ request()->routeIs('admin.reports.inventory') ? 'active' : '' }}">
                                    <i class="fas fa-boxes me-2"></i> Inventory Report
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.reports.profit-loss') }}" class="{{ request()->routeIs('admin.reports.profit-loss') ? 'active' : '' }}">
                                    <i class="fas fa-coins me-2"></i> Profit & Loss
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif

                <!-- SETTINGS -->
                @if ($canManageSystem)
                <ul class="nav-item">
                    <li>
                        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
                @endif
                @endif
            </div>

            <!-- Logout Section -->
            <div class="sidebar-footer mt-auto">
                <div class="sidebar-divider mb-3"></div>
                <div class="logout-wrapper">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <div class="logout-icon-box">
                                <i class="fas fa-sign-out-alt"></i>
                            </div>
                            <div class="logout-text-wrapper">
                                <span class="logout-title">Sign Out</span>
                                <span class="logout-subtitle">End session</span>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Top Navbar -->
            <nav class="navbar-top">
                <div class="navbar-left">
                    <button class="menu-toggle" id="menu-toggle">
                        <i class="fas fa-bars-staggered"></i>
                    </button>
                    <h1 class="page-title">@yield('title', 'Dashboard')</h1>
                </div>

                <div class="navbar-right">
                    <div class="dropdown">
                        <div class="user-dropdown-premium" data-bs-toggle="dropdown">
                            <div class="dropdown-avatar-box">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
                                @else
                                    {{ Auth::user()->initials }}
                                @endif
                            </div>
                            <div class="dropdown-user-info d-none d-md-flex">
                                <span class="dropdown-user-name">{{ Auth::user()->full_name }}</span>
                                <span class="role-badge-mini role-{{ Auth::user()->role }}">{{ Auth::user()->role_label }}</span>
                            </div>
                            <i class="fas fa-chevron-down ms-2 fs-xs opacity-50"></i>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end p-2 border-0 shadow-lg mt-2" style="border-radius: 16px; min-width: 240px; box-shadow: 0 10px 40px rgba(0,0,0,0.1) !important;">
                            <li class="p-3 border-bottom mb-2 bg-light rounded-top-3 d-md-none">
                                <div class="fw-bold">{{ Auth::user()->full_name }}</div>
                                <div class="small text-muted mb-1">{{ Auth::user()->email }}</div>
                                <span class="role-badge-mini role-{{ Auth::user()->role }}">{{ Auth::user()->role_label }}</span>
                            </li>
                            <li class="px-2 py-1 small text-uppercase fw-bold text-muted opacity-50" style="font-size: 0.65rem;">Account Management</li>
                            <li><a class="dropdown-item rounded-3 py-2" href="#" onclick="showProfile()"><i class="fas fa-user-edit me-2 text-primary"></i> Edit Profile</a></li>
                            <li><a class="dropdown-item rounded-3 py-2" href="{{ route('admin.settings.index') }}"><i class="fas fa-shield-alt me-2 text-primary"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item rounded-3 py-2 text-danger fw-bold">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>


            <!-- Page Content -->
            <div class="page-content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Global Skeleton Loading Functions
        function showGlobalSkeletonLoader() {
            const loader = document.getElementById('globalSkeletonLoader');
            if (loader) {
                loader.classList.add('active');
                // Ensure sidebar stays visible and interactive
                const sidebar = document.getElementById('sidebar-wrapper');
                if (sidebar) {
                    sidebar.style.zIndex = '1051'; // Higher than skeleton
                }
            }
        }

        function hideGlobalSkeletonLoader() {
            const loader = document.getElementById('globalSkeletonLoader');
            if (loader) {
                loader.classList.remove('active');
                // Reset sidebar z-index
                const sidebar = document.getElementById('sidebar-wrapper');
                if (sidebar) {
                    sidebar.style.zIndex = '1050';
                }
            }
        }

        // Initialize skeleton loading on page navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Intercept all navigation links including sidebar submenu links
            const interceptNavigation = function(e) {
                const target = e.target.closest('a');
                if (!target) return;
                
                const href = target.getAttribute('href');
                const isModal = target.hasAttribute('data-bs-toggle');
                const isDropdown = target.classList.contains('dropdown-item');
                const isAnchor = href && href.startsWith('#');
                const isJavascript = href && href.startsWith('javascript:');
                const hasTarget = target.hasAttribute('target');
                const hasOnclick = target.hasAttribute('onclick');
                
                // Show skeleton for valid navigation links
                if (href && !isModal && !isDropdown && !isAnchor && !isJavascript && !hasTarget && !hasOnclick) {
                    showGlobalSkeletonLoader();
                }
            };
            
            // Listen to clicks on the entire document
            document.addEventListener('click', interceptNavigation);
            
            // Specifically handle sidebar submenu links
            document.querySelectorAll('.submenu a, .nav-link[href]').forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href && !href.startsWith('#') && !href.startsWith('javascript:')) {
                        showGlobalSkeletonLoader();
                    }
                });
            });
            
            // Hide skeleton when page loads
            window.addEventListener('load', function() {
                hideGlobalSkeletonLoader();
            });
            
            // Hide skeleton on back/forward navigation
            window.addEventListener('pageshow', function(event) {
                hideGlobalSkeletonLoader();
            });
        });

        // Toggle sidebar logic
        function toggleSidebar() {
            if (window.innerWidth >= 992) {
                document.body.classList.toggle('toggled-sidebar');
            } else {
                document.body.classList.toggle('show-sidebar');
            }
        }

        document.getElementById('menu-toggle')?.addEventListener('click', function(e) {
            e.preventDefault();
            toggleSidebar();
        });

        // Close mobile sidebar when clicking on overlay
        document.querySelector('.sidebar-overlay')?.addEventListener('click', function() {
            document.body.classList.remove('show-sidebar');
        });


        // Toggle submenu function
        function toggleSubmenu(id, element) {
            const submenu = document.getElementById(id);
            const arrow = element.querySelector('.arrow');
            const isShown = submenu.classList.contains('show');
            
            // Close all other open submenus
            document.querySelectorAll('.submenu.show').forEach(s => {
                if (s.id !== id) {
                    s.classList.remove('show');
                    // Find the arrow for this submenu to reset rotation
                    const otherToggle = document.querySelector(`[onclick*="${s.id}"]`);
                    if (otherToggle) {
                        const otherArrow = otherToggle.querySelector('.arrow');
                        if (otherArrow) otherArrow.classList.remove('rotated');
                    }
                }
            });
            
            // Toggle the clicked one
            if (submenu) {
                if (isShown) {
                    submenu.classList.remove('show');
                    if (arrow) arrow.classList.remove('rotated');
                } else {
                    submenu.classList.add('show');
                    if (arrow) arrow.classList.add('rotated');
                }
            }
        }

        // Auto-expand submenu based on current route
        document.addEventListener('DOMContentLoaded', function() {
            // User Management submenu
            @if (request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.activity-logs.*'))
                const userSubmenu = document.getElementById('userSubmenu');
                const userArrow = document.querySelector('[onclick="toggleSubmenu(\'userSubmenu\', this)"] .arrow');
                if (userSubmenu) {
                    userSubmenu.classList.add('show');
                    if (userArrow) userArrow.classList.add('rotated');
                }
            @endif

            // Product Management submenu
            @if (request()->routeIs('admin.products.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.brands.*') || request()->routeIs('admin.uom.*') || request()->routeIs('admin.variations.*'))
                const productSubmenu = document.getElementById('productSubmenu');
                const productArrow = document.querySelector('[onclick="toggleSubmenu(\'productSubmenu\', this)"] .arrow');
                if (productSubmenu) {
                    productSubmenu.classList.add('show');
                    if (productArrow) productArrow.classList.add('rotated');
                }
            @endif

            // Supplier submenu
            @if (request()->routeIs('admin.suppliers.*') || request()->routeIs('admin.purchase-history.*') || request()->routeIs('admin.supplier-returns.*') || request()->routeIs('admin.payment-terms.*'))
                const supplierSubmenu = document.getElementById('supplierSubmenu');
                const supplierArrow = document.querySelector('[onclick="toggleSubmenu(\'supplierSubmenu\', this)"] .arrow');
                if (supplierSubmenu) {
                    supplierSubmenu.classList.add('show');
                    if (supplierArrow) supplierArrow.classList.add('rotated');
                }
            @endif

            // Inventory submenu
            @if (request()->routeIs('admin.inventory.*'))
                const inventorySubmenu = document.getElementById('inventorySubmenu');
                const inventoryArrow = document.querySelector('[onclick="toggleSubmenu(\'inventorySubmenu\', this)"] .arrow');
                if (inventorySubmenu) {
                    inventorySubmenu.classList.add('show');
                    if (inventoryArrow) inventoryArrow.classList.add('rotated');
                }
            @endif

            // Sales submenu
            @if (request()->routeIs('cashier.pos.*') || request()->routeIs('cashier.sales.*') || request()->routeIs('supervisor.sales.*') || request()->routeIs('supervisor.transactions.*') || request()->routeIs('supervisor.returns.*') || request()->routeIs('supervisor.customers.*'))
                const salesSubmenu = document.getElementById('salesSubmenu');
                const salesArrow = document.querySelector('[onclick="toggleSubmenu(\'salesSubmenu\', this)"] .arrow');
                if (salesSubmenu) {
                    salesSubmenu.classList.add('show');
                    if (salesArrow) salesArrow.classList.add('rotated');
                }
            @endif

            // Supervisor cash submenu
            @if (request()->routeIs('supervisor.cash.*'))
                const cashSubmenu = document.getElementById('cashSubmenu');
                const cashArrow = document.querySelector('[onclick="toggleSubmenu(\'cashSubmenu\', this)"] .arrow');
                if (cashSubmenu) {
                    cashSubmenu.classList.add('show');
                    if (cashArrow) cashArrow.classList.add('rotated');
                }
            @endif

            // Reports submenu
            @if (request()->routeIs('admin.reports.*') || request()->routeIs('supervisor.reports.*'))
                const reportsSubmenu = document.getElementById('reportsSubmenu');
                const reportsArrow = document.querySelector('[onclick="toggleSubmenu(\'reportsSubmenu\', this)"] .arrow');
                if (reportsSubmenu) {
                    reportsSubmenu.classList.add('show');
                    if (reportsArrow) reportsArrow.classList.add('rotated');
                }
            @endif

            // Settings auto-highlight (no submenu to expand)
            @if (request()->routeIs('admin.import.*') || request()->routeIs('admin.taxes.*') || request()->routeIs('admin.settings.*'))
                // Settings is now a flat link, no expand logic needed
            @endif
        });

        // Coming Soon notification
        function showComingSoon() {
            Swal.fire({
                title: 'Coming Soon!',
                text: 'This feature is under development.',
                icon: 'info',
                confirmButtonColor: '#FF8C42',
                confirmButtonText: 'Got it'
            });
        }

        // --- PREMIUM PROFILE MODAL ---
        function showProfile() {
            const modalHtml = `
            <div class="modal fade" id="profileEditModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                        <div class="profile-header">
                            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="profile-avatar-wrapper" onclick="document.getElementById('avatar-input').click()">
                                <img id="profile-preview" src="{{ Auth::user()->avatar_url }}" alt="Profile">
                                <div class="avatar-overlay">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="profile-form-container">
                            <div class="text-center mb-4">
                                <h4 class="fw-bold mb-0">{{ Auth::user()->full_name }}</h4>
                                <span class="badge role-{{ Auth::user()->role }} py-2 px-3 mt-2 rounded-pill">{{ Auth::user()->role_label }}</span>
                            </div>

                            <ul class="nav nav-pills nav-fill nav-pills-premium" id="profileTabs" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info-pane" type="button">Basic Info</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security-pane" type="button">Security</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="profileTabContent">
                                <!-- Info Pane -->
                                <div class="tab-pane fade show active" id="info-pane">
                                    <form id="profileInfoForm" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" id="avatar-input" name="avatar" class="d-none" accept="image/*" onchange="previewAvatar(this)">
                                        
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label-premium"><i class="fas fa-user me-2 text-primary"></i>Full Name</label>
                                                <input type="text" class="form-control" name="full_name" value="{{ Auth::user()->full_name }}" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label-premium"><i class="fas fa-envelope me-2 text-primary"></i>Email Address</label>
                                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label-premium"><i class="fas fa-phone me-2 text-primary"></i>Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label-premium"><i class="fas fa-id-card me-2 text-primary"></i>Employee ID</label>
                                                <input type="text" class="form-control" value="{{ Auth::user()->employee_id }}" disabled>
                                            </div>
                                            <div class="col-12 text-center mt-4">
                                                <button type="submit" class="btn btn-primary px-5 py-2 fw-bold rounded-pill shadow-sm" id="btnUpdateProfile">
                                                    Update Profile
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Security Pane -->
                                <div class="tab-pane fade" id="security-pane">
                                    <form id="profileSecurityForm">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label-premium"><i class="fas fa-lock me-2 text-danger"></i>Current Password</label>
                                                <input type="password" class="form-control" name="current_password" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label-premium"><i class="fas fa-key me-2 text-primary"></i>New Password</label>
                                                <input type="password" class="form-control" name="new_password" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label-premium"><i class="fas fa-shield-alt me-2 text-primary"></i>Confirm New Password</label>
                                                <input type="password" class="form-control" name="new_password_confirmation" required>
                                            </div>
                                            <div class="col-12 text-center mt-4">
                                                <button type="submit" class="btn btn-outline-danger px-5 py-2 fw-bold rounded-pill mb-2" id="btnUpdatePassword">
                                                    Change Password
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

            // Remove existing modal if any
            const existingModal = document.getElementById('profileEditModal');
            if (existingModal) existingModal.remove();

            // Append new modal to body
            document.body.insertAdjacentHTML('beforeend', modalHtml);

            // Show modal
            const bModal = new bootstrap.Modal(document.getElementById('profileEditModal'));
            bModal.show();

            // Form Handlers
            initProfileHandlers();
        }

        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function initProfileHandlers() {
            // Profile Info Update
            document.getElementById('profileInfoForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                const btn = document.getElementById('btnUpdateProfile');
                const originalText = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Updating...';

                const formData = new FormData(this);

                try {
                    const res = await fetch('{{ route("admin.profile.update") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await res.json();
                    if (data.success) {
                        Swal.fire({ icon: 'success', title: 'Success!', text: data.message, timer: 2000, showConfirmButton: false });
                        // Update UI elements in navbar
                        const headerName = document.querySelector('.dropdown-user-name');
                        if (headerName) headerName.textContent = data.user.full_name;
                        
                        const avatars = document.querySelectorAll('.dropdown-avatar-box img, .user-dropdown img');
                        avatars.forEach(img => {
                            img.src = data.user.avatar_url + '?t=' + new Date().getTime();
                        });

                        setTimeout(() => location.reload(), 1500); // Reload to reflect all changes
                    } else {
                        let errorMsg = '';
                        if (data.errors) {
                            errorMsg = Object.values(data.errors).flat().join('<br>');
                        }
                        Swal.fire({ icon: 'error', title: 'Error', html: errorMsg || 'Update failed' });
                    }
                } catch (error) {
                    console.error('Profile update error:', error);
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong. Please try again.' });
                } finally {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
            });

            // Password Update
            document.getElementById('profileSecurityForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                const btn = document.getElementById('btnUpdatePassword');
                const originalText = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Updating...';

                const formData = new FormData(this);

                try {
                    const res = await fetch('{{ route("admin.profile.update-password") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await res.json();
                    if (data.success) {
                        Swal.fire({ icon: 'success', title: 'Secure!', text: data.message, timer: 2000 });
                        this.reset();
                    } else {
                        let errorMsg = '';
                        if (data.errors) {
                            errorMsg = Object.values(data.errors).flat().join('<br>');
                        }
                        Swal.fire({ icon: 'error', title: 'Oops...', html: errorMsg || 'Password change failed' });
                    }
                } catch (error) {
                    Swal.fire({ icon: 'error', title: 'Connection Issue', text: 'Could not connect to server.' });
                } finally {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
            });
        }

        // Improved Menu Search for Minimalist Sidebar
        document.getElementById('menuSearch')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const navItems = document.querySelectorAll('.nav-item');
            
            navItems.forEach(item => {
                const links = item.querySelectorAll('.nav-link, .submenu li a');
                let foundMatch = false;
                
                links.forEach(link => {
                    const text = (link.querySelector('span')?.textContent || link.textContent).toLowerCase();
                    if (text.includes(searchTerm)) {
                        foundMatch = true;
                        // Highlight match Color
                        link.style.color = 'var(--primary-blue)';
                    } else {
                        link.style.color = '';
                    }
                });

                item.style.display = foundMatch || searchTerm === '' ? '' : 'none';
                
                // Auto-expand submenus if match found
                if (foundMatch && searchTerm !== '') {
                    const submenu = item.querySelector('.submenu');
                    if (submenu) submenu.classList.add('show');
                }
            });
        });

        // Theme Toggle Persistent Logic
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            const themeIcon = themeToggle.querySelector('i');
            
            // Apply saved theme on page load
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            themeIcon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            
            themeToggle.addEventListener('click', () => {
                const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
                const newTheme = isDark ? 'light' : 'dark';
                
                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                
                themeIcon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
