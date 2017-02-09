<h4><?= Yii::t('app', 'DELIVERY_AREAS'); ?></h4>
<div class="box-body">
    <table class="table table-striped">
        <tr>
            <th><?= Yii::t('app', 'ID'); ?></th>
            <th><?= Yii::t('app', 'NAME'); ?></th>
            <th><?= Yii::t('app', 'ARABIC'); ?></th>
        </tr>
        <?php
        foreach ($areaShops as $shop) {
            echo '<tr>
                  <td>'.$shop->id.'</td>
                  <td>'.$shop->name.'</td>
                  <td>'.$shop->ar_name.'</td>
            </tr>';
        }
        ?>
    </table>
</div>