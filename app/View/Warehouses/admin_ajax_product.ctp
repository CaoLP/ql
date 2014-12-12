<div class="row">
    <div class="col-md-12">
            <?php
            echo $this->Paginator->prev(__('<i class="icon-arrow-left-3"></i> Trang trước'), array('tag' => false,'id'=>'prev','class'=>'pull-left', 'escape' => false), null, array('tag' => false,'id'=>'prev', 'class' => 'disabled pull-left', 'disabledTag' => 'a', 'escape' => false));
            echo $this->Paginator->next(__('Trang tiếp <i class="icon-arrow-right-3"></i>'), array('tag' => false,'id'=>'next', 'class' => 'pull-right', 'escape' => false), null, array('tag' => false,'id'=>'next', 'class' => 'pull-right disabled', 'disabledTag' => 'a', 'escape' => false));
            ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
        foreach($warehouses as $key=>$warehouse){
        ?>
            <div class="col-xs-6 col-md-3">
                <a href="javascript:;" class="thumbnail"
                   data-key="data<?php echo $key;?>"
                   data-limit="<?php echo $warehouse['qty'];?>"
                   data-price="<?php echo $warehouse['price'];?>"
                   data-retail_price="<?php echo $warehouse['retail_price'];?>"
                   data-id="<?php echo $warehouse['id'];?>"
                   data-optionsName="<?php echo $warehouse['optionsName'];?>"
                   data-name="<?php echo $warehouse['name'];?>"
                   data-code="<?php echo $warehouse['code'];?>"
                   data-options="<?php echo $warehouse['options'];?>">
                    <img src="<?php echo $warehouse['thumbnail'];?>">
                    <div class="detail">
                        <span class="label label-success"><?php echo $warehouse['name'];?></span>
                        <span class="label label-warning"><?php echo $warehouse['code'];?></span>
                        <span class="label label-info"><?php echo $warehouse['optionsName'];?></span>
                        <span class="label label-danger"><?php echo number_format($warehouse['price'], 0, '.', ',');?></span>
                        <span class="label label-danger"><?php echo number_format($warehouse['retail_price'], 0, '.', ',');?></span>
                    </div>
                </a>
                <div id="data<?php echo $key;?>" style="display: none"><?php echo $warehouse['data'];?></div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

