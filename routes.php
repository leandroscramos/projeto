<?php

// Path = Array onde cada posição é um elemento da URL.
$path = explode('/', $_SERVER['REQUEST_URI']);

// Action = Posição do array.
$action = $path[sizeOf($path) - 1];
$action = explode('?', $action);
$action = $action[0];

// Controllers.
include_once $_SESSION["root"].'php/Controller/ControllerLogin.php';
include_once $_SESSION["root"].'php/Controller/ControllerDocType.php';
include_once $_SESSION["root"].'php/Controller/ControllerSector.php';
include_once $_SESSION["root"].'php/Controller/ControllerProcType.php';
include_once $_SESSION["root"].'php/Controller/ControllerMacroProc.php';
include_once $_SESSION["root"].'php/Controller/ControllerProcess.php';


// Condicionais que verificam o roteamento das actions.
if ($action == '' || $action == 'index' || $action == 'index.php' || $action == 'login') {
	require_once $_SESSION["root"].'php/View/ViewLogin.php';
}

/* Rotas para LOGIN e LOGOUT */
else if ($action == 'postLogin') {
	$cLogin = new ControllerLogin();
	$cLogin->verificaLogin();
}

else if ($_SESSION["logado"] != true){
	header("Location:index");
}

else if ($action == 'logout') {
	$cLogin = new ControllerLogin();
	$cLogin->logout();
}

else if ($action == 'logado') {	
	include_once $_SESSION["root"].'php/View/ViewLogged.php';	
}
/* Rotas para LOGIN e LOGOUT */


else if ($action == 'docList') {
    include_once $_SESSION["root"].'php/View/viewDocumentList.php';
}

else if ($action == 'document') {
    $cDocType = new ControllerDocType();
    $doctypes = $cDocType->readDocType();
    $cSector = new ControllerSector();
    $sectors = $cSector->readSector();
    include_once $_SESSION["root"].'php/View/viewDocument.php';
}


/* Rota para Tipos de Documento */
else if ($action == 'docType') {
    if (($_SESSION['login']['permissao']) == 'Administrador') {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'create':
                    $cDocType = new ControllerDocType();
                    $cDocType->createDocType();    
                    header("Location:docType");
                    break;        
                case 'update':
                    $cDocType = new ControllerDocType();
                    $cDocType->updateDocType();    
                    header("Location:docType");
                    break;
                case 'delete':
                    $cDocType = new ControllerDocType();
                    $cDocType->deleteDocType();    
                    header("Location:docType");
                    break;
            }
        } else {
            $cDocType = new ControllerDocType();
            $doctypes = $cDocType->readDocType();
            include_once $_SESSION["root"].'php/View/viewDocumentType.php';
        }
    } else {
        header("Location:logado");
    }
    
}

/* Rota para Setores */
else if ($action == 'sector') {
    if (($_SESSION['login']['permissao']) == 'Administrador') {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'create':
                    $cSector = new ControllerSector();
                    $cSector->createSector();    
                    header("Location:sector");
                    break;        
                case 'update':
                    $cSector = new ControllerSector();
                    $cSector->updateSector();    
                    header("Location:sector");
                    break;
                case 'delete':
                    $cSector = new ControllerSector();
                    $cSector->deleteSector();    
                    header("Location:sector");
                    break;
            }
        } else {
            $cSector = new ControllerSector();
            $sectors = $cSector->readSector();
            include_once $_SESSION["root"].'php/View/ViewSector.php';
        }
    } else {
        header("Location:logado");
    }
}

/* Rota para Tipos de Macroprocessos */
else if ($action == 'procType') {
    if (($_SESSION['login']['permissao']) == 'Administrador') {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'create':
                    $cProcType = new ControllerProcType();
                    $cProcType->createProcType();    
                    header("Location:procType");
                    break;        
                case 'update':
                    $cProcType = new ControllerProcType();
                    $cProcType->updateProcType();    
                    header("Location:procType");
                    break;
                case 'delete':
                    $cProcType = new ControllerProcType();
                    $cProcType->deleteProcType();    
                    header("Location:procType");
                    break;
            }
        } else {
            $cProcType = new ControllerProcType();
            $procTypes = $cProcType->readProcType();
            include_once $_SESSION["root"].'php/View/ViewProcType.php';
        }
    } else {
        header("Location:logado");
    }
}

/* Rota para Macroprocessos */
else if ($action == 'macroProc') {
    if (($_SESSION['login']['permissao']) == 'Administrador') {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'create':
                    $cMacroProc = new ControllerMacroProc();
                    $cMacroProc->createMacroProc();    
                    header("Location:macroProc");
                    break;        
                case 'update':
                    $cMacroProc = new ControllerMacroProc();
                    $cMacroProc->updateMacroProc();    
                    header("Location:macroProc");
                    break;
                case 'delete':
                    $cMacroProc = new ControllerMacroProc();
                    $cMacroProc->deleteMacroProc();    
                    header("Location:macroProc");
                    break;
            }
        } else {
            $cMacroProc = new ControllerMacroProc();
            $macroProcs = $cMacroProc->readMacroProc();
            $cProcType = new ControllerProcType();
            $procTypes = $cProcType->readProcType();
            include_once $_SESSION["root"].'php/View/ViewMacroProcess.php';
        }
    } else {
        header("Location:logado");
    }
}

/* Rota para Processos */
else if ($action == 'process') {
    if (($_SESSION['login']['permissao']) == 'Administrador') {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'create':
                    $cProcess = new ControllerProcess();
                    $cProcess->createProcess();    
                    header("Location:process");
                    break;        
                case 'update':
                    $cProcess = new ControllerProcess();
                    $cProcess->updateProcess();    
                    header("Location:process");
                    break;
                case 'delete':
                    $cProcess = new ControllerProcess();
                    $cProcess->deleteProcess();    
                    header("Location:process");
                    break;
            }
        } else {
            $cProcess = new ControllerProcess();
            $processs = $cProcess->readProcess();
            $cMacroProc = new ControllerMacroProc();
            $macroProcs = $cMacroProc->readMacroProc();
            include_once $_SESSION["root"].'php/View/ViewProcess.php';
        }
    } else {
        header("Location:logado");
    }
}

// Rotas para páginas não encontradas.
else {
    echo "Página não encontrada!";    
}

?>