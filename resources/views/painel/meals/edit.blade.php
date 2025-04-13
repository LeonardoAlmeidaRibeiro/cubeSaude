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
                                                <h5 class="mb-0">Editar Refeição</h5>
                                                <a href="{{ route('meals.index') }}" class="btn btn-sm btn-light">
                                                    <i class="fas fa-arrow-left"></i> Voltar
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('meals.update', $meal->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <!-- Nome da Refeição -->
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nome da Refeição*</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $meal->name) }}" required>
                                                    @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Tipo da Refeição -->
                                                <div class="mb-3">
                                                    <label for="meal_type" class="form-label">Tipo da Refeição*</label>
                                                    <select class="form-control @error('meal_type') is-invalid @enderror" id="meal_type" name="meal_type" required>
                                                        <option value="">Selecione...</option>
                                                        <option value="cafe" {{ old('meal_type', $meal->meal_type) == 'cafe' ? 'selected' : '' }}>Café da manhã</option>
                                                        <option value="almoco" {{ old('meal_type', $meal->meal_type) == 'almoco' ? 'selected' : '' }}>Almoço</option>
                                                        <option value="jantar" {{ old('meal_type', $meal->meal_type) == 'jantar' ? 'selected' : '' }}>Jantar</option>
                                                        <option value="lanche" {{ old('meal_type', $meal->meal_type) == 'lanche' ? 'selected' : '' }}>Lanche</option>
                                                    </select>
                                                    @error('meal_type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Carboidratos -->
                                                <div class="mb-3">
                                                    <label for="carbs" class="form-label">Carboidratos (g)*</label>
                                                    <input type="number" step="0.1" class="form-control @error('carbs') is-invalid @enderror" id="carbs" name="carbs" value="{{ old('carbs', $meal->carbs) }}" required>
                                                    @error('carbs')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Data e Hora do Consumo -->
                                                <div class="mb-3">
                                                    <label for="consumed_at" class="form-label">Data e Hora da Refeição*</label>
                                                    <input type="datetime-local" class="form-control @error('consumed_at') is-invalid @enderror" id="consumed_at" name="consumed_at" value="{{ old('consumed_at', \Carbon\Carbon::parse($meal->consumed_at)->format('Y-m-d\TH:i')) }}">
                                                    @error('consumed_at')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                    <a href="{{ route('meals.index') }}" class="btn btn-outline-secondary me-md-2">
                                                        <i class="fas fa-times"></i> Cancelar
                                                    </a>&nbsp;
                                                    <button type="submit" class="btn btn-primary text-white">
                                                        <i class="fas fa-save"></i> Atualizar Refeição
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
