<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title><?php echo e(config('app.name')); ?></title>
    <link href="<?php echo e(asset('/css/app.css')); ?>" rel="stylesheet"/>
</head>
<body>
<?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
<?php if (!isset($__inertiaSsr)) { $__inertiaSsr = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsr instanceof \Inertia\Ssr\Response) { echo $__inertiaSsr->body; } else { ?><div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div><?php } ?>
</body>
<script src="<?php echo e(asset('/js/app.js')); ?>" defer></script>
</html>
<?php /**PATH C:\OpenServer\domains\anime-zero-recode\resources\views/app.blade.php ENDPATH**/ ?>