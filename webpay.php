<?php
if (!defined('_PS_VERSION_'))
    exit;

class webpay extends PaymentModule {

    const URL_LOGO_JPG = "modules/webpay/webpay-plus.gif";

    function __construct() {
        $this->name = "webpay";
        $this->tab = "payments_gateways";
        $this->version = "1.0";
        $this->author = "Oscar Villagran";

        parent::__construct();

        $this->displayName = $this->l("Webpay");
        $this->description = $this->l("Pagos vía WebPay en Chile");
        $this->confirmUnistall = $this->l('¿Está seguro de que desea eliminar este módulo?');

        $this->page = basename(__FILE__, '.php');
    }

    public function install() {
        if (parent::install() == false || !$this->registerHook('leftColumn') || !$this->registerHook('payment')
            || !$this->registerHook('paymentReturn') )
            return false;
        return true;
    }

    public function hookLeftColumn($params){
        global $smarty;
        return $this->display(__FILE__,'webpay.tpl');
    }

    public function hookRightColumn( $params ){
        return $this->hookLeftColumn( $params );
    }

    public function uninstall() {
        return parent::uninstall();
    }

    public function getContent() {
    }

    public function hookPayment($params){
        global $smarty;
        return $this->display(__FILE__,'payment.tpl');
    }

    public function hookPaymentReturn($params){}
}

?>
