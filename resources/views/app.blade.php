<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ core_config('app_name') }}</title>

      <!-- Styles -->
      <link href="/css/core.css" rel="stylesheet" />
  </head>
</head>
<body class="{{ core_html('body_classes') }}">
  <div id="etigate">

  </div>
  <script charset="utf8" src="/js/core.js"></script>
</body>
</html>
