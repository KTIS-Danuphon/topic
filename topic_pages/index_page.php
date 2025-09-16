<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskManager Pro - ระบบจัดการงาน</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            --navbar-height: 70px;
            --sidebar-width: 280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        /* ========== NAVBAR STYLES ========== */
        .navbar-custom {
            background: var(--primary-gradient);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.15);
            height: var(--navbar-height);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.4rem;
            color: white !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            margin: 0 0.2rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white !important;
            transform: translateY(3px);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 0.5rem 0;
            backdrop-filter: blur(10px);
        }

        .dropdown-item {
            padding: 0.7rem 1.2rem;
            transition: all 0.2s ease;
            border-radius: 8px;
            margin: 0 0.5rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #f8f9fc 0%, #e9ecf4 100%);
            transform: translateX(2px);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--secondary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 4px 12px rgba(241, 93, 108, 0.3);
        }

        /* ========== SIDEBAR STYLES ========== */
        .sidebar {
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            height: calc(100vh - var(--navbar-height));
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border-right: 1px solid rgba(0, 0, 0, 0.05);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #cbd5e0 0%, #a0aec0 100%);
            border-radius: 3px;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
        }

        .sidebar-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .sidebar-nav {
            padding: 1.5rem 0;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #718096;
            letter-spacing: 0.1em;
            margin-bottom: 0.5rem;
        }

        .nav-item {
            margin: 0 1rem 0.3rem 1rem;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem 1rem;
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: var(--primary-gradient);
            transition: width 0.3s ease;
            z-index: -1;
        }

        .nav-link-custom:hover {
            color: white;
            transform: translateX(4px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .nav-link-custom:hover::before {
            width: 100%;
        }

        .nav-link-custom.active {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .nav-link-left {
            display: flex;
            align-items: center;
        }

        .nav-link-custom i {
            margin-right: 0.8rem;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .badge-custom {
            background: var(--secondary-gradient);
            color: white;
            font-size: 0.7rem;
            padding: 0.3rem 0.6rem;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(241, 93, 108, 0.3);
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            margin-left: var(--sidebar-width);
            padding-top: var(--navbar-height);
            min-height: 100vh;
            transition: margin-left 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .main-content.sidebar-collapsed {
            margin-left: 0;
        }

        .content-wrapper {
            padding: 2rem;
        }

        .page-header {
            background: linear-gradient(135deg, #ffffff 0%, #f7fafc 100%);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        .page-title {
            font-size: 2.2rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
        }

        .page-subtitle {
            color: #718096;
            margin: 0.5rem 0 0 0;
            font-size: 1.1rem;
        }

        /* ========== SIDEBAR TOGGLE ========== */
        .sidebar-toggle {
            position: fixed;
            top: calc(var(--navbar-height) + 20px);
            left: 20px;
            width: 44px;
            height: 44px;
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 1001;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            display: none;
        }

        .sidebar-toggle:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        }

        .sidebar-toggle.sidebar-hidden {
            left: 20px;
        }

        /* ========== TASK CARDS ========== */
        .task-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .task-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        }

        .task-header {
            background: var(--primary-gradient);
            color: white;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .task-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(5deg);
            }
        }

        .task-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .task-meta {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }

        .meta-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .meta-badge:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-1px);
        }

        .task-id {
            font-family: 'Courier New', monospace;
        }

        .task-body {
            padding: 2.5rem;
        }

        .section {
            margin-bottom: 2.5rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #f1f5f9;
            position: relative;
        }

        .section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .section-title i {
            font-size: 1.4rem;
        }

        /* ========== DESCRIPTION BOX ========== */
        .description-box {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 2rem;
            font-size: 1.05rem;
            line-height: 1.8;
            white-space: pre-wrap;
            position: relative;
            overflow: hidden;
        }

        .description-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-gradient);
        }

        .mention-highlight {
            background: linear-gradient(135deg, #ebf4ff 0%, #dbeafe 100%);
            color: #1e40af;
            padding: 4px 10px;
            border-radius: 8px;
            font-weight: 600;
            border: 2px solid #bfdbfe;
            display: inline-block;
            margin: 0 2px;
            transition: all 0.2s ease;
        }

        .mention-highlight:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2);
        }

        /* ========== USER BADGES ========== */
        .user-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%);
            color: #0d9488;
            padding: 0.8rem 1.2rem;
            border-radius: 50px;
            border: 2px solid #5eead4;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .user-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .user-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 148, 136, 0.3);
        }

        .user-badge:hover::before {
            left: 100%;
        }

        .user-badge.mentioned {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            color: #d97706;
            border-color: #fbbf24;
        }

        .user-badge.mentioned:hover {
            box-shadow: 0 8px 20px rgba(217, 119, 6, 0.3);
        }

        /* ========== FILES GRID ========== */
        .files-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .file-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .file-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--success-gradient);
        }

        .file-card:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-color: #cbd5e0;
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .file-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .file-icon.image {
            background: linear-gradient(135deg, #ecfdf5 0%, #a7f3d0 100%);
            color: #059669;
        }

        .file-icon.document {
            background: linear-gradient(135deg, #eff6ff 0%, #bfdbfe 100%);
            color: #2563eb;
        }

        .file-icon.pdf {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            color: #dc2626;
        }

        .file-icon.archive {
            background: linear-gradient(135deg, #faf5ff 0%, #e9d5ff 100%);
            color: #9333ea;
        }

        .file-icon.video {
            background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%);
            color: #ea580c;
        }

        .file-icon.audio {
            background: linear-gradient(135deg, #f0fdf4 0%, #bbf7d0 100%);
            color: #16a34a;
        }

        .file-info {
            flex: 1;
            min-width: 0;
        }

        .file-name {
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.4rem;
            font-size: 1rem;
            word-wrap: break-word;
        }

        .file-meta {
            font-size: 0.9rem;
            color: #718096;
            display: flex;
            gap: 1.2rem;
        }

        /* ========== STATISTICS ========== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f7fafc 100%);
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.8rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--success-gradient);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.95rem;
            color: #718096;
            font-weight: 600;
        }

        /* ========== STATUS BADGES ========== */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            border: 2px solid;
            transition: all 0.2s ease;
        }

        .status-badge.pending {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            color: #d97706;
            border-color: #fbbf24;
        }

        .status-badge.in-progress {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: #2563eb;
            border-color: #60a5fa;
        }

        .status-badge.completed {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            color: #16a34a;
            border-color: #4ade80;
        }

        /* ========== NO DATA STATE ========== */
        .no-data {
            color: #a0aec0;
            text-align: center;
            padding: 3rem;
            font-style: italic;
        }

        .no-data i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* ========== RESPONSIVE DESIGN ========== */
        @media (max-width: 768px) {
            :root {
                --sidebar-width: 100%;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: flex !important;
                align-items: center;
                justify-content: center;
            }

            .content-wrapper {
                padding: 1rem;
            }

            .task-header {
                padding: 1.5rem;
            }

            .task-title {
                font-size: 1.5rem;
            }

            .task-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-header {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 1.8rem;
            }

            .files-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .user-badges {
                flex-direction: column;
            }
        }

        @media (min-width: 769px) {
            .sidebar-toggle {
                display: none !important;
            }
        }

        /* ========== LOADING ANIMATIONS ========== */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========== SMOOTH SCROLLING ========== */
        html {
            scroll-behavior: smooth;
        }
    </style>
    <style>
        body {
            overflow-x: hidden;
            /* ป้องกัน scrollbar แนวนอน */
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background: #343a40;
            color: #fff;
            transition: transform 0.3s ease;
            z-index: 1050;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar .nav-link-custom {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #adb5bd;
            text-decoration: none;
        }

        .sidebar .nav-link-custom.active,
        .sidebar .nav-link-custom:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        /* main-content เวลามี sidebar */
        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }

        .main-content.sidebar-collapsed {
            margin-left: 0;
        }

        /* Mobile fix: sidebar ทับ content */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Navbar collapse custom */
        .navbar-collapse {
            background: #212529;
        }
    </style>
    <style>
        .modal-header {
            background-color: #0d6efd;
            color: white;
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        /* Mention Dropdown */
        .mention-dropdown {
            position: absolute;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            max-height: 200px;
            overflow-y: auto;
            z-index: 1055;
            display: none;
            min-width: 250px;
        }

        .mention-item {
            padding: 0.75rem 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #f8f9fa;
            transition: background-color 0.2s;
        }

        .mention-item:hover,
        .mention-item.selected {
            background-color: #f8f9fa;
        }

        .mention-item:last-child {
            border-bottom: none;
        }

        .mention-avatar {
            width: 32px;
            height: 32px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            color: #6c757d;
        }

        .mention-info .mention-name {
            font-weight: 500;
            color: #212529;
        }

        .mention-info .mention-username {
            font-size: 0.875rem;
            color: #6c757d;
        }

        /* Mention Tag Styling */
        .mention-tag {
            color: #0d6efd !important;
            font-weight: 500;
            background-color: rgba(13, 110, 253, 0.1);
            padding: 0.125rem 0.25rem;
            border-radius: 0.25rem;
            text-decoration: none;
        }

        /* User Tags */
        .user-tags-container {
            min-height: 50px;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 0.5rem;
            background-color: #fff;
        }

        .user-tag {
            display: inline-flex;
            align-items: center;
            background-color: #e7f3ff;
            border: 1px solid #b6d7ff;
            border-radius: 50px;
            padding: 0.25rem 0.75rem;
            margin: 0.25rem;
            font-size: 0.875rem;
            color: #0d6efd;
        }

        .user-tag .btn-remove {
            background: none;
            border: none;
            color: #6c757d;
            font-size: 1rem;
            margin-left: 0.5rem;
            cursor: pointer;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
        }

        .user-tag .btn-remove:hover {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .btn-add-user {
            border: 1px dashed #6c757d;
            background-color: transparent;
            color: #6c757d;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .btn-add-user:hover {
            background-color: #f8f9fa;
            border-color: #495057;
            color: #495057;
        }

        /* File Attachments */
        .file-attachments {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1rem;
            background-color: #fff;
            min-height: 80px;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            background-color: #f8f9fa;
            border-radius: 0.375rem;
            margin-bottom: 0.5rem;
            border: 1px solid #e9ecef;
        }

        .file-item:last-child {
            margin-bottom: 0;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex: 1;
        }

        .file-icon {
            width: 32px;
            height: 32px;
            background-color: #e9ecef;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }

        .file-details .file-name {
            font-weight: 500;
            color: #212529;
        }

        .file-details .file-size {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .btn-remove-file {
            background: none;
            border: none;
            color: #dc3545;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 0.25rem;
            transition: background-color 0.2s;
        }

        .btn-remove-file:hover {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .btn-add-file {
            width: 100%;
            border: 1px dashed #6c757d;
            background-color: transparent;
            color: #6c757d;
            border-radius: 0.375rem;
            padding: 0.75rem;
            font-size: 0.875rem;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-add-file:hover {
            background-color: #f8f9fa;
            border-color: #495057;
            color: #495057;
        }

        .file-input-hidden {
            display: none;
        }

        /* Custom scrollbar for mention dropdown */
        .mention-dropdown::-webkit-scrollbar {
            width: 6px;
        }

        .mention-dropdown::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .mention-dropdown::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .mention-dropdown::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 0.5rem;
            }

            .user-tag {
                font-size: 0.75rem;
                padding: 0.2rem 0.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>
    <!-- Top Navigation Bar -->
    <?php include 'navbar.php'; ?>
    <!-- Left Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="content-wrapper">
            <div class="container">
                <!-- Page Header -->
                <div class="page-header fade-in">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-6">
                            <h1 class="page-title">งานทั้งหมด</h1>
                            <p class="page-subtitle">จัดการและติดตามงานของคุณ</p>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="d-flex flex-wrap justify-content-lg-end gap-2">

                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle w-100 w-sm-auto" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-funnel me-1"></i> กรองข้อมูล
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" onclick="filterTasks('all')">ทั้งหมด</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterTasks('today')">วันนี้</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterTasks('week')">สัปดาห์นี้</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterTasks('month')">เดือนนี้</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle w-100 w-sm-auto" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-sort-down me-1"></i> เรียงตาม
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" onclick="sortTasks('date_desc')">วันที่สร้าง (ใหม่-เก่า)</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="sortTasks('date_asc')">วันที่สร้าง (เก่า-ใหม่)</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="sortTasks('title')">ชื่องาน (A-Z)</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="sortTasks('priority')">ความสำคัญ</a></li>
                                    </ul>
                                </div>
                                <button class="btn btn-primary w-sm-auto" data-bs-toggle="modal" data-bs-target="#task_newtopicModal">
                                    <i class="bi bi-plus-lg me-1"></i> สร้างงานใหม่
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Search and Stats -->
                    <div class="row mt-4 g-3">
                        <div class="col-12 col-md-6">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" placeholder="ค้นหางาน..." id="searchInput" onkeyup="searchTasks(this.value)">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex flex-wrap justify-content-md-end align-items-center gap-3">
                                <span class="text-muted small">
                                    แสดง <span id="currentCount">0</span> จาก <span id="totalCount">0</span> งาน
                                </span>
                                <div class="btn-group btn-group-sm" role="group">
                                    <input type="radio" class="btn-check" name="viewMode" id="gridView" checked onchange="setViewMode('grid')">
                                    <label class="btn btn-outline-secondary" for="gridView"><i class="bi bi-grid-3x3-gap"></i></label>

                                    <input type="radio" class="btn-check" name="viewMode" id="listView" onchange="setViewMode('list')">
                                    <label class="btn btn-outline-secondary" for="listView"><i class="bi bi-list"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loading Indicator -->
                <div id="loadingIndicator" class="text-center py-4 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">กำลังโหลด...</span>
                    </div>
                    <div class="mt-2">กำลังโหลดข้อมูล...</div>
                </div>

                <!-- Tasks Container -->
                <div id="tasksContainer" class="fade-in">
                    <!-- Tasks will be loaded here -->
                </div>

                <!-- Pagination Controls -->
                <div id="paginationControls" class="d-flex flex-wrap justify-content-center align-items-center mt-4 gap-3">
                    <button class="btn btn-outline-primary" id="prevPage" onclick="goToPage(currentPage - 1)" disabled>
                        <i class="bi bi-chevron-left me-1"></i> ก่อนหน้า
                    </button>

                    <div id="pageNumbers" class="d-flex gap-1"></div>

                    <button class="btn btn-outline-primary" id="nextPage" onclick="goToPage(currentPage + 1)">
                        ถัดไป <i class="bi bi-chevron-right ms-1"></i>
                    </button>

                    <div class="ms-0 ms-md-3">
                        <select class="form-select form-select-sm" id="itemsPerPage" onchange="changeItemsPerPage(this.value)">
                            <option value="5">5 รายการต่อหน้า</option>
                            <option value="10" selected>10 รายการต่อหน้า</option>
                            <option value="20">20 รายการต่อหน้า</option>
                            <option value="50">50 รายการต่อหน้า</option>
                        </select>
                    </div>
                </div>

                <p></p>

                <!-- Infinite Scroll Trigger -->
                <div id="infiniteScrollTrigger" style="height: 1px;"></div>
            </div>
        </div>
    </div>
    //////////////////////////////////////////
    <!-- Task Modal -->
    <div class="modal fade" id="task_newtopicModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">
                        <i class="bi bi-clipboard-plus me-2"></i>สร้างงานใหม่
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="task_newtopicForm">
                        <!-- หัวข้อ -->
                        <div class="mb-3">
                            <label for="taskTitle" class="form-label">
                                <i class="bi bi-card-text me-1"></i>หัวข้อ <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="taskTitle" placeholder="กรุณาใส่หัวข้องาน" required>
                            <div class="invalid-feedback">
                                กรุณาใส่หัวข้องาน
                            </div>
                        </div>

                        <!-- หมวดหมู่ -->
                        <div class="mb-3">
                            <label for="taskCategory" class="form-label">
                                <i class="bi bi-tags me-1"></i>หมวดหมู่
                            </label>
                            <select class="form-select" id="taskCategory" required>
                                <option value="" selected disabled>เลือกหมวดหมู่</option>
                                <option value="development">พัฒนาระบบ</option>
                                <option value="design">ออกแบบ</option>
                                <option value="marketing">การตลาด</option>
                                <option value="meeting">ประชุม</option>
                                <option value="other">อื่นๆ</option>
                            </select>
                        </div>

                        <!-- รายละเอียด -->
                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">
                                <i class="bi bi-file-text me-1"></i>รายละเอียด
                            </label>
                            <div class="position-relative">
                                <textarea class="form-control" id="taskDescription" rows="4"
                                    placeholder="กรุณาใส่รายละเอียดงาน สามารถใช้ @ เพื่อ mention ผู้ใช้อื่น" required></textarea>
                                <div class="invalid-feedback">
                                    กรุณาใส่รายละเอียดงาน
                                </div>
                                <div id="mentionDropdown" class="mention-dropdown"></div>
                            </div>
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>พิมพ์ @ เพื่อ mention ผู้ใช้อื่น
                                <i class="bi bi-people me-1"></i><span id="tag_span">...</span>
                            </div>
                        </div>

                        <!-- ผู้เกี่ยวข้อง -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-people me-1"></i>ผู้เกี่ยวข้อง
                            </label>
                            <div class="user-tags-container" id="userTagsContainer">
                                <button type="button" class="btn btn-add-user" onclick="showUserDropdown()">
                                    <i class="bi bi-plus me-1"></i>เพิ่มผู้ใช้
                                </button>
                            </div>
                            <select class="form-select mt-2 d-none" id="userSelect">
                                <option value="">เลือกผู้ใช้</option>
                            </select>
                        </div>

                        <!-- สถานะ -->
                        <div class="mb-3">
                            <label for="taskStatus" class="form-label">
                                <i class="bi bi-bookmark-star me-1"></i>สถานะการทำงาน
                            </label>
                            <select class="form-select" id="taskStatus" required>
                                <option value="" selected disabled>เลือกสถานะการทำงาน</option>
                                <option value="pending">รอดำเนินการ</option>
                                <option value="in-progress">กำลังดำเนินการ</option>
                                <option value="completed">เสร็จสิ้น</option>
                            </select>
                        </div>

                        <!-- ไฟล์แนบ -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-paperclip me-1"></i>ไฟล์แนบ
                            </label>
                            <div class="file-attachments" id="fileAttachments">
                                <div class="file-input-container" data-file-index="1">
                                    <input type="file" class="file-input-hidden" id="fileInput1" accept="*/*">
                                    <div class="btn-add-file" onclick="triggerFileInput('fileInput1')">
                                        <i class="bi bi-cloud-upload me-2"></i>เลือกไฟล์
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="addFileInput()">
                                <i class="bi bi-plus me-1"></i>เพิ่มไฟล์แนบ
                            </button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>ยกเลิก
                    </button>
                    <button id="saveBtn" type="button" class="btn btn-primary" onclick="saveTask()">
                        <i class="bi bi-check-circle me-1"></i>บันทึก
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.querySelector(".main-content");
        const sidebarToggle = document.getElementById("sidebarToggle");

        function toggleSidebar() {
            if (window.innerWidth <= 768) {
                // Mobile: toggle แสดง/ซ่อนแบบ overlay
                sidebar.classList.toggle("show");
            } else {
                // Desktop: toggle ย่อ/ขยาย sidebar
                sidebar.classList.toggle("collapsed");
                mainContent.classList.toggle("sidebar-collapsed");
            }
        }

        // ปิด sidebar เมื่อคลิกนอก sidebar (เฉพาะ mobile)
        document.addEventListener("click", function(e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove("show");
                }
            }
        });

        // รีเซ็ต state เวลา resize
        window.addEventListener("resize", function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove("show");
            }
        });
    </script>

    <!-- สคริปฟิลเตอร์ -->
    <script>
        // Global variables
        let currentPage = 1;
        let itemsPerPage = 10;
        let totalItems = 0;
        let totalPages = 0;
        let currentFilter = 'all';
        let currentSort = 'date_desc';
        let currentSearch = '';
        let isLoading = false;
        let allTasks = [];
        let filteredTasks = [];
        let viewMode = 'grid';

        // Mock data - Complete 15 tasks
        const mockTasks = [{
                id: 1,
                title: "พัฒนาระบบจัดการงานใหม่สำหรับบริษัท",
                category: "development",
                status: "pending",
                created_at: "2023-01-15 14:30",
                priority: 3
            },
            {
                id: 2,
                title: "ออกแบบ Landing Page สำหรับผลิตภัณฑ์ใหม่",
                category: "design",
                status: "in-progress",
                created_at: "2023-01-14 10:15",
                priority: 2
            },
            {
                id: 3,
                title: "วิเคราะห์ข้อมูลการขายไตรมาส 4",
                category: "marketing",
                status: "completed",
                created_at: "2024-01-13 16:45",
                priority: 1
            },
            {
                id: 4,
                title: "ประชุมทีมพัฒนาประจำสัปดาห์",
                category: "meeting",
                status: "pending",
                created_at: "2024-01-12 09:00",
                priority: 2
            },
            {
                id: 5,
                title: "อัพเดท API Documentation",
                category: "development",
                status: "in-progress",
                created_at: "2025-01-11 11:20",
                priority: 2
            },
            {
                id: 6,
                title: "สร้างแคมเปญโฆษณา Social Media",
                category: "marketing",
                status: "pending",
                created_at: "2025-01-10 13:15",
                priority: 3
            },
            {
                id: 7,
                title: "ปรับปรุง UI/UX หน้า Dashboard",
                category: "design",
                status: "completed",
                created_at: "2025-01-09 15:30",
                priority: 1
            },
            {
                id: 8,
                title: "ทดสอบระบบ Security",
                category: "development",
                status: "in-progress",
                created_at: "2025-01-08 08:45",
                priority: 3
            },
            {
                id: 9,
                title: "จัดทำรายงานผลประกอบการรายเดือน",
                category: "other",
                status: "pending",
                created_at: "2025-01-07 12:00",
                priority: 2
            },
            {
                id: 10,
                title: "Workshop เรื่องการใช้งาน CRM",
                category: "meeting",
                status: "completed",
                created_at: "2025-01-06 14:00",
                priority: 1
            },
            {
                id: 11,
                title: "พัฒนา Mobile App สำหรับลูกค้า",
                category: "development",
                status: "pending",
                created_at: "2025-01-05 10:30",
                priority: 3
            },
            {
                id: 12,
                title: "ออกแบบโบรชัวร์ผลิตภัณฑ์",
                category: "design",
                status: "in-progress",
                created_at: "2025-09-30 11:15",
                priority: 2
            },
            {
                id: 13,
                title: "วิเคราะห์คู่แข่งในตลาด",
                category: "marketing",
                status: "pending",
                created_at: "2025-09-01 09:45",
                priority: 2
            },
            {
                id: 14,
                title: "ติดตั้งระบบ Backup ใหม่",
                category: "development",
                status: "pending",
                created_at: "2025-09-15 16:20",
                priority: 1
            },
            {
                id: 15,
                title: "ประเมินประสิทธิภาพทีมงาน",
                category: "other",
                status: "in-progress",
                created_at: "2025-09-16 01:00",
                priority: 2
            }
        ];

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            allTasks = [...mockTasks];
            applyFiltersAndSort();
            updateSidebarCounts();
        });

        // Toggle sidebar for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');

            sidebar.classList.toggle('show');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('sidebar-collapsed');
        }

        // Load tasks by status
        function loadTasks(status) {
            currentFilter = status;
            currentPage = 1;

            // Update active nav link
            document.querySelectorAll('.nav-link-custom').forEach(link => {
                link.classList.remove('active');
            });

            // Update page title
            const titles = {
                'all': 'งานทั้งหมด',
                'pending': 'งานรอดำเนินการ',
                'in-progress': 'งานกำลังดำเนินการ',
                'completed': 'งานเสร็จสิ้น'
            };

            document.getElementById('pageTitle').textContent = titles[status] || 'งานทั้งหมด';

            applyFiltersAndSort();
        }

        // Filter tasks by date range
        function filterTasks(dateFilter) {
            console.log(dateFilter);

            const now = new Date();
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

            let filteredByDate = allTasks;

            if (dateFilter === 'today') {
                filteredByDate = allTasks.filter(task => {
                    const taskDate = new Date(task.created_at);
                    const taskDay = new Date(taskDate.getFullYear(), taskDate.getMonth(), taskDate.getDate());
                    console.log(taskDay);
                    return taskDay.getTime() === today.getTime();
                });
            } else if (dateFilter === 'week') {
                const weekAgo = new Date(today.getTime() - (7 * 24 * 60 * 60 * 1000));
                filteredByDate = allTasks.filter(task => {
                    const taskDate = new Date(task.created_at);
                    console.log(taskDate + '>=' + weekAgo);

                    return taskDate >= weekAgo;
                });
            } else if (dateFilter === 'month') {
                const monthAgo = new Date(today.getTime() - (30 * 24 * 60 * 60 * 1000));
                filteredByDate = allTasks.filter(task => {
                    const taskDate = new Date(task.created_at);
                    console.log(taskDate + '>=' + monthAgo);

                    return taskDate >= monthAgo;
                });
            }

            allTasks = filteredByDate;
            currentPage = 1;
            applyFiltersAndSort();
        }

        // Sort tasks
        function sortTasks(sortType) {
            currentSort = sortType;
            applyFiltersAndSort();
        }

        // Search tasks
        function searchTasks(query) {
            console.log(query);
            currentSearch = query.toLowerCase();
            console.log('currentSearch', currentSearch);
            currentPage = 1;
            applyFiltersAndSort();
        }

        // Apply all filters and sorting
        function applyFiltersAndSort() {
            showLoading();

            setTimeout(() => {
                // Start with all tasks
                let tasks = [...allTasks];

                // Apply status filter
                if (currentFilter !== 'all') {
                    tasks = tasks.filter(task => task.status === currentFilter);
                }

                // Apply search filter
                // if (currentSearch) {
                //     tasks = tasks.filter(task =>
                //         task.title.toLowerCase().includes(currentSearch)
                //     );
                // }
                if (currentSearch) {
                    const searchLower = currentSearch.toLowerCase();

                    tasks = tasks.filter(task => {
                        const title = task.title.toLowerCase();

                        // ปีจาก created_at
                        const year = new Date(task.created_at).getFullYear().toString();

                        // task code
                        const taskCode = 'TASK-' + year + '-' + task.id.toString().padStart(4, '0');

                        const status = getStatusName(task.status.toLowerCase());

                        return (
                            title.includes(searchLower) ||
                            year.includes(searchLower) ||
                            taskCode.toLowerCase().includes(searchLower) ||
                            status.includes(searchLower)
                        );
                    });
                }


                // Apply sorting
                tasks.sort((a, b) => {
                    switch (currentSort) {
                        case 'date_desc':
                            console.log('date_desc');
                            return new Date(b.created_at) - new Date(a.created_at);
                        case 'date_asc':
                            console.log('date_asc');
                            return new Date(a.created_at) - new Date(b.created_at);
                        case 'title':
                            console.log('title');
                            return a.title.localeCompare(b.title, 'th');
                        case 'priority':
                            console.log('priority');
                            return b.priority - a.priority;
                        default:
                            console.log('00');
                            return 0;
                    }
                });

                filteredTasks = tasks;
                totalItems = filteredTasks.length;
                totalPages = Math.ceil(totalItems / itemsPerPage);

                renderTasks();
                renderPagination();
                updateCounts();
                hideLoading();
            }, 300);
        }

        // Render tasks
        function renderTasks() {
            const container = document.getElementById('tasksContainer');
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const tasksToShow = filteredTasks.slice(startIndex, endIndex);

            if (tasksToShow.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                        <h4 class="mt-3 text-muted">ไม่พบงานที่ค้นหา</h4>
                        <p class="text-muted">ลองเปลี่ยนคำค้นหาหรือกรองข้อมูลใหม่</p>
                    </div>
                `;
                return;
            }

            const tasksHtml = tasksToShow.map(task => `
                <div class="col-12 col-lg-12 col-xl-12 task-container">
                    <div class="task-card">
                        <div class="task-header ${task.category}">
                            <h3 class="task-title">${task.title}</h3>
                            <div class="task-meta">
                                <span class="task-id"><i class="bi bi-hash me-1"></i>TASK-${new Date(task.created_at).getFullYear()}-${task.id.toString().padStart(4, '0')}</span>
                                <span class="category-badge"><i class="bi bi-code-slash me-1"></i>${getCategoryName(task.category)}</span>
                                <span class="created-date"><i class="bi bi-calendar3 me-1"></i>${formatDate(task.created_at)}</span>
                                <span class="priority-badge"><i class="bi bi-card-list me-1"></i>ความสำคัญ ${task.priority}</span>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="status-badge ${task.status}">${getStatusName(task.status)}</span>
                                <div class="dropdown">
                                <a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>ดูรายละเอียด</a>

                                  <!--   <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>ดูรายละเอียด</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>แก้ไข</a></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>ลบ</a></li>
                                    </ul> -->
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');

            container.innerHTML = `<div class="row g-3">${tasksHtml}</div>`;
        }

        // Render pagination
        function renderPagination() {
            const container = document.getElementById('pageNumbers');
            const prevBtn = document.getElementById('prevPage');
            const nextBtn = document.getElementById('nextPage');

            // Update prev/next buttons
            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === totalPages || totalPages === 0;

            // Generate page numbers
            let pagesHtml = '';
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            for (let i = startPage; i <= endPage; i++) {
                pagesHtml += `
                    <button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">
                        ${i}
                    </button>
                `;
            }

            container.innerHTML = pagesHtml;
        }

        // Go to specific page
        function goToPage(page) {
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            renderTasks();
            renderPagination();
            updateCounts();
        }

        // Change items per page
        function changeItemsPerPage(newValue) {
            itemsPerPage = parseInt(newValue);
            currentPage = 1;
            totalPages = Math.ceil(totalItems / itemsPerPage);
            renderTasks();
            renderPagination();
            updateCounts();
        }

        // Set view mode
        function setViewMode(mode) {
            viewMode = mode;
            // Could implement different view modes here
            renderTasks();
        }

        // Update counts display
        function updateCounts() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, totalItems);
            const currentCount = totalItems === 0 ? 0 : endIndex;

            document.getElementById('currentCount').textContent = currentCount;
            document.getElementById('totalCount').textContent = totalItems;
        }

        // Update sidebar counts
        function updateSidebarCounts() {
            const total = allTasks.length;
            const pending = allTasks.filter(t => t.status === 'pending').length;
            const inProgress = allTasks.filter(t => t.status === 'in-progress').length;
            const completed = allTasks.filter(t => t.status === 'completed').length;

            document.getElementById('totalTaskCount').textContent = total;
            document.getElementById('pendingTaskCount').textContent = pending;
            document.getElementById('progressTaskCount').textContent = inProgress;
            document.getElementById('completedTaskCount').textContent = completed;
        }

        // Utility functions
        function getCategoryName(category) {
            const categories = {
                'development': 'พัฒนา',
                'design': 'ออกแบบ',
                'marketing': 'การตลาด',
                'meeting': 'ประชุม',
                'other': 'อื่นๆ'
            };
            return categories[category] || 'อื่นๆ';
        }

        function getStatusName(status) {
            const statuses = {
                'pending': 'รอดำเนินการ',
                'in-progress': 'กำลังดำเนินการ',
                'completed': 'เสร็จสิ้น'
            };
            return statuses[status] || 'ไม่ทราบสถานะ';
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const options = {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            return date.toLocaleDateString('th-TH', options);
        }

        function showLoading() {
            isLoading = true;
            document.getElementById('loadingIndicator').classList.remove('d-none');
            document.getElementById('tasksContainer').style.opacity = '0.5';
        }

        function hideLoading() {
            isLoading = false;
            document.getElementById('loadingIndicator').classList.add('d-none');
            document.getElementById('tasksContainer').style.opacity = '1';
        }

        // Handle responsive sidebar
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                document.getElementById('sidebarToggle').style.display = 'flex';
            } else {
                document.getElementById('sidebarToggle').style.display = 'none';
                document.getElementById('sidebar').classList.remove('show');
            }
        });
    </script>
    <!-- สคริปฟิลเตอร์ -->

    <script>
        // Mock data - normally from API
        const users = [{
                id: 1,
                name: 'สมชาย จันทร์เพ็ญ',
                username: 'somchai'
            },
            {
                id: 2,
                name: 'สุดา ใจดี',
                username: 'suda'
            },
            {
                id: 3,
                name: 'วิชัย สมบูรณ์',
                username: 'wichai'
            },
            {
                id: 4,
                name: 'นิรันดร์ วงศ์ดี',
                username: 'niran'
            },
            {
                id: 5,
                name: 'อรทัย บุญมี',
                username: 'orathai'
            },
            {
                id: 6,
                name: 'ธนา กิจดี',
                username: 'thana'
            },
            {
                id: 7,
                name: 'รัชนี สุขใส',
                username: 'rachani'
            },
            {
                id: 8,
                name: 'ประวิทย์ เก่งกาจ',
                username: 'prawit'
            }
        ];

        // Global variables
        let selectedUsers = [];
        let mentionUsers = [];
        let fileInputCounter = 1;
        let currentMentionStart = -1;
        let selectedMentionIndex = -1;

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            setupMentionSystem();
            setupFileInput('fileInput1');
            populateUserDropdown();
            setupModalEvents();
        });

        // Modal Events Setup
        function setupModalEvents() {
            const modal = document.getElementById('task_newtopicModal');

            modal.addEventListener('hidden.bs.modal', function() {
                resetForm();
            });

            modal.addEventListener('show.bs.modal', function() {
                resetinput_Form();
                populateUserDropdown();
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.position-relative')) {
                    hideMentionDropdown();
                }
                if (!e.target.closest('.user-tags-container') && !e.target.closest('#userSelect')) {
                    hideUserDropdown();
                }
            });
        }

        // Form Reset
        function resetForm() {
            document.getElementById('task_newtopicForm').reset();
            document.getElementById('task_newtopicForm').classList.remove('was-validated');
            selectedUsers = [];
            mentionUsers = [];
            fileInputCounter = 1;
            updateUserTagsDisplay();
            resetFileAttachments();
            hideMentionDropdown();
            hideUserDropdown();
        }

        // User Management
        function populateUserDropdown() {
            const userSelect = document.getElementById('userSelect');
            userSelect.innerHTML = '<option value="">เลือกผู้ใช้</option>';

            users.forEach(user => {
                if (!selectedUsers.find(u => u.id === user.id)) {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = user.name;
                    userSelect.appendChild(option);
                }
            });
        }

        function showUserDropdown() {
            const userSelect = document.getElementById('userSelect');
            userSelect.classList.remove('d-none');
            userSelect.focus();

            // Add change event listener
            userSelect.onchange = function() {
                if (this.value) {
                    addUser(parseInt(this.value));
                    this.value = '';
                    hideUserDropdown();
                }
            };
        }

        function hideUserDropdown() {
            const userSelect = document.getElementById('userSelect');
            userSelect.classList.add('d-none');
        }

        function addUser(userId) {
            const user = users.find(u => u.id === userId);
            if (user && !selectedUsers.find(u => u.id === user.id)) {
                selectedUsers.push(user);
                updateUserTagsDisplay();
                populateUserDropdown();
            }
        }

        function removeUser(userId) {
            selectedUsers = selectedUsers.filter(user => user.id !== userId);
            updateUserTagsDisplay();
            populateUserDropdown();
        }

        function updateUserTagsDisplay() {
            const container = document.getElementById('userTagsContainer');
            container.innerHTML = '';

            selectedUsers.forEach(user => {
                const userTag = document.createElement('span');
                userTag.className = 'user-tag';
                userTag.innerHTML = `
                    ${user.name}
                    <button type="button" class="btn-remove" onclick="removeUser(${user.id})" title="ลบ">
                        <i class="bi bi-x"></i>
                    </button>
                `;
                container.appendChild(userTag);
            });

            const addBtn = document.createElement('button');
            addBtn.type = 'button';
            addBtn.className = 'btn btn-add-user';
            addBtn.innerHTML = '<i class="bi bi-plus me-1"></i>เพิ่มผู้ใช้';
            addBtn.onclick = showUserDropdown;
            container.appendChild(addBtn);
        }

        // Mention System
        function setupMentionSystem() {
            const textarea = document.getElementById('taskDescription');
            const dropdown = document.getElementById('mentionDropdown');

            textarea.addEventListener('input', function(e) {
                handleMentionInput(e);
            });

            textarea.addEventListener('keydown', function(e) {
                handleMentionKeydown(e);
            });
        }

        function handleMentionInput(e) {
            const textarea = e.target;
            const cursorPos = textarea.selectionStart;
            const text = textarea.value;

            // Find @ symbol before cursor
            let atPos = text.lastIndexOf('@', cursorPos - 1);

            if (atPos !== -1) {
                const textAfterAt = text.substring(atPos + 1, cursorPos);

                // Check if there's a space before @, or if it's at start
                const charBeforeAt = atPos > 0 ? text.charAt(atPos - 1) : ' ';

                if ((charBeforeAt === ' ' || charBeforeAt === '\n' || atPos === 0) &&
                    !textAfterAt.includes(' ') && !textAfterAt.includes('\n')) {
                    currentMentionStart = atPos;
                    showMentionDropdown(textAfterAt, textarea);
                } else {
                    hideMentionDropdown();
                }
            } else {
                hideMentionDropdown();
            }
        }

        function handleMentionKeydown(e) {
            const dropdown = document.getElementById('mentionDropdown');

            if (dropdown.style.display === 'block') {
                const items = dropdown.querySelectorAll('.mention-item');

                if (items.length > 0) {
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        selectedMentionIndex = Math.min(selectedMentionIndex + 1, items.length - 1);
                        updateMentionSelection(items);
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        selectedMentionIndex = Math.max(selectedMentionIndex - 1, 0);
                        updateMentionSelection(items);
                    } else if (e.key === 'Enter' || e.key === 'Tab') {
                        e.preventDefault();
                        if (selectedMentionIndex >= 0 && items[selectedMentionIndex]) {
                            const userId = parseInt(items[selectedMentionIndex].dataset.userId);
                            const user = users.find(u => u.id === userId);
                            if (user) {
                                selectMentionUser(user);
                            }
                        }
                    } else if (e.key === 'Escape') {
                        hideMentionDropdown();
                    }
                }
            }
        }

        function showMentionDropdown(query, textarea) {
            const dropdown = document.getElementById('mentionDropdown');

            // Filter users based on query
            const filteredUsers = users.filter(user =>
                user.name.toLowerCase().includes(query.toLowerCase()) ||
                user.username.toLowerCase().includes(query.toLowerCase())
            );

            if (filteredUsers.length === 0) {
                hideMentionDropdown();
                return;
            }

            dropdown.innerHTML = '';
            filteredUsers.forEach((user, index) => {
                const item = document.createElement('div');
                item.className = 'mention-item';
                item.dataset.userId = user.id;
                item.innerHTML = `
                    <div class="mention-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="mention-info">
                        <div class="mention-name">${user.name}</div>
                        <div class="mention-username">@${user.username}</div>
                    </div>
                `;

                item.addEventListener('click', () => selectMentionUser(user));
                dropdown.appendChild(item);
            });

            // Position dropdown
            const rect = textarea.getBoundingClientRect();
            const containerRect = textarea.closest('.position-relative').getBoundingClientRect();

            dropdown.style.top = `${rect.bottom - containerRect.top + 5}px`;
            dropdown.style.left = `${rect.left - containerRect.left}px`;
            dropdown.style.display = 'block';

            selectedMentionIndex = 0;
            updateMentionSelection(dropdown.querySelectorAll('.mention-item'));
        }

        function updateMentionSelection(items) {
            items.forEach((item, index) => {
                item.classList.toggle('selected', index === selectedMentionIndex);
            });
        }

        function selectMentionUser(user) {
            const textarea = document.getElementById('taskDescription');
            const cursorPos = textarea.selectionStart;
            const text = textarea.value;

            // Find @ position
            const atPos = text.lastIndexOf('@', cursorPos - 1);

            // Replace @query with @username
            const beforeMention = text.substring(0, atPos);
            const afterMention = text.substring(cursorPos);
            // const mentionText = `@${user.username}`;
            const mentionText = `@${user.name}, `;
            //const mentionText = `@${user.name.replace(/\s+/g, ".")}`; //@ชื่อ.สกุล

            textarea.value = beforeMention + mentionText + afterMention;

            // Set cursor position after mention
            const newCursorPos = atPos + mentionText.length;
            textarea.setSelectionRange(newCursorPos, newCursorPos);

            // Add to mentioned users
            if (!mentionUsers.find(u => u.id === user.id)) {
                mentionUsers.push(user);
            }

            // const availableFriends = this.friends.filter(friend =>                  
            // !this.mentionedFriends.has(friend.id) &&
            //         friend.name.toLowerCase().includes(query.toLowerCase())
            //     );

            hideMentionDropdown();
            textarea.focus();
            updateMentionUsers();
        }

        function updateMentionUsers() {
            const text = document.getElementById("taskDescription").value;

            // สร้าง array ใหม่จาก text ที่ตรงจริง ๆ
            const foundUsers = users.filter(user => {
                const pattern = new RegExp(`@\\${user.name}\\,`, "g");
                return pattern.test(text);
            });

            // อัปเดต mentionUsers ให้ตรงกับ foundUsers
            mentionUsers = foundUsers.map(u => ({
                id: u.id,
                name: u.name
            }));

            console.log("mentionUsers:", mentionUsers);
        }

        document.getElementById("taskDescription").addEventListener("input", updateMentionUsers);

        function hideMentionDropdown() {
            document.getElementById('mentionDropdown').style.display = 'none';
            selectedMentionIndex = -1;
        }

        // File Management
        function setupFileInput(inputId) {
            const input = document.getElementById(inputId);
            if (!input) return;

            input.addEventListener('change', function() {
                if (this.files.length > 0) {
                    displaySelectedFile(this);
                }
            });
        }

        function triggerFileInput(inputId) {
            document.getElementById(inputId).click();
        }

        function addFileInput() {
            fileInputCounter++;
            const container = document.getElementById('fileAttachments');

            const fileInputContainer = document.createElement('div');
            fileInputContainer.className = 'file-input-container';
            fileInputContainer.dataset.fileIndex = fileInputCounter;

            const inputId = `fileInput${fileInputCounter}`;
            fileInputContainer.innerHTML = `
                <input type="file" class="file-input-hidden" id="${inputId}" accept="*/*">
                <div class="btn-add-file" onclick="triggerFileInput('${inputId}')">
                    <i class="bi bi-cloud-upload me-2"></i>เลือกไฟล์
                </div>
            `;

            container.appendChild(fileInputContainer);
            setupFileInput(inputId);
        }

        // Enhanced file input validation
        function displaySelectedFile(input) {
            if (!input.files || input.files.length === 0) {
                console.warn('No file selected for input:', input.id);
                return;
            }

            const file = input.files[0];
            const container = input.parentElement;

            // Validate file
            if (file.size > 4 * 1024 * 1024) {
                showAlert(`ไฟล์ "${file.name}" มีขนาดใหญ่เกินไป (สูงสุด 4MB)`, 'danger');
                input.value = ''; // Clear the input
                return;
            }

            console.log(`📎 File selected: ${file.name} (${formatFileSize(file.size)})`);

            container.innerHTML = `
                <div class="file-item" data-file-attached="true">
                    <div class="file-info">
                        <div class="file-icon">
                            <i class="bi bi-file-earmark${getFileIcon(file.type)}"></i>
                        </div>
                        <div class="file-details">
                <input type="file" class="file-input-send" name="${input.id}" id="${input.id}" >

                            <div class="file-name" title="${file.name}">${truncateFileName(file.name, 30)}</div>
                            <div class="file-size">${formatFileSize(file.size)}</div>
                            <div class="file-type text-muted" style="font-size: 0.75rem;">${file.type || 'Unknown type'}</div>
                        </div>
                    </div>
                    <button type="button" class="btn-remove-file" onclick="removeFileInput(this)" title="ลบไฟล์">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            `;
            const fileInput_new = document.getElementById(input.id);
            fileInput_new.value = "";
            const dt = new DataTransfer();
            dt.items.add(input.files[0]);
            fileInput_new.files = dt.files;
        }

        function getFileIcon(mimeType) {
            if (!mimeType) return '';

            if (mimeType.startsWith('image/')) return '-image';
            if (mimeType.startsWith('video/')) return '-play';
            if (mimeType.startsWith('audio/')) return '-music';
            if (mimeType.includes('pdf')) return '-pdf';
            if (mimeType.includes('word')) return '-word';
            if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return '-excel';
            if (mimeType.includes('powerpoint') || mimeType.includes('presentation')) return '-ppt';
            if (mimeType.includes('zip') || mimeType.includes('rar') || mimeType.includes('archive')) return '-zip';
            if (mimeType.includes('text')) return '-text';

            return '';
        }

        function truncateFileName(fileName, maxLength) {
            if (fileName.length <= maxLength) return fileName;

            const extension = fileName.split('.').pop();
            const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.'));
            const truncatedName = nameWithoutExt.substring(0, maxLength - extension.length - 4);

            return `${truncatedName}...${extension}`;
        }

        function removeFileInput(button) {
            const container = button.closest('.file-input-container');
            const fileItem = button.closest('.file-item');

            if (container && fileItem) {
                console.log('🗑️ Removing file input');

                // Find the hidden input and clear it
                const input = container.querySelector('.file-input-hidden');
                if (input) {
                    input.value = '';
                    console.log('✅ File input cleared:', input.id);
                }

                // Reset to upload state
                const fileIndex = container.dataset.fileIndex;
                const inputId = `fileInput${fileIndex}`;

                container.innerHTML = `
                    <input type="file" class="file-input-hidden" id="${inputId}" accept="*/*">
                    <div class="btn-add-file" onclick="triggerFileInput('${inputId}')">
                        <i class="bi bi-cloud-upload me-2"></i>เลือกไฟล์
                    </div>
                `;

                setupFileInput(inputId);
            }
        }

        function resetFileAttachments() {
            const container = document.getElementById('fileAttachments');
            container.innerHTML = `
                <div class="file-input-container" data-file-index="1">
                    <input type="file" class="file-input-hidden" id="fileInput1" accept="*/*">
                    <div class="btn-add-file" onclick="triggerFileInput('fileInput1')">
                        <i class="bi bi-cloud-upload me-2"></i>เลือกไฟล์
                    </div>
                </div>
            `;
            fileInputCounter = 1;
            setupFileInput('fileInput1');
            console.log('🔄 File attachments reset');
        }

        // File validation helper
        function validateAllFiles() {
            const fileInputs = document.querySelectorAll('.file-input-hidden');
            const validFiles = [];

            fileInputs.forEach(input => {
                if (input.files && input.files.length > 0) {
                    const file = input.files[0];

                    if (file.size > 10 * 1024 * 1024) {
                        throw new Error(`ไฟล์ "${file.name}" มีขนาดใหญ่เกินไป`);
                    }

                    validFiles.push({
                        input: input,
                        file: file,
                        name: file.name,
                        size: file.size,
                        type: file.type
                    });
                }
            });

            return validFiles;
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Form Validation & Save
        function validateForm() {
            const form = document.getElementById('task_newtopicForm');
            const title = document.getElementById('taskTitle');

            let isValid = true;

            // Reset validation
            form.classList.remove('was-validated');

            // Check title
            if (!title.value.trim()) {
                title.classList.add('is-invalid');
                isValid = false;
            } else {
                title.classList.remove('is-invalid');
            }

            form.classList.add('was-validated');
            return isValid;
        }

        function saveTask() {
            if (!validateForm()) {
                console.log('!validateForm');
                return;
            }
            // const btn = document.getElementById("saveBtn");
            // // ปิดการกดซ้ำ
            // btn.disabled = true;
            // // เปลี่ยนข้อความ
            // btn.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> กำลังบันทึก...`;
            // // จำลองการบันทึก (เช่น เรียก API)
            // setTimeout(() => {
            //     // ตัวอย่าง: บันทึกเสร็จแล้ว
            //     btn.innerHTML = `<i class="bi bi-check-circle me-1"></i>บันทึก`;
            //     // ถ้าต้องการกดใหม่ภายหลัง ให้เปิดใช้งานอีกครั้ง:
            //     // btn.disabled = false;
            // }, 3000);

            const formData = {
                title: document.getElementById('taskTitle').value.trim(),
                category: document.getElementById('taskCategory').value,
                description: document.getElementById('taskDescription').value.trim(),
                staus: document.getElementById('taskStatus').value,
                relatedUsers: selectedUsers.map(user => user.id),
                mentionedUsers: mentionUsers.map(user => user.id),
                files: []
            };

            // Collect files
            const fileInputs = document.querySelectorAll('.file-input-send');
            // const fileInputs = document.querySelectorAll('.file-input-hidden');
            fileInputs.forEach(input => {
                if (input.files.length > 0) {
                    formData.files.push({
                        name: input.files[0].name,
                        size: input.files[0].size,
                        type: input.files[0].type,
                        file: input.files[0]
                    });
                }
            });

            console.log('Data to send:', formData);

            // Show loading state
            const saveBtn = document.querySelector('.modal-footer .btn-primary');
            const originalHtml = saveBtn.innerHTML;
            saveBtn.innerHTML = '<i class="bi bi-arrow-repeat spin me-1"></i>กำลังบันทึก...';
            saveBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Reset button
                saveBtn.innerHTML = originalHtml;
                saveBtn.disabled = false;

                // Show success message
                showAlert('บันทึกงานสำเร็จ!', 'success');

                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('task_newtopicModal'));
                modal.hide();

                // In real implementation, call API here:
                saveTaskToAPI(formData);
            }, 1500);
        }

        // API Integration Functions
        function saveTaskToAPI(formData) {
            const apiFormData = new FormData();

            // Basic form data
            apiFormData.append('title', formData.title);
            apiFormData.append('category', formData.category);
            apiFormData.append('description', formData.description);
            apiFormData.append('taskStatus', formData.staus);
            apiFormData.append('related_users', JSON.stringify(formData.relatedUsers));
            apiFormData.append('mentioned_users', JSON.stringify(formData.mentionedUsers));

            // Files
            formData.files.forEach((fileData, index) => {
                apiFormData.append(`files[${index}]`, fileData.file);
            });
            fetch('api/save_task.php', {
                    method: 'POST',
                    body: apiFormData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showAlert('บันทึกงานสำเร็จ!', 'success');
                        const modal = bootstrap.Modal.getInstance(document.getElementById('task_newtopicModal'));
                        modal.hide();
                        // Optionally reload page or update UI
                    } else {
                        showAlert('เกิดข้อผิดพลาด: ' + (data.message || 'ไม่ทราบสาเหตุ'), 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ: ' + error.message, 'danger');
                })
                .finally(() => {
                    // Reset button state
                    const saveBtn = document.querySelector('.modal-footer .btn-primary');
                    saveBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i>บันทึก';
                    saveBtn.disabled = false;
                });
        }

        function loadUsersFromAPI() {
            fetch('api/get_users.php', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success && Array.isArray(data.data)) {
                        // Update global users array
                        users.length = 0;
                        users.push(...data.data);
                        populateUserDropdown();
                    } else {
                        console.error('Invalid API response:', data);
                        showAlert('ไม่สามารถโหลดรายชื่อผู้ใช้ได้', 'warning');
                    }
                })
                .catch(error => {
                    console.error('Error loading users:', error);
                    showAlert('เกิดข้อผิดพลาดในการโหลดรายชื่อผู้ใช้', 'warning');
                });
        }

        // Utility Functions
        function showAlert(message, type = 'info') {
            // Create alert container if it doesn't exist
            let alertContainer = document.getElementById('alertContainer');
            if (!alertContainer) {
                alertContainer = document.createElement('div');
                alertContainer.id = 'alertContainer';
                alertContainer.className = 'position-fixed top-0 end-0 p-3';
                alertContainer.style.zIndex = '9999';
                document.body.appendChild(alertContainer);
            }

            // Create alert element
            const alertId = 'alert-' + Date.now();
            const alertDiv = document.createElement('div');
            alertDiv.id = alertId;
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.setAttribute('role', 'alert');
            alertDiv.innerHTML = `
                <i class="bi bi-${getAlertIcon(type)} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;

            alertContainer.appendChild(alertDiv);

            // Auto remove after 5 seconds
            setTimeout(() => {
                const alert = document.getElementById(alertId);
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        }

        function getAlertIcon(type) {
            const icons = {
                success: 'check-circle-fill',
                danger: 'exclamation-triangle-fill',
                warning: 'exclamation-triangle-fill',
                info: 'info-circle-fill'
            };
            return icons[type] || 'info-circle-fill';
        }

        // CSS for spinning animation
        const style = document.createElement('style');
        style.textContent = `
            .spin {
                animation: spin 1s linear infinite;
            }
            
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
            
            #alertContainer {
                max-width: 350px;
            }
            
            #alertContainer .alert {
                margin-bottom: 10px;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                border: none;
            }
        `;
        document.head.appendChild(style);

        // Load users when page loads (uncomment to use API)
        // document.addEventListener('DOMContentLoaded', function() {
        //     loadUsersFromAPI();
        // });
    </script>
    <script>
        function resetinput_Form() {
            // เลือก form
            const form = document.getElementById('task_newtopicForm');
            if (!form) {
                console.warn('ไม่พบ form #taskForm');
                return;
            }

            // ล้างค่า input, textarea, select ภายใน form
            form.querySelectorAll('input, textarea, select').forEach(el => {
                switch (el.type) {
                    case 'checkbox':
                    case 'radio':
                        el.checked = false; // ล้าง checkbox / radio
                        break;
                    default:
                        el.value = ''; // ล้าง text, number, textarea, select
                }
            });
        }
    </script>
</body>

</html>