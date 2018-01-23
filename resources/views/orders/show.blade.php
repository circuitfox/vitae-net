<?php
          $file = DB::table('orders')->where('id', 5)->value('doc');

           header('Content-type: application/pdf');

           echo file_get_contents('data:application/pdf;base64,'.base64_encode($file));
echo

           ?>
