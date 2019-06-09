<?
// Super Admin Inline Keyboard
$superadmin_keyboard = json_encode(["inline_keyboard"=>[
  [["text"=>"✉ Send To All","callback_data"=>"sendtoall"]],
  [["text"=>"👤 Users","callback_data"=>"usercount"]],
  [["text"=>"🔗 Short Links","callback_data"=>"kuttit"]],
  [["text"=>"🔧 Update State","callback_data"=>"newupdate"]],
  [["text"=>"❓ Help","callback_data"=>"help"]],
  [["text"=>"🚪 Exit","callback_data"=>"exit"]],
]]);

// Admin Inline Keyboard
$admin_keyboard = json_encode(["inline_keyboard"=>[
  [["text"=>"✉ Send To All","callback_data"=>"sendtoall"]],
  [["text"=>"👤 Users","callback_data"=>"usercount"]],
  [["text"=>"❓ Help","callback_data"=>"help"]],
  [["text"=>"🚪 Exit","callback_data"=>"exit"]],
]]);