<div class="row" id="print-form">
    <table>
        <tr>
            <td colspan="5" class="text-center text-uppercase bill-shop-name">
                <?php echo $this->Session->read('Auth.User.Store.name')?>
            </td>
        </tr>
        <tr>
            <td colspan="5" class="text-center bill-shop-address">
                <?php echo $this->Session->read('Auth.User.Store.address')?>
            </td colspan="5" class="text-center">
        </tr>
        <tr>
            <td colspan="5" class="text-center bill-shop-phone">
                <?php echo $this->Session->read('Auth.User.Store.phone')?>
            </td>
        </tr>
        <tr><td colspan="5" class="text-center bill-title">PHIẾU BÁN LẺ</td></tr>
        <tr><td colspan="5"><hr></td></tr>
        <tr class="dot-bottom">
            <td colspan="3" class="text-left"><?php echo 'Mã HĐ: '. $this->request->data['Order']['code']?></td>
            <td colspan="2" class="text-right"><?php echo 'Ngày: '. date('d-m-Y',strtotime($this->request->data['Order']['created']))?></td>
        </tr>
        <tr class="dot-bottom">
            <td colspan="5">Nhân viên: <?php echo $this->request->data['Creater']['name']?></td>
        </tr>
        <tr>
            <td colspan="5">
                <table class="bill-table">
                    <thead>
                    <tr>
                        <th>TT</th>
                        <th class="text-left">Tên hàng</th>
                        <th class="text-center">SL</th>
                        <th class="text-right">Đơn giá</th>
                        <th class="text-right">Thành tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($this->request->data['OrderDetail'] as $key=>$order_detail){
                        ?>
                        <tr>
                            <td><?php echo $key+1;?></td>
                            <td class="text-left">
                                <span><?php
                                    echo $order_detail['name']. ' ' . $order_detail['code']
                                    ?></php></span><br><span class="opt">
                                    <?php
                                    $opts = explode(',',$order_detail['product_options']);
                                    $temp = array();
                                    foreach($opts as $opt){
                                        if(isset($options[$opt]))
                                        $temp[] = $options[$opt];
                                    }
                                    $op = implode(',',$temp);
                                    echo $op;
                                    ?></span>
                            </td>
                            <td  class="text-center"><?php echo $order_detail['qty']?></td>
                            <td  class="text-right"><?php echo number_format($order_detail['price'], 0, '.', ','); ?></td>
                            <td  class="text-right"><?php echo number_format(($order_detail['qty'] * $order_detail['price']),0, '.', ',')?></td>
                        </tr>
                    <?php
                    }?>
                    <tr>
                        <td colspan="2" class="bill-bold">Tổng cộng</td>
                        <td colspan="1"></td>
                        <td colspan="2" class="text-right"><?php echo number_format($this->request->data['Order']['total'], 0, '.', ',');?></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr class="dot-bottom">
            <td colspan="4" class="bill-bold">Giảm giá</td>
            <?php

            ?>
            <td class="text-right"><?php echo number_format($this->request->data['Order']['total_promote'], 0, '.', ',');?></td>
        </tr>
        <tr class="dot-bottom">
            <td colspan="4" class="bill-bold">Số tiền phải thanh toán</td>
            <td class="text-right"><?php echo number_format($this->request->data['Order']['amount'], 0, '.', ',');?></td>
        </tr>
        <tr class="dot-bottom">
            <td colspan="4" class="bill-bold">Khách trả</td>
            <td class="text-right"><?php echo number_format($this->request->data['Order']['receive'], 0, '.', ',');?></td>
        </tr>
        <tr class="dot-bottom">
            <td colspan="4" class="bill-bold">Tiền thừa</td>
            <td class="text-right"><?php echo number_format($this->request->data['Order']['refund'], 0, '.', ',');?></td>
        </tr>
        <tr>
            <td colspan="5" class="text-center bill-italic">
                Trân trọng cảm ơn quý khách hàng
            </td>
        </tr>
    </table>
</div>