<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
@include("../../includes/in_protecao_gerenciador.php");
@include("../../includes/in_conecta.php");

date_default_timezone_set('America/Maceio');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$LOGO_SRC = "/IB2_tqbw0lp7.jpg";


function determinarTurnoAtual(){

    $hora = date('H:i');

    if($hora >= '01:00' && $hora < '07:00'){
        return '01:00 - 07:00';
    }

    if($hora >= '07:00' && $hora < '13:00'){
        return '07:00 - 13:00';
    }

    if($hora >= '13:00' && $hora < '19:00'){
        return '13:00 - 19:00';
    }

    return '19:00 - 01:00';
}

function calcularTempo($inicio, $fim)
{
    $inicioTs = strtotime($inicio);
    $fimTs = strtotime($fim);

    if ($inicioTs === false || $fimTs === false) {
        return '00:00';
    }

    if ($fimTs < $inicioTs) {
        $fimTs = strtotime('+1 day', $fimTs);
    }

    $tempo = $fimTs - $inicioTs;
    $horas = floor($tempo / 3600);
    $minutos = floor(($tempo - ($horas * 3600)) / 60);
    return sprintf("%02d:%02d", $horas, $minutos);
}

function determinarTurno($hora_inicio)
{
    $hora = strtotime($hora_inicio);

    if ($hora >= strtotime('01:00') && $hora < strtotime('07:00')) {
        return '01:00 - 07:00';
    } elseif ($hora >= strtotime('07:00') && $hora < strtotime('13:00')) {
        return '07:00 - 13:00';
    } elseif ($hora >= strtotime('13:00') && $hora < strtotime('19:00')) {
        return '13:00 - 19:00';
    } else {
        if ($hora >= strtotime('19:00') || $hora < strtotime('01:00')) {
            return '19:00 - 01:00';
        }
    }

    return '';
}


$sQuery_embarque = "SELECT MAX(id) AS ult, num_emb FROM tab_embarque";
$oResult_embarque = $conn->query($sQuery_embarque);

if ($oResult_embarque) {
    $row_embarque = $oResult_embarque->fetch_assoc();
    $ult_valor = $row_embarque['ult'];


    $sQuery_minaporto = "SELECT TIME_FORMAT(SEC_TO_TIME(AVG(TIME_TO_SEC(tempo_mina_porto))), '%H:%i') AS media FROM tab_recebimento WHERE id_embarque = $ult_valor";
    $oResult_minaporto = $conn->query($sQuery_minaporto);

    $sQuery_numemb = "SELECT * FROM tab_embarque WHERE id =  $ult_valor";
    $oResult_numemb = $conn->query($sQuery_numemb);

    if ($oResult_numemb) {
        $row_numemb = $oResult_numemb->fetch_assoc();
        $_SESSION['num_emb'] = $row_numemb['num_emb'];
        $_SESSION['navio'] = $row_numemb['navio'];
    }

$login = $_SESSION['ibrittomag']['UsuarioLogin'];
$usuario_logado = $_SESSION['ibrittomag']['UsuarioNome'] ?? $login;
$hoje = date('Y-m-d');

$turno_atual = determinarTurnoAtual();


$sQuery_registros = "
SELECT *
FROM tab_operacao
WHERE matricula='$login'
AND id_embarque='{$_SESSION['num_emb']}'
AND data='$hoje'
AND turno='$turno_atual'
ORDER BY id DESC
";

    $oResult_registros = $conn->query($sQuery_registros);
    $total_registros = ($oResult_registros) ? $oResult_registros->num_rows : 0;
}


