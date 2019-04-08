# ajax-Demo
jquery 的 *ajax* 跨域使用 *php* 对数据库进行增删改查


---

## 项目介绍
* 此项目是本人第一个小项目，业务逻辑简单，供新手参考学习，了解跨域的实现
* 此项目注释内有原生 ```ajax``` 跨域实现了 ```get post``` 请求
* ```jquery $.ajax``` 实现 ```get post put delete``` 请求发送数据与接受返回数据
* ```put delete```Postman无法测试
* 数据库仅一表
## 快速开始
1. 将项目根目录下的 staffsql.sql导入MySQL
2. phpstudy设置站点域名
	1. MySQL管理器->站点域名管理
	2. 前端网站域：```ajax.me``` | 后端网站域：```ajax.php.me```
	3. 新增网站目
		* 前端：项目目录\index.html
		* 后端：项目目录\Result
	4. 点击保存设置并生成配置文件
	5. 打开hosts 添加内容
		* ```127.0.0.1    ajax.me```
		* ```127.0.0.1    ajax.php.me```
	6. 打开网址```ajax.me```
	7. **Tips:请修改linkStaffsql链接数据库的参数**
## 文件注解
### index.html
> 网址前端主入口
>> 员工查询，员工创建，员工信息更改，员工信息删除
>>> ```put delete```使用```file_get_contents("php://input")```获取数据
### Result DIR
#### service.php
>判断请求头实现增删改查并且返回数据
#### Staff.php
>数据库的链接，数据库增删改查
>>Tips:请修改```linkStaffsql```链接数据库的参数

## 开源协议
根据MIT许可证发布
