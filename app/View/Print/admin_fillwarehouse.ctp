<div style="width: 8.267in; margin: 0 auto">
    <table width="100%">
        <tr>
            <td colspan="9"></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: left; width: 60%" class="shop-name">
                <p><strong>Thời trang ĐN</strong>
                    <br>
                    429 Lê Duẩn – TP.Đà Nẵng
                    <br>
                    Điện thoại: 05113.99.08.23
                </p>
            </td>
            <td colspan="4" class="text-center">
                <p><strong>Mẫu số: 01 - VT</strong><br>
                    (Ban hành theo QĐ số: 48/2006/QĐ- BTC<br>
                    Ngày 14/9/2006 của Bộ trưởng BTC)</p>
            </td>
        </tr>
        <tr>
            <td colspan="9" class="text-center">
                <span class="title">PHIẾU NHẬP KHO</span>
            </td>
        </tr>
        <tr>
            <td colspan="9" class="text-center"><?php echo date('\N\g\à\y d \t\h\á\n\g m \n\ă\m Y',strtotime($data['InoutWarehouse']['created'])); ?></td>
        </tr>
        <tr>
            <td colspan="9" class="text-center">Số <?php echo $data['InoutWarehouse']['code']; ?></td>
        </tr>
        <tr>
            <td colspan="9"></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Người lập phiếu: </strong></td><td colspan="7"><?php echo $data['Creater']['name']; ?></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Theo: </strong></td><td colspan="7"><?php echo $data['InoutWarehouse']['code']; ?></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Nhập tại kho: </strong></td><td colspan="7"><?php echo $data['Store']['name']; ?></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Địa chỉ: </strong></td><td colspan="7"><?php echo $data['Store']['address']; ?></td>
        </tr>
        <tr>
            <td colspan="9"></td>
        </tr>
        <tr>
            <td colspan="9">
                <table width="100%" class="sub-table">
                    <tr>
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Tên hàng</th>
                        <th rowspan="2">Mã hàng</th>
                        <th rowspan="2">Kho</th>
                        <th rowspan="2">Đvt</th>
                        <th colspan="2">Số lượng</th>
                        <th rowspan="2">Đơn giá</th>
                        <th rowspan="2">Thành tiền</th>
                    </tr>
                    <tr>
                        <th>Theo C.từ</th>
                        <th>Thực nhập</th>
                    </tr>
                    <?php
                    $total = 0;
                    foreach($data['InoutWarehouseDetail'] as $key=>$detail){
                        $total += $detail['qty'];
                       ?>
                        <tr>
                            <td class="text-center"><?php echo $key+1; ?></td>
                            <td width="250"><?php echo $detail['name']; ?> (<?php echo $detail['option_names']; ?>)</td>
                            <td><?php echo $detail['sku']; ?></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><?php echo $detail['qty']; ?></td>
                            <td class="text-right"></td>
                            <td class="text-right"><?php echo number_format($detail['price'], 0, '.', ','); ?></td>
                            <td class="text-right"><?php echo number_format($detail['total'], 0, '.', ','); ?></td>
                        </tr>
                    <?php
                    }
                    ?>

                    <tr>
                        <td></td>
                        <td><strong>Cộng:</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right"><strong><?php echo $total; ?></strong></td>
                        <td class="text-right"><strong></strong></td>
                        <td class="text-right"><strong></strong></td>
                        <td class="text-right"><strong><?php echo number_format($data['InoutWarehouse']['total'], 0, '.', ','); ?></strong></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="9"></td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td colspan="3" class="text-center"><?php echo date('\N\g\à\y d \t\h\á\n\g m \n\ă\m Y'); ?></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center">
                <strong>Người lập phiếu</strong>
                <br>
                <span class="text-italic">(Ký, họ tên)</span>
            </td>
            <td colspan="2" class="text-center">
                <strong>Người giao hàng</strong>
                <br>
                <span class="text-italic">(Ký, họ tên)</span>
            </td>
            <td colspan="2" class="text-center">
                <strong>Thủ kho</strong>
                <br>
                <span class="text-italic">(Ký, họ tên)</span>
            </td>
            <td colspan="3" class="text-center">
                <strong>Kế toán trưởng<br>
                    (Hoặc bộ phận có
                    nhu cầu nhận)</strong>
                <br>
                <span class="text-italic">(Ký, họ tên)</span>
            </td>
        </tr>
        <tr>
            <td colspan="9">

            </td>
        </tr>
    </table>
</div>
