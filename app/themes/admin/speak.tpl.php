<?php
require 'header.php';
if ($this->func == 'index') {
    ?>
    <div class="main_title">
        <span>会话管理</span>列表<?= $this->anchor('speak/add', '新增', 'class="but1"'); ?>
    </div>
    <table class="table">
        <tr class="bt">
            <th>ID</th>
            <th>名称</th>
            <th>自己头像</th>
            <th>对方头像</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        <?
        foreach ($result as $row) {
            ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><? if ($row['face1'] != '') { ?>
                        <a href="<?= $row['face1']; ?>" target="_blank"><img src="<?= $row['face1'] ?>"
                                                                             align="absmiddle" width="100"/></a>
                    <? } ?></td>
                <td><? if ($row['face2'] != '') { ?>
                        <a href="<?= $row['face2']; ?>" target="_blank"><img src="<?= $row['face2'] ?>"
                                                                             align="absmiddle" width="100"/></a>
                    <? } ?></td>
                <td><?= $row['addtime'] ?></td>
                <td>
                    <a href="/index.php/speak/?speak_id=<?=$row['id']?>" target="_blank">查看效果</a>&nbsp;|&nbsp;
                    <?
                    echo $this->anchor('speak/log/?speak_id=' . $row['id'], '聊天记录');
                    echo '&nbsp;|&nbsp;';
                    echo $this->anchor('speak/edit/?id=' . $row['id'], '编辑');
                    echo '&nbsp;|&nbsp;';
                    $arr = array(
                        'onclick' => "return confirm('确定要删除吗？')"
                    );
                    echo $this->anchor('speak/delete/?id=' . $row['id'], '删除', $arr);
                    ?>
                </td>
            </tr>
        <? } ?>
    </table>
    <?
} elseif ($this->func == 'add' || $this->func == 'edit') {
    ?>
    <div class="main_title">
        <span>会话管理</span><? if ($this->func == 'add') { ?>新增<? } else { ?>编辑<? } ?>
        <?= $this->anchor('speak', '列表', 'class="but1"'); ?>
    </div>
    <script src="/plugin/js/ajaxfileupload.js"></script>
    <form method="post">
        <input type="hidden" name="id" value="<?= $row['id'] ?>"/>
        <div class="form1">
            <table cellpadding="6">
                <tr><td>名称：</td><td><input type="text" name="name" value="<?=$row['name']?>"/></td></tr>
                <tr>
                    <td>自己头像：</td>
                    <td>
                        <input type="hidden" name="face1" id="face1" value="<?= $row['face1'] ?>"/>
                <span id="upload_span_face1">
                    <? if ($row['face1'] != '') { ?>
                        <a href="<?= $row['face1']; ?>" target="_blank"><img src="<?= $row['face1'] ?>"
                                                                             align="absmiddle" width="100"/></a>
                    <? } ?>
                </span>
                        <div class="upload-upimg">
                            <span class="_upload_f">上传图片</span>
                            <input type="file" id="upload_face1" name="files"
                                   onchange="upload_image('face1','article')"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>对方头像：</td>
                    <td>
                        <input type="hidden" name="face2" id="face2" value="<?= $row['face2'] ?>"/>
                <span id="upload_span_face2">
                    <? if ($row['face2'] != '') { ?>
                        <a href="<?= $row['face2']; ?>" target="_blank"><img src="<?= $row['face2'] ?>"
                                                                             align="absmiddle" width="100"/></a>
                    <? } ?>
                </span>
                        <div class="upload-upimg">
                            <span class="_upload_f">上传图片</span>
                            <input type="file" id="upload_face2" name="files"
                                   onchange="upload_image('face2','article')"/>
                        </div>
                    </td>
                </tr>
            </table>
            <input type="submit" class="but3" value="保存"/>
            <input type="button" class="but3" value="返回" onclick="window.history.go(-1)"/>
        </div>
    </form>
    <?
}elseif($this->func=='log'){
    ?>
    <div class="main_title">
        <span>会话管理</span>列表<?= $this->anchor('speak/log_add/?speak_id='.$_GET['speak_id'], '新增', 'class="but1"'); ?>
        <?= $this->anchor('speak', '返回列表', 'class="but1"'); ?>
        <a href="/index.php/speak/?speak_id=<?=$_GET['speak_id']?>" target="_blank" class="but1">查看效果</a>
    </div>
    <table class="table">
        <tr class="bt">
            <th>ID</th>
            <th>说话方</th>
            <th>内容</th>
            <th>图片</th>
            <th>显示时间</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        <?
        $arr_is=array('','自己','对方');
        foreach ($result as $row) {
            ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $arr_is[$row['is_self']] ?></td>
                <td><?= nl2br($row['content']) ?></td>
                <td><? if ($row['picture'] != '') { ?>
                        <a href="<?= $row['picture']; ?>" target="_blank"><img src="<?= $row['picture'] ?>"
                                                                             align="absmiddle" width="100"/></a>
                    <? } ?></td>
                <td><?= $row['time1'] ?></td>
                <td><?= $row['addtime'] ?></td>
                <td>
                    <?
                    echo $this->anchor('speak/log_edit/?id=' . $row['id'], '编辑');
                    echo '&nbsp;|&nbsp;';
                    $arr = array(
                        'onclick' => "return confirm('确定要删除吗？')"
                    );
                    echo $this->anchor("speak/log_delete/?id={$row['id']}&speak_id={$row['speak_id']}", '删除', $arr);
                    ?>
                </td>
            </tr>
        <? } ?>
    </table>
<?
}elseif ($this->func == 'log_add' || $this->func == 'log_edit') {
    ?>
    <div class="main_title">
        <span>会话管理</span><? if ($this->func == 'add') { ?>新增<? } else { ?>编辑<? } ?>
        <input type="button" class="but1" value="返回" onclick="window.history.go(-1)"/>
    </div>
    <script src="/plugin/js/ajaxfileupload.js"></script>
    <form method="post">
        <input type="hidden" name="id" value="<?= $row['id'] ?>"/>
        <div class="form1">
            <table cellpadding="6">
                <tr>
                    <td>说话者：</td>
                    <td><select name="is_self">
                            <option value="1">自己</option>
                            <option value="2" <? if($row['is_self']==2){echo 'selected';}?>>对方</option>
                        </select></td>
                </tr>
                <tr>
                    <td>内容：</td>
                    <td><textarea cols="50" rows="3" name="content"><?= $row['content'] ?></textarea></td>
                </tr>
                <tr>
                    <td>图片：</td>
                    <td>
                        <input type="text" name="picture" id="picture" value="<?= $row['picture'] ?>"/><br>
                <span id="upload_span_picture">
                    <? if ($row['picture'] != '') { ?>
                        <a href="<?= $row['picture']; ?>" target="_blank"><img src="<?= $row['picture'] ?>"
                                                                             align="absmiddle" width="100"/></a>
                    <? } ?>
                </span>
                        <div class="upload-upimg">
                            <span class="_upload_f">上传图片</span>
                            <input type="file" id="upload_picture" name="files"
                                   onchange="upload_image('picture','article')"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>时间：</td>
                    <td>
                        <input type="text" name="time1" value="<?= $row['time1'] ?>"/>
                    </td>
                </tr>
            </table>
            <input type="submit" class="but3" value="保存"/>
            <input type="button" class="but3" value="返回" onclick="window.history.go(-1)"/>
        </div>
    </form><br><br>
    注意：图片优先显示，有图片的显示图片，没有图片的才显示文字。
    <?
}
require 'footer.php';