## 说明
整这个东西是因为我每次版本更新的原石都忘记抢，导致想起来的时候就晚了</br>
而且有时候根本抢不到，白嫖玩家手速太猛了</br>
如果使用方法看不懂，有不明白的地方我也不想解答，我也是菜批就写着玩玩的</br>
## 使用方法
打开链接[https://bbs.mihoyo.com/ys/](https://bbs.mihoyo.com/ys/)并登录</br>
按F12打开开发者工具，刷新页面，然后切换到Network，点击`ys/`，找到`cookie`并全部复制</br>
<img src="https://user-images.githubusercontent.com/75831884/139770496-803764e8-aba7-49f6-b81f-a452b2845427.png" width="500" height="300"></br>
腾讯云函数地址：[https://console.cloud.tencent.com/scf/](https://console.cloud.tencent.com/scf/)</br>
选择左侧的函数服务</br>
<img src="https://user-images.githubusercontent.com/75831884/139518833-4858dd94-59af-40a8-9414-e8ab0023ae33.png" width="500" height="300"></br>
通过新建腾讯云函数（如下图设置，其余未展示的默认即可），记得在函数配置里把超时时间拉满，应该是900秒</br>
<img src="https://user-images.githubusercontent.com/75831884/139518897-4a737823-601b-4854-a8a3-66f8455bb223.png" width="500" height="300"></br>
把index.php内的所有内容复制到腾讯云函数里，并正确填写所需参数</br>
<img src="https://user-images.githubusercontent.com/75831884/139518903-f1c66a25-5804-4d4d-b5e4-f79702e0366f.png" width="500" height="300"></br>
<img src="https://user-images.githubusercontent.com/75831884/139518912-2a413744-96d9-4ad7-b098-19d74351ebcf.png" width="500" height="300"></br>
<img src="https://user-images.githubusercontent.com/75831884/139518934-74b9cd3c-ab6f-4e13-a1bd-e91af125709b.png" width="500" height="300"></br>
最后点击完成，执行时间尽可能选择开始时间前的30即可，脚本每次执行60秒</br>
商品id可以通过抓包获取，如果只为了领原石，默认的商品id即可</br>
创建触发器，选择定时触发，触发周期选择自定义，填写cron表达式</br>
最终兑换结果是否成功可以在云函数日志里面查询，会玩的可以配合一些qq机器人把结果发送到你的qq上</br>
## cron表达式
示例：`15 07 16 12 10 * 2022` 表示2022年10月12日16时07分15秒执行脚本。</br>
## 拓展
下图是我配合[go-cqhttp](https://github.com/Mrs4s/go-cqhttp)做的把结果通知到QQ</br>
<img src="https://user-images.githubusercontent.com/75831884/138081549-f2773a4b-de5c-46e3-85ec-6d3ae0f1ae0e.png" width="500" height="300"></br>
