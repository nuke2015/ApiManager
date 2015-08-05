<?php
    defined('API') or exit('http://gwalker.cn');
    define('BASEURL',baseUrl());
    //接口分类id
   if(empty($id)){$id = I($_GET['id']);}
   $aid = I($_GET['tag']);
   //得到数据的详情信息start
   $sql = "select * from api where aid='{$aid}' and isdel=0";
   $info = select($sql);
   if(count($info)){
        foreach ($info as $key => &$value) {
            $value['parameter']=unserialize($value['parameter']);
        }
        unset($value);
    }
    $date=date("Y-m-d_H:i:s");
    //修改文件头
    header("Content-type:application/json");
    header("Content-Disposition:attachment;filename=postman{$date}.json");


?>
{
    "id": "api_1",
    "name": "API",
    "timestamp": <?php echo time(); ?>690,
    "requests": [
    <?php foreach ($info as $key => $value): ?>
        {
            "collectionId": "api_1",
            "id": "<?php echo $value['id']; ?>",
            "name": "<?php echo $value['name']; ?>",
            "description": "",
            "url": "<?php echo $value['url']; ?>",
            "method": "<?php echo strtoupper($value['type']); ?>",
            "headers": "",
            "data": [
            <?php foreach ($value['parameter']['name'] as $key1=>$para): ?>
                {
                    "key": "<?php echo $para ?>",
                    "value": "<?php echo $value['parameter']['default'][$key1]; ?>",
                    "type": "text"
                }<?php if($key1!=count($value['parameter']['name'])-1){echo ",";} ?>
            <?php endforeach; ?>
            ],
            "dataMode": "params",
            "timestamp": 0,
            "responses": [],
            "version": 2
        }<?php if($key!=count($info)-1){echo ",";} ?>
    <?php endforeach; ?>
    ]
}
