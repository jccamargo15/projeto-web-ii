<!-- editado por Jocemar Filho
    em 11/10/18 -->
<div class="container">
      <div class="row">
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Cadastrar Contas</h4>
          <form class="needs-validation" action="src/acao_contas.php" method="POST" novalidate>
            <input type="hidden" name="acao" value="inserir">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Nome da Conta</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="" value="" required>
              </div>
            </div>

            <button class="btn btn-primary btn-lg" type="submit">Salvar</button>
          </form>
        </div>
      </div>

      <hr class="mb-4">

      <hr class="mb-4">
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>