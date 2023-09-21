<div class="table-responsive">
    <table class="table table-bordered table-striped" id="profit_by_products_table">
        <thead>
            <tr>
               <th>@lang('sale.product')</th>
                <th>@lang('sale.product_purchase_price')</th>
                <th>@lang('sale.product_sell_price')</th>
                <th>@lang('sale.product_quantity')</th>
                <th>@lang('lang_v1.gross_profit')</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 footer-total">
                <td><strong>@lang('sale.total'):</strong></td>
                <!-- <td><span class="display_currency footer_totalcost" data-currency_symbol ="true"></span></td>
                <td><span class="display_currency footer_totalprice" data-currency_symbol ="true"></span></td>-->
                <td></td>
                <td></td>
                 <td></td>
                <td><span class="display_currency footer_total" data-currency_symbol ="true"></span></td>
            </tr>
        </tfoot>
    </table>

    <p class="text-muted">
        @lang('lang_v1.profit_note')
    </p>
</div>