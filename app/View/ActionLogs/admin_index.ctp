<div class="row">
    <div class="col-md-12">
        <?php foreach ($action_logs as $log) {
            ?>
            <div class="alert alert-info" role="alert">
                <?php echo date('d/m/Y h:m:s \:', strtotime($log['ActionLog']['created'])) ?>
                <br>
                <?php echo $log['ActionLog']['message']; ?>
            </div>
        <?php
        }?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class=" pull-right">
            <div class="dataTables_info" id="data-table_info">
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Showing {:start} to {:end} {:count} entries')
                ));
                ?>
            </div>
            <ul class="pagination pull-right">
                <?php
                echo $this->Paginator->prev(__('&laquo;'), array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a', 'escape' => false));
                echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
                echo $this->Paginator->next(__('&raquo;'), array('tag' => 'li', 'currentClass' => 'disabled', 'escape' => false), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a', 'escape' => false));
                ?>
            </ul>
        </div>
    </div>
</div>