// Verifica qual formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_atual = date('Y-m-d');
    $hora_atual = date('H:i');

    if (isset($_POST['form_registro'])) { // Se o formulário de registro foi enviado
        $placa = $_POST['placa'];
        $num_caixa = $_POST['num_caixa'];
        $hora_inicio = $hora_atual; // Hora atual como início
        $hora_fim = $hora_atual; // Hora atual como fim (ajuste conforme necessário)
        $porao = $_POST['porao'];
        $matricula = $_SESSION['ibrittomag']['UsuarioLogin'];
        $turno = determinarTurno($hora_inicio); // Determina o turno com base na hora de início

        // Insere os dados na tabela tab_operacao
        $sql = "INSERT INTO tab_operacao (placa, num_caixa, hora_inicio, hora_fim, data, id_embarque, porao, matricula, turno) 
                VALUES ('$placa', '$num_caixa', '$hora_inicio', '$hora_fim', '$data_atual', '{$_SESSION['num_emb']}', '$porao', '$matricula', '$turno')";

        if ($conn->query($sql) === TRUE) {
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Erro ao inserir o registro: " . $conn->error;
        }
    } elseif (isset($_POST['form_ocorrencia'])) {
        $data_ocorrencia = $_POST['data_ocorrencia'] ?? $data_atual;
        $hora_inicio = $_POST['hora_inicio_ocorrencia'] ?? $hora_atual;
        $hora_fim = trim($_POST['hora_fim_ocorrencia'] ?? '');
        $ocorrencia = $conn->real_escape_string($_POST['ocorrencia']);
        $turno = determinarTurno($hora_inicio);
        $matricula = $_SESSION['ibrittomag']['UsuarioLogin'];
        $observacao = $conn->real_escape_string($_POST['observacao'] ?? '');
        $porao = $conn->real_escape_string($_POST['porao']);
        $tempo = '';

        if ($hora_fim !== '') {
            $tempo = calcularTempo($hora_inicio, $hora_fim);
        }

        $horaFimSql = ($hora_fim !== '') ? "'" . $conn->real_escape_string($hora_fim) . "'" : "NULL";
        $tempoSql = ($tempo !== '') ? "'" . $conn->real_escape_string($tempo) . "'" : "NULL";

        $sql = "INSERT INTO tab_emb_ocorrencia (data, ocorrencia, id_embarque, hora_inicio, hora_fim, tempo, turno, matricula, obs, porao) 
                VALUES ('{$data_ocorrencia}', '{$ocorrencia}', '{$_SESSION['num_emb']}', '{$hora_inicio}', {$horaFimSql}, {$tempoSql}, '{$turno}', '{$matricula}', '{$observacao}', '{$porao}')";

        if ($conn->query($sql) === TRUE) {
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Erro ao inserir o registro: " . $conn->error;
        }
    } elseif (isset($_POST['finalizar_ocorrencia'])) {
        $id_ocorrencia = (int)($_POST['id_ocorrencia'] ?? 0);
        $hora_inicio_base = $_POST['hora_inicio_base'] ?? '';
        $hora_fim = trim($_POST['hora_fim_finalizar'] ?? '');
        $observacao_final = $conn->real_escape_string($_POST['observacao_finalizar'] ?? '');

        if ($id_ocorrencia > 0 && $hora_inicio_base !== '' && $hora_fim !== '') {
            $tempo = calcularTempo($hora_inicio_base, $hora_fim);

            $sql = "UPDATE tab_emb_ocorrencia
                    SET hora_fim = '" . $conn->real_escape_string($hora_fim) . "',
                        tempo = '" . $conn->real_escape_string($tempo) . "',
                        obs = CASE
                            WHEN obs IS NULL OR obs = '' THEN '{$observacao_final}'
                            ELSE CONCAT(obs, ' | {$observacao_final}')
                        END
                    WHERE Id = {$id_ocorrencia}
                      AND matricula = '" . $conn->real_escape_string($_SESSION['ibrittomag']['UsuarioLogin']) . "'
                      AND id_embarque = '" . $conn->real_escape_string($_SESSION['num_emb']) . "'";

            if ($conn->query($sql) === TRUE) {
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "Erro ao finalizar a ocorrência: " . $conn->error;
            }
        }
    }
}

$matricula_usuario = $_SESSION['ibrittomag']['UsuarioLogin'];

$query = "SELECT porao, id_embarque, data, turno
          FROM tab_operacao
          WHERE matricula = '$matricula_usuario'
          ORDER BY Id DESC
          LIMIT 1";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ultimo_porao = $row['porao'];
    $id_embarque = $row['id_embarque'];
    $data = $row['data'];
    $turno = $row['turno'];
} else {
    $ultimo_porao = '';
    $id_embarque = '';
    $data = date('Y-m-d');
    $turno = '07:00 - 13:00';
}

// Consulta SQL para obter as opções de ocorrência da tabela tac_cadocorrencia ordenadas em ordem alfabética
$query_ocorrencias = "SELECT ocorrencia, usa_obs FROM tac_cadocorrencia ORDER BY ocorrencia ASC";
$result_ocorrencias = $conn->query($query_ocorrencias);

