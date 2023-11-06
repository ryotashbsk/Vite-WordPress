export default [
  {
    name: 'subject',
    label: 'お問い合わせ内容',
    type: 'checkbox',
    checkboxes: ['ホテルについて', 'イベント開催について', '採用について', 'ボランティアについて', '取材について', 'その他'],
    required: true
  },
  {
    name: 'belongs',
    label: '所属名',
    type: 'text',
    required: false,
    placeholder: '○○株式会社・○○学校'
  },
  {
    name: 'name',
    label: 'お名前(漢字)',
    type: 'text',
    required: true,
    placeholder: 'ホテル 一郎'
  },
  {
    name: 'kana',
    label: 'お名前(ひらがな)',
    type: 'text',
    required: true,
    placeholder: 'ほてる いちろう'
  },
  {
    name: 'address',
    label: '住所',
    type: 'text',
    required: false,
    placeholder: '宮城県仙台市青葉区〇〇マンション〇号室'
  },
  {
    name: 'email',
    label: 'E-mail アドレス',
    type: 'email',
    required: true,
    placeholder: '半角英数字'
  },
  {
    name: 'email_confirm',
    label: 'E-mail アドレス(再入力)',
    type: 'email',
    required: true,
    placeholder: '上記と同じアドレスをご入力ください'
  },
  {
    name: 'tel',
    label: '電話番号',
    type: 'tel',
    required: true,
    placeholder: '半角数字'
  },
  {
    name: 'message',
    label: 'お問い合わせ内容',
    type: 'textarea',
    required: true,
    placeholder: '内容はできるだけ詳しくご入力ください'
  }
];
