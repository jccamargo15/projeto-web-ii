<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
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

$contasDAO = new ContasDAO();
$relatorioDAO = new RelatorioDAO();
?>
<h1>Extrato</h1>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form action="?page=relatorio_extrato" method="post">
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
                <option value="01" <?php if ($mes=='01') {echo 'selected';} ?>>Janeiro</option>
                <option value="02" <?php if ($mes=='02') {echo 'selected';} ?>>Fevereiro</option>
                <option value="03" <?php if ($mes=='03') {echo 'selected';} ?>>Março</option>
                <option value="04" <?php if ($mes=='04') {echo 'selected';} ?>>Abril</option>
                <option value="05" <?php if ($mes=='05') {echo 'selected';} ?>>Maio</option>
                <option value="06" <?php if ($mes=='06') {echo 'selected';} ?>>Junho</option>
                <option value="07" <?php if ($mes=='07') {echo 'selected';} ?>>Julho</option>
                <option value="08" <?php if ($mes=='08') {echo 'selected';} ?>>Agosto</option>
                <option value="09" <?php if ($mes=='09') {echo 'selected';} ?>>Setembro</option>
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

$debitoAnterior = $relatorioDAO->extratoAnterior('debito', $mes, $ano, $carteira); 
$saldoDebitoAnterior = $debitoAnterior[0]->getSoma();
$creditoAnterior = $relatorioDAO->extratoAnterior('credito', $mes, $ano, $carteira); 
$saldoCreditoAnterior = $creditoAnterior[0]->getSoma();
$saldoAnterior = $saldoCreditoAnterior - $saldoDebitoAnterior;

echo '<br>';

$debitoAtual = $relatorioDAO->extratoAtual('debito', $mes, $ano, $carteira); 
$saldoDebitoAtual  = $debitoAtual[0]->getSoma();
$creditoAtual = $relatorioDAO->extratoAtual('credito', $mes, $ano, $carteira); 
$saldoCreditoAtual = $creditoAtual[0]->getSoma();
$saltoAtual = $saldoCreditoAtual - $saldoDebitoAtual;

echo '<h5>Saldo anterior: R$ ' . $saldoAnterior .'</h5>';
echo '<br>';


?>

<table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>CATEGORIA</th>
        <th>DESCRIÇÃO</th>
        <th>TIPO</th>
        <th>DATA</th>
        <th>VALOR</th>
        <!-- <th>CONTA</th> -->
      </tr>
    </thead>
    <tbody>
    <?php

    // $tipo = 'debito';
    $lista = $relatorioDAO->extrato($mes, $ano, $carteira);
      if($lista != 0){
        foreach ($lista as $i =>$val) {
          echo '<tr>';
            echo '<td>'. $lista[$i]->getCategoria() .'</td>';
            echo '<td>'. $lista[$i]->getDescricao() .'</td>';
            echo '<td>'. $lista[$i]->getTipo() .'</td>';
            echo '<td>'. $lista[$i]->getData() .'</td>';
            echo '<td>'. $lista[$i]->getValor() .'</td>';

          echo '</tr>';
        }
      }else{
        echo 'Nenhum registro encontrado!';
      }
    ?>
  </tbody>
  </table>


  
<?php 
echo '<h5>Saldo atual: R$ ' . ($saldoAnterior + $saltoAtual) . '</h5>';
include 'tpl.footer.php'; ?>
</div>