if ($result_ocorrencias && $result_ocorrencias->num_rows > 0) {
    $ocorrencias = array();
    while ($row = $result_ocorrencias->fetch_assoc()) {
        $ocorrencias[] = [
            'ocorrencia' => $row['ocorrencia'],
            'usa_obs' => $row['usa_obs']
        ];
    }
} else {
    $ocorrencias = array();
}

$sQuery = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(tempo))) AS total_tempo_parado FROM tab_emb_ocorrencia WHERE id_embarque = '{$_SESSION['num_emb']}'";
$oResult = mysqli_query($conn, $sQuery);
$row = mysqli_fetch_assoc($oResult);
$total_tempo_parado = $row['total_tempo_parado'];

$query_poroes = "
    SELECT 'Porão 1' AS porao FROM tab_embarque WHERE id = {$ult_valor} AND COALESCE(porao_1, 0) > 0
    UNION ALL
    SELECT 'Porão 2' AS porao FROM tab_embarque WHERE id = {$ult_valor} AND COALESCE(porao_2, 0) > 0
    UNION ALL
    SELECT 'Porão 3' AS porao FROM tab_embarque WHERE id = {$ult_valor} AND COALESCE(porao_3, 0) > 0
    UNION ALL
    SELECT 'Porão 4' AS porao FROM tab_embarque WHERE id = {$ult_valor} AND COALESCE(porao_4, 0) > 0
    UNION ALL
    SELECT 'Porão 5' AS porao FROM tab_embarque WHERE id = {$ult_valor} AND COALESCE(porao_5, 0) > 0
    UNION ALL
    SELECT 'Porão 6' AS porao FROM tab_embarque WHERE id = {$ult_valor} AND COALESCE(porao_6, 0) > 0
";

$ocorrencias_abertas = [];
$qOcorrenciasAbertas = "
    SELECT Id, data, ocorrencia, hora_inicio, hora_fim, tempo, porao, obs
    FROM tab_emb_ocorrencia
    WHERE
        id_embarque = '" . $conn->real_escape_string($_SESSION['num_emb']) . "'
        AND matricula = '" . $conn->real_escape_string($matricula_usuario) . "'
        AND (hora_fim IS NULL OR hora_fim = '')
    ORDER BY data DESC, hora_inicio DESC
";
$rOcorrenciasAbertas = $conn->query($qOcorrenciasAbertas);
if ($rOcorrenciasAbertas && $rOcorrenciasAbertas->num_rows > 0) {
    while ($row = $rOcorrenciasAbertas->fetch_assoc()) {
        $ocorrencias_abertas[] = $row;
    }
}

?>

