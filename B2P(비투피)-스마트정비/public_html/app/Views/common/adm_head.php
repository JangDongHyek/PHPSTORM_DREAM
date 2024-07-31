
<div id="adm_content"
    <?php if(in_array($pid, ['order_search', 'waiting_list', 'new_list', 'send_list','deliver_list', 'confirm_list', 'state_list', 'cancel_list','return_list', 'exchange_list'])) { echo "class='order'"; } ?>
    <?php if(in_array($pid, ['calculate_view','auction_list', 'gmarket_list'])) { echo "class='calcu'"; } ?>
>
    <?php echo view('common/admin_menu'); ?>
    <div class="con_wrap <?php echo $pid;?>">