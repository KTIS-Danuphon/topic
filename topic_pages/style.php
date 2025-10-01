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
            top: calc(var(--navbar-height) + 7px);
            left: 7px;
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