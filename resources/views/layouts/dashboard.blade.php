<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-rG1BqxxVZYRJZB2E2CYn4R6D8BcNoJwry5pMswYah4RlYqMyRHDsVVqg4v2tJ9g1" crossorigin="anonymous">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SYIKNpCkQPiFOnI6TqFVMIGwoGgj8kU2FJFqJ" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        #app {
            display: flex;
            min-height: 100vh;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
            overflow-y: auto;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #212529;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li {
            padding: 10px;
            font-size: 1.1em;
            display: block;
            transition: background 0.3s;
        }

        #sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
        }

        #sidebar ul li:hover {
            background: #495057;
        }

        #content {
            flex: 1;
            padding: 20px;
        }

        .user-panel {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #495057;
        }

        .user-panel .image {
            flex: 0 0 auto;
            margin-right: 10px;
        }

        .user-panel .image img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .user-panel .info {
            flex: 1 1 auto;
        }

        @media (max-width: 768px) {
            #sidebar {
                min-width: 80px;
                max-width: 80px;
            }

            #sidebar ul li {
                text-align: center;
            }

            #sidebar ul li a span {
                display: none;
            }

            #sidebar ul li:hover {
                background: #343a40;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #content {
                padding-left: 20px;
            }

            #sidebarCollapse {
                display: none;
            }

            #sidebarCollapse i {
                font-size: 1.5em;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark bg-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>



        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src={{ asset('images/' . auth()->user()->image) }} class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">



                        <!-- Categories -->
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tags.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>Tags</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('posts.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>Posts</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>Users</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Logout</p>
                            </a>
                        </li>

                        <!-- Add more sidebar links as needed -->

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-cBT+KRI8qOG2rNlLmdkEFsgJ6b8ch3ahEqnStJ5+C6Y+wLidTAAV6W11GO6v5f0D" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SYIKNpCkQPiFOnI6TqFVMIGwoGgj8kU2FJFqJ" crossorigin="anonymous"></script>

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>

    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SYIKNpCkQPiFOnI6TqFVMIGwoGgj8kU2FJFqJ" crossorigin="anonymous"></script>

    <!-- Custom JS for toggling sidebar -->
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>

</html>
