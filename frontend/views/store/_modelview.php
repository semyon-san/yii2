<?
if ($devices) : ?>
    <?php foreach ($devices as $device) : ?>
        <a href='device/index?DeviceSearch[id]=<?=$device->id?>' target="_blank" ><?=$device->id?></a>
		<br />
    <?php endforeach; ?>

<? else : ?>
    <b>Not found</b>
<? endif ?>


