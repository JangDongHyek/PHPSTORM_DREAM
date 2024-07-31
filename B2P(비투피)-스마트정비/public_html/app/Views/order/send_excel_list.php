
<link href="/css/common.css?v=<?= filemtime(FCPATH . 'css/common.css'); ?>" rel="stylesheet" type="text/css">
<link href="/css/adm.css?v=<?= filemtime(FCPATH . 'css/adm.css'); ?>" rel="stylesheet" type="text/css">

<div id="adm_content">
    <div class="con_wrap" style="all: unset">
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>주문</th>
                    <th>택배사</th>
                    <th>운송장/등기번호</th>
                    <th>사유</th>
                </tr>
                </thead>
                <?php foreach ($this->data as $row) : ?>
                <tbody>
                <tr>
                    <td><?=$row['aValue']?></td>
                    <td><?=$row['bValue']?></td>
                    <td><?=$row['cValue']?></td>
                    <td>
                        <div style="max-width: 450px!important;white-space: break-spaces;"><?=$row['Message']?></div>
                    </td>
                </tr>
                </tbody>
                <?endforeach;?>
            </table>
        </div>
    </div>
</div>
