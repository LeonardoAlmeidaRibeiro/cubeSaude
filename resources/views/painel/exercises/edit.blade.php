<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sb-admin/css/sb-admin-2.css') }}" rel="stylesheet">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts2.sidebar')

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts2.topbar')

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">
                        <div class="container">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h1>Editar Exercício</h1>
                                <a href="{{ route('exercises.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left"></i> Voltar
                                </a>
                            </div>
                        
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <form action="{{ route('exercises.update', $exercise->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                        
                                        <div class="mb-3">
                                            <label for="activity" class="form-label">Atividade Física</label>
                                            <input type="text" class="form-control @error('activity') is-invalid @enderror" 
                                                   id="activity" name="activity" 
                                                   value="{{ old('activity', $exercise->activity) }}" required>
                                            @error('activity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                        
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="duration" class="form-label">Duração (minutos)</label>
                                                    <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                                           id="duration" name="duration" 
                                                           value="{{ old('duration', $exercise->duration) }}" min="1" required>
                                                    @error('duration')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                        
                                                <div class="col-md-6 mb-3">
                                                    <label for="done_at" class="form-label">Data e Hora do Exercício</label>
                                                    <input type="datetime-local" class="form-control @error('done_at') is-invalid @enderror" 
                                                           id="done_at" name="done_at" 
                                                           value="{{ old('done_at', $exercise->done_at->format('Y-m-d\TH:i')) }}" required>
                                                    @error('done_at')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                        
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Atualizar Exercício
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- teste --}}
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{ asset('sb-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages -->
    <script src="{{ asset('sb-admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('sb-admin/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('sb-admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('sb-admin/js/demo/chart-pie-demo.js') }}"></script>
    <script>
        function checkNotifications() {
            fetch('/notifications-check')
                .then(response => response.json())
                .then(data => {
                    if (data.count > 0) {
                        // Atualizar o contador
                        document.getElementById('notification-count').innerText = data.count;
                        // Opcional: mostrar toast
                        new bootstrap.Toast(document.getElementById('new-notification-toast')).show();
                    }
                });
        }

        // Verificar a cada 60 segundos
        setInterval(checkNotifications, 60000);

    </script>


</html>
