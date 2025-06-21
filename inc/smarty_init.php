<?php
require_once '../libs/Smarty.class.php';

$smarty = new Smarty();

// Cấu hình thư mục cho Smarty
$smarty->setTemplateDir('../templates/');
$smarty->setCompileDir('../templates_c/');
$smarty->setCacheDir('../cache/');
$smarty->setConfigDir('../configs/');

// Bật debug (Tùy chọn)
$smarty->debugging = false;
