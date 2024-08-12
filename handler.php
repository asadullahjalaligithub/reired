<?php

ini_set('allow_url_fopen', 1);

$rootpath = $_SERVER['DOCUMENT_ROOT'];
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// echo "this is not an ajax request" . $requestPath;
switch ($requestPath) {
    case '/':
    case '/index.php':
        require 'index.php';
        break;
    case '/checkuser.php':
        require $rootpath . '/checkuser.php';
        break;
    case '/dashboard.php':
        require $rootpath . '/dashboard.php';
        break;
    case '/anotherpage.php':
        require $rootpath . '/anotherpage.php';
        break;
    case '/Database.php':
        require $rootpath . '/Database.php';
        break;
    case '/applictionReport.php':
        require $rootpath . '/applictionReport.php';
        break;
    case '/application-php.php':
        require $rootpath . '/application-php.php';
        break;
    case '/Application-update.php':
        require $rootpath . '/Application-update.php';
        break;
    case '/Application.php':
        require $rootpath . '/Application.php';
        break;
    case '/applicationmanifest.php':
        require $rootpath . '/applicationmanifest.php';
        break;
    case '/barcode.php':
        require $rootpath . '/barcode.php';
        break;
    case '/checkslip.php':
        require $rootpath . '/checkslip.php';
        break;
    case '/checkstatus.php':
        require $rootpath . '/checkstatus.php';
        break;
    case '/deleteBiometric-php.php':
        require $rootpath . '/deleteBiometric-php.php';
        break;
    case '/deliverbarcode.php':
        require $rootpath . '/deliverbarcode.php';
        break;
    case '/downloadDelete.php':
        require $rootpath . '/downloadDelete.php';
        break;
    case '/email.php':
        require $rootpath . '/email.php';
        break;
    case '/final_xml.php':
        require $rootpath . '/final_xml.php';
        break;
    case '/footer-links.php':
        require $rootpath . '/footer-links.php';
        break;
    case '/footer.php':
        require $rootpath . '/footer.php';
        break;
    case '/generalReport.php':
        require $rootpath . '/generalReport.php';
        break;
    case '/header-links.php':
        require $rootpath . '/header-links.php';
        break;
    case '/header.php':
        require $rootpath . '/header.php';
        break;
    case '/invoicebarcode.php':
        require $rootpath . '/invoicebarcode.php';
        break;
    case '/left-menus.php':
        require $rootpath . '/left-menus.php';
        break;
    case '/login-authentication.php':
        require $rootpath . '/login-authentication.php';
        break;
    case '/manage-users-php.php':
        require $rootpath . '/manage-users-php.php';
        break;
    case '/manage-users.php':
        require $rootpath . '/manage-users.php';
        break;
    case '/manifestReport.php':
        require $rootpath . '/manifestReport.php';
        break;
    case '/printDeliverySheet.php':
        require $rootpath . '/printDeliverySheet.php';
        break;
    case '/printinvoice.php':
        require $rootpath . '/printinvoice.php';
        break;
    case '/printPdfReport.php':
        require $rootpath . '/printPdfReport.php';
        break;
    case '/printreciept.php':
        require $rootpath . '/printreciept.php';
        break;
    case '/printSlip.php':
        require $rootpath . '/printSlip.php';
        break;
    case '/printSticker.php':
        require $rootpath . '/printSticker.php';
        break;
    case '/recieptbarcode.php':
        require $rootpath . '/recieptbarcode.php';
        break;
    case '/reports.php':
        require $rootpath . '/reports.php';
        break;
    case '/slip.php':
        require $rootpath . '/slip.php';
        break;
    case '/sms.php':
        require $rootpath . '/sms.php';
        break;
    case '/status-php.php':
        require $rootpath . '/status-php.php';
        break;
    case '/status-php2.php':
        require $rootpath . '/status-php2.php';
        break;
    case '/status.php':
        require $rootpath . '/status.php';
        break;
    case '/systembackup.php':
        require $rootpath . '/systembackup.php';
        break;
    case '/updateApplication-php.php':
        require $rootpath . '/updateApplication-php.php';
        break;
    case '/updateApplication.php':
        require $rootpath . '/updateApplication.php';
        break;
    default:
        http_response_code(404);
        echo @parse_url($_SERVER['REQUEST_URI'])['path'];
        exit('Not Found');
}
// }




