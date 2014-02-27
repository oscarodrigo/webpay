<?php

class webpayPaymentModuleFrontController extends ModuleFrontController{
    public $ssl = true;

    const URL_LOGO_JPG = "modules/webpay/webpay-plus.gif";
    public function initContent() {

        $product_session = array();
        $products = $this->context->cart->getProducts();
        $this->display_column_left = false;

        for ($i = 0; $i < count($products); $i++) {
            $product_session[$i]["id_product_attribute"]    = $products[$i]["id_product_attribute"];
            $product_session[$i]["id_product"]              = $products[$i]["id_product"];
            $product_session[$i]["cart_quantity"]           = $products[$i]["cart_quantity"];
            $product_session[$i]["name"]                    = $products[$i]["name"];
            $product_session[$i]["price_wt"]                = $products[$i]["price_wt"];
        }

        $position = 0;
        $total_gross_amount = 0;
        foreach ($products as $product) {
            for ($i = 0; $i < (int) $product_session[$position]["cart_quantity"]; $i++) {
                $total_gross_amount+=$product["price_wt"];
            }
            $position++;
        }

        $transport_amount = $this->context->cart->getOrderTotal(true, Cart::BOTH) - $total_gross_amount;

        parent::initContent();

        $this->context->smarty->assign('nbProducts', $this->context->cart->nbProducts());
        $this->context->smarty->assign("product", $product_session);
        $this->context->smarty->assign("total", $this->context->cart->getOrderTotal(true, Cart::BOTH));
        $this->context->smarty->assign("url_submit", Tools::getShopDomainSsl(true, true) . __PS_BASE_URI__ . "cgi-bin/tbk_bp_pago.cgi");
        $this->context->smarty->assign("transport_amount", $transport_amount);
        $this->context->smarty->assign("webpay-plus.gif", Tools::getShopDomainSsl(true, true) . __PS_BASE_URI__ . self::URL_LOGO_JPG);

        $this->setTemplate("payment_execution.tpl");
    }
}

?>