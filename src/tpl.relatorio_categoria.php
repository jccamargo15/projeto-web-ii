<?php 
//include_once 'src/acao_relatorio.php';
include_once 'class/class.Contas.php';
include_once 'class/class.ContasDAO.php';
include_once 'class/class.Relatorio.php';
include_once 'class/class.RelatorioDAO.php';

if (isset($_POST['mesFiltro']) && !empty($_POST['mesFiltro'])) {
	$mes = $_POST['mesFiltro'];
} else {
	$mes = date("m");
}
if (isset($_POST['anoFiltro']) && !empty($_POST['anoFiltro'])) {
	$ano = $_POST['anoFiltro'];
} else {
	$ano = date("Y");
}

if (isset($_POST['tipoFiltro']) && !empty($_POST['tipoFiltro'])) {
	$tipo = $_POST['tipoFiltro'];
} else {
	$tipo = 'debito';
}
if (isset($_POST['carteiraFiltro']) && !empty($_POST['carteiraFiltro'])) {
	$carteira = $_POST['carteiraFiltro'];
} else {
	$carteira = 1;
}

$contasDAO    = new ContasDAO();
$relatorioDAO = new RelatorioDAO();
?>
<h1>Relatório Categoria</h1>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form action="?page=relatorio_categoria" method="post">
        <div class="form-row">
        	<!-- <div class="col-md-3 mb-3">
        		<label for="tipoFiltro">Tipo</label>
    			<select name="tipoFiltro" id="" class="form-control">
    				<option value="debito">Débito</option>
    				<option value="credito">Crédito</option>
    			</select>
        	</div> -->
        	<div class="col-md-3 mb-3">
        		<label for="carteiraFiltro">Carteira</label>
    			<select class="form-control" name="carteiraFiltro" id="id_conta">
              <?php
              $conta = $contasDAO->lista();
              foreach ($conta as $i =>$val) { ?>
                <option value = "<?php echo $conta[$i]->getId() ?>"><?php echo $conta[$i]->getNome() ?></option>
              <?php } ?>
            </select>     		
        	</div>
          <div class="col-md-3 mb-3">
            <label for="dataFiltro">Mês</label>
              <select class="form-control" name="mesFiltro" id="">
                <option value="1" <?php if ($mes=='1') {echo 'selected';} ?>>Janeiro</option>
                <option value="2" <?php if ($mes=='2') {echo 'selected';} ?>>Fevereiro</option>
                <option value="3" <?php if ($mes=='3') {echo 'selected';} ?>>Março</option>
                <option value="4" <?php if ($mes=='4') {echo 'selected';} ?>>Abril</option>
                <option value="5" <?php if ($mes=='5') {echo 'selected';} ?>>Maio</option>
                <option value="6" <?php if ($mes=='6') {echo 'selected';} ?>>Junho</option>
                <option value="7" <?php if ($mes=='7') {echo 'selected';} ?>>Julho</option>
                <option value="8" <?php if ($mes=='8') {echo 'selected';} ?>>Agosto</option>
                <option value="9" <?php if ($mes=='9') {echo 'selected';} ?>>Setembro</option>
                <option value="10" <?php if ($mes=='10') {echo 'selected';} ?>>Outubro</option>
                <option value="11" <?php if ($mes=='11') {echo 'selected';} ?>>Novembro</option>
                <option value="12" <?php if ($mes=='12') {echo 'selected';} ?>>Dezembro</option>
              </select>
          </div>
          <div class="col-md-3 mb-3">
            <label for="anoFiltro">Ano</label>
            <select class="form-control" name="anoFiltro" id="">
              <option value="2017" <?php if ($ano=='2017') {echo 'selected';} ?>>2017</option>
              <option value="2018" <?php if ($ano=='2018') {echo 'selected';} ?>>2018</option>
              <option value="2019" <?php if ($ano=='2019') {echo 'selected';} ?>>2019</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <button class="btn btn-primary" type="submit">Filtrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php 

echo '<br>';
// print_r(extratoCatetoria($tipo, $mes, $ano, $carteira));
$lista = $relatorioDAO->extratoCatetoria('debito', $mes, $ano, $carteira);
// while ($lista = mysql_fetch_assoc($lista)) {
// 	$lista['tipo_mov'];
// 	$lista['data'];
// 	$lista['soma'];
// 	$lista['conta'];
// }
echo '<br>';

?>


<h3>Débito</h3>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>CATEGORIA</th>
        <th>VALOR</th>
        <!-- <th>DESCRIÇÃO</th> -->
        <!-- <th>DATA</th> -->
        <!-- <th>CONTA</th> -->
      </tr>
    </thead>
    <tbody>
    <?php

    // $tipo = 'debito';
    // $lista = $movimentacaoDAO->lista($tipo, $mes, $ano);
      if($lista != 0){
        foreach ($lista as $i =>$val) {
          echo '<tr>';
            echo '<td>'. $lista[$i]->getCategoria() .'</td>';
            echo '<td>'. $lista[$i]->getSoma() .'</td>';
            // echo '<td>'. $lista[$i]['descricao'] .'</td>';
            // echo '<td>'. $lista[$i]['data'] .'</td>';
            // echo '<td>'. $lista[$i]['id'] .'</td>';
            // echo '<td>'. $lista[$i]['tipo_mov'] .'</td>';
            // echo '<td>'. $lista[$i]['conta'] .'</td>';
          echo '</tr>';
        }
      }else{
        echo 'Nenhum registro encontrado!';
      }
    ?>
  </tbody>
  </table>

<?php
$lista = $relatorioDAO->extratoCatetoria('credito', $mes, $ano, $carteira);
?>

<h3>Crédito</h3>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>CATEGORIA</th>
        <th>VALOR</th>
        <!-- <th>DESCRIÇÃO</th> -->
        <!-- <th>DATA</th> -->
        <!-- <th>CONTA</th> -->
      </tr>
    </thead>
    <tbody>
    <?php

    // $tipo = 'debito';
    // $lista = $movimentacaoDAO->lista($tipo, $mes, $ano);
      if($lista != 0){
        foreach ($lista as $i =>$val) {
          echo '<tr>';
            echo '<td>'. $lista[$i]->getCategoria() .'</td>';
            echo '<td>'. $lista[$i]->getSoma() .'</td>';
            // echo '<td>'. $lista[$i]['descricao'] .'</td>';
            // echo '<td>'. $lista[$i]['data'] .'</td>';
            // echo '<td>'. $lista[$i]['id'] .'</td>';
            // echo '<td>'. $lista[$i]['tipo_mov'] .'</td>';
            // echo '<td>'. $lista[$i]['conta'] .'</td>';
          echo '</tr>';
        }
      }else{
        echo 'Nenhum registro encontrado!';
      }
    ?>
  </tbody>
  </table>


  <br>
  <br>
  <br>
  <br>
  <br>

<?php include 'tpl.footer.php'; ?>
</div>