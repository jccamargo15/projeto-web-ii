<!-- atualizado por Jocemar Filho
    em 14/10/18 -->
<?php
  include_once('class/class.Contas.php');
  include_once('class/class.ContasDAO.php');


  if( isset($_GET['confirm']) and !empty($_GET['confirm']) ){
    if($_GET['confirm'] == 1){
      echo "Conta cadastrada com sucesso!!";
    }
    if($_GET['confirm'] == 2){
      echo "Conta atualizada com sucesso!!";
    }
    if($_GET['confirm'] == 3){
      echo "Conta excluída com sucesso!!";
    }
  }

  $contasDAO = new ContasDAO();

  if( isset($_GET['editar']) and !empty($_GET['editar']) ){
    $id = $_GET['id'];

    $vetor = $contasDAO->listaUm($id);
  ?>

<div class="container">
  <div class="row">
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Cadastrar Contas</h4>
      <form class="needs-validation" action="src/acao_contas.php" method="POST" novalidate>
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?php echo $vetor[0]->getId();?>">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nome da Conta</label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="" value="<?php echo $vetor[0]->getNome();?>" required>
          </div>
        </div>

        <button class="btn btn-primary btn-lg" type="submit">Salvar</button>
      </form>
    </div>
  </div>
</div>

<?php
  }else{
?>
  
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
</div>

<?php
  }
?>

<hr class="mb-4">

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>NOME</th>
        <th>AÇÃO</th>
      </tr>
    </thead>
    <tbody>
    <?php

    $lista = $contasDAO->lista();
      if($lista != 0){
        foreach ($lista as $i =>$val) {
          echo '<tr>';
            echo '<td>'. $lista[$i]->getNome() .'</td>';
            echo '<td> 
              <a href= "index.php?page=cadastro_conta&editar=1&id='. $lista[$i]->getId() .'&acao=editar"><img width="24px" heigth="24px" src="img/edit.png"></a>
              <a href= "src/acao_contas.php?id='. $lista[$i]->getId() .'&acao=excluir"><img width="24px" heigth="244px" src="img/delete.png"></a>
            </td>';

          echo '</tr>';
        }
      }else{
        echo 'Nenhum registro encontrado!';
      }
    ?>
  </tbody>
  </table>

  <hr class="mb-4">
  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; Projeto Web 2</p>
  </footer>
</div>