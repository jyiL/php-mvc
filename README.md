## php mvc 框架

#### 请确保你的服务器满足以下要求
* PHP >= 7.3
* OpenSSL PHP 拓展
* PDO PHP 拓展

### 安装
    git clone git@github.com:jyiL/php-mvc.git
    
    # 修改数据库配置
    vi config/config.php
    
    # 修改index.php文件下的APP_URL
    APP_URL = domain
    
    chmod +x install.sh
    
    # 创建数据库表
    ./install.sh or php install.php
    
* `注意：windows系统建议执行php install.php`
    
### Browse（浏览器）
    http://domain
    
## TODO
- [x] 登陆（/admin/user/login）
- [x] 注册（/admin/user/register）
- [x] 分类管理（/admin/category/list）
