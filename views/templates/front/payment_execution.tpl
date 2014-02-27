{capture name=path}{l s='Pago con Webpay' mod='webpay'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

    <h2>{l s='Resumen del pedido' mod='webpay'}</h2>

{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}
    {if $nbProducts <= 0}
	<p class="warning">{l s='Tu carro de compras está vacío.' mod='webpay'}</p>
    {else}
        <h3>{l s='Pago con Webpay' mod='webpay'}</h3>
        <div id="description">
            <div class="left-position">
                <img alt="logo" src="{$orangeconnect_logo}" width="30%" height="30%" />
            </div>
            <div class="left-position">
                Ha elegido pago con webpay.<br /><br />
                Resumen de su pedido:
            </div>
        </div>
<form method="post" action="{$url_submit}">
    <p>
    <table>
        <tr>
            <td class="bold">Producto</td>
            <td class="bold">Precio Unitario</td>
            <td class="bold">Cantidad</td>
            <td class="bold">Total</td>
        </tr>
    {foreach key=key item=item from=$product}
        <tr>
            <td>{$item.name}</td>
            <td>${str_replace(",",".",number_format($item.price_wt,0))}</td>
            <td>{$item.cart_quantity}</td>
            <td>${str_replace(",",".",number_format($item.price_wt*$item.cart_quantity,0))}</td>
        </tr>
    {/foreach}
    </table><br />
    
    <table>
        <tr>
            <td colspan="2" class="bold">Transporte</td>
        </tr>
        <tr>
            <td>Valor</td>
            <td>${str_replace(",",".",number_format($transport_amount,0))}</td>
        </tr>
    </table><br />
    <div id="total">Total: ${str_replace(",",".",number_format($total,0))}</div><br />
    <b>Por favor, confirme su compra pulsando en "Confirmo mi compra".</b>
    <p class="cart_navigation">
	<a href="{$link->getPageLink('order', true, NULL, "step=3")}" class="button_large">{l s='Otros métodos de pago' mod='webpay'}</a>
        <input type="submit" name="submit" value="{l s='Confirmo mi compra' mod='webpay'}" class="exclusive_large" />
    </p>

              <input name="TBK_TIPO_TRANSACCION" value="TR_NORMAL" type="HIDDEN">
              <input name="TBK_ID_SESION" value="35236475678" type="HIDDEN">
              <input name="TBK_URL_EXITO" size="40" value="http://www.ejemplo.cl/modules/webpay/exito.php" type="HIDDEN">
              <input name="TBK_URL_FRACASO" size="40" value="http://www.ejemplo.cl/modules/webpay/fracaso.php" type="HIDDEN">
              <input name="TBK_ORDEN_COMPRA" size="40" value="20140226131111" type="HIDDEN">
              <input name="TBK_MONTO" size="40" value="{$total}" type="HIDDEN">

</form>
    {/if}
