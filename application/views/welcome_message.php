<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--MAIN-->
<div id="top">
    <img src="<?= config_item('resource_root') ?>image/character/visual.png" alt="visual" style="height: 300px;width: auto;vertical-align: bottom">
    <div id="site_title">
        <span style="font-size: 50px;">ShinyColorsPortal</span><br>
        The database and portal website of THE IDOLM@STER ShinyColors
        <div id="top_search">
            <a href="<?= config_item('root_url') ?>idol" class="button il" style="width: 160px">
                アイドル一覧
            </a>
            <a href="<?= config_item('root_url') ?>unit" class="button il" style="width: 160px">
                ユニット一覧
            </a>
            <!--<form action="<?= config_item('root_url') ?>search/idol/" method="get"
            <label><input type="search" name="name" id="idol_search" placeholder="アイドルを検索"></label>-->
            <!-- ゆるして -->
        </div>
    </div>
</div>
<main>
    <div id="sidebar">
        <h2>Information</h2>
        <h3>データ情報</h3>
        <p>
            データベース更新：<?= hsc(ConvertDateString(config_item('db_last_modified'),'ja_year')) ?>
        </p>
        <h3>システム情報</h3>
        <p>
            <?= config_item('system_name')." ".config_item('system_version') ?><br>
            on <?= $_SERVER['SERVER_NAME'] ?>
        </p>
    </div>
    <div id="mainbar">
        <h2>Welcome to ShinyColorsPortal!</h2>
        <p>
            ShinyColorsPortalへようこそ。ShinyColorsPortalは、アイドル・ユニットの情報を提供する非公式データベース・ポータルサイトです。
        </p>
        <h3>Menu</h3>
        <div class="buttonbox">
            <a href="<?= config_item('root_url') ?>idol" class="button il half">
                アイドル一覧<br>
                <span class="subtext">アイドル一覧から詳しい情報を見る</span>
            </a>
            <a href="<?= config_item('root_url') ?>unit" class="button il half">
                ユニット一覧<br>
                <span class="subtext">ユニット一覧から詳しい情報を見る</span>
            </a>
            <a href="<?= config_item('root_url') ?>info/about" class="button il half">
                このサイトについて<br>
                <span class="subtext">ShinyColorPortalの簡単な説明</span>
            </a>
            <a href="<?= config_item('root_url') ?>info/privacy" class="button il half">
                プライバシーポリシー<br>
                <span class="subtext">プライバシーに関するお約束</span>
            </a>
        </div>
        <hr>
        <div>
            <h2 style="margin-top: 5px">更新情報</h2>
            <a href="https://mstdn.miyacorata.net/@283pro" class="mstdn" target="_blank">283pro<span>mstdn.miyacorata.net</span></a>
            更新情報はmastodonより配信しております。
        </div>
        <div id="infobox">
            <?php
            $url = "https://mstdn.miyacorata.net/@283pro.atom";
            $atom = simplexml_load_file($url);
            if($atom){
                foreach ($atom->entry as $entry){
                    if(mb_strpos($entry->content,"(承前)"))continue;
                    echo "<h4>".date("Y年n月j日 H:i",strtotime($entry->published) + (60 * 60 * 9 * 0))."配信 - <a href=\"".$entry->id."\" target=\"_blank\">Mastodonで見る</a></h4>".PHP_EOL;
                    echo $entry->content.PHP_EOL;
                }
            }else{
                ?>
                <p style="padding-top: 80px;text-align: center">
                    <img src="<?= config_item('resource_root') ?>image/283.png" alt="" style="width: 150px"><br>
                    Mastodonからお知らせを取得できませんでした
                </p>
                <?php
            }
            ?>
        </div>
    </div>

</main>

