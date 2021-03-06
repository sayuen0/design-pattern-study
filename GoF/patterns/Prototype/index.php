<?php

/**
 * クローンをいじろうが元のオブジェクトに影響を与えない
 * 
 * PHPにはもともとcloneの機能があるのでそれを用いる
 * cloneの機能がない言語においては
 * 明示的に深いコピーをしたインスタンスを返す
 * つまり、ディープコピーしないと予期せぬバグの原因になりますよということ
 * 
 * 
 */






class Prototype
{
  private $values = array();
  public function __set($key, $val)
  {
    $this->values[$key]   = $val;
  }

  public function __get($key)
  {
    return $this->values[$key];
  }

  /**
   * phpのコピーはシャローコピーなので
   * 深いコピーを作成するためにマジックメソッドcloneを作る
   * 
   */
  public function __clone()
  {
    foreach ($this->values as $key => $val) {
      if (is_object($val)) {
        $this->key = clone $val;
      } else {
        $this->key = $val;
      }
    }
  }
}


class Child
{
  private $values = array();
  public function __set($key, $val)
  {
    $this->values[$key] = $val;
  }

  public function __get($key)
  {
    return $this->values[$key];
  }
}


function say($i)
{
  print "$i <br>";
}


// オリジナル作成

$originalObj = new Prototype();
$originalObj->hoge = "fuga";
$cloneObj = clone $originalObj;
say($originalObj->hoge === $cloneObj->hoge ? "OK" : "NG"); //OK


// クローンにピヨを代入
$cloneObj->hoge = "piyo";

//クローンにはhogeがあって、
// オリジナルにはpiyoがある
say($originalObj->hoge == $cloneObj->hoge  ? "OK" : "NG"); //NG;

var_dump($originalObj->hoge);
var_dump($cloneObj->hoge);

$originalObj->child = new Child();
$originalObj->child->xyzzy = "vim";
$cloneObj  = clone $originalObj;
say($originalObj->child->xyzzy == $cloneObj->child->xyzzy ? "OK" : "NG"); //OK

// cloneのchildのxyzzyにemacsを代入

$cloneObj->child->xyzzy = "emacs";

// オリジナルとクローンが正しくディープコピーされている
// マジックメソッドcloneを上書きしておかないと
// オリジナルもemacsになるので気をつける
// 以下は、Childには__cloneしてないので、
// childのプロパティがシャローコピーされてしまった例
say($originalObj->child->xyzzy == "vim" ? "OK" : "NG"); // NG
say($cloneObj->child->xyzzy == "emacs" ? "OK" : "NG"); //OK

var_dump($originalObj->child);
var_dump($cloneObj->child);
