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
                        <div class="container py-4">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-primary text-white">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">Editar Medição de Glicose</h5>
                                                <a href="{{ route('glucose.index') }}" class="btn btn-sm btn-light">
                                                    <i class="fas fa-arrow-left"></i> Voltar
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('glucose.update', $glucose->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <!-- Campo Valor da Glicose -->
                                                <div class="mb-3">
                                                    <label for="value" class="form-label">Valor da Glicose (mg/dL)*</label>
                                                    <input type="number" step="0.1" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', $glucose->value) }}" required>
                                                    @error('value')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Campo Tipo da Medição -->
                                                <div class="mb-3">
                                                    <label for="measurement_type" class="form-label">Tipo da Medição*</label>
                                                    <select class="form-control @error('measurement_type') is-invalid @enderror" id="measurement_type" name="measurement_type" required>
                                                        <option value="">Selecione...</option>
                                                        <option value="jejum" {{ old('measurement_type', $glucose->measurement_type) == 'jejum' ? 'selected' : '' }}>Jejum</option>
                                                        <option value="pre-refeicao" {{ old('measurement_type', $glucose->measurement_type) == 'pre-refeicao' ? 'selected' : '' }}>Pré-refeicao</option>
                                                        <option value="pos-refeicao" {{ old('measurement_type', $glucose->measurement_type) == 'pos-refeicao' ? 'selected' : '' }}>Pós-refeicao</option>
                                                    </select>
                                                    @error('measurement_type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Campo Data e Hora da Medição -->
                                                <div class="mb-3">
                                                    <label for="measured_at" class="form-label">Data e Hora da Medição*</label>
                                                    <input type="datetime-local" class="form-control @error('measured_at') is-invalid @enderror" id="measured_at" name="measured_at" value="{{ old('measured_at', \Carbon\Carbon::parse($glucose->measured_at)->format('Y-m-d\TH:i')) }}" required>
                                                    @error('measured_at')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                    <a href="{{ route('glucose.index') }}" class="btn btn-outline-secondary me-md-2">
                                                        <i class="fas fa-times"></i> Cancelar
                                                    </a>&nbsp;
                                                    <button type="submit" class="btn btn-primary text-white">
                                                        <i class="fas fa-save"></i> Atualizar Medição
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
