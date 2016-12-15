GiftWrapping拡張(プラグイン形式)

以下を適用した際の実装サンプルです。
https://github.com/EC-CUBE/ec-cube/pull/1985

## 機能概要

- 購入確認画面で、ギフトラッピングを選択できるようにする
- ギフトラッピングを選択した場合、500円の明細を追加する

## 拡張の流れ
- FormExtensionを作成
    - Shopping/OrderTypeをExtendして項目追加

- Calclatorを作成
    - ギフトラッピングを選択した場合に+500円の明細を作る

## 実装コード
- Form/Extension/GiftExtension
  - 購入確認画面へギフトラッピングの選択項目を追加
- Calc/GiftStrategy
  - ギフトラッピングが選択されている場合に明細の追加を行う
- ServiceProvider/GiftServiceProvider
  - CalclationContextにStrategyを追加する
