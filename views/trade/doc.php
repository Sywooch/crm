<?php
/* @var $model app\models\Trade */
?>
<table width="100%">
    <tbody>
        <tr>
            <td valign="top" width="50%">
                <div><strong>ЗАКАЗЧИК</strong>:</div>

                <div><strong><?= $model->contractor->opf->short ?> &laquo;<?= $model->contractor->name ?>&raquo;</strong></div>

                <div><strong>ИНН/КПП</strong> <?= $model->contractor->inn ?>/ <?= $model->contractor->kpp ?></div>

                <div><strong>р/c</strong> <?= $model->contractor->rs ?></div>

                <div><?= $model->contractor->bank ?></div>

                <div><strong>к/с</strong> <?= $model->contractor->ks ?></div>

                <div><strong>БИК</strong> <?= $model->contractor->bik ?></div>

                <div><strong>ОГРН</strong> <?= $model->contractor->ogrn ?></div>
            </td>
            <td valign="top" width="50%">
                <div><strong>ИСПОЛНИТЕЛЬ</strong>:</div>

                <div><strong>ООО &laquo;Инновационные технологии информационных систем&raquo;</strong></div>

                <div><strong>ИНН/КПП</strong> 5904223289/590401001</div>

                <div><strong>р/с</strong> 40702810849090075630</div>

                <div>ЗАПАДНО-УРАЛЬСКИЙ БАНК ПАО СБЕРБАНК</div>

                <div><strong>К/с</strong> 30101810900000000603</div>

                <div><strong>БИК</strong> 045773603</div>

            </td>
        </tr>
        <tr>
            <td valign="top">
                <div>&ldquo;Утверждаю&rdquo;</div>

                <br />

                <div>______________________ /__________________/</div>

                <div>м.п.</div>
            </td>
            <td valign="top">
                <div>&ldquo;Утверждаю&rdquo;</div>

                <div>Директор</div>

                <div>_______________________ / Иванов А.С. /</div>

                <div>м.п.</div>
            </td>
        </tr>
    </tbody>
</table>
<br>
<h1 style="font-size: 18px; text-align: center;">АКТ СДАЧИ-ПРИЕМКИ ВЫПОЛНЕННЫХ РАБОТ</h1>

<div style="text-align:center;">по договору №_________________ от &laquo;___&raquo;___________201__г.</div>

<br />

<div style="text-align:right;">&laquo;____&raquo; ____________ 20__ г.</div>

<br />

<div>Мы, нижеподписавшиеся, представители <strong>ООО &laquo;Инновационные технологии информационных систем&raquo;</strong> и <strong><?= $model->contractor->opf->short ?> &laquo;<?= $model->contractor->name ?>&raquo;</strong>, составили настоящий АКТ СДАЧИ-ПРИЕМКИ ВЫПОЛНЕННЫХ РАБОТ о нижеследующем:</div>

<br />

<div>
    <strong>ООО &laquo;Инновационные технологии информационных систем&raquo;</strong> оказало услуги:                 
</div>
<ol>
    <li><?= $model->name ?></li>
</ol>
<div>            
    Работы выполнены в полном объеме, надлежащим образом.
</div>

<br />

<div>
    <strong><?= $model->contractor->opf->short ?> &laquo;<?= $model->contractor->name ?>&raquo;</strong> принимает услуги:
</div>
<ol>
    <li><?= $model->name ?></li>
</ol>
<div>
    <strong><?= $model->contractor->opf->short ?> &laquo;<?= $model->contractor->name ?>&raquo;</strong> не имеет претензий к <strong>ООО &laquo;Инновационные технологии информационных систем&raquo;</strong>.
</div>

<br />

<div>Стоимость услуг по данному акту сдачи-приемки выполненных работ составила <strong><?= $model->price[0] ?></strong> рублей <?= $model->price[1] ?> коп.</div>

<br />

<div>Следует к оплате по данному акту сдачи-приемки выполненных работ: <strong><?= $model->price[0] ?></strong> рублей <?= $model->price[1] ?> коп.</div>
<br />

<table width="100%">
    <tbody>
        <tr>
            <td valign="top" width="50%">
                <div><?= $model->contractor->opf->short ?> &laquo;<?= $model->contractor->name ?>&raquo;</div>
            </td>
            <td valign="top" width="50%">
                <div>ООО &laquo;Инновационные технологии информационных систем&raquo;</div>
            </td>
        </tr>
        <tr>
            <td valign="top" width="50%">
                <div>Представитель Заказчика</div>
                <br />

                <div>________________ /___________________</div>
            </td>
            <td valign="top" width="50%">
                <div>Представитель Исполнителя</div>
                <br />

                <div>________________ /___________________</div>
            </td>
        </tr>
    </tbody>
</table>
