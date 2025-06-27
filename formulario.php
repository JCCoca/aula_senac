<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <div class="container py-4">
        <h1 class="mb-4">Formulário</h1>
        <form action="salvar_formulario.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="sexo" id="sexo-m" class="form-check-input" value="Masculino" required>
                                <label for="sexo-m" class="form-check-label">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="sexo" id="sexo-f" class="form-check-input" value="Feminino" required>
                                <label for="sexo-f" class="form-check-label">Feminino</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="data-nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" id="data-nascimento" class="form-control" required="required">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Enviar
            </button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>