# Mediatorパターン

> **相手は相談役一人だけ**

## 概要

Mediator:調停者(相談役)に全て投げる

相談役は各人からの要求をすべて受け取り、各人に指示を出す

ただし相談役は仕事の詳細についてはとやかく言わない

## 登場人物

- Mediator: 相談役。Colleagueに指示を出すインタフェース
- ConcreteMediator
- Colleage: 仕事をするインタフェース
- ConcreteColleage

## クラス図

![Mediator\_design\_pattern\.png \(634×192\)](https://upload.wikimedia.org/wikipedia/commons/e/e4/Mediator_design_pattern.png)

## やり方

## メリット(用途)

- お互いがお互いをコントロールしようとして依存し合う状況を解消できる

### 疎結合の実現

例えば、100個のオブジェクトが相互にメッセージを送りあうとする
1このオブジェクトはそれぞれが99個の相手へのアクセスを持つので、
99^2 = 9801の関係グラフ線ができるようになる。

ところがMediatorをかまして1個のオブジェクトは1人のMediatorとだけやり取りするようにすると、
Mediatorが100人のアクセスを持っていれば9700個の関係グラフ線を節約できる

## 登場人物

- メディエータ:調停者。コリーグAの相談をコリーグBに投げる
- コリーグ: 同僚。メディエータに対してだけ相談を投げる、コリーグからのメッセージを受け取る

## デメリット

Mediatorの処理は複雑になる。あらゆる調停に関する処理、すなわち個々のオブジェクトに関する情報を全て有していないといけないため。

## ソース

### Java

[include](../../patterns/dpsrc_2009-10-10/src/Mediator/Sample/LoginFrame.java)
[include](../../patterns/dpsrc_2009-10-10/src/Mediator/Sample/ColleagueCheckbox.java)
[include](../../patterns/dpsrc_2009-10-10/src/Mediator/Sample/Colleague.java)
[include](../../patterns/dpsrc_2009-10-10/src/Mediator/Sample/Main.java)
[include](../../patterns/dpsrc_2009-10-10/src/Mediator/Sample/ColleagueButton.java)
[include](../../patterns/dpsrc_2009-10-10/src/Mediator/Sample/ColleagueTextField.java)
[include](../../patterns/dpsrc_2009-10-10/src/Mediator/Sample/Mediator.java)

### PHP

[include](../../patterns/Mediator/index.php)
