# 使用 PHPUnit 來測 private property

## 原來 PHPUnit 內建就有 assertion 可以用！還搞什麼 Reflection/Closure

* 這不是測 `private method`，是測 `private property`

* 之前不小心在哪裡看到原來 PHPUnit 有內建可以 access 到 private 的函式，如下：
    - `$this->assertObjectHasAttribute('name', $target);`
    - `$this->assertAttributeEquals('Ken', 'name', $target);`

* 這個 repo 就只是為了驗證不小心哪裡看來的功能真的能用，哈。



## 本專案 PHPUnit 的引入流程

1. `mkdir yourProj && cd yourProj` 建專案目錄
1. `composer init` 如果已經存在 composer.json 的話可省去這一步
1. `composer require --dev phpunit/phpunit` 透過 composer 下載安裝 phpunit
1. `git init` 初始化一個 git repo，如果不需要版控可以省略接下來 git 開頭的指令
1. `git add .`
1. `git commit -m'init commit'`
1. `./vendor/bin/phpunit --generate-configuration` 建立 phpunit.xml
1. `mkdir src` 放 source code
1. `mkdir tests` 放 test case，記得檔案要以 `xxxxxTest.php` 結尾
1. 參考[這裡](https://goo.gl/a24270) 看看 src 和 tests 裡面寫什麼，還要記得對 `composer.json` 做 psr-4 設定
1. 寫好你的第一個 test case，[exmaple](https://goo.gl/Mz4dyR)，並執行 `./vendor/bin/phpunit` (以下簡稱「跑測試」) 應該可以看到第一個綠燈



## 新手注意事項

1. 在 `src/ToTestSetter.php` 有設 `namespace App;` 所以在 `tests/ToTestSetterTest.php` 裡要 new 的時候應該要 `$obj = new App\ToTestSetter();`，而且最上面應該要 `require __DIR__ . '/../src/ToTestSetter.php';`

2. 你會發現我 [這裡](https://goo.gl/snhUan) 在 new 的時候並沒有加上 `App\` 在前面，最上面也沒有 `require __DIR__ . '/../src/ToTestSetter.php';` 是因為三件事：
    1. 最上面用 `use App\ToTestSetter;`
    2. `composer.json` 裡設定的 `psr-4` 生效，產生正確的 `vendor/autoload.php` 檔用來自動載入 class。
    3. `phpunit.xml` 裡有設定 `bootstrap=vendor/autoload.php` 所以跑測試時自動載入 `autoload.php` ，使用 psr-4 自動類別載入機制，所以不用另在 `tests/ToTestSetterTest.php` 最上面寫 `require __DIR__ . '/../src/ToTestSetter.php';`。

3. Composer `psr-4` 使用方式速成班：
    - 參考 [這裡](https://goo.gl/fQ8fYS) 在 `composer.json` 的 `autoload` section 中設定 `App` 這個 namespace 的 root folder 是 `src/`
    - 承上設定，所有 `src/*.php` 的類別都要有 `namespace App;` 在最上面
    - 如果有子資料夾如 `src/Model/*.php`，那類別最上面要用 `namespace App\Model;`，再有子資料夾的話類推
    - 類別名稱(class name) 必須和 PHP檔名 `完全一樣`，連大小寫都要一樣，例如： `class ToTestSetter { public function __contruct() { .... } }` 就必須放在 `ToTestSetter.php` 裡面，同時類別名稱首字慣例要大寫！
    - 設定完要記得執行 `composer dump` 來產生(或更新) `vendor/autoload.php` 的內容。
    - 最大好處：以後只要 follow 上述規則，並更新 autoload.php 檔，只要 `require __DIR__ . '/../vendor/autoload.php';` 就不用以傳統方式 require 一堆其他 class 檔案。