<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="1000">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php include("../../includes/in_laboratorio.php"); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../../assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/css/slicknav.min.css">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/datatables/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/datatables/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/datatables/responsive.jqueryui.min.css">
    <link rel="stylesheet" href="../../assets/css/typography.css">
    <link rel="stylesheet" href="../../assets/css/default-css.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/responsive.css">
    <script src="../../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        :root{
            --panel-bg: rgba(255,255,255,.94);
            --panel-border: #d7e1ee;
            --panel-shadow: 0 12px 30px rgba(15,23,42,.08);
            --text-main: #15233c;
            --text-soft: #5f7088;
            --brand-red: #ff1f14;
            --bg-gray:
                radial-gradient(circle at top left, rgba(245,247,250,.82), rgba(223,230,240,.96) 40%),
                linear-gradient(180deg, #d8e0eb 0%, #cfd9e5 100%);
        }

        body{
            background: var(--bg-gray);
            color: var(--text-main);
            font-family: 'Inter', Arial, Helvetica, sans-serif;
        }

        .page-container{
            background: transparent;
            padding-left: 0 !important;
        }

        .sidebar-menu,
        .main-header-area,
        .page-title-area,
        .header-area,
        .breadcrumb-area,
        .offset-area {
            display: none !important;
        }

        .main-content,
        .main-content-inner {
            margin-left: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        .main-content-inner{
            padding: 12px;
        }

        .form-shell{
            width: 100%;
            max-width: 1520px;
            margin: 0 auto;
        }

        .dashboard-topbar{
            display: grid;
            grid-template-columns: 240px 1fr 170px;
            align-items: center;
            gap: 18px;
            margin: 10px auto 14px;
            padding: 16px 20px;
            background: rgba(255,255,255,.92);
            border: 1px solid var(--panel-border);
            border-radius: 24px;
            box-shadow: var(--panel-shadow);
        }

        .topbar-brand img{
            display: block;
            max-width: 210px;
            width: 100%;
            height: auto;
        }

        .topbar-center{
            text-align: center;
        }

        .topbar-center h1{
            margin: 0;
            color: var(--text-main);
            font-size: clamp(26px, 2.1vw, 34px);
            font-weight: 900;
            line-height: 1.05;
        }

        .topbar-center p{
            margin: 8px 0 0;
            color: #31425c;
            font-size: clamp(16px, 1.2vw, 20px);
            font-weight: 500;
        }

        .topbar-clock{
            text-align: right;
            color: #26364e;
        }

        .topbar-clock .date{
            font-size: 16px;
            font-weight: 500;
        }

        .topbar-clock .time{
            margin-top: 4px;
            font-size: 18px;
            font-weight: 900;
        }

        .summary-strip{
            display: grid;
            grid-template-columns: 1.2fr 1fr 1fr;
            gap: 0;
            margin-bottom: 12px;
            background: rgba(255,255,255,.92);
            border: 1px solid var(--panel-border);
            border-radius: 20px;
            box-shadow: var(--panel-shadow);
            overflow: hidden;
        }

        .summary-item{
            padding: 14px 18px;
            text-align: center;
            border-left: 1px solid var(--panel-border);
        }

        .summary-item:first-child{
            border-left: 0;
        }

        .summary-label{
            color: var(--text-soft);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .2px;
        }

        .summary-value{
            margin-top: 4px;
            color: var(--text-main);
            font-size: 22px;
            font-weight: 900;
            line-height: 1.1;
        }

        .main-content-inner .card{
            border: 1px solid var(--panel-border);
            border-radius: 22px;
            box-shadow: var(--panel-shadow);
            background: var(--panel-bg);
            overflow: hidden;
        }

        .main-content-inner .card-body{
            padding: 22px 24px;
        }

        .main-content-inner .header-title{
            margin-bottom: 18px;
            color: var(--text-main);
            font-size: 24px;
            font-weight: 900;
            letter-spacing: .2px;
            text-transform: uppercase;
        }

        .col-form-label{
            color: var(--text-main);
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .2px;
        }

        .form-control,
        .form-control:focus{
            min-height: 54px;
            border-radius: 16px;
            border: 1px solid var(--panel-border);
            background: #f9fbfe;
            color: var(--text-main);
            box-shadow: none;
        }

        select.form-control{
            padding-right: 36px;
        }

        .btn.btn-success{
            min-height: 52px;
            border: 0;
            border-radius: 16px;
            background: linear-gradient(180deg, #ff3a2d, #e31d13);
            box-shadow: 0 12px 24px rgba(255,31,20,.22);
            font-weight: 900;
            letter-spacing: .2px;
            text-transform: uppercase;
        }

        .btn.btn-success:hover,
        .btn.btn-success:focus{
            background: linear-gradient(180deg, #ff4a3d, #d9170f);
        }

        .table-responsive{
            border: 1px solid var(--panel-border);
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
        }

        .table{
            margin-bottom: 0;
        }

        .table thead th{
            background: #f3f7fc !important;
            color: var(--text-main);
            border-color: var(--panel-border);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .2px;
        }

        .table tbody td{
            border-color: var(--panel-border);
            color: var(--text-main);
            font-size: 14px;
            font-weight: 600;
            vertical-align: middle;
        }

        .helper-text{
            margin-top: 6px;
            color: var(--text-soft);
            font-size: 12px;
            font-weight: 700;
        }

        .section-gap{
            margin-top: 18px;
        }

        .operation-card{
            position: relative;
        }

        .operation-card::before{
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, #ff3a2d, #e31d13);
        }

        .operation-head{
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e6edf6;
        }

        .operation-head .header-title{
            margin-bottom: 0 !important;
        }

        .operation-badge{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 34px;
            padding: 6px 12px;
            border-radius: 999px;
            background: #f4f8fd;
            border: 1px solid var(--panel-border);
            color: var(--text-soft);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .2px;
            white-space: nowrap;
        }

        .action-panel{
            padding: 14px;
            border: 1px solid #e5edf7;
            border-radius: 18px;
            background: linear-gradient(180deg, #fcfdff, #f5f9fe);
        }

        .action-panel + .action-panel{
            margin-top: 14px;
        }

        .footer-area{
            background: transparent;
            color: var(--text-soft);
        }

        .footer-area p{
            font-weight: 700;
        }

        @media (max-width: 768px){
            .main-content-inner{
                padding: 10px;
            }

            .dashboard-topbar{
                grid-template-columns: 1fr;
                text-align: center;
                padding: 14px 16px;
            }

            .topbar-brand{
                justify-self: center;
            }

            .topbar-clock{
                text-align: center;
            }

            .summary-strip{
                grid-template-columns: 1fr;
            }

            .operation-head{
                flex-direction: column;
                align-items: flex-start;
            }

            .summary-item{
                border-left: 0;
                border-top: 1px solid var(--panel-border);
            }

            .summary-item:first-child{
                border-top: 0;
            }

            .main-content-inner .card-body{
                padding: 18px 16px;
            }

            .main-content-inner .header-title{
                font-size: 20px;
            }
        }

        @media (min-width: 900px) and (max-width: 1400px){
            .dashboard-topbar{
                grid-template-columns: 210px 1fr 150px;
                padding: 14px 18px;
            }

            .topbar-center h1{
                font-size: clamp(22px, 2vw, 28px);
            }

            .summary-value{
                font-size: 18px;
            }

            .main-content-inner .header-title{
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <div class="page-container">
        <div class="main-content-inner">
            <div class="form-shell">
                <header class="dashboard-topbar">
                    <div class="topbar-brand">
                        <img src="<?= htmlspecialchars($LOGO_SRC, ENT_QUOTES, 'UTF-8') ?>" alt="Logo">
                    </div>
                    <div class="topbar-center">
                        <h1>Sistema de Embarque - <?= htmlspecialchars($_SESSION['navio'] ?? '', ENT_QUOTES, 'UTF-8') ?></h1>
                        <p>Embarque: <?= htmlspecialchars($_SESSION['num_emb'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                    <div class="topbar-clock">
                        <div class="date"><?= date('d/m/Y') ?></div>
                        <div class="time" id="horaAtual"><?= date('H:i:s') ?></div>
                    </div>
                </header>

                <section class="summary-strip">
                    <div class="summary-item">
                        <div class="summary-label">Usuário Logado</div>
                        <div class="summary-value"><?= htmlspecialchars($usuario_logado, ENT_QUOTES, 'UTF-8') ?></div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Turno Atual</div>
                        <div class="summary-value"><?= htmlspecialchars($turno_atual, ENT_QUOTES, 'UTF-8') ?></div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Registros no Turno</div>
                        <div class="summary-value"><?= (int)$total_registros ?></div>
                    </div>
                </section>

                <div class="row">
                    <div class="col-12">
                        <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card operation-card">
                                <div class="card-body">
                                    <div class="operation-head">
                                        <h4 class="header-title">Registro de Caixa</h4>
                                        <span class="operation-badge">Lançamento rápido do turno</span>
                                    </div>
                                    <form id="form_validation" method="POST">
                                        <div class="action-panel">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="example-text-input" class="col-form-label">Placa</label>
                                                <input class="form-control form-control-lg" type="text" name="placa" required>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <label for="example-search-input" class="col-form-label">Número da Caixa</label>
                                                <input class="form-control form-control-lg validate" type="text" pattern="[0-9]+" name="num_caixa" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <label for="porao" class="col-form-label">Porão:</label>
                                                <select name="porao" class="form-control">
                                                    <?php
                                                    $result_poroes = $conn->query($query_poroes);
                                                    if ($result_poroes && $result_poroes->num_rows > 0) {
                                                        while ($row_porao = $result_poroes->fetch_assoc()) {
                                                            $selected = ($row_porao['porao'] == $ultimo_porao) ? 'selected' : '';
                                                            echo "<option value='" . $row_porao['porao'] . "' $selected>" . $row_porao['porao'] . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=''>Nenhum porão disponível</option>";
                                                    }
                                                    echo "<option value='$ultimo_porao' selected>$ultimo_porao</option>";
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="col col-lg-2">
                                            </div>
                                            <div class="col col-lg-2">
                                                <button type="submit" class="btn btn-success btn-lg btn-block" name="form_registro">Salvar</button>
                                            </div>
                                            <div class="col col-lg-2">
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 section-gap">
                            <div class="card operation-card">
                                <div class="card-body">
                                    <div class="operation-head">
                                        <h4 class="header-title">Registrar Parada / Ocorrência</h4>
                                        <span class="operation-badge">Abertura imediata ou fechamento direto</span>
                                    </div>
                                    <form method="POST">
                                        <div class="action-panel">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="col-form-label">Data da Ocorrência</label>
                                                <input class="form-control form-control-lg" type="date" name="data_ocorrencia" value="<?= date('Y-m-d') ?>" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="col-form-label">Porão</label>
                                                <select name="porao" class="form-control form-control-lg" required>
                                                    <?php
                                                    $result_poroes = $conn->query($query_poroes);
                                                    if ($result_poroes && $result_poroes->num_rows > 0) {
                                                        while ($row_porao = $result_poroes->fetch_assoc()) {
                                                            echo "<option value='" . htmlspecialchars($row_porao['porao'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row_porao['porao'], ENT_QUOTES, 'UTF-8') . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=''>Nenhum porão disponível</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="col-form-label">Hora Inicial</label>
                                                <input class="form-control form-control-lg" type="time" name="hora_inicio_ocorrencia" value="<?= date('H:i') ?>" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="col-form-label">Hora Final</label>
                                                <input class="form-control form-control-lg" type="time" name="hora_fim_ocorrencia">
                                                <div class="helper-text">Opcional. Pode finalizar depois.</div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <label class="col-form-label">Ocorrência</label>
                                                <select name="ocorrencia" id="ocorrenciaSelect" class="form-control form-control-lg" required>
                                                    <option value="">Selecione a ocorrência</option>
                                                    <?php foreach ($ocorrencias as $item): ?>
                                                        <option
                                                            value="<?= htmlspecialchars($item['ocorrencia'], ENT_QUOTES, 'UTF-8') ?>"
                                                            data-usa-obs="<?= htmlspecialchars((string)$item['usa_obs'], ENT_QUOTES, 'UTF-8') ?>"
                                                        >
                                                            <?= htmlspecialchars($item['ocorrencia'], ENT_QUOTES, 'UTF-8') ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <label class="col-form-label">Observação</label>
                                                <textarea class="form-control" name="observacao" id="observacaoField" rows="3" placeholder="Preencha quando a ocorrência exigir observação."></textarea>
                                            </div>
                                        </div>

                                        <div class="row justify-content-md-center">
                                            <div class="col col-lg-3">
                                                <button type="submit" class="btn btn-success btn-lg btn-block" name="form_ocorrencia">Salvar Ocorrência</button>
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 section-gap">
                            <div class="card operation-card">
                                <div class="card-body">
                                    <div class="operation-head">
                                        <h4 class="header-title">Ocorrências em Aberto</h4>
                                        <span class="operation-badge">Finalização posterior pelo operador</span>
                                    </div>
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-center">
                                                <thead class="text-capitalize bg-light">
                                                    <tr>
                                                        <th>Data</th>
                                                        <th>Porão</th>
                                                        <th>Ocorrência</th>
                                                        <th>Hora Inicial</th>
                                                        <th>Hora Final</th>
                                                        <th>Obs</th>
                                                        <th>Ação</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($ocorrencias_abertas)): ?>
                                                        <?php foreach ($ocorrencias_abertas as $oc): ?>
                                                            <tr>
                                                                <td><?= htmlspecialchars($oc['data'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                <td><?= htmlspecialchars($oc['porao'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                <td><?= htmlspecialchars($oc['ocorrencia'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                <td><?= htmlspecialchars($oc['hora_inicio'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                <td>
                                                                    <form method="POST" class="m-0 d-flex flex-column align-items-center">
                                                                        <input type="hidden" name="id_ocorrencia" value="<?= (int)$oc['Id'] ?>">
                                                                        <input type="hidden" name="hora_inicio_base" value="<?= htmlspecialchars($oc['hora_inicio'], ENT_QUOTES, 'UTF-8') ?>">
                                                                        <input type="time" name="hora_fim_finalizar" class="form-control" style="min-height:42px;max-width:130px;" required>
                                                                </td>
                                                                <td>
                                                                        <input type="text" name="observacao_finalizar" class="form-control" style="min-height:42px;max-width:220px;" placeholder="Obs final (opcional)">
                                                                </td>
                                                                <td>
                                                                        <button type="submit" name="finalizar_ocorrencia" class="btn btn-success btn-sm">Finalizar</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr><td colspan="7">Nenhuma ocorrência em aberto para o usuário logado.</td></tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card operation-card">
                                <div class="card-body">
                                    <div class="operation-head">
                                        <h4 class="header-title">Registros do Turno</h4>
                                        <span class="operation-badge">Total: <?= $total_registros ?></span>
                                    </div>
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-center">
                                                <thead class="text-capitalize bg-light">
                                                    <tr>
                                                        <th scope="col">Turno</th>
                                                        <th scope="col">Porão</th>
                                                        <th scope="col">Hora de Entrada</th>
                                                        <th scope="col">Hora de Saída</th>
                                                        <th scope="col">Placa</th>
                                                        <th scope="col">Número da Caixa</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($oResult_registros->num_rows > 0) {
                                                        while ($row_registros = $oResult_registros->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . $row_registros['turno'] . "</td>";
                                                            echo "<td>" . $row_registros['porao'] . "</td>";
                                                            echo "<td>" . $row_registros['hora_inicio'] . "</td>";
                                                            echo "<td>" . $row_registros['hora_fim'] . "</td>";
                                                            echo "<td>" . $row_registros['placa'] . "</td>";
                                                            echo "<td>" . $row_registros['num_caixa'] . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='7'>Nenhum registro encontrado</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Textual inputs start -->
                        
                        <!-- Textual inputs end -->
                        <!-- Ocorrências list start -->
                       
                        <!-- Ocorrências list end -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-area">
            <p>© 2024 Sistema de Controle de Operações Portuárias. Desenvolvido por Rafael Cupertino ds Santos.</p>
        </div>
    </footer>
    <script src="../../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/metisMenu.min.js"></script>
    <script src="../../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../../assets/js/jquery.slicknav.min.js"></script>
    <script src="../../assets/js/plugins.js"></script>
    <script src="../../assets/js/scripts.js"></script>
    <script src="../../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script>
        function atualizarHora() {
            var horaEl = document.getElementById('horaAtual');
            if (!horaEl) return;
            horaEl.textContent = new Date().toLocaleTimeString('pt-BR', { hour12: false });
        }

        function atualizarObrigatoriedadeObs() {
            var ocorrenciaSelect = document.getElementById('ocorrenciaSelect');
            var observacaoField = document.getElementById('observacaoField');
            if (!ocorrenciaSelect || !observacaoField) return;

            var option = ocorrenciaSelect.options[ocorrenciaSelect.selectedIndex];
            var usaObs = option ? String(option.getAttribute('data-usa-obs') || '').toUpperCase() : '';
            var obrigatorio = ['S', 'SIM', 'Y', 'YES', '1'].includes(usaObs);

            observacaoField.required = obrigatorio;
            observacaoField.placeholder = obrigatorio
                ? 'Observação obrigatória para esta ocorrência.'
                : 'Preencha quando a ocorrência exigir observação.';
        }

        function carregarTurno() {
            var horaAtual = new Date().getHours();
            var turnoSelect = document.getElementsByName('turno')[0];
            if (!turnoSelect) return;

            if (horaAtual >= 1 && horaAtual < 7) {
                turnoSelect.value = '01:00 - 07:00';
            } else if (horaAtual >= 7 && horaAtual < 13) {
                turnoSelect.value = '07:00 - 13:00';
            } else if (horaAtual >= 13 && horaAtual < 19) {
                turnoSelect.value = '13:00 - 19:00';
            } else {
                turnoSelect.value = '19:00 - 01:00';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            atualizarHora();
            carregarTurno();
            atualizarObrigatoriedadeObs();
            var ocorrenciaSelect = document.getElementById('ocorrenciaSelect');
            if (ocorrenciaSelect) {
                ocorrenciaSelect.addEventListener('change', atualizarObrigatoriedadeObs);
            }
            setInterval(atualizarHora, 1000);
        });
    </script>
</body>

</html>